@extends('layouts.admin')

@section('content')

<div class="p-3 projects">

    <h2>{{$project->title}}</h2>


    @if ($project->image)
        <img src="{{ asset('storage/'. $project->image) }}"  alt="{{$project->image}}" width="100" class="project-img">

    @else
    <img src="/img/not-found.jpg"  alt="" width="100" class="project-img">
    @endif


</div>



@endsection
