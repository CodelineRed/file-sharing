'use strict';
/**
 * Handled cookie banner look and behavior
 * 
 * @param {object} $ jQuery object
 * @returns {undefined}
 */
(function($) {
    window.addEventListener('load', function() {
        window.cookieconsent.initialise({
            window: '<div role="dialog" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window w-100 {{classes}}">'
                    + '<div class="container"><div class="row align-items-center">{{children}}</div></div></div>',
            elements: {
                messagelink: '<div class="col-12 col-sm-8 col-lg-10 pb-3 pb-sm-0"><span id="cookieconsent:desc" class="cc-message">{{message}} ' 
                        + '<a aria-label="' + cookieLayer.messageLink + '" tabindex="0" class="cc-link" href="{{href}}" data-toggle="modal" data-target="#cookie-policy">{{link}}</a></span></div>',
                dismiss: '<a aria-label="' + cookieLayer.dismissLink + '" tabindex="0" class="cc-btn cc-dismiss">{{dismiss}}</a>',
                allow: '<a aria-label="' + cookieLayer.allowLink + '" tabindex="0" class="cc-btn cc-allow">{{allow}}</i></a>'
            },
            compliance: {
                info: '<div class="cc-compliance col-12 col-sm-4 col-lg-2">{{dismiss}}</div>',
                'opt-in':'<div class="cc-compliance cc-highlight col-12 col-sm-6 col-lg-4">{{dismiss}}{{allow}}</div>',
                'opt-out': '<div class="cc-compliance cc-highlight col-12 col-sm-6 col-lg-4">{{deny}}{{dismiss}}</div>'
            },
            palette: {
                popup: {
                    background: '#2c3034',
                    text: '#ffffff'
                },
                button: {
                    background: '#2e97bf',
                    text: '#ffffff'
                }
            },
            theme: 'classic',
            type: 'info',
            content: {
                header: cookieLayer.header,
                message: cookieLayer.message,
                dismiss: cookieLayer.dismiss,
                allow: cookieLayer.allow,
                deny: cookieLayer.deny,
                link: cookieLayer.link,
                policy: cookieLayer.policy,
                href: cookieLayer.href
            },
            onInitialise: function(status) {
                var type = this.options.type;
                var didConsent = this.hasConsented();
                if (type === 'opt-in' && didConsent) {
                    // enable cookies
                }
                if (type === 'opt-out' && !didConsent) {
                    // disable cookies
                }

                setTimeout(function() {
                    $('.cc-window').remove();
                }, 250);
            },
            onPopupOpen: function() {
                // do something
            },
            onPopupClose: function() {
                // do something
            },
            onStatusChange: function(status, chosenBefore) {
                var type = this.options.type;
                var didConsent = this.hasConsented();
                if (type === 'opt-in' && didConsent) {
                    // enable cookies
                }
                if (type ==='opt-out' && !didConsent) {
                    // disable cookies
                }

                setTimeout(function() {
                    $('.cc-window').remove();
                }, 250);
            },
            onRevokeChoice: function() {
                var type = this.options.type;
                if (type === 'opt-in') {
                    // disable cookies
                }
                if (type === 'opt-out') {
                    // enable cookies
                }
            }
        });
    });
})(jQuery);
