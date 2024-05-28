@extends('layouts.admin')

@section('content')

<div class="p-3 projects">
    <h2>New Projects</h2>

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

        <form action="{{ route('admin.projects.store') }}" method="POST" class="my-3 d-flex" enctype="multipart/form-data">
            @csrf

            <div>

                <input class="form-control me-2 " name="title" type="text" id="title"  placeholder="Create" aria-label="Search" name="title">

                <div class="my-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" class="form-control" name="image">
                </div>



                    <div class="check-bg my-3">

                        <label class="form-label" >Technologies:</label>
                        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                            @foreach ($technologies as $technology)

                            <input type="checkbox" class="btn-check" id="technology_{{$technology->id}}" autocomplete="off" value="{{$technology->id}}" name="technologies[]">
                            <label class="btn btn-outline-primary" for="technology_{{$technology->id}}">{{$technology->title}}</label>

                            @endforeach

                        </div>

                    </div>

                    <div class="my-3">


                        <label class="form-label" for="title">Types:</label>
                        <select class="form-select" aria-label="Default select example" name="type">
                            @foreach ($types as $type)

                            <option value="{{$type->id}}">{{$type->title}}</option>


                            @endforeach
                        </select>
                    </div>

                <button class="btn btn-success me-3" type="submit">Add project</button>
                <button type="reset" class="btn btn-danger">Reset</button>

            </div>





        </form>




    </div>

</div>



@endsection
