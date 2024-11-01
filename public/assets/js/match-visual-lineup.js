/*
 * Position the elements in the field of the "Match Visual Lineup" block.
 */
window.addEventListener('load', () => {

  daps_position_field_elements();

});

function daps_position_field_elements() {

  let el;

  var elements = document.getElementsByClassName(
      'daextsoenl-match-visual-lineup-left-formation-player-container');

  for (let i = 0; i < elements.length; i++) {

    let current = elements[i];

    let numberOfIcons = 0;
    let positionsApplied = 0;

    //get the coords x and y
    let x = current.getAttribute('data-position-x');
    let y = current.getAttribute('data-position-y');

    //calculate the total number of icons for each player so that the x position can be handled properly
    el = current.nextElementSibling;
    while(el !== null){

      if (el.classList.contains('daextsoenl-event-icon')) {
        numberOfIcons++;
      }

      if (el.classList.contains(
          'daextsoenl-match-visual-lineup-left-formation-player-container')) {
        break;
      }

      el = el.nextElementSibling;

    }

    //set the positions of the icons -------------------------------------------
    el = current.nextElementSibling;
    while(el !== null){

      if (el.classList.contains('daextsoenl-event-icon')) {

        //calculate xOffset
        let xOffset = 16 * positionsApplied - (numberOfIcons * 16 / 2) + 8;

        el.style.position = 'absolute';
        el.style.top = 'calc(' + y + '% + 44px)';
        el.style.left = 'calc(' + x + '% + ' + xOffset + 'px)';
        positionsApplied++;

      }

      if (el.classList.contains(
          'daextsoenl-match-visual-lineup-left-formation-player-container')) {
        break;
      }

      el = el.nextElementSibling;

    }

    //Make the player containers and the icons visible -----------------------
    let el2 = document.getElementsByClassName(
        'daextsoenl-match-visual-lineup-left-formation-player-container');
    for (let i = 0; i < el2.length; i++) {
      el2[i].style.visibility = 'visible';
    }
    let el3 = document.querySelectorAll(
        '.daextsoenl-match-visual-lineup-left-formation .daextsoenl-event-icon');
    for (let i = 0; i < el3.length; i++) {
      el3[i].style.visibility = 'visible';
    }

  }

}