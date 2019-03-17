<?php
# See http://php.net/manual/de/function.sprintf.php if you want to use placeholders in strings
return [
    'user' => 'User',
    'role' => 'Role',
    'name' => 'Name',
    'provider' => 'Provider',
    'purpose' => 'Purpose',
    'expires' => 'Expires',
    'type' => 'Type %1$s',
    'session' => 'Session',
    'password' => 'Password',
    'password-repeat' => 'Password repeat',
    'user-name' => 'User name',
    'login' => 'Login',
    'created-at' => 'Created at',
    'updated-at' => 'Updated at',
    'construction' => 'This service is temporarily not available',
    'failed-csrf' => 'Failed CSRF check',
    'not-allowed-method' => 'Method must be one of',
    'page-not-found' => 'Page not found',
    'unauthorized' => 'Unauthorized',
    'auth-code' => 'Authentication Code',
    'code' => 'Code',
    'submit' => 'Submit',
    'guest' => 'Guest',
    'member' => 'Member',
    'admin' => 'Admin',
    'superadmin' => 'Superadmin',
    'enable-2fa' => 'Enable two factor auth',
    'enable-2fa-step1' => '1. Install "Google Authenticator" (<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en" target="_blank">Android</a> or <a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8" target="_blank">iOS</a>) on your mobile device.',
    'enable-2fa-step2' => '2. Enter "Secret" into the app or scan the QR code.<br/>Handle "Secret" like a password and save it.',
    'enable-2fa-step3' => '3. Enter code from the app into input field.',
    '2fa-secret' => 'Secret',
    'recovery-codes' => 'Recovery Codes',
    'recovery-codes-text' => 'Treat this codes like passwords and save them.<br/>You will see them only this time.',
    'back-to' => 'Back to',
    '2fa-enabled' => 'Two factor auth is enabled',
    'file-extension' => 'File Extension',
    'file-extension-ph' => 'File Extension e.g. \'.mp3\'',
    'extension-unlocked' => 'Extension unlocked',
    'locked' => 'Locked',
    'lock-file' => 'Lock file',
    'lock-user' => 'Lock user',
    'unlocked' => 'Unlocked',
    'unlock-file' => 'Unlock file',
    'unlock-user' => 'Unlock user',
    'show-file' => 'Show file',
    'file-size' => 'File size',
    'file-name' => 'File name',
    'files' => 'Files',
    'owner' => 'Owner',
    'remove' => 'Remove',
    'remove-user' => 'Remove user',
    'no-files' => 'No files were found',
    'download' => 'Download',
    'upload' => 'Upload',
    'upload-file' => 'Upload file',
    'choose-file' => 'File (max. %1$s)',
    'note' => 'Note',
    'note-included' => 'Note belongs to file.',
    'no-audio-support' => 'Your browser does not support the audio element',
    'no-video-support' => 'Your browser does not support the video element',
    'file-not-accessible' => 'File is not accessible',
    'file-not-exists' => 'File doesn\'t exists',
    'user-not-exists' => 'User doesn\'t exists',
    'user-is-hidden' => 'User is locked',
    'cookie-policy-title' => 'Cookie Policy',
    'cookie-policy-text' => 'This website uses cookies to determine if a user is logged in, in which language texts are displayed and if the user has already been redirected to their preferred language.',
    'confirm-remove' => 'Delete irrevocably?',
    'admin-funcs' => 'Admin functions',
    
    'file-show-m1' => 'File is missing on disk',
    'file-upload-m1' => 'File "%1$s" was successfully uploaded',
    'file-upload-m2' => 'File extension not allowed',
    'file-upload-m3' => 'An error occoured (code: %1$s)',
    'file-upload-m4' => 'File could not uploaded',
    'file-upload-m5' => 'Note "%1$s" was created',
    'file-hidden-m0' => 'File "<a href="%2$s" class="alert-link">%1$s</a>" is now locked',
    'file-hidden-m1' => 'File "<a href="%2$s" class="alert-link">%1$s</a>" is now unlocked',
    'file-hidden-m2' => 'Not owner of file',
    'file-hidden-m3' => 'User was not found',
    'file-remove-m1' => 'File "%1$s" was removed',
    'file-remove-m2' => 'Not owner of file',
    'file-remove-m3' => 'User was not found',
    'file-extension-remove-m1' => 'File extension "%1$s" was removed',
    'file-extension-remove-m2' => 'File extension was not found',
    'file-extension-hidden-m0' => 'File "%1$s" is now unlocked',
    'file-extension-hidden-m1' => 'File "%1$s" is now locked',
    'file-extension-hidden-m2' => 'File extension was not found',
    'file-extension-create-m1' => 'File extension exists',
    'file-extension-create-m2' => 'File type doesn\'t exists',
    'file-extension-create-m3' => 'File extension not allowed',
    'file-extension-create-m4' => 'File extension "%1$s" was created',
    'file-extension-create-m5' => 'File extension or file type is not a string',
    'user-save-m1' => 'User exists',
    'user-save-m2' => 'User name is too short (min. %1$s chars)',
    'user-save-m3' => 'Password is too short (min. %1$s chars)',
    'user-save-m4' => 'User "<a href="%2$s" class="alert-link">%1$s</a>" was created',
    'user-save-m5' => 'Password or user is not a string',
    'user-hidden-m0' => 'User "<a href="%2$s" class="alert-link">%1$s</a>" is now locked',
    'user-hidden-m1' => 'User "<a href="%2$s" class="alert-link">%1$s</a>" is now unlocked',
    'user-hidden-m2' => 'Access denied',
    'user-remove-m1' => 'User "%1$s" was removed',
    'user-remove-m2' => 'Failed to remove user "%1$s"',
    'register-flash-m1' => 'User name is taken',
    'register-flash-m2' => 'User name too short (at least %1$s characters)',
    'register-flash-m3' => 'Password too short (at least %1$s characters)',
    'register-flash-m4' => 'Password was repeated incorrectly',
    'register-flash-m5' => 'Registration complete',
    'register-flash-m6' => 'Captcha failed',
    'register-flash-m7' => 'User name too long (max %1$s characters)',
    'register-flash-m8' => 'User name can only contains: a-z, A-Z, 0-9, _, -',
    'register-flash-m9' => 'User name not allowed',
    'register-flash-m10' => 'Password must include at least one number',
    'register-flash-m11' => 'Password must include at least one lowercase letter',
    'register-flash-m12' => 'Password must include at least one uppercase letter',
    'register-flash-m13' => 'Password must include at least one symbol',
    
    // cookie layer
    'cl-header' => 'Cookies used on the website!',
    'cl-message' => 'This website uses cookies to ensure you get the best experience on our website. You agree to our cookies if you continue to use our website.',
    'cl-dismiss' => 'Got it!',
    'cl-allow' => 'Allow cookies',
    'cl-deny' => 'Decline',
    'cl-link' => 'Learn more',
    'cl-message-link' => 'Learn more about cookies',
    'cl-dismiss-link' => 'Dismiss cookie message',
    'cl-allow-link' => 'Allow cookies',
    'cl-policy' => 'Cookie Policy',
    'cl-href' => '#privacypolicy',
    
    // cookie policy modal
    'cpm-sdi' => 'Show detailed information',
    'cpm-php' => 'Maintains user states on all page requests.',
    'cpm-auto-detect' => 'Set when the user has been redirected to their preferred language.',
    'cpm-cc-status' => 'Saves the consent status of the user for cookies on the current domain.',
    'cpm-current-locale' => 'Saves in which language the web page is displayed.',
    'cpm-1pjar' => 'Google uses these cookies, based on recent searches and interactions, to customise ads on Google websites.',
    'cpm-consent' => 'This cookie is used by Google for cookie approval.',
    'cpm-nid' => 'These cookies are used by Google to store user preferences and information when viewing pages with Google maps on them.',
    'cpm-ogpc' => 'These cookies are used by Google to store user preferences and information when viewing pages with Google maps on them.',
    'cpm-type1' => 'Type 1 = Absolutely required cookie',
    'cpm-type2' => 'Type 2 = Function cookie',
    'cpm-type3' => 'Type 3 = Service cookie',
    'cpm-type4' => 'Type 4 = Third party cookie',
    
    // navigation labels
    'page-index-label' => 'Home',
    'page-example-label' => 'Example page',
    'user-show-label' => 'Profile',
    'user-show-all-label' => 'All profiles',
    'user-login-label' => 'Login',
    'user-logout-label' => 'Logout',
    'user-create-label' => 'Create profile',
    'user-two-factor-label' => 'Enable two factor auth',
    'user-register-label' => 'Register',
    'file-extension-show-label' => 'Show file extensions',
    'file-extension-create-label' => 'Create file extension',
    'langswitch-label' => 'EN',
    'langswitch-image' => '<img src="https://cdn.rawgit.com/hjnilsson/country-flags/master/svg/us.svg" style="max-height: 20px;">',
    
    // misc
    // decimal point
    'dp' => '.',
    // thousands separator
    'ts' => ',',
    'date' => 'Y-m-d',
    'time' => 'g:ia',
    'datetime' => 'Y-m-d g:ia',
    'timezone' => 'America/New_York',
    
    'month' => '%1$s month',
    'months' => '%1$s months',
    'year' => '%1$s year',
    'years' => '%1$s years',
];
