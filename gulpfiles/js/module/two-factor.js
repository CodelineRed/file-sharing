'use strict';

/**
 * Init script for two factor page
 * 
 * @returns {undefined}
 */
function initTwoFactor() {
    (function($) {
        $('[id^="tf_code_"]').keyup(function() {
            let id = $(this).attr('id');
            id = parseInt(id.substring(id.length - 1, id.length)) + 1;
            let code = $('[id="tf_code_1"]').val() + $('[id="tf_code_2"]').val() 
                + $('[id="tf_code_3"]').val() + $('[id="tf_code_4"]').val() 
                + $('[id="tf_code_5"]').val() + $('[id="tf_code_6"]').val();
            $('[id="tf_code"]').val(code);

            if (id > 0 && id < 7) {
                $('[id="tf_code_' + id + '"]').focus();
            }
        });

        $('.toggle-tf-form').click(function(event) {
            event.preventDefault();
            if ($('#tf-form:visible').length) {
                $('#tf-form').hide();
                $('#rc-form').show();
                $('#rc-form input[type="text"]').first().focus();
            } else {
                $('#tf-form').show();
                $('#rc-form').hide();
                $('#tf-form input[type="text"]').first().focus();
            }
        });
    })(jQuery);
}
