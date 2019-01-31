'use strict';

/**
 * @param {string} cname
 * @param {string} cvalue
 * @param {integer} exdays
 * @returns {undefined}
 */
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = 'expires='+d.toUTCString();
    document.cookie = cname + '=' + cvalue + ';' + expires + ';path=/';
}

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
