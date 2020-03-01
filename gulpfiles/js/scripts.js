/*global confirmRemove initCookieConsent initCreateFolder initDataTable initUpdateFile initUpdateFolder initUploadFileForm processLocationHash*/
'use strict';

// jQuery.noConflict();
(function($) {
    $(document).ready(function() {
        $('html').removeClass('no-js');
        $('[data-toggle="tooltip"]').tooltip();
        
        // disable submit button after submit
        $('form').submit(function(e) {
            $('input[type="submit"],button[type="submit"]').attr('disabled', 'disabled');
        });
        
        // show confirm message before removing a record
        $('[data-remove]').click(function(e) {
            if (!confirm(confirmRemove + '\n' + $(this).data('remove'))) { // eslint-disable-line  no-alert
                e.preventDefault();
            }
        });
        
        $('[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            window.location.hash = $(e.target).data('id');
        });
        
        $('.modal').on('shown.bs.modal', function(e) {
            $(this).find('input[type="text"]').first().focus();
        });
        
        initCookieConsent();
        initCreateFolder();
        initDataTable();
        initUpdateFile();
        initUpdateFolder();
        initUploadFileForm();
        processLocationHash();
    });
})(jQuery);
