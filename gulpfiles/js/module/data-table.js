/*global dataTablesLangUrl*/
'use strict';

/**
 * Sets table state to localStorage
 * 
 * @param {object} tables
 * @param {string} id
 * @returns {undefined}
 */
function setTableState(tables, id) {
    let tableState = JSON.parse(localStorage.getItem(id));

    if (typeof tableState === 'object' 
            && tables[id]['init'] === true) {
        let order = tables[id]['ref'].order();
        let pageInfo = tables[id]['ref'].page.info();
        
        tableState = {
            'orderColumn': order[0][0],
            'orderBy': order[0][1],
            'page': pageInfo.page,
            'init': false
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
        let tables = {};
        
        $('.data-table').each(function() {
            let id = $(this).attr('id');
            tables[id] = {};
            tables[id]['init'] = false;
            tables[id]['ref'] = $('#' + id).DataTable({
                'language': {
                    'url': dataTablesLangUrl
                }
            });
        });
        
        // restore table to last table state
        $('.data-table').on('init.dt', function(e, settings, json) {
            let id = $(e.target).attr('id');
            let tableState = JSON.parse(localStorage.getItem(id));
            
            if (typeof tables[id] === 'object') {
                if (typeof tableState === 'object' && tableState !== null) {
                    tables[id]['ref'].order([tableState.orderColumn, tableState.orderBy]).draw(); // eslint-disable-line array-bracket-newline
                    tables[id]['ref'].page(tableState.page).draw('page');
                }
                tables[id]['init'] = true;
                localStorage.setItem(id, JSON.stringify(tableState));
            }
        });
        
        // on order change
        $('.data-table').on('order.dt', function(e, settings, ordArr) {
            setTableState(tables, $(e.target).attr('id'));
        });
        
        // on page change
        $('.data-table').on('page.dt', function(e, settings) {
            setTableState(tables, $(e.target).attr('id'));
        });
    })(jQuery);
}
