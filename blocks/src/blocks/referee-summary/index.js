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
    if(typeof this.props.attributes.refereeId === 'undefined'){
      this.props.setAttributes({refereeId: '0'});
    }

  }

  render() {

    const refereeIdData = {
      action: 'daextsoenl_get_referee_list',
      attributeName: 'refereeId',
      title: __('Referee', 'soccer-engine-lite'),
      actionParameters: '&default_label=1'
    };

    return [
      <div className="daextsoenl-block-image">{__('Referee Summary', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={refereeIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
      </InspectorControls>
    ];

  }

}

/**
 * Register the Gutenberg block
 */
registerBlockType('daextsoenl/referee-summary', {
  title: 'Referee Summary',
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('referee summary', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
    __('engine', 'soccer-engine-lite'),
  ],
  attributes: {
    refereeId: {
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
