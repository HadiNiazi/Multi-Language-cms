<?php

namespace App\Http\Controllers\Translator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Translator\Translation\Fruits\CreateRequest;
use App\Models\Fruit;
use App\Models\FruitTranslation;
use App\Models\Language;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class FruitController extends Controller
{
    public function openFruitsPage(Request $request, $language)
    {
        $languageId = $this->fetchLanguageFromCode($language);

        if (! in_array($languageId, loginUserAssignedLanguageIds())) {
            abort(403, 'You are not authorized to access this resource');
        }

        $fruits = Fruit::whereHas('englishTranslation', function($query) {
            return $query->where('status', FruitTranslation::COMPLETED);
        })->get();

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
                ->addColumn('status', function($row) use ($language) {
                    $status = '';

                    $language = Language::where('code', $language)->first();
                    $translationFruitId = null;

                    if ($translation = $row->translation) {
                        $translationFruitId = $translation->fruit_id;
                    }

                    if ($language) {

                        $translated = FruitTranslation::where('language_id', $language->id)->where('fruit_id', $translationFruitId)->first();

                        if (! $translated) {
                            $status = '<span class="badge badge-danger">Pending</span>';
                        }
                        else if ($translated->status == FruitTranslation::PENDING) {
                            $status = '<span class="badge badge-danger">Pending</span>';
                        }
                        else if ($translated->status == FruitTranslation::COMPLETED) {
                            $status = '<span class="badge badge-success">Completed</span>';
                        }
                        else if ($translated->status == FruitTranslation::IN_PROGRESS) {
                            $status = '<span class="badge badge-info">In-Progress</span>';
                        }

                    }

                    return $status;
                })
                ->addColumn('created_by', function($row) use ($language) {

                    $createdByUserName = null;

                    $language = Language::where('code', $language)->first();
                    $translationFruitId = null;

                    if ($translation = $row->translation) {
                        $translationFruitId = $translation->fruit_id;
                    }

                    if ($language) {

                        $translated = FruitTranslation::where('language_id', $language->id)->where('fruit_id', $translationFruitId)->first();

                        if ($translated) {
                            $createdBy = $translated->createdBy;

                            if ($createdBy) {
                                $createdByUserName = $createdBy->name;
                            }
                        }

                    }

                    return $createdByUserName;
                })
                ->addColumn('updated_by', function($row) use ($language) {

                    $updatedByUserName = null;

                    $language = Language::where('code', $language)->first();
                    $translationFruitId = null;

                    if ($translation = $row->translation) {
                        $translationFruitId = $translation->fruit_id;
                    }

                    if ($language) {

                        $translated = FruitTranslation::where('language_id', $language->id)->where('fruit_id', $translationFruitId)->first();

                        if ($translated) {
                            $updatedBy = $translated->updatedBy;

                            if ($updatedBy) {
                                $updatedByUserName = $updatedBy->name;
                            }
                        }

                    }

                    return $updatedByUserName;
                })
                ->addColumn('created_at', function($row){
                    if ($translation = $row->englishTranslation) {
                        return $translation->created_at->diffForHumans();
                    }
                })
                ->addColumn('action', function($row) use ($language) {
                    if ($row->englishTranslation) {
                        $btn = '
                            <a href="'.route('fruits.translations.edit', ['fruit' => $row->fruit_id, 'language' => $language]).'" data-toggle="tooltip"  data-id="'.$row->id.'" title="Show" class="btn btn-sm btn-info view translationButton"> <i class="mdi mdi-google-translate" style="font-size:14px"></i> </a>';
                        return $btn;
                    }
                })
                ->rawColumns(['action', 'status', 'visible'])
                ->make(true);
        }

        return view('translator.sections.fruits.index');
    }

    public function openLanguagesPage()
    {
        $user = auth()->user();
        $assignedLanguages = [];
        $allLanguages = fetchLanguagesWithoutDefault();

        if ($languages = $user->languages) {
            foreach ($languages as $language) {

                $assignedLanguages[] = [
                    'id' => $language->id,
                    'name' => $language->name,
                    'code' => $language->code
                ];

            }
        }

        return view('translator.sections.languages.index', compact('assignedLanguages', 'allLanguages'));
    }

    public function editFruitTranslationPage(Request $request, $fruit)
    {
        $translatedFruits = null;

        $languageId = $this->fetchLanguageFromCode($request->language);

        if (! in_array($languageId, loginUserAssignedLanguageIds())) {
            abort(403, 'You are not authorized to access this resource');
        }

        $fruit = Fruit::where('fruit_id', $fruit)->first();

        $languageCode = $request->language ? $request->language: defaultLanguageCode();

        if (! $fruit) {
            return back()->withErrors(config('error.404_with_mail'));
        }

        $language = Language::where('code', $languageCode)->first();

        if (! $language) {
            return back()->withInput()->withErrors('Unable to find such language, please refresh the webpage and try again.');
        }

        $translatedFruits = FruitTranslation::query()
                            ->where('fruit_id', $fruit->id)
                            ->where('language_id', $language->id)
                            ->first();


        if (! $translatedFruits) {
            $translatedFruits = FruitTranslation::query()
                            ->where('fruit_id', $fruit->id)
                            ->where('language_id', defaultLanguageId())
                            ->first();
        }

        $translation = $fruit->translation;
        $languages = fetchLanguagesWithoutDefault();
        $rTlLanguageCodes = Language::where('rtl', Language::RTL)->pluck('code');

        return view('translator.sections.fruits.translations.edit', compact('translation', 'languages', 'translatedFruits', 'rTlLanguageCodes'));
    }

    public function storeFruitTranslations(CreateRequest $request)
    {
        $status = $request->translated_status == 2 ? FruitTranslation::COMPLETED: FruitTranslation::IN_PROGRESS ;
        $isVisible = 0;

        if ($request->translated_status == 2 && $request->translated_is_visible == 1) {
            $isVisible = 1;
        }

        $language = Language::where('code', $request->language)->first();

        if (! $language) {
            return back()->withInput()->withErrors('Unable to find such language, please refresh the webpage and try again.');
        }

        if (isTranslator()) {

            $user = auth()->user();

            $assignedLanguages = $user->languages->map(function ($language) {
                return $language->code;
            })->toArray();

            if (! in_array($request->language, $assignedLanguages)) {
                return back()->withInput()->withErrors('Unable to find such language, please refresh the webpage and try again.');
            }

        }

        if (defaultLanguageId() == $language->id) {
            return back()->withInput()->withErrors('Unable to find such language, please choose correct language.');
        }

        $fruit = Fruit::where('fruit_id', $request->fruit)->first();

        if (! $fruit) {
            return back()->withInput()->withErrors('Unable to find such fruit, please refresh the webpage and try again.');
        }

        try {

            if ($request->delete) {

                $deleted = $this->deleteFruitTranslation($request, $fruit->id, $language->id);

                if ($deleted) {
                    session()->flash('alert-success', 'Translation removed successfully');

                    return to_route('fruits.index', ['language' => $request->language]);
                }
                else {
                    return back()->withErrors('There is no translation against this language.');
                }
            }

            $translation = FruitTranslation::where('fruit_id', $fruit->id)
                            ->where('language_id', $language->id)
                            ->first();

            $translated_imageNames = [];
            $imagesPath = public_path('/storage/fruits/images/');

            if ($translation) {

                if ($request->hasFile('translated_images')) {

                    if ($translation->images) {

                        foreach(explode('|', $translation->images) as $image) {
                            FileUploadService::delete($image, $imagesPath);
                        }
                    }

                    foreach($request->translated_images as $image) {
                        $translated_imageNames[] = FileUploadService::upload($image, $imagesPath);
                    }

                }

                $translation->update([
                    'language_id' => $language ? $language->id: '',
                    'title_1' => $request->translated_title_1,
                    'title_2' => $request->translated_title_2,
                    'title_3' => $request->translated_title_3,
                    'heading_title_1' => $request->translated_heading_title_1,
                    'heading_title_2' => $request->translated_heading_title_2,
                    'heading_title_3' => $request->translated_heading_title_3,
                    'description_1' => $request->translated_heading_description_1,
                    'description_2' => $request->translated_heading_description_2,
                    'description_3' => $request->translated_heading_description_3,
                    'status' => $request->translated_status,
                    'is_visible' => $isVisible,
                    'images' => implode("|",$translated_imageNames),
                    'updated_by' => auth()->id()
                ]);

            }
            else {


                if ($request->hasFile('translated_images')) {

                    foreach($request->translated_images as $image) {
                        $translated_imageNames[] = FileUploadService::upload($image, $imagesPath);
                    }

                }

                $translationRandomId = rand(9, 99). rand(999, 9999);

                $translation = FruitTranslation::where('translation_id', $translationRandomId)->first();

                if ($translation) {
                    return back()->withErrors('Id already exists, please resubmit request again. If still problem persists, please contact with administrator');
                }

                $fruit->translation()->create([
                    'language_id' => $language ? $language->id: '',
                    'title_1' => $request->translated_title_1,
                    'title_2' => $request->translated_title_2,
                    'title_3' => $request->translated_title_3,
                    'heading_title_1' => $request->translated_heading_title_1,
                    'heading_title_2' => $request->translated_heading_title_2,
                    'heading_title_3' => $request->translated_heading_title_3,
                    'description_1' => $request->translated_heading_description_1,
                    'description_2' => $request->translated_heading_description_2,
                    'description_3' => $request->translated_heading_description_3,
                    'status' => $request->translated_status,
                    'is_visible' => $isVisible,
                    'images' => implode("|",$translated_imageNames),
                    'created_by' => auth()->id(),
                    'translation_id' => $translationRandomId
                ]);
            }

            session()->flash('alert-success', 'Translation saved successfully');

            return to_route('fruits.index', ['language' => $request->language]);

        }
        catch (\Exception $ex) {
            return back()->withErrors('Something went wrong, the error is '. $ex->getMessage());
        }

    }

    private function deleteFruitTranslation($request, $fruitId, $languageId)
    {
        $status = false;

        try {

            $translation = FruitTranslation::where('fruit_id', $fruitId)->where('language_id', $languageId)->first();

            if ($translation) {

                if ($translation->images) {
                    $this->deleteTranslationImages($translation);
                }

                $translation->delete();
                $status = true;

            }
        }
        catch(\Exception $ex) {
            return back()->withErrors('Something went wrong, the error is '. $ex->getMessage());
        }

        return $status;

    }

    private function deleteTranslationImages($translation)
    {
        $imagesPath = public_path('/storage/fruits/images/');

        foreach(explode('|', $translation->images) as $image) {
            FileUploadService::delete($image, $imagesPath);
        }
    }

    private function fetchLanguageFromCode($languageCode)
    {
        $languageId = null;
        $language = Language::where('code', $languageCode)->first();

        if ($language) {
            $languageId = $language->id;
        }

        return $languageId;
    }

}
