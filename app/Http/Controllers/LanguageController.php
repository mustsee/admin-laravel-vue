<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Language::all());
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
            'code' => 'required|unique:languages|max:10'
        ];

        Validator::make($data, $rules)->validate();

        $language = new Language([
            'code' => $data['code']
        ]);
        $language->save();

        return response()->json($language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Language::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Successfully remove language code'
        ]);
    }
}
