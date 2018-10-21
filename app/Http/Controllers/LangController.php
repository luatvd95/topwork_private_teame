<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    private $lang_active = [
        'vi',
        'en'
    ];

    public function changeLang(Request $request, $lang)
    {
        if (in_array($lang, $this->lang_active)) {
            $request->session()->put(['lang' => $lang]);

            return redirect()->back();
        }
    }
}

