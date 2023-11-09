<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use App\Models\FruitTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;

class HomeController extends Controller
{
    public function openHomePage(Request $request)
    {
        $language = $request->language ?: 'english';
        $searched = $request->searched;

        $language = Language::where('name', $language)->first();

        if (! $language) {
            abort(404, 'Unable to find '. $request->language. '. please choose correct language.');
        }

        if ($request->ajax()) {

            $fruitTranslations = FruitTranslation::search($searched)
                        ->where('status', FruitTranslation::COMPLETED)
                        ->where('language_id', $language->id)
                        ->orderBy('title_1', 'asc')
                        ->when($request->language, function ($query) use ($language) {
                            $query->where('language_id', $language->id);
                        })
                        ->get();

            return Datatables::of($fruitTranslations)
                ->addIndexColumn()

                ->addColumn('title_1', function($translation) use ($language) {

                    $title = Str::limit($translation->title_1, 20);

                    $fruit = $translation->fruit;
                    $fruitId = $fruit->fruit_id;

                    $title = '<a href="'.route('site.fruits.details', ['fruit_id' => $fruitId, 'name' => Str::slug($translation->title_1), 'language' => strtolower($language->name)]).'">'. $title. '</a>';

                    return $title;
                })
                ->addColumn('title_2', function($translation){
                    return Str::limit($translation->title_2, 20);
                })
                ->addColumn('title_3', function($translation){
                    return Str::limit($translation->title_3, 20);
                })
                ->addColumn('action', function($translation) use ($language) {

                    $fruit = $translation->fruit;

                    $fruitId = $fruit ? $fruit->fruit_id: null;
                    $fruitPrimaryId = $fruit ? $fruit->id: null;

                    $btn = '<a href="'.route('site.fruits.details', ['fruit_id' => $fruitId, 'name' => Str::slug($translation->title_1), 'language' => strtolower($language->name)]).'" data-toggle="tooltip"  data-id="'.$fruitPrimaryId.'" title="Show" class="btn btn-sm btn-info view translationButton"> <i class="fa-solid fa-up-right-from-square" style="font-size:14px"></i> </a>';

                    return $btn;
                })
                ->rawColumns(['action', 'status', 'visible', 'title_1'])
                ->make(true);
        }

        // $fruitTranslations = $fruitTranslations->get();

        return view('site.index');
    }

    public function openFruitDetailsPage($fruitId)
    {
        $fruit = Fruit::where('fruit_id', $fruitId)->first();

        if (! $fruit) {
            session()->flash('alert-danger', 'Unable to find the record, please refresh the webpage and try again. If still problem persists contact with administrator.');
            return back();
        }

        $translation = $fruit->translation;

        return view('site.fruit.details', compact('translation'));
    }
}
