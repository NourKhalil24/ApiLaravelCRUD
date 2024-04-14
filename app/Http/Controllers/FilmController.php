<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $films=Film::all();
        return response()->json([
            'status'=>'success',
            'film'=>$films
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|String|max:255',
            'type'=>'required|String|max:255'
        ]);
        $film=Film::create([
            'name'=>$request->name,
            'type'=>$request->type
        ]);
        return response()->json([
            'status'=>'success',
            'film'=>$film
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        return response()->json([
            'status'=>'success',
            'film'=>$film
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        $request->validate([
            'name'=>'nullable|String|max:255',
            'type'=>'nullable|String|max:255'
        ]);
        $newData=[];
        if(isset($request->name)){
            $newData['name']=$request->name;
        }
        if(isset($request->type)){
            $newData['type']=$request->type;
        }
        $film->update($newData);
        return response()->json([
            'status'=>'success',
            'film'=>$film
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        $film->delete();
        return response()->json([
            'status'=>'success'
        ]);
    }
}
