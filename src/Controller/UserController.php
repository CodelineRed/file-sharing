<?php
namespace App\Controller;

use App\Entity\RecoveryCode;
use App\Entity\User;
use App\Utility\GeneralUtility;
use App\Utility\LanguageUtility;

/**
 * UserController is used for pages in context of user
 */
class UserController extends BaseController {
    
    /**
     * create Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function createAction($request, $response, $args) {
        // Render view
        return $this->view->render($response, 'user/create.html.twig', array_merge($args, [
            'roles' => $this->em->getRepository('App\Entity\Role')->findAll(),
        ]));
    }
    
    /**
     * saveCreate Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function saveCreateAction($request, $response, $args) {
        $user = $request->getParam('user_name');
        $pass = $request->getParam('user_pass');
        
        // if is other user and current user is alowed show_user_other
        if (is_string($pass) && is_string($user)) {
            $userSearch = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $user]);
            $role = $this->em->getRepository('App\Entity\Role')->findOneBy(['name' => $request->getParam('user_role')]);
            
            // if user exists
            if ($userSearch instanceof User) {
                $this->flash->addMessage('message', LanguageUtility::trans('user-save-m1') . ';' . self::STYLE_DANGER);
            } elseif (strlen($pass) < 6) {
                $this->flash->addMessage('message', LanguageUtility::trans('user-save-m2', [6]) . ';' . self::STYLE_DANGER);
            } else {
                if ($role === NULL) {
                    $role = $this->em->getRepository('App\Entity\Role')->findOneBy(['name' => 'member']);
                }
                
                $newUser = new User();
                $newUser->setName($user)
                    ->setPass($pass)
                    ->setRole($role);
                $this->em->persist($newUser);
                $this->em->flush();
                $this->flash->addMessage('message', LanguageUtility::trans('user-save-m3', [$user]) . ';' . self::STYLE_SUCCESS);
            }
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('user-save-m4') . ';' . self::STYLE_DANGER);
        }
        
        // Render view
        return $response->withRedirect($this->router->pathFor('user-create-' . LanguageUtility::getLocale()));
    }
    
    /**
     * Show Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function showAction($request, $response, $args) {
        $postMaxSize = ini_get('post_max_size');
        $uploadMaxSize = ini_get('upload_max_filesize');
        
        if (intval($uploadMaxSize) < intval($postMaxSize)) {
            $unit = substr($uploadMaxSize, -1);
            $maxFileSize = intval($uploadMaxSize) . ' ' . ($unit !== 'B' ? $unit . 'B' : $unit);
        } else {
            $unit = substr($postMaxSize, -1);
            $maxFileSize = intval($postMaxSize) . ' ' . ($unit !== 'B' ? $unit . 'B' : $unit);
        }
        
        // if is other user and current user is alowed show_user_other
        if (isset($args['name']) && $this->acl->isAllowed($this->currentRole, 'show_user_other')) {
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);
            
            // if user exists
            if ($user instanceof User && !$user->isHidden()) {
                $this->logger->info("User '" . $args['name'] . "' found - UserController:show");
            } elseif ($this->currentRole !== 'superadmin') {
                // if user not found
                $this->logger->info("User '" . $args['name'] . "' not found - UserController:show");
                $_SESSION['notFoundRoute'] = $request->getUri()->getPath();
                return $response->withRedirect($this->router->pathFor('error-not-found-' . LanguageUtility::getGenericLocale()));
            }
        } elseif (!is_null($this->currentUser) && !isset($args['name']) && $this->acl->isAllowed($this->currentRole, 'show_user')) {
            // if is logged in user and allowed show_user
            $user = $this->em->getRepository('App\Entity\User')->findOneBy(['id' => $this->currentUser]);
            
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
            'maxFileSize' => $maxFileSize,
            'files' => $user->getUniqueFiles(),
            'publicFiles' => $user->getPublicFiles(),
            'roles' => $this->em->getRepository('App\Entity\Role')->findAll(),
        ]));
    }
    
    /**
     * showAll Action
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
        ]));
    }
    
    /**
     * updateRole Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function updateRoleAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);
        $role = $this->em->getRepository('App\Entity\Role')->findOneBy(['name' => $args['role']]);
        
        if ($user === NULL || $role === NULL) {
            return $response->withRedirect($this->router->pathFor('page-index-' . LanguageUtility::getGenericLocale()));
        }
        
        if ($this->currentUser === $user->getId()) {
            GeneralUtility::setCurrentRole($role->getName());
        }
        
        if (GeneralUtility::getCurrentUser() !== $user->getId()) {
            $args['name'] = $user->getName();
        }
        
        $user->setRole($role);
        $this->em->flush($user);
        
        return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args));
    }
    
    /**
     * Login Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function loginAction($request, $response, $args) {
        // Render view
        return $this->view->render($response, 'user/login.html.twig', array_merge($args, []));
    }
    
    /**
     * Login Validate Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return static
     */
    public function loginValidateAction($request, $response, $args) {
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
     * Logout Action
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
     * Enable Two Factor Action
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
        
        if ($user->hasTwoFactor()) {
            unset($_SESSION['pass_code']);
            return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale()));
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
            
            if ($userPass !== NULL && $passCode === NULL && password_verify($userPass, $user->getPass())) {
                $passValid = TRUE;
                $_SESSION['pass_code'] = GeneralUtility::generateCode(6);
            } elseif (isset($_SESSION['pass_code']) && $_SESSION['pass_code'] === $passCode) {
                $passValid = TRUE;
                $code = $request->getParam('tf_code');
                $checkResult = $ga->verifyCode($secret, $code, 2); // 2 = 2*30sec clock tolerance
                
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

                        if (!($recoveryCode instanceof RecoveryCode)) {
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
            'qr' => $ga->getQRCodeGoogleUrl($user->getName(), $secret, 'fs.imhh.me'),
            'passValid' => $passValid,
            'passCode' => isset($_SESSION['pass_code']) ? $_SESSION['pass_code'] : '',
        ]));
    }
    
    /**
     * Two Factor Action
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
                $_SESSION['currentRole'] = $user->getRole()->getName();
                $_SESSION['currentUser'] = $user->getId();
                $this->logger->info("User " . $user->getId() . " logged in - UserController:twoFactor");
                return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale()));
            }

            if ($request->isPost()) {
                $code = $request->getParam('tf_code');
                $checkResult = $ga->verifyCode($secret, $code, 2); // 2 = 2*30sec clock tolerance
                
                if ($checkResult === FALSE) {
                    $userRecoveryCodes = $this->em->getRepository('App\Entity\RecoveryCode')->findBy(['user' => $user->getId()]);
                    
                    if (is_array($userRecoveryCodes) && count($userRecoveryCodes) > 0) {
                        foreach ($userRecoveryCodes as $recoveryCode) {
                            if (password_verify($code, $recoveryCode->getCode())) {
                                $checkResult = TRUE;
                                $this->em->remove($recoveryCode);
                                $this->em->flush();
                                break;
                            }
                        }
                    }
                }
                
                if ($checkResult) {
                    unset($_SESSION['tempUser']);
                    $_SESSION['currentRole'] = $user->getRole()->getName();
                    $_SESSION['currentUser'] = $user->getId();
                    $this->logger->info("User " . $user->getId() . " logged in - UserController:twoFactor");
                    return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale()));
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
     * toggleHidden Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function toggleHiddenAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);
        
        if ($user instanceof User && $user->getId() === $this->currentUser || ($user instanceof User && $this->acl->isAllowed($this->currentRole, 'edit_user_other'))) {
            $hidden = $user->isHidden();
            $user->setHidden(!$hidden);
            $this->em->persist($user);
            $this->em->flush();
            $this->flash->addMessage('message', LanguageUtility::trans('user-hidden-m' . intval($hidden), [$user->getName()]) . ';' . self::STYLE_SUCCESS);
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('user-hidden-m2') . ';' . self::STYLE_DANGER);
        }
        
        return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args));
    }
    
    /**
     * remove Action
     * 
     * @param \Slim\Http\Request $request
     * @param \Slim\Http\Response $response
     * @param array $args
     * @return \Slim\Http\Response
     */
    public function removeAction($request, $response, $args) {
        $user = $this->em->getRepository('App\Entity\User')->findOneBy(['name' => $args['name']]);
        
        if ($user instanceof User && $this->acl->isAllowed($this->currentRole, 'delete_user_other')) {
            $this->em->remove($user);
            $this->em->flush();
            $this->flash->addMessage('message', LanguageUtility::trans('user-remove-m1', [$user->getName()]) . ';' . self::STYLE_SUCCESS);
        } else {
            $this->flash->addMessage('message', LanguageUtility::trans('user-remove-m2', [$user->getName()]) . ';' . self::STYLE_DANGER);
        }
        
        if ($this->currentUser === $user->getId()) {
            return $response->withRedirect($this->router->pathFor('user-logout-' . LanguageUtility::getGenericLocale()));
        } else {
            return $response->withRedirect($this->router->pathFor('user-show-' . LanguageUtility::getLocale(), $args));
        }
    }
}
