//Get the base Component used to defined new components
const {Component} = wp.element;

const { TextControl, PanelBody } = wp.components;

// Deconstruct just the __ function from wp.i18n global object
const { __ } = wp.i18n;

class GenericInput extends Component {

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

    const attributeName = this.props.data.attributeName;
    const title = this.props.data.title;
    const placeholder = this.props.data.placeholder;
    const setAttributes = this.props.setAttributes;

    return(
        <PanelBody title={title} initialOpen={false}>
          <TextControl
              onChange={ ( value ) => setAttributes( { [attributeName]: value } ) }
              value={ this.props.attributes[attributeName] }
              placeholder={placeholder}
          />
        </PanelBody>
    );

  }

}

export default GenericInput;
