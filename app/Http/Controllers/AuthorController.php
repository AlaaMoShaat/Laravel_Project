<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::withCount('articles')->orderBy('id', 'desc')->paginate(10);
        $this->authorize('viewAny', Author::class);
        return response()->view('cms.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::where('guard_name', 'author')->get();
        $cities = City::all();
        $this->authorize('create', Author::class);
        return response()->view('cms.author.create', compact('cities', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required|unique:authors,email',
            ],
            [
                'firstname.required' => 'هذا الحقل مطلوب',
                'email.required' => 'هذا الحقل مطلوب'
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $authors = new Author();
            $authors->email = $request->get('email');
            $authors->password = Hash::make($request->get('password'));
            $isSaved = $authors->save();
            if ($isSaved) {
                $users = new User();
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/author', $imageName);
                    $users->image = $imageName;
                }
                $users->firstname = $request->get('firstname');
                $users->lastname = $request->get('lastname');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->mobile = $request->get('mobile');
                $users->date = $request->get('date');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($authors);

                $isSaved = $users->save();
            }
            return response()->json([
                'icon' => 'success',
                'title' => 'Created is successfully',

            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $authors = Author::findOrFail($id);
        $cities = City::all();
        return response()->view('cms.author.edit', compact('authors', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator(
            $request->all(),
            [
                'password' => 'nullable',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email' => 'required',
            ],
            [
                'firstname.required' => 'هذا الحقل مطلوب',
                'email.required' => 'هذا الحقل مطلوب'
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $authors = Author::findOrFail($id);
            $authors->email = $request->get('email');
            $isUpdated = $authors->save();
            if ($isUpdated) {
                $users = $authors->user;
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/author', $imageName);
                    $users->image = $imageName;
                }
                $users->firstname = $request->get('firstname');
                $users->lastname = $request->get('lastname');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->mobile = $request->get('mobile');
                $users->date = $request->get('date');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($authors);
                $isUpdated = $users->save();
            }
            return ['redirect' => route('authors.index')];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $authors = Author::destroy($id);
    }
}
