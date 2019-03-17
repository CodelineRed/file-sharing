'use strict';

/**
 * @param {object} $
 * @returns {undefined}
 */
(function($) {
    if (document.querySelector('html').classList.contains('locale-process-session')) {
        for (var i = 0; i < document.querySelectorAll('a.langswitch').length; i++) {
            document.querySelectorAll('a.langswitch')[i].onclick = function(event) {
                event.preventDefault();
                setCookie('current_locale', this.getAttribute('data-locale'), 365);
                window.location.reload();
            };
        }
    }
})(jQuery);
