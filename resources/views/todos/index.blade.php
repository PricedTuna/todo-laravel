@extends('app')

@section('content')
  <div class="container w-25 border p-4 shadow-sm mt-4" >
    <!-- Form to add tasks -->
    <form action="{{route('todos')}}" method="post">
      @csrf
      <div class="mb-3">
        <label for="taskTitle" class="form-label">Task title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="taskTitle" />
        <select class="form-select mt-2" name="category_id" >
          @foreach ($categories as $category)
            <option value="{{$category->id}}" >{{$category->title}}</option>
          @endforeach
        </select>
        <div class="mt-2">
          @error('title')
          <h6 class="alert alert-danger">{{ $message }}</h6>
          @enderror
          @if ( session('success') )
          <h6 class="alert alert-success">{{ session('success') }}</h6>
          @endif
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>


    <!-- Show tasks -->
    <div class="container" >
      @foreach ($todos as $todo)
        <div class="row py-1">
          <div class="col-md-9 d-flex gap-2 align-items-center">
          <span style="height: 0.8rem; width: 0.8rem; border: 2px solid black; background-color: {{$todo->category->color}};" ></span>
            <a href="{{route('todos.edit', ['id' => $todo->id])}}">{{$todo->title}}</a>
          </div>
          <div class="col-md-3 d-flex justify-content-end">
            <form action="{{route('todos.delete', ['id' => $todo->id])}}" method="post" >
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