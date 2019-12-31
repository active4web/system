<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('generateRandomString')){
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if ( ! function_exists('get_lang')){
    function get_lang() {
        if(isset($_SESSION['lang']))
        {
            $lang = $_SESSION['lang'];
        }else{
            $lang = 'arabic';
        }
        return $lang;
    }
}
