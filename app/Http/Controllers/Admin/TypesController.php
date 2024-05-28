<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Functions\Helper as Help;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
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
        $exists = Type::where('title', $request->title)->first();
        if($exists){
            return redirect()->route('admin.types.index')->with('error', 'Type exist');

        }else{
            $new = new Type();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Type::class);
            $new->save();

            return redirect()->route('admin.types.index')->with('success', 'Type added');

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
    public function update(Request $request, Type $type)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:30'
        ],
        [
            'title.required' => 'Title is obbligatory',
            'title.min' => 'Title must have at least 3 letters',
            'title.max' => 'Title must have a maximum of 30 letters',
        ]);

        $exists = Type::where('title', $request->title)->first();
        if($exists){
            return redirect()->route('admin.types.index')->with('error', 'Type exist');

        }else{
            $data['slug'] = Help::generateSlug($request->title, Type::class);
            $type->update($data);

            return redirect()->route('admin.types.index')->with('success', 'Type modificated');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Type deleted');
    }
}
