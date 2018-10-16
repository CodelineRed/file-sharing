'use strict';

// jQuery.noConflict();
(function($) {
    $(document).ready(function() {
        $('html').removeClass('no-js');
        $('[data-toggle="tooltip"]').tooltip();
        
        $('input[type="file"]').change(function(e) {
            $(this).next().text(e.target.files[0].name);
        });
        
        $('form').submit(function(e) {
            $('input[type="submit"],button[type="submit"]').attr('disabled', 'disabled');
        });
    });
})(jQuery);
