/*global bootstrap*/
'use strict';

/**
 * Init all tooltips
 * 
 * @returns {undefined}
 */
function initTooltip() {
    (function($) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')); // eslint-disable-line array-bracket-newline
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    })(jQuery);
}
