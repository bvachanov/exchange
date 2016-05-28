<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App;
use Illuminate\Http\Request;

class LanguageController extends Controller {

    protected $langs = ['en', 'de'];

    public function changeLanguage($lang) {
        if (in_array($lang, $this->langs)) {
            App::setLocale($lang);
            Session::set('locale', $lang);
        }
        return redirect()->back();
    }

}
