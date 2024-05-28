<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Functions\Helper as Help;

class TechnologiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exists = Technology::where('title', $request->title)->first();
        if($exists){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology exist');

        }else{
            $new = new Technology();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Technology::class);
            $new->save();

            return redirect()->route('admin.technologies.index')->with('success', 'Technology added');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:30'
        ],
        [
            'title.required' => 'Title is obbligatory',
            'title.min' => 'Title must have at least 3 letters',
            'title.max' => 'Title must have a maximum of 30 letters',
        ]);

        $exists = Technology::where('title', $request->title)->first();
        if($exists){
            return redirect()->route('admin.technologies.index')->with('error', 'Technology exist');

        }else{
            $data['slug'] = Help::generateSlug($request->title, Technology::class);
            $technology->update($data);

            return redirect()->route('admin.technologies.index')->with('success', 'Technology modificated');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success', 'Technology deleted');
    }
}
