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
        
        $('[class*="remove-"]').click(function(e) {
            if (!confirm('Are you sure to remove this record?')) { // eslint-disable-line  no-alert
                e.preventDefault();
            }
        });
        
        // initialize tables with DataTable
        $('table').DataTable({
            'language': {
                'url': dataTablesLangUrl
            }
        });
    });
})(jQuery);
