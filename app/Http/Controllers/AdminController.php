<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::orderBy('id', 'desc')->filter(request(['search']))->paginate(10);
        $this->authorize('viewAny', Admin::class);
        return response()->view('cms.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        $roles = Role::where('guard_name', 'admin')->get();
        $this->authorize('create', Admin::class);
        return response()->view('cms.admin.create', compact('cities', 'roles'));
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
                'email' => 'required|unique:admins,email',
                'password' => 'required|unique:admins,email|min:6',
            ],
            [
                'firstname.required' => 'هذا الحقل مطلوب',
                'email.required' => 'هذا الحقل مطلوب',
                'password.min' => 'password must at least 6 char'
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));
            $isSaved = $admins->save();
            if ($isSaved) {
                $users = new User();
                $roles = Role::findOrFail($request->get('role_id'));
                $admins->assignRole(($roles->name));
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin', $imageName);
                    $users->image = $imageName;
                }
                $users->firstname = $request->get('firstname');
                $users->lastname = $request->get('lastname');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->mobile = $request->get('mobile');
                $users->date = $request->get('date');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($admins);

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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        $cities = City::all();
        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('cms.admin.edit', compact('admins', 'cities', 'roles'));
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
            $admins = Admin::findOrFail($id);
            $admins->email = $request->get('email');
            $isUpdated = $admins->save();
            if ($isUpdated) {
                $users = $admins->user;
                if (request()->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();
                    $image->move('storage/images/admin', $imageName);
                    $users->image = $imageName;
                }
                $users->firstname = $request->get('firstname');
                $users->lastname = $request->get('lastname');
                $users->status = $request->get('status');
                $users->gender = $request->get('gender');
                $users->mobile = $request->get('mobile');
                $users->date = $request->get('date');
                $users->city_id = $request->get('city_id');
                $users->actor()->associate($admins);
                $isUpdated = $users->save();
            }
            return ['redirect' => route('admins.index')];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        if ($admin->id == Auth::id()) {
            return redirect()->route('admins.index')->withErrors(trans('cannot delete yoursef'));
        } else {
            $admin->user()->delete();
            $isDeleted = $admin->delete();
            return response()->json([
                'icon' => 'success',
                'title' => 'Admin is Deleted'
            ]);
        }
    }
}
