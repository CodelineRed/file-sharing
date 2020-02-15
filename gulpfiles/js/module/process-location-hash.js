'use strict';

/**
 * Process location hash value
 * 
 * @returns {undefined}
 */
function processLocationHash() {
    (function($) {
        var hash = window.location.hash;
        
        if (typeof hash === 'string' && hash !== '') {
            if (/Tab/.test(hash)) {
                $(hash).click();
            }
        }
    })(jQuery);
}
