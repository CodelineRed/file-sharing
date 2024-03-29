<?php
namespace App\Controller;

use App\Entity\File;
use App\Entity\RecoveryCode;
use App\Entity\Role;
use App\Entity\UploadLimit;
use App\Entity\User;
use App\Utility\GeneralUtility;
use App\Utility\LanguageUtility;

/**
 * UserController is used for pages in context of user
 */
class UserController extends BaseController {

    /**
     * Shows registration form
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function registerAction($request, $response, $args) {
        if ($this->settings['active_pages']['register'] === FALSE && $this->currentRole !== 'superadmin') {
            return $this->view->render($response, 'partials/construction.html.twig', array_merge($args, []));
        }

        // Render view
        return $this->view->render($response, 'user/register.html.twig', array_merge($args, []));
    }

    /**
     * Saves data from registration form
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function saveRegisterAction($request, $response, $args) {
        if ($this->settings['active_pages']['register'] === FALSE && $this->currentRole !== 'superadmin') {
            return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
        }
        $rcRespSuccess = TRUE;

        if (isset($this->settings['recaptcha']['secret']) && strlen($this->settings['recaptcha']['secret']) > 20) {
            $recaptcha = new \ReCaptcha\ReCaptcha($this->settings['recaptcha']['secret']);
            $resp = $recaptcha->setExpectedHostname($request->getServerParam('SERVER_NAME'))
                ->verify($request->getParam('g-recaptcha-response'), GeneralUtility::getUserIP());
            $rcRespSuccess = $resp->isSuccess();
        }

        if ($rcRespSuccess || isset($_ENV['docker'])) {
            $userName = $request->getParam('user_name');
            $userPass = $request->getParam('user_pass');
            $userPassRepeat = $request->getParam('user_pass_repeat');
            $validation = [
                'user_not_duplicated' => TRUE,
            ];

            // if validation passed
            if (GeneralUtility::validateUser($userName, $userPass, $userPassRepeat, $validation)) {
                $role = $this->em->getRepository('App\Entity\Role')->findOneBy(['name' => 'member']);
                $uploadLimit = $this->em->getRepository('App\Entity\UploadLimit')->findOneBy(['name' => 'general']);

                if ($role instanceof Role && $uploadLimit instanceof UploadLimit) {
                    $user = new User();
                    $user->setName($userName)
                        ->setPass($userPass)
                        ->setRole($role)
                        ->setUploadLimit($uploadLimit);
                    $this->em->persist($user);
                    $this->em->flush();
                    $this->flash->addMessage('message', LanguageUtility::trans('register-flash-m5') . ';' . self::STYLE_SUCCESS);
                }

                return $response->withRedirect($this->router->pathFor('user-login-' . LanguageUtility::getGenericLocale()));
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('register-flash-m6') . ';' . self::STYLE_DANGER);
        }

        return $response->withRedirect($this->router->pathFor('user-register-' . LanguageUtility::getLocale()));
    }

    /**
     * Shows user settings
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function settingsAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);

        // if user is not allowed to see page
        if (!($user instanceof User 
            && (($this->currentUser === $user->getId() && $this->acl->isAllowed($this->currentRole, 'update_user')) 
            || $this->acl->isAllowed($this->currentRole, 'update_user_other')))) {
            return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
        }

        // Render view
        return $this->view->render($response, 'user/settings.html.twig', array_merge($args, []));
    }

    /**
     * Shows user detail page
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function showAction($request, $response, $args) {
        // if is other user and current user is alowed show_user_other
        if (isset($args['name']) && $this->acl->isAllowed($this->currentRole, 'show_user_other')) {
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);

            // if user exists
            if ($user instanceof User && !$user->isHidden()) {
                //$this->logger->info("User '" . $args['name'] . "' found - UserController:show");
            } elseif ($this->currentRole !== 'superadmin' || $user === NULL) {
                // if user exits and is hidden
                if ($user instanceof User && $user->isHidden()) {
                    $this->logger->info("User '" . $args['name'] . "' is hidden - UserController:show");
                    $this->flash->addMessage('message', LanguageUtility::trans('user-is-hidden') . ';' . self::STYLE_DANGER);
                } else {
                    $this->logger->info("User '" . $args['name'] . "' not found - UserController:show");
                    $this->flash->addMessage('message', LanguageUtility::trans('user-not-exists') . ';' . self::STYLE_DANGER);
                }
                return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
            }
        } elseif (!is_null($this->currentUser) && !isset($args['name']) && $this->acl->isAllowed($this->currentRole, 'show_user')) {
            // if is logged in user and allowed show_user
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);

            // if user not exists or is hidden
            if ($user === NULL || $user->isHidden()) {
                GeneralUtility::setCurrentRole('guest');
                GeneralUtility::setCurrentUser(NULL);
                return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
            }
        } else {
            // if user is not logged in
            $this->logger->info("User not logged in - UserController:show");
            return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
        }

        // Render view
        return $this->view->render($response, 'user/show.html.twig', array_merge($args, [
            'user' => $user,
            'maxFileSize' => GeneralUtility::getUploadMaxFilesize(),
            'files' => $this->em->getRepository('App\Entity\User')->findUniqueFiles($user->getFiles()),
            'publicFiles' => $this->em->getRepository('App\Entity\User')->findPublicFiles($user->getFiles()),
            'roles' => $this->em->getRepository('App\Entity\Role')->findAll(),
        ]));
    }

    /**
     * Shows all user
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function showAllAction($request, $response, $args) {
        // Render view
        return $this->view->render($response, 'user/show-all.html.twig', array_merge($args, [
            'users' => $this->em->getRepository('App\Entity\User')->findAll(),
            'roles' => $this->em->getRepository('App\Entity\Role')->findAll(),
        ]));
    }

    /**
     * Updates role from user
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function updateRoleAction($request, $response, $args) {
        $currentUser = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);
        $role = $this->em->getRepository('App\Entity\Role')->findOneBy(['name' => $args['role']]);

        // if user not found or role not found
        if ($user === NULL || $role === NULL) {
            return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
        }

        // if current user is requested user
        if ($this->currentUser === $user->getId()) {
            GeneralUtility::setCurrentRole($role->getName());
        }

        // if current user is not requested user
        if ($this->currentUser !== $user->getId()) {
            // set argument to stay on user show page
            $args['name'] = $user->getName();
        }

        $user->setRole($role);
        $this->em->flush($user);

        $redirectPath = $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args);

        if (is_string($request->getParam('return'))) {
            $redirectPath = $request->getParam('return');
        } 

        $this->logger->info("User '" . $currentUser->getName() . "' changed role of '" . $user->getName() . "' to '" . $role->getName() . "' - UserController:updateRole");
        return $response->withRedirect($redirectPath);
    }

    /**
     * Shows login form
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function loginAction($request, $response, $args) {
        if ($this->settings['active_pages']['login'] === FALSE && $this->currentRole !== 'superadmin') {
            return $this->view->render($response, 'partials/construction.html.twig', array_merge($args, []));
        }

        // Render view
        return $this->view->render($response, 'user/login.html.twig', array_merge($args, []));
    }

    /**
     * Validates data from login form
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return static
     */
    public function loginValidateAction($request, $response, $args) {
        if ($this->settings['active_pages']['login'] === FALSE && $this->currentRole !== 'superadmin') {
            return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
        }

        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $request->getParam('user_name'), 'hidden' => 0]);
        unset($_SESSION['tempUser']);

        // if user exists
        if ($user instanceof User) {
            // if password valid
            if (password_verify($request->getParam('user_pass'), $user->getPass())) {
                $_SESSION['tempUser'] = $user->getId();
                return $response->withRedirect($this->router->pathFor('user-two-factor-' . LanguageUtility::getLocale()));
            } else {
                $this->logger->info("User " . $user->getId() . " wrong password - UserController:loginValidate");
            }
        } else {
            $this->logger->info("User '" . $request->getParam('user_name') . "' not found - UserController:loginValidate");
        }

        // user or password not valid - redirect to login
        return $response->withRedirect($this->router->pathFor('user-login-' . LanguageUtility::getGenericLocale()));
    }

    /**
     * Logout user from system
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function logoutAction($request, $response, $args) {
        GeneralUtility::setCurrentRole('guest');
        GeneralUtility::setCurrentUser(NULL);
        $this->logger->info("User " . $this->currentUser . " logged out - UserController:logout");
        return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
    }

    /**
     * Enables 2FA and generates recovery codes
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function enableTwoFactorAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
        $ga = new \PHPGangsta_GoogleAuthenticator();
        $secret = $user->getTwoFactorSecret();
        $passValid = FALSE;

        // if user has 2FA enabled
        if ($user->hasTwoFactor()) {
            unset($_SESSION['pass_code']);
            return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $user->getName()]));
        }

        // if empty - generate new secret and update user
        if (empty($secret)) {
            // create unique secret
            do {
                $secret = $ga->createSecret();
                $userSecret = $this->em->getRepository('App\Entity\User')->findOneBy(['twoFactorSecret' => $secret]);
            } while ($userSecret instanceof User);

            $user->setTwoFactorSecret($secret);
            $this->em->flush($user);
        }

        if ($request->isPost()) {
            $userPass = $request->getParam('user_pass');
            $passCode = $request->getParam('pass_code');

            // if password is valid
            if ($userPass !== NULL && $passCode === NULL && password_verify($userPass, $user->getPass())) {
                // set temporary values
                $passValid = TRUE;
                $_SESSION['pass_code'] = GeneralUtility::generateCode(6);
            } elseif (isset($_SESSION['pass_code']) && $_SESSION['pass_code'] === $passCode) {
                // if temporary pass_code valid
                $passValid = TRUE;
                $code = $request->getParam('tf_code');
                $checkResult = $ga->verifyCode($secret, $code, 2); // 2 = 2*30sec clock tolerance

                // if two factor is valid
                if ($checkResult) {
                    $user->setTwoFactor(TRUE);
                    $this->em->flush($user);
                    unset($_SESSION['pass_code']);

                    // disable old recovery codes
                    $oldRecoveryCodes = $this->em->getRepository('App\Entity\RecoveryCode')->findBy(['user' => $this->currentUser]);
                    foreach ($oldRecoveryCodes as $oldRecoveryCode) {
                        $this->em->remove($oldRecoveryCode);
                    }

                    // create unique recover codes
                    $countCodes = 0;
                    $recoveryCodes = [];
                    do {
                        $newRecoveryCode = GeneralUtility::generateCode();
                        $newEncryptRecoveryCode = GeneralUtility::encryptPassword($newRecoveryCode);
                        $recoveryCode = $this->em->getRepository('App\Entity\RecoveryCode')->findOneBy(['code' => $newEncryptRecoveryCode]);

                        // if recovery code not exists
                        if ($recoveryCode === NULL) {
                            $recoveryCode = new RecoveryCode();
                            $recoveryCode->setCode($newEncryptRecoveryCode)
                                    ->setUser($user);
                            $this->em->persist($recoveryCode);
                            $recoveryCodes[] = $newRecoveryCode;
                            $countCodes++;
                        }
                    } while ($countCodes < 5);

                    // save all changes
                    $this->em->flush();
                    $this->flash->addMessage('message', LanguageUtility::trans('2fa-enabled') . ';' . self::STYLE_SUCCESS);

                    return $this->view->render($response, 'user/recovery-codes.html.twig', array_merge($args, [
                        'recoveryCodes' => $recoveryCodes,
                    ]));
                }
            }
        }

        // Render view
        return $this->view->render($response, 'user/enable-two-factor.html.twig', array_merge($args, [
            'secret' => $secret,
            'qr' => $ga->getQRCodeGoogleUrl($user->getName(), $secret, $this->settings['2fa_qrc_title']),
            'passValid' => $passValid,
            'passCode' => isset($_SESSION['pass_code']) ? $_SESSION['pass_code'] : '',
        ]));
    }

    /**
     * Shows 2FA form validates data
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function twoFactorAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $_SESSION['tempUser']]);

        // if user exists
        if ($user instanceof User) {
            $ga = new \PHPGangsta_GoogleAuthenticator();
            $secret = $user->getTwoFactorSecret();

            // if 2FA is disabled
            if (!$user->hasTwoFactor()) {
                GeneralUtility::setCurrentRole($user->getRole()->getName());
                GeneralUtility::setCurrentUser($user->getId());
                $this->logger->info("User " . $user->getId() . " logged in - UserController:twoFactor");
                return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $user->getName()]));
            }

            if ($request->isPost()) {
                $code = $request->getParam('tf_code');
                $checkResult = $ga->verifyCode($secret, $code, 2); // 2 = 2*30sec clock tolerance

                // if two factor is not valid
                if ($checkResult === FALSE) {
                    $userRecoveryCodes = $this->em->getRepository('App\Entity\RecoveryCode')->findBy(['user' => $user->getId()]);

                    // if user has recovery codes
                    if (is_array($userRecoveryCodes) && count($userRecoveryCodes) > 0) {
                        foreach ($userRecoveryCodes as $recoveryCode) {
                            // if $code is a recovery code
                            if (password_verify($code, $recoveryCode->getCode())) {
                                $checkResult = TRUE;
                                $this->em->remove($recoveryCode);
                                $this->em->flush();
                                break;
                            }
                        }
                    }
                }

                // if two factor is valid
                if ($checkResult) {
                    unset($_SESSION['tempUser']);
                    GeneralUtility::setCurrentRole($user->getRole()->getName());
                    GeneralUtility::setCurrentUser($user->getId());
                    $this->logger->info("User " . $user->getId() . " logged in - UserController:twoFactor");
                    return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $user->getName()]));
                }
            }
        } else {
            $this->logger->info("User '" . $_SESSION['tempUser'] . "' not found - UserController:twoFactor");
            return $response->withRedirect($this->router->pathFor('user-login-' . LanguageUtility::getGenericLocale()));
        }

        // Render view
        return $this->view->render($response, 'user/two-factor.html.twig', array_merge($args, []));
    }

    /**
     * Toggles user hidden flag
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function toggleHiddenAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);

        // if user exists and current user is requested user or user exists and role can edit user other
        if ($user instanceof User && $this->currentUser === $user->getId() 
                || ($user instanceof User && $this->acl->isAllowed($this->currentRole, 'update_user_other'))) {
            $hidden = $user->isHidden();
            $user->setHidden(!$hidden);
            $this->em->persist($user);
            $this->em->flush();
            $this->flash->addMessage('message', LanguageUtility::trans('user-hidden-m' . intval($user->isHidden()), [
                $args['name'],
                $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args)
            ]) . ';' . self::STYLE_SUCCESS);
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('user-hidden-m2') . ';' . self::STYLE_DANGER);
        }

        $redirectPath = $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args);

        if (is_string($request->getParam('return'))) {
            $redirectPath = $request->getParam('return');
        }

        return $response->withRedirect($redirectPath);
    }

    /**
     * Removes user and all files from system
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function removeAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);

        // if user exists and role can delete user other
        if ($user instanceof User && $this->acl->isAllowed($this->currentRole, 'remove_user_other')) {
            $files = $user->getFiles();

            // remove all files from user
            foreach ($files as $file) {
                // if file exists
                if ($file instanceof File && file_exists($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName())) {
                    unlink($this->settings['upload']['path'] . $file->getHashName() . $file->getExtension()->getName());
                }
            }

            $this->em->remove($user);
            $this->em->flush();
            $this->flash->addMessage('message', LanguageUtility::trans('user-remove-m1', [$user->getName()]) . ';' . self::STYLE_SUCCESS);
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('user-remove-m2', [$user->getName()]) . ';' . self::STYLE_DANGER);
        }

        // if current user is requested user
        if ($this->currentUser === $user->getId()) {
            return $response->withRedirect($this->router->pathFor('user-logout-' . LanguageUtility::getGenericLocale()));
        } else {
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
            $redirectPath = $this->router->pathFor('user-show-' . LanguageUtility::getLocale(), ['name' => $user->getName()]);

            if (is_string($request->getParam('return'))) {
                $redirectPath = $request->getParam('return');
            } 

            return $response->withRedirect($redirectPath);
        }
    }

    /**
     * Update user parameter
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function updateAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);
        $process = $request->getParam('process');

        if ($user instanceof User 
            && (($this->currentUser === $user->getId() && $this->acl->isAllowed($this->currentRole, 'update_user')) 
            || $this->acl->isAllowed($this->currentRole, 'update_user_other'))) {
            if ($process === 'password-change') {
                $userName = $user->getName();
                $userPass = $request->getParam('user_pass');
                $userPassNew = $request->getParam('user_pass_new');
                $userPassRepeat = $request->getParam('user_pass_repeat');
                $validation = [
                    'max_user_name_length' => 200,
                    'min_user_name_length' => 0,
                    'user_not_duplicated' => FALSE,
                ];

                // if validation passed and password is right
                if (password_verify($userPass, $user->getPass()) 
                    && GeneralUtility::validateUser($userName, $userPassNew, $userPassRepeat, $validation)) {
                    $user->setPass($userPassNew);
                    $this->em->persist($user);
                    $this->em->flush();
                    $this->flash->addMessage('message', LanguageUtility::trans('user-update-m2') . ';' . self::STYLE_SUCCESS);
                } else {
                    $this->flash->addMessage('message', LanguageUtility::trans('user-update-m4') . ';' . self::STYLE_DANGER);
                }
            }

            if ($process === '2fa-reset') {
                $userPass = $request->getParam('user_pass');

                // if password is right
                if (password_verify($userPass, $user->getPass())) {
                    // disable old recovery codes
                    $oldRecoveryCodes = $this->em->getRepository('App\Entity\RecoveryCode')->findBy(['user' => $user]);
                    foreach ($oldRecoveryCodes as $oldRecoveryCode) {
                        $this->em->remove($oldRecoveryCode);
                    }

                    $user->setTwoFactor(FALSE)
                        ->setTwoFactorSecret('');
                    $this->em->persist($user);
                    $this->em->flush();
                    $this->flash->addMessage('message', LanguageUtility::trans('user-update-m3') . ';' . self::STYLE_SUCCESS);
                } else {
                    $this->flash->addMessage('message', LanguageUtility::trans('user-update-m4') . ';' . self::STYLE_DANGER);
                }
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('user-update-m1') . ';' . self::STYLE_DANGER);
        }

        return $response->withRedirect($this->router->pathFor('user-settings-' . LanguageUtility::getLocale(), ['name' => $args['name']]));
    }
}
