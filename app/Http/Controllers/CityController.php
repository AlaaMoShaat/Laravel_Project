<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('country')->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return response()->view('cms.city.create', compact('countries'));
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
                'street' => 'nullable',
                'country_id' => 'required',
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
            $cities = new City();
            $cities->name = $request->get('name');
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');
            $isSaved = $cities->save();
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
        $cities = City::findOrFail($id);
        return response()->view('cms.city.show', compact('cities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cities = City::findOrFail($id);
        $countries = Country::all();
        return response()->view('cms.city.edit', compact('cities', 'countries'));
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
                'street' => 'required',
                'country_id' => 'required'
            ],
            [
                'name.required' => 'هذا الحقل مطلوب',
                'street.required' => 'هذا الحقل مطلوب'
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $cities = City::findOrFail($id);
            $cities->name = $request->get('name');
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');
            $isUpdated = $cities->save();
            return ['redirect' => route('cities.index')];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cities = City::destroy($id);
    }
}
