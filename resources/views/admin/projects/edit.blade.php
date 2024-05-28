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

        <form action="{{ route('admin.projects.update', $project) }}" class="d-flex" method="POST" id="form-projects{{$project->id}}">
            @csrf
            @method('PUT')
            <input class="form-control" type="text" value="{{ $project->title }}" name="title">

            <button type="submit" class="btn btn-primary ms-3 ">Update Project</button>

        </form>





    </div>

</div>



@endsection
