<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Mail\RegistrationMail;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('id', '!=', auth()->id())->get();

        if ($request->ajax()) {

            return Datatables::of($users)
                ->addIndexColumn()

                ->addColumn('name', function($row){
                    return Str::limit($row->name, 20);
                })
                ->addColumn('email', function($row){
                    return Str::limit($row->email, 20);
                })
                ->addColumn('languages', function($row){
                    $languageNames = [];
                    if ($languages = $row->languages) {
                        foreach ($languages as $language) {
                            $languageNames[] = ucfirst($language->name);
                        }
                    }
                    return implode(', ', $languageNames);
                })
                ->addColumn('role', function($row){
                    $role = null;

                    if ($row->role == User::TRANSLATOR) {

                        $role = '<span class="badge badge-info">Translator</span>';
                    }
                    else if ($row->role == User::ADMIN) {
                        $role = '<span class="badge badge-success">Administrator</span>';
                    }

                    return $role;
                })
                ->addColumn('status', function($row){
                    $status = null;

                    if ($row->email_verified_at == null) {

                        $status = '<span class="badge badge-danger">Disabled</span>';
                    }
                    else if ($row->email_verified_at != null) {
                        $status = '<span class="badge badge-success">Active</span>';
                    }

                    return $status;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" title="Show" class="btn btn-sm btn-success view showButton"> <i class="fas fa-eye"></i> </a>
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" title="Edit" class="btn btn-sm btn-primary edit editButton"> <i class="fas fa-edit"></i> </a>
                    <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" title="Delete" class="btn btn-sm btn-danger del deleteButton"> <i class="fas fa-trash"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status', 'role'])
                ->make(true);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $languages = $request->languages;

        if ($request->user) {

            $user = User::find($request->user);
            $users = User::where('email', '!=', $user->email)->get();

            $userEmails = $users->map(function($user) {
                return $user->email;
            })->toArray();

            if (! $user) {
                return response()->json([
                    'error' => config('error.404_show')
                ], 404);

            }

            else if (in_array($request->email, $userEmails)) {
                return response()->json([
                    'error' => 'Email already taken'
                ], 404);
            }

            try {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'email_verified_at' => $request->status == 1 ? now(): null,
                    'role' => $request->role,
                ]);

                $user->languages()->sync($languages);

            }
            catch(\Exception $ex) {
                return response()->json([
                    'error' => 'Something went wrong, the error is '. $ex->getMessage()
                ], 401);
            }

        }
        else {

            $user = User::where('email', $request->email)->first();

            if ($languages != null) {

                foreach ($languages as $language) {
                    $language = Language::find($language);

                    if (! $language) {
                        return response()->json([
                            'error' => 'Unable to find the language, please select the correct language which exists in system'
                        ], 404);
                    }

                }

            }

            if ($user) {
                return response()->json([
                    'error' => 'email already taken'
                ], 422);
            }

            try {

                $randomPassword = rand(10, 99). Str::random(6);

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'email_verified_at' => $request->status == 1 ? now(): null,
                    'role' => $request->role != null ? $request->role: User::TRANSLATOR,
                    'password' => $randomPassword
                ]);


                if ($user) {

                    $user->languages()->attach($languages);

                    $data = [
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => $randomPassword,
                    ];

                    Mail::to($user->email)->send(new RegistrationMail($data));
                }
            }
            catch(\Exception $ex) {
                return response()->json([
                    'error' => 'Something went wrong, the error is '. $ex->getMessage()
                ], 401);
            }
        }

        return response()->json([
            'message' => 'User saved successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'error' => config('error.404_show')
            ], 404);
        }

        $languages = [];

        if ($user->languages) {
            $languages = $user->languages->map(function($language) {
                return ucfirst($language->name);
            })->toArray();
        }

        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role == User::ADMIN ? '<span class="badge badge-success">Administrator</span>': '<span class="badge badge-info">Translator</span>' ,
                'status' => $user->email_verified_at != null ? '<span class="badge badge-success">Active</span>': '<span class="badge badge-danger">Disabled</span>' ,
                'languages' => implode(', ', $languages)
            ]
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $languages = null;
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'error' => config('error.404_show')
            ], 404);
        }

        if ($user->languages) {
            $languages = $user->languages;
        }

        return response()->json([
            'user' => $user,
            'languages' => $languages
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (! $user) {
            return response()->json([
                'error' => config('error.404_show')
            ], 404);
        }

        try {

            if ($user->languages) {
                $user->languages()->detach();
            }

            $user->delete();
        }
        catch(\Exception $ex) {
            return response()->json([
                'error' => 'Something went wrong, the error is '. $ex->getMessage()
            ], 401);
        }

        return response()->json([
            'message' => 'Location removed successfully'
        ], 201);
    }

    public function loadLanguages()
    {
        $languages = fetchLanguagesWithoutDefault();

        return response()->json([
            'languages' => $languages
        ], 201);
    }
}
