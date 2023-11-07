<?php
use App\Models\User;
use App\Models\Language;

if (! file_exists('isAdmin')) {
    function isAdmin() {

        $status = false;
        $user = User::where('id', auth()->id())->where('role', User::ADMIN)->first();

        if ($user) {
            $status = true;
        }

        return $status;
    }
}

if (! file_exists('isTranslator')) {
    function isTranslator() {

        $status = false;
        $user = User::where('id', auth()->id())->where('role', User::TRANSLATOR)->first();

        if ($user) {
            $status = true;
        }

        return $status;
    }
}


if (! file_exists('fetchLanguagesWithoutDefault')) {
    function fetchLanguagesWithoutDefault() {

        return Language::where('id', '!=', defaultLanguageId())->get();

    }
}

