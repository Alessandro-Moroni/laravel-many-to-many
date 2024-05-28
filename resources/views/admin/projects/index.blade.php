@extends('layouts.admin')

@section('content')

<div class="p-3 projects">
    <h2>Projects</h2>

    <div class="table-projects">


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

        <div>
            <div>
                <form action="{{route('admin.projects.index')}}" method="GET" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="toSearch" placeholder="Search Project" aria-label="Search">
                    <button class="btn btn-success" type="search">Search</button>
                </form>
            </div>

            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary my-3">
                Create a new Project
            </a>

        </div>

        <table class="table">
            <thead>
              <tr>
                <th scope="col"><a href="{{route('admin.orderby', ['direction'=> $direction, 'column' => 'title'])}}">Title</a></th>
                <th scope="col">Image</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)

                <tr>
                  <td>
                    {{ $project->title }}
                  </td>

                  <td>
                    <img src="{{ asset('storage/'. $project->image) }}" alt="{{$project->image}}" alt="{{$project->title}}" width="100">
                  </td>

                  <td>
                    {{ $project->type?->title }}
                  </td>



                  <td class="d-flex">
                    <a href="{{route('admin.projects.edit', $project->id)}}" class="btn btn-warning me-3">
                        <i class="fa-solid fa-pen"></i>
                    </a>

                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure want to delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                  </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>

</div>

<script>

    function submitForm(id){
        const form = document.getElementById(`form-projects${id}`);
        form.submit();
    }


</script>

@endsection
