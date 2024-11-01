const {registerBlockType} = wp.blocks;
const { InspectorControls } = wp.blockEditor;
const {Component} = wp.element;
const { __ } = wp.i18n;

import GenericDateTimePicker from '../../components/GenericDateTimePicker';
import GenericReactSelect from '../../components/GenericReactSelect';
import MultiReactSelect from '../../components/MultiReactSelect';
import GenericInput from '../../components/GenericInput';
import BallIcon from '../../components/BallIcon';

class BlockEdit extends Component {

  constructor(props) {

    super(...arguments);
    this.props = props;

    //Initialize the attributes
    if(typeof this.props.attributes.playerId === 'undefined'){
      this.props.setAttributes({playerId: '0'});
    }
    if(typeof this.props.attributes.transferTypeId === 'undefined'){
      this.props.setAttributes({transferTypeId: '0'});
    }
    if(typeof this.props.attributes.teamIdLeft === 'undefined'){
      this.props.setAttributes({teamIdLeft: '0'});
    }
    if(typeof this.props.attributes.teamIdJoined === 'undefined'){
      this.props.setAttributes({teamIdJoined: '0'});
    }
    if(typeof this.props.attributes.startDate === 'undefined'){
      this.props.setAttributes({startDate: '1900-01-01'});
    }
    if(typeof this.props.attributes.endDate === 'undefined'){
      this.props.setAttributes({endDate: '2100-01-01'});
    }
    if(typeof this.props.attributes.feeLowerLimit === 'undefined'){
      this.props.setAttributes({feeLowerLimit: '0'});
    }
    if(typeof this.props.attributes.feeHigherLimit === 'undefined'){
      this.props.setAttributes({feeHigherLimit: '1000000000'});
    }
    if(typeof this.props.attributes.columns === 'undefined'){
      this.props.setAttributes({columns: ["player","citizenship","age","team_left","team_joined","date","market_value","fee"]});
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

    const setAttributes = this.props.setAttributes;

    const playerIdData = {
      action: 'daextsoenl_get_player_list',
      attributeName: 'playerId',
      title: __('Player', 'soccer-engine-lite'),
    };

    const dateStartData = {
      title: __('Start Date', 'soccer-engine-lite'),
      date: this.props.attributes.startDate,
      attributeName: 'startDate'
    };

    const dateEndData = {
      title: __('End Date', 'soccer-engine-lite'),
      date: this.props.attributes.endDate,
      attributeName: 'endDate'
    };

    const teamIdLeftData = {
      action: 'daextsoenl_get_team_list',
      attributeName: 'teamIdLeft',
      title: __('Team Left', 'soccer-engine-lite'),
    };

    const teamIdJoinedData = {
      action: 'daextsoenl_get_team_list',
      attributeName: 'teamIdJoined',
      title: __('Team Joined', 'soccer-engine-lite'),
    };

    const feeLowerLimitData = {
      attributeName: 'feeLowerLimit',
      title: __('Fee Lower Limit', 'soccer-engine-lite'),
      placeholder: __('Set the fee lower limit', 'soccer-engine-lite'),
    };

    const feeHigherLimitData = {
      attributeName: 'feeHigherLimit',
      title: __('Fee Higher Limit', 'soccer-engine-lite'),
      placeholder: __('Set the fee higher limit', 'soccer-engine-lite'),
    };

    const transferTypeIdData = {
      action: 'daextsoenl_get_transfer_type_list',
      attributeName: 'transferTypeId',
      title: __('Transfer Type', 'soccer-engine-lite'),
    };

    const columnsData = {
      action: 'daextsoenl_get_columns_transfers',
      attributeName: 'columns',
      title: __('Columns', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint1Data = {
      action: 'daextsoenl_get_columns_transfers',
      attributeName: 'hiddenColumnsBreakpoint1',
      title: __('Hidden Columns (Breakpoint 1)', 'soccer-engine-lite'),
    };

    const hiddenColumnsBreakpoint2Data = {
      action: 'daextsoenl_get_columns_transfers',
      attributeName: 'hiddenColumnsBreakpoint2',
      title: __('Hidden Columns (Breakpoint 2)', 'soccer-engine-lite'),
    };

    const paginationData = {
      action: 'daextsoenl_get_pagination_list',
      attributeName: 'pagination',
      title: __('Pagination', 'soccer-engine-lite'),
    };

    return [
      <div className="daextsoenl-block-image">{__('Transfers', 'soccer-engine-lite')}</div>,
      <InspectorControls key="inspector">
        <GenericReactSelect data={playerIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={transferTypeIdData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={teamIdLeftData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericReactSelect data={teamIdJoinedData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={dateStartData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericDateTimePicker data={dateEndData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericInput data={feeLowerLimitData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
        <GenericInput data={feeHigherLimitData} attributes={this.props.attributes} setAttributes={this.props.setAttributes} />
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
registerBlockType('daextsoenl/transfers', {
  title: __('Transfers', 'soccer-engine-lite'),
  icon: BallIcon,
  category: 'daextsoenl-soccer-engine',
  keywords: [
    __('transfers', 'soccer-engine-lite'),
    __('soccer', 'soccer-engine-lite'),
    __('engine', 'soccer-engine-lite'),
  ],
  attributes: {
    playerId: {
      type: 'string',
    },
    startDate: {
      type: 'string',
    },
    endDate: {
      type: 'string',
    },
    teamIdLeft: {
      type: 'string',
    },
    teamIdJoined: {
      type: 'string',
    },
    feeLowerLimit: {
      type: 'string',
    },
    feeHigherLimit: {
      type: 'string',
    },
    transferTypeId: {
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
