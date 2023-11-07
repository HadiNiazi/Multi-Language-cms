<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Fruits\CreateRequest;
use App\Http\Requests\Admin\Fruits\UpdateRequest;
use App\Models\Fruit;
use App\Models\FruitTranslation;
use App\Models\Language;
use App\Models\Translation;
use App\Models\Vegetable;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class FruitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $fruits = Fruit::with(['translations'])->get();

        if ($request->ajax()) {

            return Datatables::of($fruits)
                ->addIndexColumn()
                ->addColumn('title_1', function($row){
                    if ($translation = $row->englishTranslation) {
                        return Str::limit($translation->title_1, 20);
                    }
                })
                ->addColumn('title_2', function($row){
                    if ($translation = $row->englishTranslation) {
                        return Str::limit($translation->title_2, 20);
                    }
                })
                ->addColumn('title_3', function($row){
                    if ($translation = $row->englishTranslation) {
                        return Str::limit($translation->title_3, 20);
                    }
                })
                ->addColumn('status', function($row){
                    $status = null;

                    if ($translation = $row->englishTranslation) {

                        if ($translation->status == FruitTranslation::COMPLETED) {
                            $status = '<span class="badge badge-success">Completed</span>';
                        }
                        else if ($translation->status == FruitTranslation::IN_PROGRESS) {
                            $status = '<span class="badge badge-info">In Progress</span>';
                        }
                        else {
                            $status = '<span class="badge badge-danger">Not Started</span>';
                        }

                    }

                    return $status;
                })
                ->addColumn('visibility', function($row){
                    $is_visible = null;

                    if ($translation = $row->englishTranslation) {

                        if ($translation->is_visible == FruitTranslation::YES) {
                            $is_visible = '<span class="badge badge-success">Yes</span>';
                        }
                        else if ($translation->is_visible == FruitTranslation::NO) {
                            $is_visible = '<span class="badge badge-danger">No</span>';
                        }

                    }

                    return $is_visible;
                })
                ->addColumn('created_by', function($row){
                    $createdBy = null;

                    if ($translation = $row->englishTranslation) {
                        if ($createdBy = $translation->createdBy) {
                            $createdBy = $createdBy->name;
                        }
                    }

                    return $createdBy;
                })
                ->addColumn('updated_by', function($row){
                    $updatedBy = null;

                    if ($translation = $row->englishTranslation) {
                        if ($updatedBy = $translation->updatedBy) {
                            $updatedBy = $updatedBy->name;
                        }
                    }

                    return $updatedBy;
                })
                ->addColumn('created_at', function($row){
                    if ($translation = $row->englishTranslation) {
                        return $translation->created_at->diffForHumans();
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '
                    <a href="'.route('admin.fruits.show', $row->fruit_id).'" data-toggle="tooltip"  data-id="'.$row->fruit_id.'" title="Show" class="btn btn-sm btn-success view showButton"> <i class="fas fa-eye"></i> </a>
                    <a href="'.route('admin.fruits.edit', $row->fruit_id).'" data-toggle="tooltip"  data-id="'.$row->fruit_id.'" data-toggle="tooltip"  data-id="'.$row->fruit_id.'" title="Edit" class="btn btn-sm btn-primary edit editButton"> <i class="fas fa-edit"></i> </a>
                    <a href="'.route('admin.fruits.destroy', $row->fruit_id).'" data-toggle="tooltip"  data-id="'.$row->fruit_id.'" data-toggle="tooltip"  data-id="'.$row->fruit_id.'" title="Delete" class="btn btn-sm btn-danger del deleteButton"> <i class="fas fa-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'visibility'])
                ->make(true);
        }

        return view('admin.fruits.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fruits.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $user = auth()->user();
        $defaultLanguage = defaultLanguage();

        $fruitRandomId = rand(9, 99). rand(999, 9999);

        $fruit = Fruit::where('fruit_id', $fruitRandomId)->first();

        if ($fruit) {
            return back()->withErrors('Fruit Id already exists, please resubmit request again. If still problem persists please contact with administrator');
        }

        $fruit = Fruit::create([
            'fruit_id' => $fruitRandomId != null ? $fruitRandomId: Fruit::FRUIT_ID_STARTING_FROM
        ]);

        if (! $fruit) {
            return back()->withInput()->withErrors(config('error.404_with_mail'));
        }

        $imagePath = public_path('/storage/fruits/images');
        $imageNames = [];

        if ($request->hasFile('images')) {

            foreach($request->images as $image) {
                $imageNames[] = FileUploadService::upload($image, $imagePath);
            }

        }

        $fruit->translation()->create([
            'language_id' => $defaultLanguage ? $defaultLanguage->id: '',
            'title_1' => $request->title_1,
            'title_2' => $request->title_2,
            'title_3' => $request->title_3,
            'heading_title_1' => $request->heading_title_1,
            'heading_title_2' => $request->heading_title_2,
            'heading_title_3' => $request->heading_title_3,
            'description_1' => $request->heading_description_1,
            'description_2' => $request->heading_description_2,
            'description_3' => $request->heading_description_3,
            'status' => $request->status != null ? $request->status: 0,
            'is_visible' => $request->is_visible ? $request->is_visible: 0,
            'images' => implode("|",$imageNames),
            'created_by' => auth()->id()
        ]);

        session()->flash('alert-success', 'Fruit saved successfully');

        return to_route('admin.fruits.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Fruit $fruit)
    {
        $translation = $fruit->translation;
        return view('admin.fruits.show', compact('fruit', 'translation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruit $fruit)
    {
        $translation = $fruit->translation;
        return view('admin.fruits.edit', compact('fruit', 'translation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Fruit $fruit)
    {
        $user = auth()->user();
        $defaultLanguage = defaultLanguage();

        $fruit->englishTranslation()->update([
            'language_id' => $defaultLanguage ? $defaultLanguage->id: '',
            'title_1' => $request->title_1,
            'title_2' => $request->title_2,
            'title_3' => $request->title_3,
            'heading_title_1' => $request->heading_title_1,
            'heading_title_2' => $request->heading_title_2,
            'heading_title_3' => $request->heading_title_3,
            'description_1' => $request->heading_description_1,
            'description_2' => $request->heading_description_2,
            'description_3' => $request->heading_description_3,
            'status' => $request->status,
            'is_visible' => $request->is_visible ? $request->is_visible: 0,
            'updated_by' => auth()->id()
        ]);

        $imagesPath = public_path('/storage/fruits/images/');
        $imageNames = [];

        if ($request->hasFile('images')) {

            if ($fruit->translation) {

                if ($fruit->translation->images != null) {
                    foreach(explode('|', $fruit->translation->images) as $image) {
                        FileUploadService::delete($image, $imagesPath);
                    }
                }

                foreach($request->images as $image) {
                    $imageNames[] = FileUploadService::upload($image, $imagesPath);
                }

                $fruit->translation->update([
                    'images' => implode('|', $imageNames)
                ]);

            }
            else {

                foreach($request->images as $image) {
                    $imageNames[] = FileUploadService::upload($image, $imagesPath);
                }

                $fruit->translation->update([
                    'images' => implode('|', $imageNames)
                ]);
            }

        }

        session()->flash('alert-success', 'Fruit updated successfully');

        return to_route('admin.fruits.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fruit $fruit)
    {
        $imagesPath = public_path('/storage/fruits/images/');

        foreach ($fruit->translations as $translation) {
            foreach(explode('|', $translation->images) as $image) {
                FileUploadService::delete($image, $imagesPath);
            }
        }

        if (count($fruit->translations) > 0) {
            $fruit->translations()->delete();
        }

        $fruit->delete();

        return response()->json([
            'message' => 'Fruit removed successfully'
        ], 201);
    }

}
