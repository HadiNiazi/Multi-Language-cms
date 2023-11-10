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
    public function openHomePage()
    {
        $languages = Language::with(['users'])->get();

        return view('site.index', compact('languages'));
    }

    public function openLanguagesPage()
    {
        return view('site.languages');
    }

    public function openItemsPage($language, $item)
    {
        $request = request();
        $language = $request->segment(1) ?: 'english';
        $searched = $request->searched;

        $language = Language::where('code', $language)->first();

        if (! $language) {
            abort(404, 'Unable to find '. $request->language. '. please choose correct language.');
        }

        if ($request->ajax()) {

            $fruitTranslations = FruitTranslation::search($searched)
                        ->where('status', FruitTranslation::COMPLETED)
                        ->orderBy('title_1', 'asc')
                        ->when($request->language, function ($query) use ($language) {
                            $query->where('language_id', $language->id);
                        })
                        ->get();

            return Datatables::of($fruitTranslations)
                ->addIndexColumn()

                ->addColumn('title_1', function($translation) use ($language) {

                    $title = Str::limit($translation->title_1, 120);

                    $translationId = $translation->translation_id;

                    $title = '<div style="text-align:left"><a href="'.route('site.fruits.details', ['language' => strtolower($language->code), 'fruit_id' => $translationId]).'">'. $title. '</a></div>';

                    return $title;
                })
                ->rawColumns(['action', 'status', 'visible', 'title_1'])
                ->make(true);
        }

        // $fruitTranslations = $fruitTranslations->get();

        return view('site.fruit.items');
    }

    public function openFruitDetailsPage($languageId, $translationId)
    {
        $translation = FruitTranslation::where('translation_id', $translationId)->first();

        if (! $translation) {
            session()->flash('alert-danger', 'Unable to find the record, please refresh the webpage and try again. If still problem persists contact with administrator.');
            return back();
        }

        $translation = $translation;

        return view('site.fruit.details', compact('translation'));
    }
}
