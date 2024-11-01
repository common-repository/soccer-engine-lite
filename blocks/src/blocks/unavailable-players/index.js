const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericReactSelect from '../../components/GenericReactSelect';
import MultiReactSelect from '../../components/MultiReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.playerId === 'undefined'){
      this.props.setAttributes({playerId: "0"});
    }
    if(typeof this.props.attributes.unavailablePlayerTypeId === 'undefined'){
      this.props.setAttributes({unavailablePlayerTypeId: "0"});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['player', 'age', 'citizenship', 'unavailable_player_type', 'start_date', 'end_date']});
    }
    if(typeof this.props.attributes.hiddenColumnsBreakpoint1 === 'undefined'){
      this.props.setAttributes({hiddenColumnsBreakpoint1: []});
    }
    if(typeof this.props.attributes.hiddenColumnsBreakpoint2 === 'undefined'){
      this.props.setAttributes({hiddenColumnsBreakpoint2: []});
    }
    if(typeof this.props.attributes.pagination === 'undefined'){
      this.props.setAttributes({pagination: '10'});
    }

  }

  render() {

    const playerIdData = {
      action: 'daextsoenl_get_player_list',
      attributeName: 'playerId',
      title: __('Player', 'soccer-engine-lite'),
    };

    const unavailablePlayerTypeIdData = {
      action: 'daextsoenl_get_unavailable_player_type_list',
      attributeName: 'unavailablePlayerTypeId',
      title: __('Unavailable Player Type', 'soccer-engine-lite'),
    };

    const columnsData = {
      action: 'daextsoenl_get_columns_unavailable_players',
      attributeName: 'columns',
      title: __('Columns', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'daextsoenl_get_columns_unavailable_players',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'daextsoenl_get_columns_unavailable_players',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'soccer-engine-lite'),
    };

    const paginationData = {
      action: 'daextsoenl_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'soccer-engine-lite'),
    };

    return [
      <div className="daextsoenl-block-image">{__('Unavailable Players', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={playerIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={unavailablePlayerTypeIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <MultiReactSelect data={columnsData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <MultiReactSelect data={hiddenColumnsBreakpoint1Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <MultiReactSelect data={hiddenColumnsBreakpoint2Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={paginationData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
      </InspectorControls>
    ];

  }

}

/**
 * Register the Gutenberg block
 */
registerBlockType('daextsoenl/unavailable-players', {
  title: __('Unavailable Players', 'soccer-engine-lite'),
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('unavailable', 'soccer-engine-lite'),
    __('players', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
  ],
  attributes: {
    playerId: {
      type: 'string',
    },
    unavailablePlayerTypeId: {
      type: 'string',
    },
    columns: {
      type: 'array',
    },
    hiddenColumnsBreakpoint1: {
      type: 'array',
    },
    hiddenColumnsBreakpoint2: {
      type: 'array',
    },
    pagination: {
      type: 'string',
    }
  },

  /**
   * The edit function describes the structure of your block in the context of the editor.
   * This represents what the editor will render when the block is used.
   *
   * The "edit" property must be a valid function.
   *
   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
   */
  edit: BlockEdit,

  /**
   * The save function defines the way in which the different attributes should be combined
   * into the final markup, which is then serialized by Gutenberg into post_content.
   *
   * The "save" property must be specified and must be a valid function.
   *
   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/
   */
  save: function() {

    /**
     * This is a dynamic block and the rendering is performed with PHP:
     *
     * https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
     */
    return null;

  },

});