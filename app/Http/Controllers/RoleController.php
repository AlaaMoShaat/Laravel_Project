<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount('permissions')->OrderBy('id', 'desc')->paginate(5);

        return view('cms.spaity.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.spaity.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {

            $roles = new Role();
            $roles->name = $request->get('name');
            $roles->guard_name = $request->get('guard_name');

            $isSaved = $roles->save();

            if ($isSaved) {
                return response()->json([
                    'icon' => 'success',
                    'title' => "Created is Successfully",
                ], 200);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => "Created is Failed",
                ], 400);
            }
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::findOrFail($id);
        return response()->view('cms.spaity.role.edit', compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {

            $roles = Role::findOrFail($id);
            $roles->name = $request->get('name');
            $roles->guard_name = $request->get('guard_name');

            $isSaved = $roles->save();

            return ['redirect' => route('roles.index')];
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roles = Role::destroy($id);
    }
}
