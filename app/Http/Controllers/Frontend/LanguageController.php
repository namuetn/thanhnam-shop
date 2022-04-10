<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return redirect()->back();
    }
}
