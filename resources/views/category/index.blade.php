@extends('app')

@section('content')
  <div class="container w-25 border p-4 shadow-sm mt-4" >
    <!-- Form to add cateogory -->
    <form action="{{route('category.store')}}" method="post">
      @csrf
      <div class="mb-3">
        <label for="categoryTitle" class="form-label">Category title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="categoryTitle" />
        <label for="categoryColor" class="form-label">Category color</label>
        <input type="color" value="#ff0000" name="color" class="form-control @error('color') is-invalid @enderror" id="categoryColor" />
        <div class="mt-2">
          @error('title')
          <h6 class="alert alert-danger">{{ $message }}</h6>
          @enderror
          @error('color')
          <h6 class="alert alert-danger">{{ $message }}</h6>
          @enderror
          @if ( session('success') )
          <h6 class="alert alert-success">{{ session('success') }}</h6>
          @endif
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>


    <!-- Show cateogory -->
    <div class="container">
      @foreach ($categories as $category)
        <div class="row py-1">
          <div class="col-md-9 d-flex gap-2 align-items-center">
            <span style="height: 0.8rem; width: 0.8rem; border: 2px solid black; background-color: {{$category->color}};" ></span>
            <a href="{{route('category.edit', ['id' => $category->id])}}">{{$category->title}}</a>
          </div>
          <div class="col-md-3 d-flex justify-content-end">
            <form action="{{route('category.delete', ['id' => $category->id])}}" method="post" >
              @method('DELETE')
              @csrf
              <button class="btn btn-danger btn-sm" >Delete</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection