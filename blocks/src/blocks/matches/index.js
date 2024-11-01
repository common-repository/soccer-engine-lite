//Get the registerBlockType() function used for the registration of the block
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

    if(typeof this.props.attributes.teamId1 === 'undefined'){
      this.props.setAttributes({teamId1: '0'});
    }
    if(typeof this.props.attributes.teamId2 === 'undefined'){
      this.props.setAttributes({teamId2: '0'});
    }
    if(typeof this.props.attributes.startDate === 'undefined'){
      this.props.setAttributes({startDate: '1900-01-01'});
    }
    if(typeof this.props.attributes.endDate === 'undefined'){
      this.props.setAttributes({endDate: '2100-01-01'});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['date', 'time', 'team_1', 'result', 'team_2']});
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

    const teamId1Data = {
      action: 'daextsoenl_get_team_list',
      attributeName: 'teamId1',
      title: __('Team 1', 'soccer-engine-lite'),
    };

    const teamId2Data = {
      action: 'daextsoenl_get_team_list',
      attributeName: 'teamId2',
      title: __('Team 2', 'soccer-engine-lite'),
    };

    const startDateData = {
      title: __('Start Date', 'soccer-engine-lite'),
      date: this.props.attributes.startDate,
      attributeName: 'startDate'
    };
    const endDateData = {
      title: __('End Date', 'soccer-engine-lite'),
      date: this.props.attributes.endDate,
      attributeName: 'endDate'
    };

    const columnsData = {
      action: 'daextsoenl_get_columns_matches',
      attributeName: 'columns',
      title: __('Columns', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'daextsoenl_get_columns_matches',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'daextsoenl_get_columns_matches',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'soccer-engine-lite'),
    };

    const paginationData = {
      action: 'daextsoenl_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'soccer-engine-lite'),
    };

    return [
      <div className="daextsoenl-block-image">{__('Matches', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={teamId1Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={teamId2Data} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={startDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={endDateData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('daextsoenl/matches', {
  title: __('Matches', 'soccer-engine-lite'),
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('matches', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
    __('engine', 'soccer-engine-lite'),
  ],

  attributes: {
    teamId1: {
      type: 'string',
    },
    teamId2: {
      type: 'string',
    },
    startDate: {
      type: 'string',
    },
    endDate: {
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
