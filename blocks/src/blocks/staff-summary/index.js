const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericReactSelect from '../../components/GenericReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.staffId === 'undefined'){
      this.props.setAttributes({staffId: '0'});
    }

  }

  render() {

    const staffIdData = {
      action: 'daextsoenl_get_staff_list',
      attributeName: 'staffId',
      title: __('Staff', 'soccer-engine-lite'),
      actionParameters: '&default_label=1'
    };

    return [
      <div className="daextsoenl-block-image">{__('Staff Summary', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={staffIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
      </InspectorControls>
    ];

  }

}

/**
 * Register the Gutenberg block
 */
registerBlockType('daextsoenl/staff-summary', {
  title: __('Staff Summary', 'soccer-engine-lite'),
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('staff', 'soccer-engine-lite'),
    __('summary', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
  ],
  attributes: {
    staffId: {
      type: 'string',
    },
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
