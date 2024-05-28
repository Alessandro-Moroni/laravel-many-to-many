<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Functions\Helper as Help;
use Illuminate\Support\Facades\Storage;


class ProjecstController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET['toSearch'])){
            $projects = Project::where('title', 'like', '%'. $_GET['toSearch'] . '%')->get();
        }else{
            $projects = Project::all();
        }

        $direction = 'desc';

        return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function orderby($direction, $column){
        $direction = $direction === 'desc' ? 'asc' : 'desc';

        $projects = Project::orderBy($column, $direction)->get();
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exists = $request->validate([
            'title' => 'required|min:3|max:30',
            'image' => 'sometimes|image',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
        ],
        [
            'title.required' => 'Title is obbligatory',
            'title.min' => 'Title must have at least 3 letters',
            'title.max' => 'Title must have a maximum of 30 letters',
            'image.image' => 'Upload file must be an image',
            'technologies.array' => 'Technologies must be an array',
            'technologies.*.exists' => 'Technologies is invalidated',
        ]);

        $data = $request->all();
        if(array_key_exists('image', $data)){
            $image_path = Storage::put('uploads', $data['image']);
            $data['image'] = $image_path;


        }


        $exists = Project::where('title', $request->title)->first();
        if($exists){
            return redirect()->route('admin.projects.index')->with('error', 'Project exist');

        }else{
            $new = new Project();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Project::class);
            $new->image = $data['image'] ?? null;
            $new->type_id = $request->type;
            $new->save();


        }

        if(array_key_exists('technologies', $data)){
            $new->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project added');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:30',
            'image' => 'sometimes|image',
            'technologies' => 'array',
            'technologies.*' => 'exists:technologies,id',
        ],
        [
            'title.required' => 'Title is obbligatory',
            'title.min' => 'Title must have at least 3 letters',
            'title.max' => 'Title must have a maximum of 30 letters',
            'image.image' => 'Upload file must be an image',
            'technologies.array' => 'Technologies must be an array',
            'technologies.*.exists' => 'Technologies is invalidated',
        ]);

        $data = $request->all();
        if(array_key_exists('image', $data)){
            $image_path = Storage::put('uploads', $data['image']);
            $data['image'] = $image_path;


        }

        $exists = Project::where('title', $request->title)->first();
        if($exists){
            return redirect()->route('admin.projects.index')->with('error', 'Project exist');

        }else{
            $data['slug'] = Help::generateSlug($request->title, Project::class);
            $project->image = $data['image'] ?? null;
            $project->type_id = $request->type;
            $project->update($data);


        }

        if(array_key_exists('technologies', $data)){
            $project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project modificated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if($project->image){
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted');
    }
}
