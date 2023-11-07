<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Fruits\Translation\CreateRequest;
use App\Models\Fruit;
use App\Models\FruitTranslation;
use App\Models\Language;
use App\Models\Section;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use DataTables;
use Illuminate\Support\Str;
use stdClass;

class TranslationController extends Controller
{

    public function openFruitTranslationPage(Request $request)
    {
        $sections = Section::all();

        $fruit = null;
        $translations = [];

        if ($request->ajax()) {

            return Datatables::of($translations)
                ->addIndexColumn()
                ->addColumn('title_1', function($row){
                    return Str::limit($row->title_1, 20);
                })
                ->addColumn('title_2', function($row){
                    return Str::limit($row->title_2, 20);
                })
                ->addColumn('title_3', function($row){
                    return Str::limit($row->title_3, 20);
                })
                ->addColumn('status', function($row){
                    $status = null;

                    if ($row->is_visible == true) {
                        $status = '<span class="badge badge-primary">Published</span>';
                    }
                    else {
                        $status = '<span class="badge badge-danger">Draft</span>';
                    }

                    return $status;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at->diffForHumans();

                })
                ->addColumn('action', function($row){
                    $btn = '
                    <a href="'.route('admin.translations.edit', $row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Show" class="btn btn-sm btn-info view translationButton"> <i class="mdi mdi-google-translate" style="font-size:14px"></i> </a>
                    <a href="'.route('admin.fruits.show', $row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Show" class="btn btn-sm btn-success view showButton"> <i class="fas fa-eye"></i> </a>
                    <a href="'.route('admin.fruits.edit', $row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Edit" class="btn btn-sm btn-primary edit editButton"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('admin.fruits.destroy', $row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete" class="btn btn-sm btn-danger del deleteButton"> <i class="fas fa-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.fruits.translations.index', compact('sections'));
    }

}
