<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function openTranslationPage()
    {
        return view('admin.translations.index');
    }
}
