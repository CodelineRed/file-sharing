/*global initCookieConsent initEditFile dataTablesLangUrl confirmRemove*/
'use strict';

// jQuery.noConflict();
(function($) {
    $(document).ready(function() {
        $('html').removeClass('no-js');
        $('[data-toggle="tooltip"]').tooltip();
        
        // display selected file in label tag
        $('input[type="file"]').change(function(e) {
            $(this).next().text(e.target.files[0].name);
        });
        
        // disable submit button after submit
        $('form').submit(function(e) {
            $('input[type="submit"],button[type="submit"]').attr('disabled', 'disabled');
        });
        
        // show confirm message before removing a record
        $('[data-remove]').click(function(e) {
            if (!confirm(confirmRemove + '\n"' + $(this).data('remove') + '"')) { // eslint-disable-line  no-alert
                e.preventDefault();
            }
        });
        
        // initialize tables with DataTable
        $('.data-table').DataTable({
            'language': {
                'url': dataTablesLangUrl
            }
        });
        
        initCookieConsent();
        initEditFile();
    });
})(jQuery);
