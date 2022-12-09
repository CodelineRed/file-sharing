/*global dataTablesLangUrl*/
'use strict';
let dataTables = {};

/**
 * Sets table state to localStorage
 * 
 * @param {string} id
 * @returns {undefined}
 */
function setTableState(id) {
    let tableState = JSON.parse(localStorage.getItem(id));

    if (typeof tableState === 'object' 
            && dataTables[id]['init'] === true) {
        let order = dataTables[id]['ref'].order();
        let pageInfo = dataTables[id]['ref'].page.info();
        let search = dataTables[id]['ref'].search();

        tableState = {
            'init': false,
            'length': pageInfo.length,
            'orderColumn': order[0][0],
            'orderBy': order[0][1],
            'page': pageInfo.page,
            'search': search
        };

        localStorage.setItem(id, JSON.stringify(tableState));
    }
}

/**
 * Init data table
 * 
 * @returns {undefined}
 */
function initDataTable() {
    (function($) {
        $('.data-table').each(function() {
            let id = $(this).attr('id');
            dataTables[id] = {};
            dataTables[id]['init'] = false;
            dataTables[id]['ref'] = $('#' + id).DataTable({
                'language': {
                    'url': dataTablesLangUrl
                }
            });
        });

        // restore table to last table state
        $('.data-table').on('init.dt', function(e, settings, json) {
            let id = $(e.target).attr('id');
            let tableState = JSON.parse(localStorage.getItem(id));

            if (typeof dataTables[id] === 'object') {
                if (typeof tableState === 'object' && tableState !== null) {
                    dataTables[id]['ref'].order([tableState.orderColumn, tableState.orderBy]).draw(); // eslint-disable-line array-bracket-newline
                    dataTables[id]['ref'].search(tableState.search);
                    dataTables[id]['ref'].page.len(tableState.length);
                    dataTables[id]['ref'].page(tableState.page).draw('page');
                }
                localStorage.setItem(id, JSON.stringify(tableState));
            }
        });

        // on length change
        $('.data-table').on('draw.dt', function(e, settings, len) {
            dataTables[$(e.target).attr('id')]['init'] = true;
        });

        // on length change
        $('.data-table').on('length.dt', function(e, settings, len) {
            setTableState($(e.target).attr('id'));
        });

        // on order change
        $('.data-table').on('order.dt', function(e, settings, ordArr) {
            setTableState($(e.target).attr('id'));
        });

        // on page change
        $('.data-table').on('page.dt', function(e, settings) {
            setTableState($(e.target).attr('id'));
        });

        // on search change
        $('.data-table').on('search.dt', function(e, settings) {
            setTableState($(e.target).attr('id'));
        });
    })(jQuery);
}
