<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use App\Models\FruitTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;

class HomeController extends Controller
{
    public function openHomePage(Request $request)
    {
        // $languageId = $this->fetchLanguageFromCode($language);

        // if (! in_array($languageId, loginUserAssignedLanguageIds())) {
        //     abort(403, 'You are not authorized to access this resource');
        // }

        $fruits = Fruit::whereHas('translation', function($query) {
            return $query->where('status', FruitTranslation::COMPLETED);
                //    $query->orderBy('title_1', 'asc');
        })
        ->get();

        if ($request->ajax()) {

            return Datatables::of($fruits)
                ->addIndexColumn()

                ->addColumn('serial_no', function($row){
                    $count = 0;

                    if ($row) {
                        $count++;
                    }

                    return $count;
                })
                ->addColumn('title_1', function($row){

                    $title = null;

                    if ($translation = $row->translation) {
                        $title = Str::limit($translation->title_1, 20);
                    }

                    $title = '<a href="'.route('site.fruits.details', ['fruit_id' => $row->fruit_id, 'name' => Str::slug($row->translation->title_1)]).'">'. $title. '</a>';

                    return $title;
                })
                ->addColumn('title_2', function($row){
                    if ($translation = $row->translation) {
                        return Str::limit($translation->title_2, 20);
                    }
                })
                ->addColumn('title_3', function($row){
                    if ($translation = $row->translation) {
                        return Str::limit($translation->title_3, 20);
                    }
                })
                ->addColumn('action', function($row) {
                    $btn = '<a href="'.route('site.fruits.details', ['fruit_id' => $row->fruit_id, 'name' => Str::slug($row->translation->title_1)]).'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Show" class="btn btn-sm btn-info view translationButton"> <i class="fa-solid fa-up-right-from-square" style="font-size:14px"></i> </a>';

                    return $btn;
                })
                ->rawColumns(['action', 'status', 'visible', 'title_1'])
                ->make(true);
        }

        return view('site.index', compact( 'fruits'));
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
