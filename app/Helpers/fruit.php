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

    function fetchAllPublishedFruits() {
        $navbarFruits = Fruit::with(['translation', 'translations', 'translation'])->whereHas('translation', function($query) {
            return $query->where('status', FruitTranslation::COMPLETED)
                   ->where('is_visible', FruitTranslation::YES);
        })->orderBy('id', 'asc')->get();

        return $navbarFruits;
    }

}
