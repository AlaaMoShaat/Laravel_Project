<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        return response()->json([
            'status' => true,
            'message' => 'Data of City',
            'data' => $cities
        ]);
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
                'status' => false,
                'message' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $cities = new City();
            $cities->name = $request->get('name');
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');
            $isSaved = $cities->save();
            return response()->json([
                'status' => true,
                'message' => 'Created is Successfully'

            ], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cities = City::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Data of City',
            'data' => $cities
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator(
            $request->all(),
            [
                'name' => 'nullable',
                'street' => 'nullable',
            ]

        );
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->getMessageBag()->first(),

            ], 400);
        } else {
            $cities = City::findOrFail($id);
            $cities->name = $request->get('name');
            $cities->street = $request->get('street');
            $cities->country_id = $request->get('country_id');
            $isUpdated = $cities->save();
            return response()->json([
                'status' => true,
                'message' => 'Updated is Successfully'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cities = City::destroy($id);
        return response()->jasn([
            'status' => true,
            'message' => 'Deleted is Successfully'
        ], 200);
    }
}
