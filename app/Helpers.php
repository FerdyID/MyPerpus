<?php
/**
 * Created by PhpStorm.
 * User: FERDY
 * Date: 8/27/2018
 * Time: 5:29 PM
 */

function setActive($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}