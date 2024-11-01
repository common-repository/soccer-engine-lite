class DaextsoenlPaginatedTable {

  constructor(settings) {

    this.ajaxUrl = DAEXTSOENL_PHPDATA.ajaxUrl;
    this.nonce = DAEXTSOENL_PHPDATA.nonce;
    this.currentPage = 1;
    this.action = 'daextsoenl_get_paginated_table_data';
    this.tableId = settings.tableId;
    this.filter = settings.filter;
    this.columns = settings.columns;
    this.hiddenColumnsBreakpoint1 = settings.hiddenColumnsBreakpoint1;
    this.hiddenColumnsBreakpoint2 = settings.hiddenColumnsBreakpoint2;
    this.pagination = settings.pagination;
    this.tableIdAttribute = settings.tableIdAttribute;

    this.bindEventListeners();

  }

  bindEventListeners() {

    this.requestTableData();

  }

  requestTableData() {

    var oReq = new XMLHttpRequest();
    oReq.addEventListener('load', this.updateTable.bind(this, oReq));
    oReq.open('POST', this.ajaxUrl);
    oReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    var params = 'action=' + this.action;
    params += '&security=' + this.nonce;
    params += '&current_page=' + this.currentPage;
    params += '&table_id=' + this.tableId;
    params += '&filter=' + JSON.stringify(this.filter);
    params += '&columns=' + JSON.stringify(this.columns);
    params += '&hidden_columns_breakpoint_1=' +
        JSON.stringify(this.hiddenColumnsBreakpoint1);
    params += '&hidden_columns_breakpoint_2=' +
        JSON.stringify(this.hiddenColumnsBreakpoint2);
    params += '&pagination=' + this.pagination;
    oReq.send(params);

  }

  updateTable(oReq) {

    try {
      JSON.parse(oReq.responseText);
    } catch (e) {
      return;
    }

    let data = JSON.parse(oReq.responseText);
    let mainBlock = null;

    if (typeof data.body === 'undefined' || data.head.length === 0) {

      //Remove all the elements from the table container
      let myNode = document.getElementById(this.tableIdAttribute);
      myNode.innerText = '';

      //Add the main html block
      mainBlock = document.createElement('p');

      mainBlock.classList.add('daextsoenl-no-data-paragraph');

      // mainBlock.id = 'my-dynamic-table';
      mainBlock.innerHTML = 'There are no data associated with your selection.';

      document.getElementById(this.tableIdAttribute).appendChild(mainBlock);

    } else {

      //Generate the table -----------------------------------------------------

      //update table in the dom
      let html = '' +
          '<table>' +
          '<thead>';

      html += '<tr>';
      data.head.forEach(function(item, index2) {
        html += '<th data-column="' + item.column_name +
            '" data-breakpoint-1-hidden="' + item.breakpoint_1_hidden + '" ' +
            'data-breakpoint-2-hidden="' + item.breakpoint_2_hidden + '"' +
            '>' + item.column_title + '</th>';
      });
      html += '</tr>';

      html += '</thead>' +

          '<tbody>';

      data.body.forEach(function(itemA, index1) {
        html += '<tr>';
        itemA.forEach(function(item, index2) {
          html += '<td data-column="' + data.head[index2].column_name +
              '" data-breakpoint-1-hidden="' +
              data.head[index2].breakpoint_1_hidden + '"' +
              'data-breakpoint-2-hidden="' +
              data.head[index2].breakpoint_2_hidden + '"' + '>' + item +
              '</td>';
        });
        html += '</tr>';
      });

      '</tbody>' +

      '</table>';

      //Remove all the elements from the table container
      let myNode = document.getElementById(this.tableIdAttribute);
      myNode.innerText = '';

      //Add the main html block
      mainBlock = document.createElement('table');
      // mainBlock.id = 'my-dynamic-table';
      mainBlock.innerHTML = html;

      document.getElementById(this.tableIdAttribute).appendChild(mainBlock);

      //Add the HTML of the pagination -------------------------------------------
      let paginationHtml = this.generatePaginationHtml(data.pagination);

      //Add the pagination HTML to the DOM
      let paginationBlock = document.createElement('div');
      paginationBlock.id = this.tableIdAttribute + '-pagination';
      paginationBlock.classList = 'daextsoenl-paginated-table-pagination';
      paginationBlock.innerHTML = paginationHtml;
      document.getElementById(this.tableIdAttribute).
          appendChild(paginationBlock);

      const buttons = document.querySelectorAll(
          '#' + this.tableIdAttribute + '-pagination ' + 'a:not(.disabled)');

      for (const button of buttons) {
        button.addEventListener('click', (event) => {

          event.preventDefault();

          let currentPage = parseInt(event.target.getAttribute('data-page'),
              10);
          if (typeof (currentPage) !== 0) {
            this.currentPage = currentPage;
            this.requestTableData();
          }

        });
      }

    }

    //add the hover event listener on the tooltips
    const eventTooltipTriggers = document.querySelectorAll(
        '#' + this.tableIdAttribute + ' .daextsoenl-event-tooltip-trigger');

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

  }

  /**
   * Generate the HTML of the pagination based on the data available in the provided array.
   *
   * @param data_a An array with the data of the pagination
   * @returns {string} The HTML of the pagination
   */
  generatePaginationHtml(data_a) {

    var pagination_html = '';

    data_a.items.forEach(function(item, index) {

      switch (item.type) {

        case 'prev':
          var class_name = item.disabled ? 'disabled' : 'prev';
          pagination_html += '<a data-page="' +
              parseInt(item.destination_page, 10) +
              '" href="javascript: void(0)" class="' + class_name +
              '">&#171</a>';
          break;

        case 'next':

          var class_name = item.disabled ? 'disabled' : 'prev';
          pagination_html += '<a data-page="' +
              parseInt(item.destination_page, 10) +
              '" href="javascript: void(0)" class="' + class_name +
              '">&#187</a>';

          break;

        case 'ellipses':

          pagination_html += '<span>...</span>';

          break;

        case 'number':

          var class_name_value = item.disabled ? 'class="page disabled"' : '';
          pagination_html += '<a data-page="' +
              parseInt(item.destination_page, 10) +
              '" href="javascript: void(0)" ' + class_name_value + '>' +
              parseInt(item.destination_page, 10) + '</a>';

          break;

      }

    });

    return '<div class="daextsoenl-paginated-table-pagination-inner">' +
        pagination_html + '</div>';

  }

}