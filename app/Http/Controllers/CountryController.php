<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::withCount('cities')->filter(request(['search']))->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('cms.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:20',
                'code' => 'required|digits:3',
            ],
            [
                'name.required' => 'هذا الحقل مطلوب',
                'code.required' => 'هذا الحقل مطلوب'
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $countries = new Country();
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $isSaved = $countries->save();
            return response()->json([
                'icon' => 'success',
                'title' => 'Created is successfully',

            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $countries = Country::findOrFail($id);
        return response()->view('cms.country.show', compact('countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $countries = Country::findOrFail($id);
        return response()->view('cms.country.edit', compact('countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:20',
                'code' => 'required|digits:3',
            ],
            [
                'name.required' => 'هذا الحقل مطلوب',
                'code.required' => 'هذا الحقل مطلوب'
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $countries = Country::findOrFail($id);
            $countries->name = $request->get('name');
            $countries->code = $request->get('code');
            $isUpdated = $countries->save();
            return ['redirect' => route('countries.index')];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $countries = Country::destroy($id);
    }
}
