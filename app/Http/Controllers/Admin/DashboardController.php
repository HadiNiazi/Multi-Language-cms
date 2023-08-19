<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use App\Models\Language;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(Request $request)
    {
        $fruitId = Fruit::first()->id;
        $desiredLanguageCode = $request->lang;

        $translatedTitle = null;
        $translatedContent1 = null;
        $translatedContent2 = null;
        $translatedContent3 = null;

        $fruit = Fruit::findOrFail($fruitId);
        $desiredLanguage = Language::where('code', $desiredLanguageCode)->first();

        if ($desiredLanguage) {
            $translatedContent = $fruit->translations()
                ->where('language_id', $desiredLanguage->id)
                ->first();

            if ($translatedContent) {
                $translatedTitle = $translatedContent->translated_title;
                $translatedContent1 = $translatedContent->translated_heading_title_1;
                $translatedContent2 = $translatedContent->translated_heading_title_2;
                $translatedContent3 = $translatedContent->translated_heading_title_3;

            } else {
                // Fallback if translation not found
                $translatedTitle = $fruit->title;
                $translatedContent1 = $fruit->heading_title_1;
                $translatedContent2 = $fruit->heading_title_2;
                $translatedContent3 = $fruit->heading_title_3;
            }
        } else {
            // Fallback in case desired language is not found
            $translatedTitle = $fruit->title;
            $translatedContent1 = $fruit->heading_title_1;
            $translatedContent2 = $fruit->heading_title_2;
            $translatedContent3 = $fruit->heading_title_3;
        }

        return view('admin.home', compact('translatedTitle', 'translatedContent1', 'translatedContent2', 'translatedContent3'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
