@extends('layouts.admin')

@section('content')

<div class="p-3 projects">
    <h2>Projects</h2>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">

            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    @if (session('error'))

        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
    @endif

    @if (session('success'))

        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif

    <div class="table-projects">

        <form action="{{ route('admin.projects.update', $project) }}" class="" method="POST" id="form-projects{{$project->id}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input class="form-control" type="text" value="{{ old('title', $project->title) }}" name="title">


            <div class="my-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" class="form-control" name="image">
            </div>

            <div class="check-bg my-3">

                <label class="form-label" >Technologies:</label>
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                    @foreach ($technologies as $technology)

                   <input
                      type="checkbox"
                      class="btn-check"
                      id="technology_{{$technology->id}}"
                      autocomplete="off"
                      value="{{$technology->id}}"
                      name="technologies[]"
                      {{in_array($technology->id, old('technologies',  $project->technologies->pluck('id')->toArray())) ? 'checked' : ''}}>

                    <label class="btn btn-outline-primary" for="technology_{{$technology->id}}">{{$technology->title}}</label>

                    @endforeach

                </div>

            </div>

            <div class="my-3">

                <label class="form-label" for="title">Types:</label>
                <select class="form-select" aria-label="Default select example" name="type">
                    @foreach ($types as $type)

                    <option value="{{$type->id}}" {{old('type', $project->type_id) == $type->id ? 'selected' : ''}}>
                        {{$type->title}}
                    </option>


                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary ms-3 ">Update Project</button>

        </form>






    </div>

</div>



@endsection
