<?php

namespace App\Http\Controllers;

use App\MonumentTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MonumentTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monumentTranslations = MonumentTranslation::with('language:id,code')->get();
        return response()->json($monumentTranslations);
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
            'monument_id' => 'required',
            'language_id' => 'required',
            'name' => 'required',
            'city' => 'required',
            'country' => 'required',
            'content' => 'required',
        ];

        Validator::make($data, $rules)->validate();

        $objectData = [
            'monument_id' => $data['monument_id'],
            'language_id' => $data['language_id'],
            'name' => $data['name'],
            'city' => $data['city'],
            'country' => $data['country'],
            'content' => $data['content'],
        ];

        if (isset($data['id'])) {
            $monumentTranslation = MonumentTranslation::find($data['id']);
            $monumentTranslation->update($objectData);
            $message = 'Successfully updated translation';
        } else {
            $monumentTranslation = new MonumentTranslation($objectData);
            $monumentTranslation->save();
            $message = 'Successfully created translation';
        }

        return response()->json([
            'message' => $message,
            'monumentTranslation' => $monumentTranslation
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(MonumentTranslation::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MonumentTranslation::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Successfully delete Monument Translation'
        ]);
    }
}