import MultiReactSelect from '../../components/MultiReactSelect';

const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericDateTimePicker from '../../components/GenericDateTimePicker';
import GenericReactSelect from '../../components/GenericReactSelect';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.startDateOfBirth === 'undefined'){
      this.props.setAttributes({startDateOfBirth: "1900-01-01"});
    }
    if(typeof this.props.attributes.endDateOfBirth === 'undefined'){
      this.props.setAttributes({endDateOfBirth: "2100-01-01"});
    }
    if(typeof this.props.attributes.citizenship === 'undefined'){
      this.props.setAttributes({citizenship: "0"});
    }
    if(typeof this.props.attributes.foot === 'undefined'){
      this.props.setAttributes({foot: "0"});
    }
    if(typeof this.props.attributes.teamId === 'undefined'){
      this.props.setAttributes({teamId: "0"});
    }
    if(typeof this.props.attributes.squadId === 'undefined'){
      this.props.setAttributes({squadId: "0"});
    }
    if(typeof this.props.attributes.playerPositionId === 'undefined'){
      this.props.setAttributes({playerPositionId: "0"});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ['player', 'age', 'citizenship', 'height', 'foot', 'current_club', 'ownership', 'contract_expire']});
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

    const citizenshipData = {
      action: 'daextsoenl_get_citizenship_list',
      attributeName: 'citizenship',
      title: __('Citizenship', 'soccer-engine-lite'),
    };

    const startDateOfBirthData = {
      title: __('Start Date of Birth', 'soccer-engine-lite'),
      date: this.props.attributes.startDateOfBirth,
      attributeName: 'startDateOfBirth'
    };

    const endDateOfBirthData = {
      title: __('End Date of Birth', 'soccer-engine-lite'),
      date: this.props.attributes.endDateOfBirth,
      attributeName: 'endDateOfBirth'
    };

    const footData = {
      action: 'daextsoenl_get_foot_list',
      attributeName: 'foot',
      title: __('Foot', 'soccer-engine-lite'),
    };

    const squadIdData = {
      action: 'daextsoenl_get_squad_list',
      attributeName: 'squadId',
      title: __('Squad', 'soccer-engine-lite'),
      actionParameters: '&default_label=0'
    };

    const playerPositionIdData = {
      action: 'daextsoenl_get_player_position_list',
      attributeName: 'playerPositionId',
      title: __('Player Position', 'soccer-engine-lite'),
    };

    const columnsData = {
      action: 'daextsoenl_get_columns_players',
      attributeName: 'columns',
      title: __('Columns', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'daextsoenl_get_columns_players',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'daextsoenl_get_columns_players',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'soccer-engine-lite'),
    };

    const paginationData = {
      action: 'daextsoenl_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'soccer-engine-lite'),
    };

    return [
      <div className="daextsoenl-block-image">{__('Players', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericDateTimePicker data={startDateOfBirthData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={endDateOfBirthData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={citizenshipData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={footData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={playerPositionIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={squadIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('daextsoenl/players', {
  title: __('Players', 'soccer-engine-lite'),
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('players', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
    __('engine', 'soccer-engine-lite'),
  ],
  attributes: {
    startDateOfBirth: {
      type: 'string',
    },
    endDateOfBirth: {
      type: 'string',
    },
    citizenship: {
      type: 'string',
    },
    foot: {
      type: 'string',
    },
    playerPositionId: {
      type: 'string',
    },
    squadId: {
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