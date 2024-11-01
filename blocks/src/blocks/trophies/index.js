const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericReactSelect from '../../components/GenericReactSelect';
import GenericDateTimePicker from '../../components/GenericDateTimePicker';
import MultiReactSelect from '../../components/MultiReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.trophyTypeId === 'undefined'){
      this.props.setAttributes({trophyTypeId: "0"});
    }
    if(typeof this.props.attributes.teamId === 'undefined'){
      this.props.setAttributes({teamId: "0"});
    }
    if(typeof this.props.attributes.startAssignmentDate === 'undefined'){
      this.props.setAttributes({startAssignmentDate: '1900-01-01'});
    }
    if(typeof this.props.attributes.endAssignmentDate === 'undefined'){
      this.props.setAttributes({endAssignmentDate: '2100-01-01'});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['trophy_type', 'team', 'assignment_date']});
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

    const trophyTypeIdData = {
      action: 'daextsoenl_get_trophy_type_list',
      attributeName: 'trophyTypeId',
      title: __('Trophy Type', 'soccer-engine-lite'),
    };

    const teamIdData = {
      action: 'daextsoenl_get_team_list',
      attributeName: 'teamId',
      title: __('Team', 'soccer-engine-lite'),
    };

    const startAssignmentDateData = {
      title: __('Start Assignment Date', 'soccer-engine-lite'),
      date: this.props.attributes.startAssignmentDate,
      attributeName: 'startAssignmentDate'
    };

    const endAssignmentDateData = {
      title: __('End Assignment Date', 'soccer-engine-lite'),
      date: this.props.attributes.endAssignmentDate,
      attributeName: 'endAssignmentDate'
    };

    const columnsData = {
      action: 'daextsoenl_get_columns_trophies',
      attributeName: 'columns',
      title: __('Columns', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'daextsoenl_get_columns_trophies',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'daextsoenl_get_columns_trophies',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'soccer-engine-lite'),
    };

    const paginationData = {
      action: 'daextsoenl_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'soccer-engine-lite'),
    };

    return [
      <div className="daextsoenl-block-image">{__('Trophies', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={trophyTypeIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={teamIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={startAssignmentDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={endAssignmentDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('daextsoenl/trophies', {
  title: __('Trophies', 'soccer-engine-lite'),
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('trophies', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
    __('engine', 'soccer-engine-lite'),
  ],
  attributes: {
    trophyTypeId: {
      type: 'string',
    },
    teamId: {
      type: 'string',
    },
    startAssignmentDate: {
      type: 'string',
    },
    endAssignmentDate: {
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
