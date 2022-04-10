<?php

if (!function_exists('changeLanguage')) {
    function changeLanguage() {
        return session()->get('website_language') == 'en' ? true : false;
    }
}
