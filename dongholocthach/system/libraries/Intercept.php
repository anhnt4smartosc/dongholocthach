
<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: anhnt01682
 * Date: 7/20/14
 * Time: 10:29 PM
 */

class Intercept {
    public function __construct(){
        session_start();
        echo __METHOD__;
    }
} 