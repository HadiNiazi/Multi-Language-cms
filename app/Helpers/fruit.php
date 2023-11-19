<?php

use App\Models\Fruit;
use App\Models\FruitTranslation;
use App\Models\Language;
use App\Models\User;

if (! file_exists('defaultLanguage')) {
    function defaultLanguage() {
        return Language::where('code', 'eng')->where('name', 'english')->first();
    }
}

if (! file_exists('defaultLanguageId')) {
    function defaultLanguageId() {
        return Language::where('code', 'eng')->where('name', 'english')->first()->id;
    }
}

if (! file_exists('defaultLanguageCode')) {
    function defaultLanguageCode() {
        return Language::where('code', 'eng')->where('name', 'english')->first()->code;
    }
}

if (! file_exists('loginUserAssignedLanguages')) {
    function loginUserAssignedLanguages() {

        $assignedLanguages = null;

        $user = auth()->user();

        if ($user) {

            if ($user->role == User::ADMIN) {
                $assignedLanguages = fetchLanguagesWithoutDefault();
            }
            else {
                $assignedLanguages = $user->languages;
            }

        }

        return $assignedLanguages;
    }
}

if (! file_exists('loginUserAssignedLanguageIds')) {
    function loginUserAssignedLanguageIds() {

        $assignedLanguageIds = null;

        $user = auth()->user();

        if ($user) {

            if ($user->role == User::ADMIN) {
                $assignedLanguageIds = fetchLanguagesWithoutDefault()->map(function( $language ) {
                    return $language->id;
                })->toArray();
            }
            else {
                $assignedLanguageIds = $user->languages->map(function( $language ) {
                    return $language->id;
                })->toArray();
            }

        }

        return $assignedLanguageIds;
    }
}

if (! file_exists('fetchAllPublishedFruits')) {

    function fetchAllPublishedFruits($languageCode) {

        $language = Language::where('code', $languageCode)->first();

        $fruitTranslations = FruitTranslation::
                        where('status', FruitTranslation::COMPLETED)
                        ->orderBy('title_1', 'asc')
                        ->when($language, function ($query) use ($language) {
                            $query->where('language_id', $language->id);
                        })
                        ->get();

        return $fruitTranslations;
    }

}

if (! file_exists('fetchAllLanguages')) {

    function fetchAllLanguages() {
        return Language::with('users')->get();
    }
}


if (! file_exists('findLanguageFromCode')) {

    function findLanguageFromCode($code) {
        return Language::where('code', $code)->first();
    }

}
