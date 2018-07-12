<?php
namespace App\Utility;

class GeneralUtility {
    
    /**
     * @param string $pass
     * @return type
     */
    static function encryptPassword($pass) {
        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }
    
    /**
     * Generates random codes
     * 
     * @param integer $length
     * @return string
     */
    static function generateCode($length = 18) {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $code = '' ;

        while ($i <= $length) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $code = $code . $tmp;
            $i++;
        }

        return $code;
    }
    
    /**
     * Returns current user id or NULL if user not logged in.
     * 
     * @return mixed
     */
    static function getCurrentUser() {
        return isset($_SESSION['currentUser']) ? $_SESSION['currentUser'] : NULL;
    }
    
    /**
     * Returns current role or 'guest' if user not logged in.
     * 
     * @return string
     */
    static function getCurrentRole() {
        return isset($_SESSION['currentRole']) ? $_SESSION['currentRole'] : 'guest';
    }
}
