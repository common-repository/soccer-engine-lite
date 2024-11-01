//Get the base Component used to defined new components
const {Component} = wp.element;

//Required by the DateTimePicker component
const { DateTimePicker } = wp.components;
const { __experimentalGetSettings } = wp.date;
const { withState } = wp.compose;

const {
  PanelBody,
} = wp.components;

// Deconstruct just the __ function from wp.i18n global object
const { __ } = wp.i18n;

class GenericDateTimePicker extends Component {

  constructor(props) {

    super(...arguments);

  }

  /**
   * This method is invoked immediately after a component is mounted (inserted
   * into the tree). Initializations that requires DOM nodes should go here. If
   * you need to load data from a remote endpoint, this is a good place to
   * instantiate the network requests.
   *
   * https://reactjs.org/docs/react-component.html#componentdidmount
   */
  componentDidMount() {

  }

  render() {

    const {setAttributes} = this.props;

    const MyDateTimePicker = withState( {
      setAttributes: setAttributes,
      attributeName: this.props.data.attributeName,
      theDate: this.props.data.date
    } )( ( { setAttributes, attributeName, theDate, setState } ) => {
      const settings = __experimentalGetSettings();

      // To know if the current timezone is a 12 hour time with look for an "a" in the time format.
      // We also make sure this a is not escaped by a "/".
      const is12HourTime = /a(?!\\)/i.test(
          settings.formats.time
          .toLowerCase() // Test only the lower case a
              .replace( /\\\\/g, '' ) // Replace "//" with empty strings
              .split( '' ).reverse().join( '' ) // Reverse the string and test for "a" not followed by a slash
      );

      return (
          <DateTimePicker
              currentDate={ theDate }
              onChange={ ( date ) => {
                setState( { date } );
                setAttributes({[attributeName]: date});
              }}
              is12Hour={ is12HourTime }
              className={ 'daextsoenl-datetimepicker'}
          />
      );
    } );

    return (
        <PanelBody
            title={this.props.data.title}
            initialOpen={false}
        >
          <MyDateTimePicker></MyDateTimePicker>
        </PanelBody>
    );

  }

}

export default GenericDateTimePicker;
