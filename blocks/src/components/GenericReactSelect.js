//Get the base Component used to defined new components
const {Component} = wp.element;

import React from 'react';
import ReactDom from 'react-dom';
import Select from 'react-select';

const {
  PanelBody,
} = wp.components;

// Deconstruct just the __ function from wp.i18n global object
const { __ } = wp.i18n;

class GenericReactSelect extends Component {

  constructor(props) {

    super(...arguments);

    this.state = {
      options: [],
      selectedOption: [],
    };

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

    let nonce = 'security=' + window.DAEXTSOENL_PHPDATA.nonce;

    //Players ----------------------------------------------------------------------------------------------------------
    let actionParameters = '';
    if(typeof this.props.data.actionParameters !== 'undefined'){
      actionParameters = this.props.data.actionParameters;
    }

    fetch(window.DAEXTSOENL_PHPDATA.ajaxUrl, {
      method: "POST",
      credentials: 'include',//Required to avoid the 400 Bad Request error with Edge
      headers: {'Content-type': 'application/x-www-form-urlencoded'},
      body: nonce + '&action=' + this.props.data.action + actionParameters,
    })
    .then((response) => {

      if(response.ok) {
        return response.json();
      }else{
        throw new Error('Network response was not ok.');
      }

    })
    .then((data) => {

      const attributeValue = this.props.attributes[this.props.data.attributeName];

      //Update the React Select options
      let options = data.map((item) => ({
        value: item.value,
        label: item.label,
      }));
      this.setState({
        options: options,
      });

      //Find the selected item
      const selectedItem = options.find(function(item) {
        if(item.value === attributeValue){
          return item;
        }
      });

      //Set the React Select Placeholder or set the React Select selected option
      if(typeof selectedItem === 'undefined'){
        this.setState({
          placeholder: __( 'Select...', 'soccer-engine-lite')
        });
      }else{
        this.setState({
          selectedOption: {
            value: attributeValue,
            label: selectedItem.label
          }
        });
      }

    })
    .catch(error => {

      console.log('There has been a problem with your fetch operation: ', error.message);

    });

  }

  render() {

    const {setAttributes} = this.props;
    const attributeName = this.props.data.attributeName;

    const selectStyles = { menu: styles => {
        return {...styles, position: "relative"};
      }
    };

    return(
        <PanelBody
            title={this.props.data.title}
            initialOpen={false}
        >
          <Select
              styles={selectStyles}
              classNamePrefix="daextsoenl-react-select"
              value={this.state.selectedOption}
              onChange={( selectedOption ) => {
                setAttributes({[attributeName]: selectedOption.value});
                this.setState({selectedOption});
              }}
              options={this.state.options}
              placeholder={this.state.placeholder}
              noOptionsMessage={() => __('No options', 'soccer-engine-lite')}
          />
        </PanelBody>
    );

  }

}

export default GenericReactSelect;