/*global dataTablesLangUrl*/
'use strict';

/**
 * Init data table
 * 
 * @returns {undefined}
 */
function initDataTable() {
    (function($) {
        $('.data-table').DataTable({
            'language': {
                'url': dataTablesLangUrl
            }
        });
    })(jQuery);
}
