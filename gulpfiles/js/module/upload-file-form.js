'use strict';

/**
 * Init upload file form
 * 
 * @returns {undefined}
 */
function initUploadFileForm() {
    (function($) {
        // display selected file in label tag
        $('input[type="file"]').change(function(e) {
            $(this).next().text(e.target.files[0].name);
        });
        
        // disable file_included if note has changed and file is empty
        $('textarea[name="note"]').keyup(function(e) {
            if ($('input[type="file"]').val() === '' && $('input[name="file_included"]:checked').length) {
                $('label[for="file_included"]').click();
            }
        });
        
        $('textarea[name="note"]').change(function(e) {
            if ($('input[type="file"]').val() === '' && $('input[name="file_included"]:checked').length) {
                $('label[for="file_included"]').click();
            }
        });
    })(jQuery);
}
