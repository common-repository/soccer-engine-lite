/**
 * Shows and display the event tooltip on the mouseover and mouseout events.
 */
window.addEventListener('load', () => {

  //add the hover event listener on the tooltips
  const eventTooltipTriggers = document.querySelectorAll(
      '.daextsoenl-match-visual-lineup .daextsoenl-event-tooltip-trigger');

  for (const eventTooltipTrigger of eventTooltipTriggers) {

    eventTooltipTrigger.addEventListener('mouseover', (event) => {

      const positionTop = event.target.offsetTop;
      const positionLeft = event.target.offsetLeft;
      const nextElement = event.target.nextElementSibling;

      nextElement.style.display = 'block';
      nextElement.style.top = parseInt(positionTop - 24, 10) + 'px';
      nextElement.style.left = parseInt(positionLeft + 28, 10) + 'px';
      nextElement.style.position = 'absolute';

    });

    eventTooltipTrigger.addEventListener('mouseout', (event) => {

      if (event.target.className !==
          'daextsoenl-event-icon daextsoenl-event-tooltip-trigger') {
        return;
      }

      const nextElement = event.target.nextElementSibling;
      nextElement.style.display = 'none';

    });

  }

});