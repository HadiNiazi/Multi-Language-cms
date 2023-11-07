<?php

namespace App\Http\Controllers\Translator;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use App\Models\FruitTranslation;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function openSectionsPage()
    {
        $totalFruitsCount = Fruit::whereHas('englishTranslation', function( $query ) {
            return $query->where('status', FruitTranslation::COMPLETED);
        })->count();

        return view('translator.sections.index', compact('totalFruitsCount'));
    }
}
