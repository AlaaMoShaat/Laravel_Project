<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('cms.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'name' => 'required|string',
            ],
            [
                'name.required' => 'هذا الحقل مطلوب',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $categories = new Category();
            $categories->name = $request->get('name');
            $categories->status = $request->get('status');
            $categories->description = $request->get('description');
            $isSaved = $categories->save();
            return response()->json([
                'icon' => 'success',
                'title' => 'Created is successfully',

            ], 200);
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
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return response()->view('cms.category.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator(
            $request->all(),
            [
                'name' => 'required|string',
            ],
            [
                'name.required' => 'هذا الحقل مطلوب',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $categories = Category::findOrFail($id);
            $categories->name = $request->get('name');
            $categories->status = $request->get('status');
            $categories->description = $request->get('description');
            $isUpdated = $categories->save();
            return ['redirect' => route('categories.index')];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admins = Category::destroy($id);
    }
}
