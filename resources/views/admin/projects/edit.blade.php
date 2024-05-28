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
            <input class="form-control" type="text" value="{{ $project->title }}" name="title">

            <div class="my-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" class="form-control" name="image">
            </div>

            <button type="submit" class="btn btn-primary ms-3 ">Update Project</button>

        </form>





    </div>

</div>



@endsection
