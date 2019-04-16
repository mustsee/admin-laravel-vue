<?php

namespace App\Http\Controllers;

use App\Monument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monuments = Monument::with('monumentTranslations.language')->get();
        return response()->json($monuments);
        return response()->json(Monument::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->get('payload');

        $rules = [
            'default_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ];

        Validator::make($data, $rules)->validate();

        $objectData = [
            'default_name' => $data['default_name'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude'],
        ];

        if (isset($data['id'])) {
            $monument = Monument::find($data['id']);
            $monument->update($objectData);
        } else {
            $monument = new Monument($objectData);
            $monument->save();
        }

        return response()->json($monument);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Monument::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Monument::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Successfully delete Monument'
        ]);
    }
}
