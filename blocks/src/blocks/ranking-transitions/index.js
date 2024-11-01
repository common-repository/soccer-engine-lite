//Get the registerBlockType() function used for the registration of the block
const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericDateTimePicker from '../../components/GenericDateTimePicker';
import GenericReactSelect from '../../components/GenericReactSelect';
import MultiReactSelect from '../../components/MultiReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.teamId === 'undefined'){
      this.props.setAttributes({teamId: '0'});
    }
    if(typeof this.props.attributes.rankingTypeId === 'undefined'){
      this.props.setAttributes({rankingTypeId: '0'});
    }
    if(typeof this.props.attributes.startDate === 'undefined'){
      this.props.setAttributes({startDate: '1900-01-01'});
    }
    if(typeof this.props.attributes.endDate === 'undefined'){
      this.props.setAttributes({endDate: '2100-01-01'});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['team', 'ranking_type', 'date', 'value']});
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

    const teamIdData = {
      action: 'daextsoenl_get_team_list',
      attributeName: 'teamId',
      title: __('Team', 'soccer-engine-lite'),
    };

    const rankingTypeIdDate = {
      action: 'daextsoenl_get_ranking_type_list',
      attributeName: 'rankingTypeId',
      title: __('Ranking Type', 'soccer-engine-lite'),
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
      action: 'daextsoenl_get_columns_ranking_transitions',
      attributeName: 'columns',
      title: __('Columns', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'daextsoenl_get_columns_ranking_transitions',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'daextsoenl_get_columns_ranking_transitions',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'soccer-engine-lite'),
    };

    const paginationData = {
      action: 'daextsoenl_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'soccer-engine-lite'),
    };

    return [
      <div className="daextsoenl-block-image">{__('Ranking Transitions', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={teamIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={rankingTypeIdDate} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('daextsoenl/ranking-transitions', {
  title: __('Ranking Transitions', 'soccer-engine-lite'),
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('ranking transitions', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
    __('engine', 'soccer-engine-lite'),
  ],
  attributes: {
    teamId: {
      type: 'string',
    },
    rankingTypeId: {
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