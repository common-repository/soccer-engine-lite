<?php
/**
 * This file includes a class that generates a back-end menus based on the provided data.
 *
 * @package soccer-engine-lite
 */

/**
 * This class generates a back-end menus based on the provided data.
 */
class Daextsoenl_Menu {

	private $edit_mode;
	private $edit_id;
	private $item_obj;
	private $dismissible_notice_a = array();
	private $update_id;
	private $invalid_data;
	private $blocking_condition_active;
	public $shared;
	public $settings = array();
	public $values   = array();

	public function __construct( $shared ) {

		// assign an instance of Daextsoenl_Shared
		$this->shared = $shared;
	}

	public function create_update_database_table() {

		if ( isset( $_POST['update_id'] ) || isset( $_POST['form_submitted'] ) ) {

			// Nonce verification.
			check_admin_referer( 'daextsoenl_create_update_' . $this->settings['database_table_name'], 'daextsoenl_create_update_' . $this->settings['database_table_name'] . '_nonce' );

			// Sanitization -------------------------------------------------------------------------------------------.
			if ( isset( $_POST['update_id'] ) ) {
				$this->update_id = intval( $_POST['update_id'], 10 );
			}

			foreach ( $this->settings['fields'] as $key => $field ) {

				if ( isset( $field['unsaved'] ) and $field['unsaved'] ) {
					continue;
				}

				switch ( $field['type'] ) {

					case 'date':
						if ( strlen( trim( $_POST[ $field['column'] ] ) ) === 0 ) {
							$this->values[ $field['column'] ] = null;
						} else {
							$this->values[ $field['column'] ] = trim( sanitize_text_field( $_POST[ $field['column'] . '_alt_field' ] ) );
						}

						break;

					case 'select-multiple':
						if ( isset( $_POST[ $field['column'] ] ) ) {
							$this->values[ $field['column'] ] = maybe_serialize( sanitize_text_field( $_POST[ $field['column'] ] ) );
						} else {
							$this->values[ $field['column'] ] = '';
						}
						break;

					case 'text':
					case 'select':
					case 'image':
					case 'color':
					case 'time':
						$this->values[ $field['column'] ] = trim( sanitize_text_field( $_POST[ $field['column'] ] ) );
						break;

				}
			}

			// Validation ---------------------------------------------------------------------------------------------
			foreach ( $this->settings['fields'] as $key => $field ) {

				if ( isset( $field['unsaved'] ) && $field['unsaved'] ) {
					continue;
				}

				// Validation Function.
				if ( isset( $field['validation_function'] ) ) {
					foreach ( $field['validation_function'] as $key1 => $validation_function ) {

						$validation_failed = false;
						if ( is_callable( $validation_function['function'] ) ) {

							// Use the provided validation function.
							if ( ! call_user_func(
								$validation_function['function'],
								$this->values[ $field['column'] ]
							) ) {
								$validation_failed = true;

							}
						} else {

							// Use ready to use validation functions included in the framework.
							if ( ! $this->{$validation_function['function']}( $this->values[ $field['column'] ] ) ) {
								$validation_failed = true;
							}
						}

						if ( $validation_failed ) {

							$this->dismissible_notice_a[] = array(
								'message' => $validation_function['message'],
								'class'   => 'error',
							);

							$this->invalid_data = true;

						}
					}
				}

				// Validation Regex.
				if ( isset( $field['validation_regex'] ) ) {
					foreach ( $field['validation_regex'] as $key1 => $validation_regex ) {
						if ( preg_match( $validation_regex['regex'], $this->values[ $field['column'] ] ) !== 1 ) {

							$this->dismissible_notice_a[] = array(
								'message' => $validation_regex['message'],
								'class'   => 'error',
							);

							$this->invalid_data = true;

						}
					}
				}
			}

			// Custom Validation --------------------------------------------------------------------------------------.
			if ( isset( $this->settings['custom_validation'] ) ) {
				$custom_validation_result = $this->{$this->settings['custom_validation']}( $this->values, $this->update_id );
				if ( $custom_validation_result['status'] !== true ) {
					$this->invalid_data = true;
					foreach ( $custom_validation_result['messages'] as $message ) {

						$this->dismissible_notice_a[] = array(
							'message' => $message,
							'class'   => 'error',
						);

					}
				}
			}

			// Update Existing Record -------------------------------------------------------------------------------------.
			if ( isset( $_POST['update_id'] ) and ! isset( $this->invalid_data ) ) {

				// Update the database.
				global $wpdb;
				$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];

				$query = "UPDATE $table_name SET ";

				$array_for_prepare = array();
				foreach ( $this->settings['fields'] as $key => $field ) {

					if ( isset( $field['unsaved'] ) && $field['unsaved'] ) {
						continue;}

					if ( $field['type'] !== 'group-trigger' ) {

						$query .= $field['column'] . ' = ';

						$query .= '%' . $field['query_placeholder_token'];

						if ( ( $key + 1 ) < count( $this->settings['fields'] ) ) {
							$query .= ',';
						}

						$array_for_prepare[] = $this->values[ $field['column'] ];

					}
				}

				$query .= ' WHERE ' . $this->settings['database_column_primary_key'] . ' = %d';

				$array_for_prepare[] = intval( $_POST['update_id'], 10 );

				$safe_sql = $wpdb->prepare(
					$query,
					$array_for_prepare
				);

				$query_result = $wpdb->query( $safe_sql );

				if ( $query_result !== false ) {
					$this->dismissible_notice_a[] = array(
						'message' => $this->settings['label_item_updated'],
						'class'   => 'updated',
					);
				}
			} else {

				// Add New Record -----------------------------------------------------------------------------------------.
				if ( isset( $_POST['form_submitted'] ) and ! isset( $this->invalid_data ) ) {

					// Insert into the database.
					global $wpdb;
					$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];

					$query = "INSERT INTO $table_name SET ";

					$array_for_prepare = array();
					foreach ( $this->settings['fields'] as $key => $field ) {

						if ( isset( $field['unsaved'] ) && $field['unsaved'] ) {
							continue;}

						if ( $field['type'] !== 'group-trigger' ) {

							$query .= $field['column'] . ' = ';

							$query .= '%' . $field['query_placeholder_token'];

							if ( ( $key + 1 ) < count( $this->settings['fields'] ) ) {
								$query .= ',';
							}

							$array_for_prepare[] = $this->values[ $field['column'] ];

						}
					}

					$safe_sql = $wpdb->prepare(
						$query,
						$array_for_prepare
					);

					$query_result = $wpdb->query( $safe_sql );

					if ( $query_result !== false ) {
						$this->dismissible_notice_a[] = array(
							'message' => $this->settings['label_item_added'],
							'class'   => 'updated',
						);
					}
				}
			}

		}

	}

	public function process_incoming_data() {

		// Delete the item.
		if ( isset( $_POST['delete_id'] ) ) {

			// Nonce verification.
			check_admin_referer( 'daextsoenl_delete_' . $this->settings['database_table_name'], 'daextsoenl_delete_' . $this->settings['database_table_name'] . '_nonce' );

			$delete_id = intval( $_POST['delete_id'], 10 );
			$deletable = $this->shared->{'check_deletable'}( $this->settings['database_table_name'], $delete_id );

			if ( ! $deletable['status'] ) {

				$this->dismissible_notice_a[] = array(
					'message' => $deletable['message'],
					'class'   => 'error',
				);

			} else {

				global $wpdb;
				$table_name   = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
				$safe_sql     = $wpdb->prepare( "DELETE FROM $table_name WHERE " . $this->settings['database_column_primary_key'] . ' = %d ', $delete_id );
				$query_result = $wpdb->query( $safe_sql );

				if ( $query_result !== false ) {

					$this->dismissible_notice_a[] = array(
						'message' => $this->settings['label_item_deleted'],
						'class'   => 'updated',
					);

				}
			}
		}

		// Clone the item.
		if ( $this->settings['enable_clone_button'] and isset( $_POST['clone_id'] ) ) {

			global $wpdb;
			$clone_id = intval( $_POST['clone_id'], 10 );

			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
			$wpdb->query( "CREATE TEMPORARY TABLE daextsoenl_temporary_table SELECT * FROM $table_name WHERE " . $this->settings['database_column_primary_key'] . " = $clone_id" );
			$wpdb->query( 'UPDATE daextsoenl_temporary_table SET ' . $this->settings['database_column_primary_key'] . ' = NULL' );
			$wpdb->query( "INSERT INTO $table_name SELECT * FROM daextsoenl_temporary_table" );
			$wpdb->query( 'DROP TEMPORARY TABLE IF EXISTS daextsoenl_temporary_table' );

		}

		// Determine if we are in edit mode.
		if ( isset( $_GET['edit_id'] ) ) {
			$this->edit_mode = true;
			$this->edit_id   = intval( $_GET['edit_id'], 10 );
		} else {
			$this->edit_mode = false;
		}

		// If we are in edit mode get the item data
		if ( $this->edit_mode ) {
			global $wpdb;
			$table_name     = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
			$safe_sql       = $wpdb->prepare( "SELECT * FROM $table_name WHERE " . $this->settings['database_column_primary_key'] . ' = %d ', $this->edit_id );
			$this->item_obj = $wpdb->get_row( $safe_sql );
		}
	}

	public function generate_header_html() {

		?>

		<div id="daext-header-wrapper" class="daext-clearfix">

			<h2><?php echo esc_html( $this->settings['plugin_name'] ) . '&nbsp' . '-' . '&nbsp' . esc_html( $this->settings['label_plural'] ); ?></h2>

			<form action="admin.php" method="get" id="daext-search-form">

				<input type="hidden" name="page" value="daextsoenl-<?php echo esc_attr( $this->settings['url_slug'] ); ?>">

				<p><?php echo esc_html( $this->settings['label_perform_your_search'] ); ?></p>

				<?php

				// phpcs:disable -- Nonce non-necessary for data visualization.
				if(isset($_GET['s'])){

					if ( mb_strlen( trim( $_GET['s'] ) ) > 0 ) {
						$search_string = sanitize_text_field( $_GET['s'] );
					} else {
						$search_string = '';
					}

				}else{

					$search_string = '';

				}
				// phpcs:enable

				?>

				<input type="text" name="s"
						value="<?php echo esc_attr( stripslashes( $search_string ) ); ?>" autocomplete="off" maxlength="255">
				<input type="submit" value="">

			</form>

		</div>

		<?php
	}

	public function generate_blocking_messages() {

		if ( isset( $this->settings['blocking_conditions'] ) ) {

			foreach ( $this->settings['blocking_conditions'] as $key => $blocking_condition ) {

				if ( $blocking_condition['status'] ) {

					$this->blocking_condition_active = true;

					$this->display_blocking_condition_message( $blocking_condition['code'] );

				}
			}
		}
	}

	public function generate_paginated_table_html() {

		if ( $this->blocking_condition_active ) {
			return;}

		if ( count( $this->dismissible_notice_a ) > 0 ) {
			foreach ( $this->dismissible_notice_a as $key => $dismissible_notice ) {
				echo '<div class="' . esc_attr( $dismissible_notice['class'] ) . ' settings-error notice is-dismissible below-h2"><p>' . esc_html( $dismissible_notice['message'] ) . '</p></div>';
			}
		}

		?>

		<!-- table -->

		<?php

		$filter = '';

		// Create the query part used to filter the results when a search is performed.

		if(isset($_GET['s'])){

			// phpcs:ignore -- Nonce non-necessary for data visualization.
			if ( mb_strlen( trim( $filter ) ) === 0 and mb_strlen( trim( $_GET['s'] ) ) > 0 ) {
				$search_string = sanitize_text_field( $_GET['s'] );
				global $wpdb;

				$query = 'WHERE (';

				$searchable_fields = array();
				foreach ( $this->settings['fields'] as $key => $field ) {
					if ( isset( $field['searchable'] ) and $field['searchable'] ) {
						$searchable_fields[] = $field;
					}
				}

				$array_for_prepare = array();

				// Add the ID field.
				$query              .= $this->settings['database_table_name'] . '_id LIKE %s';
				$array_for_prepare[] = '%' . $search_string . '%';

				// Add the searchable fields.
				foreach ( $searchable_fields as $key => $field ) {

					$query              .= 'OR ' . $field['column'] . ' LIKE %' . $field['query_placeholder_token'];
					$array_for_prepare[] = '%' . $search_string . '%';

				}

				$query .= ')';

				$filter = $wpdb->prepare( $query, $array_for_prepare );

			}

		}

		// Retrieve the total number of items.
		global $wpdb;
		$table_name  = $wpdb->prefix . $this->shared->get( 'slug' ) . '_' . $this->settings['database_table_name'];
		$total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name $filter" );

		// Initialize the pagination class.
		require_once $this->shared->get( 'dir' ) . '/admin/inc/class-daextsoenl-pagination.php';
		$pag = new daextsoenl_pagination();
		$pag->set_total_items( $total_items );// Set the total number of items
		$pag->set_record_per_page( $this->settings['pagination_items'] ); // Set records per page
		$pag->set_target_page( 'admin.php?page=' . $this->shared->get( 'slug' ) . '-' . $this->settings['url_slug'] );// Set target page
		$pag->set_current_page();// set the current page number from $_GET

		?>

		<!-- Query the database -->
		<?php
		$query_limit = $pag->query_limit();
		$results     = $wpdb->get_results(
			"SELECT * FROM $table_name $filter ORDER BY " . $this->settings['database_column_primary_key'] . " DESC $query_limit",
			ARRAY_A
		);
		?>

		<?php if ( count( $results ) > 0 ) : ?>

			<div class="daext-items-container">

				<!-- list of tables -->
				<table class="daext-items">
					<thead>
					<tr>

						<?php foreach ( $this->settings['pagination_columns'] as $pagination_column ) : ?>
							<th>
								<div><?php echo esc_html( $pagination_column['label'] ); ?></div>
								<div class="help-icon" title="<?php echo esc_attr( $pagination_column['tooltip'] ); ?>"></div>
							</th>
						<?php endforeach; ?>

						<th></th>
					</tr>
					</thead>
					<tbody>

					<?php foreach ( $results as $result ) : ?>
						<tr>

							<?php foreach ( $this->settings['pagination_columns'] as $pagination_column ) : ?>
								<?php if ( isset( $pagination_column['filter'] ) ) : ?>
									<td>
										<?php
											$value = $this->shared->{$pagination_column['filter']}( $result[ $pagination_column['database_column'] ], $result );
											echo esc_html( $value );
										?>
									</td>
								<?php else : ?>
									<td><?php echo esc_html( stripslashes( $result[ $pagination_column['database_column'] ] ) ); ?></td>
								<?php endif; ?>

							<?php endforeach; ?>

							<td class="icons-container"
								<?php if ( $this->settings['enable_clone_button'] ) : ?>
									style="width: 76px !important; min-width: 76px !important;"
								<?php endif; ?>
							>
								<?php if ( $this->settings['enable_clone_button'] ) : ?>
									<form method="POST"
											action="admin.php?page=<?php echo esc_attr( $this->shared->get( 'slug' ) ); ?>-<?php echo esc_attr( $this->settings['url_slug'] ); ?>">
										<input type="hidden" name="clone_id" value="<?php echo esc_attr( $result[ $this->settings['database_column_primary_key'] ] ); ?>">
										<input class="menu-icon clone help-icon" type="submit" value="">
									</form>
								<?php endif; ?>
								<a class="menu-icon edit"
									href="admin.php?page=<?php echo esc_attr( $this->shared->get( 'slug' ) ); ?>-<?php echo esc_attr( $this->settings['url_slug'] ); ?>&edit_id=<?php echo esc_attr( $result[ $this->settings['database_column_primary_key'] ] ); ?>"></a>
								<form id="form-delete-<?php echo esc_attr( $result[ $this->settings['database_column_primary_key'] ] ); ?>" method="POST"
										action="admin.php?page=<?php echo esc_attr( $this->shared->get( 'slug' ) ); ?>-<?php echo esc_attr( $this->settings['url_slug'] ); ?>">
									<?php wp_nonce_field( 'daextsoenl_delete_' . $this->settings['database_table_name'], 'daextsoenl_delete_' . $this->settings['database_table_name'] . '_nonce' ); ?>
									<input type="hidden" value="<?php echo esc_attr( $result[ $this->settings['database_column_primary_key'] ] ); ?>"
											name="delete_id">
									<input class="menu-icon delete" type="submit" value="">
								</form>
							</td>
						</tr>
					<?php endforeach; ?>

					</tbody>

				</table>

			</div>

			<!-- Display the pagination -->
			<?php if ( $pag->total_items > 0 ) : ?>
				<div class="daext-tablenav daext-clearfix">
					<div class="daext-tablenav-pages">
						<span class="daext-displaying-num"><?php echo esc_html($pag->total_items); ?>
							&nbsp<?php esc_attr_e( 'items', 'soccer-engine-lite' ); ?></span>
						<?php $pag->show(); ?>
					</div>
				</div>
			<?php endif; ?>

		<?php else : ?>

			<?php

			if ( mb_strlen( trim( $filter ) ) > 0 ) {
				echo '<div class="error settings-error notice is-dismissible below-h2"><p>' . esc_html( $this->settings['label_no_results_match_filter'] ) . '</p></div>';
			}

			?>

		<?php endif; ?>

		<?php
	}

	public function generate_form_html() {

		$this->shared->set_met_and_ml();

		if ( $this->blocking_condition_active ) {
			return;}

		?>

		<div>

			<form method="POST" action="admin.php?page=<?php echo esc_attr( $this->shared->get( 'slug' ) ); ?>-<?php echo esc_attr( $this->settings['url_slug'] ); ?>" autocomplete="off">

				<input type="hidden" value="1" name="form_submitted">
				<?php wp_nonce_field( 'daextsoenl_create_update_' . $this->settings['database_table_name'], 'daextsoenl_create_update_' . $this->settings['database_table_name'] . '_nonce' ); ?>

				<div class="daext-form-container">

					<div class="daext-form-title">
						<?php if ( $this->edit_mode ) : ?>
							<?php echo esc_html( $this->settings['label_edit_item'] ) . '&nbsp' . intval( $this->edit_id, 10 ); ?>
						<?php else : ?>
							<?php echo esc_html( $this->settings['label_create_new_item'] ); ?>
						<?php endif; ?>

					</div>

					<table class="daext-form daext-form-table">

						<?php if ( $this->edit_mode ) : ?>
							<input type="hidden" name="update_id" value="<?php echo esc_attr( $this->item_obj->{$this->settings['database_column_primary_key']} ); ?>"/>
						<?php endif; ?>

						<?php foreach ( $this->settings['fields'] as $key => $field ) : ?>

							<?php

							if ( $field['type'] !== 'group-trigger' ) {
								if ( isset( $field['class'] ) ) {
									$container_classes = $field['class'] . ' ' . 'display-none';
								} else {
									$container_classes = 'tr_' . $field['column'];
								}
							}

							switch ( $field['type'] ) {

								// Group Trigger ----------------------------------------------------------------------.
								case 'group-trigger':
									?>

									<tr class="group-trigger" data-trigger-target="<?php echo esc_attr( $field['target'] ); ?>">
										<th class="group-title"><?php echo esc_html( $field['label'] ); ?></th>
										<td>
											<div class="expand-icon"></div>
										</td>
									</tr>

									<?php

									break;

								// Input Text ---------------------------------------------------------------------------------------.
								case 'text':
									?>

									<tr class="<?php echo esc_attr( $container_classes ); ?>">
										<th><label for="<?php echo esc_attr( $field['column'] ); ?>"><?php echo esc_html( $field['label'] ); ?><?php esc_html( $this->generate_optional_label( $field ) ); ?></label></th>
										<td>
											<input type="text" id="<?php echo esc_attr( $field['column'] ); ?>" maxlength="<?php echo esc_attr( $field['maxlength'] ); ?>" size="30" name="<?php echo esc_attr( $field['column'] ); ?>"
											<?php if ( $this->edit_mode ) : ?>
												value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
											<?php else : ?>
												<?php if ( isset( $field['value'] ) ) : ?>
													value="<?php echo esc_attr( $field['value'] ); ?>"
												<?php endif; ?>
											<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

								// Select -------------------------------------------------------------------------------------------.
								case 'select':
									?>

									<tr class="<?php echo esc_attr($container_classes); ?>">
										<th scope="row"><label for="title"><?php echo esc_html( $field['label'] ); ?><?php esc_html( $this->generate_optional_label( $field ) ); ?></label></th>
										<td>
											<select id="<?php echo esc_attr( $field['column'] ); ?>" name="<?php echo esc_attr( $field['column'] ); ?>" class="daext-display-none">
												<?php

												foreach ( $field['select_items'] as $item ) {
													if ( $this->edit_mode and ! isset( $field['unsaved'] ) or
														( isset( $field['unsaved'] ) and $field['unsaved'] === false ) ) {
														$select = (string) $this->item_obj->{$field['column']} === (string) $item['value'] ? 'selected' : '';
													} else {
														$select = $item['selected'] ? 'selected' : '';
													}
													echo '<option value="' . esc_attr( $item['value'] ) . '" ' . esc_attr($select) . '>' . esc_html( $item['text'] ) . '</option>';
												}

												?>
											</select>
											<div class="help-icon" title='<?php echo esc_attr( $field['tooltip'] ); ?>'></div>

										</td>
									</tr>

									<?php

									break;

								// Select Multiple ----------------------------------------------------------------------.
								case 'select-multiple':
									?>

									<tr class="<?php echo esc_attr($container_classes); ?>">
										<th scope="row"><label for="title"><?php echo esc_html( $field['label'] ); ?><?php esc_html( $this->generate_optional_label( $field ) ); ?></label></th>
										<td>
											<select id="<?php echo esc_attr( $field['column'] ); ?>" name="<?php echo esc_attr( $field['column'] ); ?>[]" class="daext-display-none" multiple>
												<?php

												foreach ( $field['select_items'] as $item ) {
													if ( $this->edit_mode ) {

														$this->item_obj->{$field['column']} = maybe_unserialize( $this->item_obj->{$field['column']} );
														if ( is_array( $this->item_obj->{$field['column']} ) and in_array( $item['value'], $this->item_obj->{$field['column']} ) ) {
															$select = 'selected="selected"';
														} else {
															$select = '';
														}
													} elseif ( is_array( $field['select_default_items'] ) and in_array( $item['value'], $field['select_default_items'] ) ) {

															$select = 'selected';
													} else {
														$select = '';
													}
													echo '<option value="' . esc_attr( $item['value'] ) . '" ' . esc_attr($select) . '>' . esc_html( $item['text'] ) . '</option>';
												}

												?>
											</select>
											<div class="help-icon" title='<?php echo esc_attr( $field['tooltip'] ); ?>'></div>

										</td>
									</tr>

									<?php

									break;

								// Date ---------------------------------------------------------------------------------.
								case 'date':
									?>

									<tr class="<?php echo esc_attr( $container_classes ); ?>">
										<th><label for="title"><?php echo esc_attr( $field['label'] ); ?><?php $this->generate_optional_label( $field ); ?></label></th>
										<td>
											<input type="text" id="<?php echo esc_attr( str_replace( '_', '-', $field['column'] ) ); ?>" maxlength="100" size="30" name="<?php echo esc_attr( $field['column'] ); ?>"

											/>
											<input type="hidden" id="<?php echo esc_attr( str_replace( '_', '-', $field['column'] ) ); ?>-alt-field" name="<?php echo esc_attr( $field['column'] ); ?>_alt_field"
												<?php if ( $this->edit_mode ) : ?>
													value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
												<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

								// Time ---------------------------------------------------------------------------------.
								case 'time':
									?>

									<tr class="<?php echo esc_attr( $container_classes ); ?>">
										<th><label for="title"><?php echo esc_html( $field['label'] ); ?><?php esc_html( $this->generate_optional_label( $field ) ); ?></label></th>
										<td>
											<input type="text" id="<?php echo esc_attr( $field['column'] ); ?>" maxlength="<?php echo esc_attr( $field['maxlength'] ); ?>" size="30" name="<?php echo esc_attr( $field['column'] ); ?>"
												<?php if ( $this->edit_mode ) : ?>
													value="<?php echo esc_attr( $this->shared->format_time( stripslashes( $this->item_obj->{$field['column']} ) ) ); ?>"
												<?php else : ?>
													<?php if ( isset( $field['value'] ) ) : ?>
														value="<?php echo esc_attr( $this->shared->format_time( stripslashes( $field['value'] ) ) ); ?>"
													<?php endif; ?>
												<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

								// Image --------------------------------------------------------------------------------.
								case 'image':
									?>

									<tr class="<?php echo esc_attr( $container_classes ); ?>">
										<th scope="row"><label for="<?php echo esc_attr( $field['column'] ); ?>"><?php echo esc_html( $field['label'] ); ?><?php esc_html( $this->generate_optional_label( $field ) ); ?></label></th>
										<td>

											<div class="image-uploader">
												<img class="selected-image"
													<?php if ( $this->edit_mode ) : ?>
														src="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
														<?php echo strlen( trim( $this->item_obj->{$field['column']} ) ) == 0 ? 'style="display: none;"' : ''; ?>
													<?php else : ?>
														src=""
														style="display: none"
													<?php endif; ?>
												>
												<input
													type="hidden"
													id="<?php echo esc_attr( $field['column'] ); ?>"
													maxlength="2083"
													name="<?php echo esc_attr( $field['column'] ); ?>"
													<?php if ( $this->edit_mode ) : ?>
														value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
													<?php endif; ?>
												>
												<a class="button_add_media"
													<?php if ( $this->edit_mode ) : ?>
													data-set-remove="<?php echo strlen( trim( $this->item_obj->{$field['column']} ) ) == 0 ? 'set' : 'remove'; ?>"
													data-set="<?php echo esc_attr( $field['set_image'] ); ?>"
													data-remove="<?php echo esc_attr( $field['remove_image'] ); ?>"
												>
														<?php echo strlen( trim( $this->item_obj->{$field['column']} ) ) == 0 ? esc_attr__( $field['set_image'] ) : esc_attr__( $field['remove_image'] ); ?>
												</a>
													<?php else : ?>
														data-set="<?php echo esc_attr( $field['set_image'] ); ?>"
														data-remove="<?php echo esc_attr( $field['remove_image'] ); ?>"
														data-set-remove="set"><?php echo esc_attr( $field['set_image'] ); ?></a>
													<?php endif; ?>
												<p class="description"><?php echo esc_attr( $field['instructions'] ); ?></p>
											</div>

										</td>
									</tr>

									<?php

									break;

								// Color --------------------------------------------------------------------------------.
								case 'color':
									?>

									<tr class="<?php echo esc_attr( $container_classes ); ?>">
										<th><label for="title"><?php echo esc_attr( $field['label'] ); ?><?php esc_html( $this->generate_optional_label( $field ) ); ?></label></th>
										<td>
											<input type="text" id="<?php echo esc_attr( $field['column'] ); ?>" class="wp-color-picker" maxlength="7" size="30" name="<?php echo esc_attr( $field['column'] ); ?>"
												<?php if ( $this->edit_mode ) : ?>
													value="<?php echo esc_attr( stripslashes( $this->item_obj->{$field['column']} ) ); ?>"
												<?php else : ?>
													<?php if ( isset( $field['value'] ) ) : ?>
														value="<?php echo esc_attr( $field['value'] ); ?>"
													<?php endif; ?>
												<?php endif; ?>
											/>
											<div class="help-icon" title="<?php echo esc_attr( $field['tooltip'] ); ?>"></div>
										</td>
									</tr>

									<?php

									break;

							}

							?>

						<?php endforeach; ?>

					</table>

					<!-- submit button -->
					<div class="daext-form-action">
						<input class="button" type="submit"
							<?php if ( $this->edit_mode ) : ?>
								value="<?php echo esc_attr( $this->settings['label_update_item'] ); ?>"
							<?php else : ?>
								value="<?php echo esc_attr( $this->settings['label_add_item'] ); ?>"
							<?php endif; ?>
						>
						<input id="cancel" class="button" type="submit" value="<?php echo esc_attr( $this->settings['label_cancel_item'] ); ?>"
						data-url="<?php menu_page_url( $this->shared->get( 'slug' ) . '-' . $this->settings['url_slug'] ); ?>"
						>
					</div>

				</div>

			</form>

		</div>

		<?php
	}

	public function generate_menu() {

		$this->process_incoming_data();
		$this->create_update_database_table();

		?>

		<div class="wrap">

			<?php $this->generate_header_html(); ?>

			<div id="daext-menu-wrapper" class="daext-menu-wrapper-<?php echo esc_attr( $this->settings['url_slug'] ); ?>">

				<?php

				$this->generate_blocking_messages();
				$this->generate_paginated_table_html();
				$this->generate_form_html();

				?>

			</div><!-- #daext-menu-wrapper -->

		</div><!-- .wrap -->

		<?php
	}

	private function generate_optional_label( $field ) {

		if ( isset( $field['required'] ) and $field['required'] === true ) {
			echo '&nbsp<span>' . esc_attr__( '*', 'soccer-engine-lite' ) . '</span>';
		}
	}

	// Simple Validations ---------------------------------------------------------------------------------------------.
	private function validate_text_0_255( $value ) {

		if ( preg_match( '/^.{0,255}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_text_1_255( $value ) {

		if ( preg_match( '/^.{1,255}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_url( $value ) {

		if ( preg_match( '/^.{0,2083}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_url_empty_allowed( $value ) {

		if ( preg_match( '/^.{0,2083}$/u', $value ) === 1 or
			strlen( trim( $value ) ) === 0 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_tinyint_unsigned( $value ) {

		if ( preg_match( '/^\d{1,3}$/u', $value ) === 1 and
			intval( $value, 10 ) <= 255 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_int_unsigned( $value ) {

		if ( preg_match( '/^\d{1,10}$/u', $value ) === 1 and
			intval( $value, 10 ) <= 4294967295 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_bigint_unsigned( $value ) {

		if ( preg_match( '/^\d{1,20}$/u', $value ) === 1 and
			intval( $value, 10 ) <= 18446744073709551616 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_date( $value ) {

		if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_date_empty_allowed( $value ) {

		if ( is_null( $value) ||
			strlen( trim( $value ) ) === 0  ||
		     preg_match( '/^\d{4}-\d{2}-\d{2}$/u', $value )
			) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_time( $value ) {

		// Ref: https://stackoverflow.com/questions/7536755/regular-expression-for-matching-hhmm-time-format
		if ( preg_match( '/^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_time_empty_allowed( $value ) {

		// Ref: https://stackoverflow.com/questions/7536755/regular-expression-for-matching-hhmm-time-format
		if ( preg_match( '/^(0[0-9]|1[0-9]|2[0-3]|[0-9]):[0-5][0-9]$/u', $value ) === 1
		or strlen( $value ) === 0 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_decimal_15_2( $value ) {

		if ( preg_match( '/^\d{1,15}(?:\.\d{1,2})?$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_bool( $value ) {

		if ( preg_match( '/^0|1$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_color( $value ) {

		if ( preg_match( '/^#(?:[0-9a-fA-F]{3}){1,2}$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_comma_separated_list_of_numbers( $value ) {

		if ( preg_match( '/^(\s*(\d+\s*,\s*)+\d+\s*|\s*\d+\s*)$/u', $value ) ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_rounds( $value ) {

		if ( intval( $value, 10 ) >= 1 and intval( $value, 10 ) <= 128 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_foot( $value ) {

		if ( preg_match( '/^0|1|2|3$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_competition_order_type( $value ) {

		if ( preg_match( '/^0|1|2$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_position_abbreviation( $value ) {

		if ( preg_match( '/^.{1,3}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_team_slot( $value ) {

		if ( preg_match( '/^0|1$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_competition_order_by( $value ) {

		if ( preg_match( '/^0|1|2|3|4|5$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}


	private function validate_jersey_number( $value ) {

		if ( preg_match( '/^\d{0,3}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_height( $value ) {

		if ( preg_match( '/^\d{0,3}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_match_part( $value ) {

		if ( preg_match( '/^0|1|2|3|4$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_formation_position( $value ) {

		if ( preg_match( '/^\d{1,3}$/u', $value ) === 1 and
			intval( $value, 10 ) >= 0 and
			intval( $value, 10 ) <= 100 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_player_position_not_available_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_position';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_position_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function transfer_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_transfer_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE transfer_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function trophy_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_trophy_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE trophy_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function ranking_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_ranking_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE ranking_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function referee_badge_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee_badge_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_badge_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function competition_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function competition_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function formation_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_formation';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE formation_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function player_award_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player_award_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_award_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function player_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_player';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE player_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function unavailable_player_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE unavailable_player_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function staff_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function jersey_set_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_jersey_set';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE jersey_set_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function jersey_set_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_jersey_set';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE jersey_set_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function staff_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function staff_award_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_staff_award_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE staff_award_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function stadium_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE stadium_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function stadium_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_stadium';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE stadium_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function team_contract_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_contract_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function agency_contract_type_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract_type';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE agency_contract_type_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function agency_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE agency_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function team_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function team_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE team_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function referee_exists( $id ) {

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function referee_exists_none_allowed( $id ) {

		if ( intval( $id, 10 ) === 0 ) {
			return true;
		}

		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_referee';
		$sql        = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE referee_id = %d", $id );
		$count      = $wpdb->get_var( $sql );

		if ( intval( $count, 10 ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_country( $value ) {

		if ( preg_match( '/^\w{2}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_country_none_allowed( $value ) {

		if ( preg_match( '/^\w{2}$/u', $value ) === 1
			or strlen( $value ) === 0 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_attendance( $value ) {

		if ( preg_match( '/^\d{0,10}$/u', $value ) === 1 ) {
			return true;
		} else {
			return false;
		}
	}

	private function validate_national_team_confederation( $value ) {

		if ( intval( $value, 10 ) >= 0 and intval( $value, 10 ) <= 5 ) {
			return true;
		} else {
			return false;
		}
	}

	// Custom Validations -----------------------------------------------------------------------------------------------
	/**
	 * The custom validation of the "Players" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_players_custom_validation( $values, $update_id ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['date_of_birth'] !== null and $values['date_of_death'] !== null and
												$values['date_of_birth'] > $values['date_of_death'] ) {
			$result['messages'][] = __( 'The "Date of Birth" must be before the "Date of Death".', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Referees" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_referees_custom_validation( $values, $update_id ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['date_of_birth'] !== null and $values['date_of_death'] !== null and
												$values['date_of_birth'] > $values['date_of_death'] ) {
			$result['messages'][] = __( 'The "Date of Birth" must be before the "Date of Death".', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Matches" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_matches_custom_validation( $values, $update_id ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Do not allow to enter multiple time the same player ----------------------------------------------------------
		$player_a = array();

		// Do not allow to modify a match which is already associated with an event
		if ( $update_id > 0 ) {
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_event';
			$safe_sql   = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE match_id = %d", $update_id );
			$count      = $wpdb->get_var( $safe_sql );
			if ( $count > 0 ) {
				$result['messages'][] = __( "This match is associated with one or more events and can't be edited.", 'soccer-engine-lite' );
			}
		}

		// Do not allow to enter multiple times the same player ---------------------------------------------------------

		// Check in the lineup
		for ( $i = 1;$i <= 11;$i++ ) {
			if ( $values[ 'team_1_lineup_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_1_lineup_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'soccer-engine-lite' ) .
											': ' . $this->shared->get_player_name( $values[ 'team_1_lineup_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_1_lineup_player_id_' . $i ];
			}
			if ( $values[ 'team_2_lineup_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_2_lineup_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'soccer-engine-lite' ) .
											': ' . $this->shared->get_player_name( $values[ 'team_2_lineup_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_2_lineup_player_id_' . $i ];
			}
		}

		// Check in the substitutions
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'team_1_substitute_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_1_substitute_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'soccer-engine-lite' ) .
											': ' . $this->shared->get_player_name( $values[ 'team_1_substitute_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_1_substitute_player_id_' . $i ];
			}
			if ( $values[ 'team_2_substitute_player_id_' . $i ] > 0 and
				in_array( $values[ 'team_2_substitute_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'soccer-engine-lite' ) .
											': ' . $this->shared->get_player_name( $values[ 'team_2_substitute_player_id_' . $i ] );
			} else {
				$player_a[] = $values[ 'team_2_substitute_player_id_' . $i ];
			}
		}

		// Do not allow to enter multiple time the same staff -----------------------------------------------------------
		$staff_a = array();

		// Check in the staff
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'team_1_staff_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'team_1_staff_id_' . $i ], $staff_a ) ) {
					$result['messages'][] = __( "You can't use this staff multiple times", 'soccer-engine-lite' ) .
											': ' . $this->shared->get_staff_name( $values[ 'team_1_staff_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'team_1_staff_id_' . $i ];
			}
			if ( $values[ 'team_2_staff_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'team_2_staff_id_' . $i ], $staff_a ) ) {
					$result['messages'][] = __( "You can't use this staff multiple times", 'soccer-engine-lite' ) .
											': ' . $this->shared->get_staff_name( $values[ 'team_2_staff_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'team_2_staff_id_' . $i ];
			}
		}

		// Do not allow to enter a team that doesn't belong to the selected competition ---------------------------------
		if ( $values['competition_id'] > 0 ) {

			global $wpdb;
			$table_name      = $wpdb->prefix . $this->shared->get( 'slug' ) . '_competition';
			$safe_sql        = $wpdb->prepare( "SELECT * FROM $table_name WHERE competition_id = %d", $values['competition_id'] );
			$competition_obj = $wpdb->get_row( $safe_sql );

			// Check Team 1
			$team_found = false;
			for ( $t = 1;$t <= 128;$t++ ) {
				if ( $values['team_id_1'] === $competition_obj->{'team_id_' . $t} ) {
					$team_found = true;
					continue;
				}
			}

			if ( ! $team_found ) {
				$result['messages'][] = __( 'Team 1 is not present in the selected competition.', 'soccer-engine-lite' );
			}

			// Check Team 2
			$team_found = false;
			for ( $t = 1;$t <= 128;$t++ ) {
				if ( $values['team_id_2'] === $competition_obj->{'team_id_' . $t} ) {
					$team_found = true;
					continue;
				}
			}

			if ( ! $team_found ) {
				$result['messages'][] = __( 'Team 2 is not present in the selected competition.', 'soccer-engine-lite' );
			}
		}

		// Do not allow to set the same team in both the team slots ---------------------------------------------------.
		if ( intval( $values['team_id_1'], 10 ) === intval( $values['team_id_2'], 10 ) ) {

			$result['messages'][] = __( "You can't select multiple times the same team.", 'soccer-engine-lite' );

		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Squads" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_squads_custom_validation( $values, $update_id ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Do not allow to enter multiple time the same player --------------------------------------------------------.
		$player_a = array();

		// Check in the lineup
		for ( $i = 1;$i <= 11;$i++ ) {
			if ( $values[ 'lineup_player_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'lineup_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'soccer-engine-lite' ) .
											': ' . $this->get_player_name( $values[ 'lineup_player_id_' . $i ] );
					continue;
				}
				$player_a[] = $values[ 'lineup_player_id_' . $i ];
			}
		}

		// Check in the substitutions.
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'substitute_player_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'substitute_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'soccer-engine-lite' ) .
											': ' . $this->get_player_name( $values[ 'substitute_player_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'substitute_player_id_' . $i ];
				if ( in_array( $values[ 'substitute_player_id_' . $i ], $player_a ) ) {
					$result['messages'][] = __( "You can't use this player multiple times", 'soccer-engine-lite' ) .
											': ' . $this->get_player_name( $values[ 'substitute_player_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'substitute_player_id_' . $i ];
			}
		}

		// Do not allow to enter multiple time the same staff ---------------------------------------------------------.
		$staff_a = array();

		// Check in the staff
		for ( $i = 1;$i <= 20;$i++ ) {
			if ( $values[ 'staff_id_' . $i ] > 0 ) {
				if ( in_array( $values[ 'staff_id_' . $i ], $staff_a ) ) {
					$result['messages'][] = __( "You can't use this staff multiple times", 'soccer-engine-lite' ) .
											': ' . $this->get_staff_name( $values[ 'staff_id_' . $i ] );
					continue;
				}
				$staff_a[] = $values[ 'staff_id_' . $i ];
			}
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Competitions" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_competitions_custom_validation( $values, $update_id ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Do not allow to modify a competition which is already associated with a match.
		if ( $update_id > 0 ) {
			global $wpdb;
			$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_match';
			$safe_sql   = $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE competition_id = %d", $update_id );
			$count      = $wpdb->get_var( $safe_sql );
			if ( $count > 0 ) {
				$result['messages'][] = __( "This competition is already associated with a match and can't be edited.", 'soccer-engine-lite' );
			}
		}

		// Validate the number of rounds of an elimination competition.
		switch ( $values['type'] ) {

			// Elimination.
			case 0:
				if ( $values['rounds'] > 7 ) {
					$result['messages'][] = __( 'The number of rounds of an elimination competition should be between 1 and 7.', 'soccer-engine-lite' );
				}

				break;

			// Round Robin.
			case 1:
				break;

		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Events" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_events_custom_validation( $values, $update_id ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		if ( intval( $values['data'] ) === 0 ) {

			// Basic.
			return $result;

		} else {

			// Complete.

			// Validate Match Effect with the related selections.
			switch ( $values['match_effect'] ) {

				// Goal.
				case 1:
					// Only a player should be selected.
					if ( $values['player_id'] > 0 and
						$values['player_id_substitution_out'] == 0 and
						$values['player_id_substitution_in'] == 0 and
						$values['staff_id'] == 0 ) {
						// correct
					} else {
						$result['messages'][] = __( 'The "Goal" event can only be associated with a player.', 'soccer-engine-lite' );

					}

					// The selected player should be present in the team associated with the event.
					if (
						$values['player_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id']
						) ) {
						$result['messages'][] = __( 'The selected player should be present in the team associated with the event.', 'soccer-engine-lite' );
					}

					break;

				// Yellow Card.
				case 2:
					// Only a player or a staff should be selected.
					if ( ( $values['player_id'] > 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] == 0 ) or
						( $values['player_id'] == 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] > 0 ) ) {
						// correct
					} else {
						$result['messages'][] = __( 'The "Yellow Card" event can only be associated with a player or with a staff.', 'soccer-engine-lite' );
					}

					// The selected player should be present in the team associated with the event.
					if (
						$values['player_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id']
						) ) {
						$result['messages'][] = __( 'The selected player should be present in the team associated with the event.', 'soccer-engine-lite' );
					}

					// The selected staff should be present in the team associated with the event
					if (
						$values['staff_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_staff_in_match(
							$values['match_id'],
							$values['staff_id']
						) ) {
						$result['messages'][] = __( 'The selected staff should be present in the team associated with the event.', 'soccer-engine-lite' );
					}

					break;

				// Red Card.
				case 3:
					// Only a player or a staff should be selected.
					if ( ( $values['player_id'] > 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] == 0 ) or
						( $values['player_id'] == 0 and $values['player_id_substitution_out'] == 0 and $values['player_id_substitution_in'] == 0 and $values['staff_id'] > 0 ) ) {
						// correct
					} else {
						$result['messages'][] = __( 'The "Red Card" event can only be associated with a player or with a staff.', 'soccer-engine-lite' );
					}

					// The selected player should be present in the team associated with the event
					if (
						$values['player_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id']
						) ) {
						$result['messages'][] = __( 'The selected player should be present in the team associated with the event.', 'soccer-engine-lite' );
					}

					// The selected staff should be present in the team associated with the event.
					if (
						$values['staff_id'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_staff_in_match(
							$values['match_id'],
							$values['staff_id']
						) ) {
						$result['messages'][] = __( 'The selected staff should be present in the team associated with the event.', 'soccer-engine-lite' );
					}

					break;

				// Substitution.
				case 4:
					// The Player Substitution Out and Players Substitution In should be selected.
					if ( $values['player_id'] == 0 and
						$values['player_id_substitution_out'] > 0 and
						$values['player_id_substitution_in'] > 0 and
						$values['staff_id'] == 0 ) {
						// correct
					} else {
						$result['messages'][] = __( 'The "Substitution" event can only be associated with a Player Substitution Our and a Player Substitution In.', 'soccer-engine-lite' );

					}

					// The selected "Player Substitution Out" should be present in the team associated with the event.
					if (
						$values['player_id_substitution_out'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id_substitution_out']
						) ) {
						$result['messages'][] = __( 'The selected "Player Substitution Out" should be present in the team associated with the event.', 'soccer-engine-lite' );
					}

					// The selected "Player Substitution In" should be present in the team associated with the event.
					if (
						$values['player_id_substitution_in'] > 0 and
						intval(
							$values['team_slot'] + 1,
							10
						) !== $this->shared->get_team_of_player_in_match(
							$values['match_id'],
							$values['player_id_substitution_in']
						) ) {
						$result['messages'][] = __( 'The selected "Player Substitution In" should be present in the team associated with the event.', 'soccer-engine-lite' );
					}

					break;

			}

			// Validate Time.
			switch ( intval( $values['part'], 10 ) ) {

				case 0:
					if ( $values['time'] < 1 || $values['time'] > 45 ) {
						$result['messages'][] = __( 'The first half time should be a value between between 1 and 45.', 'soccer-engine-lite' );
					}
					break;

				case 1:
					if ( $values['time'] < 1 || $values['time'] > 45 ) {
						$result['messages'][] = __( 'The second half time should be a value between between 1 and 45.', 'soccer-engine-lite' );
					}
					break;

				case 2:
					if ( $values['time'] < 1 || $values['time'] > 15 ) {
						$result['messages'][] = __( 'The first half extra time should be a value between between 1 and 15.', 'soccer-engine-lite' );
					}
					break;

				case 3:
					if ( $values['time'] < 1 || $values['time'] > 15 ) {
						$result['messages'][] = __( 'The second half extra time should be a value between between 1 and 15.', 'soccer-engine-lite' );
					}
					break;

				case 4:
					if ( $values['time'] < 1 || $values['time'] > 30 ) {
						$result['messages'][] = __( 'The penalty time should be a value between between 1 and 30.', 'soccer-engine-lite' );
					}
					break;

			}

			// Validate Additional Time.
			if ( preg_match( '/^\d{1,2}$/u', $values['additional_time'] ) !== 1 or
				intval( $values['additional_time'], 10 ) < 0 or intval( $values['additional_time'], 10 ) > 60 ) {
				$result['messages'][] = __( 'The additional time should be a value between 0 and 60.', 'soccer-engine-lite' );
			}

			// Validate Description.
			if ( preg_match( '/^.{1,1000}$/u', $values['description'] ) !== 1 ) {
				$result['messages'][] = __( 'Please enter a valid description.', 'soccer-engine-lite' );
			}

			if ( count( $result['messages'] ) > 0 ) {
				$result['status'] = false;
			}

			return $result;

		}
	}

	/**
	 * The custom validation of the "Team Contracts" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_team_contracts_custom_validation( $values, $update_id ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'soccer-engine-lite' );
		}

		// Verify if another team contract of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_team_contract';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        team_contract_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another team contract of the same player exists in the same period.', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Agency Contracts" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_agency_contracts_custom_validation( $values, $update_id ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'soccer-engine-lite' );
		}

		// Verify if another agency contract of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_agency_contract';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        agency_contract_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another agency contract of the same player exists in the same period.', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Unavailable Players" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_unavailable_players_custom_validation( $values, $update_id ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'soccer-engine-lite' );
		}

		// Verify if another unavailable player of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_unavailable_player';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        unavailable_player_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another unavailable player of the same player exists in the same period.', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Injuries" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_injuries_custom_validation( $values, $update_id ) {

		// Init the result.
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'soccer-engine-lite' );
		}

		// Verify if another injury of the same player exists in the same period.
		global $wpdb;
		$table_name = $wpdb->prefix . $this->shared->get( 'slug' ) . '_injury';
		$safe_sql   = $wpdb->prepare(
			"SELECT COUNT(*) FROM $table_name WHERE
        injury_id != %d AND
        player_id = %d AND 
        ((end_date > %s AND 
        start_date < %s) OR 
        (end_date > %s AND 
        start_date < %s))
        ",
			intval( $update_id, 10 ),
			intval( $values['player_id'], 10 ),
			$values['start_date'],
			$values['start_date'],
			$values['end_date'],
			$values['end_date']
		);
		$count      = intval( $wpdb->get_var( $safe_sql ), 10 );

		if ( $count !== 0 ) {
			$result['messages'][] = __( 'Another injury of the same player exists in the same period.', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Referee Badges" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_referee_badges_custom_validation( $values, $update_id ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['start_date'] > $values['end_date'] ) {
			$result['messages'][] = __( 'The "Start Date" must be before the "End Date".', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * The custom validation of the "Staff" menu.
	 *
	 * If the form is valid and array with the status equal to true e no error messages is returned.
	 *
	 * If the form is not valid an array with the status equal to false and the error messages is returned.
	 *
	 * @param $values
	 * @param $update_id
	 *
	 * @return array
	 */
	private function menu_staff_custom_validation( $values, $update_id ) {

		// Init the result
		$result = array(
			'status'   => true,
			'messages' => array(),
		);

		// Verify if the "Start Date" is before the "End Date.
		if ( $values['date_of_birth'] !== null and $values['date_of_death'] !== null and
												$values['date_of_birth'] > $values['date_of_death'] ) {
			$result['messages'][] = __( 'The "Date of Birth" must be before the "Date of Death".', 'soccer-engine-lite' );
		}

		if ( count( $result['messages'] ) > 0 ) {
			$result['status'] = false;
		}

		return $result;
	}

	/**
	 * Echos the HTML of the blocking condition message based on the provided blocking condition code.
	 *
	 * @param $code
	 */
	private function display_blocking_condition_message( $code ) {

		switch ( $code ) {

			case 'num_of_player_positions':
				echo '<p>' .
					esc_html__( 'Please add at least one player position with the', 'soccer-engine-lite' ) .
					'&nbsp' .
					'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-player-positions' ) . '">' .
					esc_html__( 'Player Positions', 'soccer-engine-lite' ) .
					'</a> ' .
					esc_html__( 'menu', 'soccer-engine-lite' ) .
					'.' .
					'</p>';

				break;

			case 'num_of_teams':
				echo '<p>' .
							esc_html__( 'Please add at least one team with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-teams' ) . '">' .
							esc_html__( 'Teams', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'number_of_matches':
				echo '<p>' .
							esc_html__( 'Please add at least one match with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-matches' ) . '">' .
							esc_html__( 'Matches', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_players':
				echo '<p>' .
							esc_html__( 'Please add at least one player type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-players' ) . '">' .
							esc_html__( 'Players', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_transfer_types':
				echo '<p>' .
							esc_html__( 'Please add at least one transfer type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-transfer-types' ) . '">' .
							esc_html__( 'Transfer Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_team_contract_types':
				echo '<p>' .
							esc_html__( 'Please add at least one team contract type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-team-contract-types' ) . '">' .
							esc_html__( 'Team Contract Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_agency_contract_types':
				echo '<p>' .
							esc_html__( 'Please add at least one contract type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-agency-contract-types' ) . '">' .
							esc_html__( 'Agency Contract Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_agencies':
				echo '<p>' .
							esc_html__( 'Please add at least one agency with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-agencies' ) . '">' .
							esc_html__( 'Teams', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_player_award_types':
				echo '<p>' .
							esc_html__( 'Please add at least one player award type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-player-award-types' ) . '">' .
							esc_html__( 'Player Award Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_unavailable_player_types':
				echo '<p>' .
							esc_html__( 'Please add at least one unavailable player type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-unavailable-player-types' ) . '">' .
							esc_html__( 'Unavailable Player Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_injurie_types':
				echo '<p>' .
							esc_html__( 'Please add at least one injury type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-injury-types' ) . '">' .
							esc_html__( 'Injury Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_staff_types':
				echo '<p>' .
							esc_html__( 'Please add at least one staff type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-staff-types' ) . '">' .
							esc_html__( 'Staff Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_staff_award_types':
				echo '<p>' .
							esc_html__( 'Please add at least one staff award type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-staff-award-types' ) . '">' .
							esc_html__( 'Staff Award Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_staffs':
				echo '<p>' .
							esc_html__( 'Please add at least one staff with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-staff' ) . '">' .
							esc_html__( 'Staff', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_referees':
				echo '<p>' .
							esc_html__( 'Please add at least one referee with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-referees' ) . '">' .
							esc_html__( 'Referees', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_referee_badge_types':
				echo '<p>' .
							esc_html__( 'Please add at least one referee badge type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-referee-badge-types' ) . '">' .
							esc_html__( 'Referee Badge Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_trophy_types':
				echo '<p>' .
							esc_html__( 'Please add at least one trophy type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-trophy-types' ) . '">' .
							esc_html__( 'Trophy Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

			case 'num_of_ranking_types':
				echo '<p>' .
							esc_html__( 'Please add at least one ranking type with the', 'soccer-engine-lite' ) .
							'&nbsp' .
							'<a href="' . esc_url( get_admin_url() . 'admin.php?page=daextsoenl-ranking-types' ) . '">' .
							esc_html__( 'Ranking Types', 'soccer-engine-lite' ) .
							'</a> ' .
							esc_html__( 'menu', 'soccer-engine-lite' ) .
							'.' .
							'</p>';

				break;

		}
	}
}