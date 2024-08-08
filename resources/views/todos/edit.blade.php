@extends('app')

@section('content')
  <div class="container w-25 border p-4 shadow-sm mt-4" >
    <!-- Form to add tasks -->
    <form action="{{route('todos.update', ['id' => $todo->id])}}" method="post">
      @method('PUT')
      @csrf
      <div class="mb-3">
        <label for="taskTitle" class="form-label">New title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="taskTitle" value="{{$todo->title}}" />
        <select class="form-select mt-2" name="category_id" >
          @foreach ($categories as $category)
            <option value="{{$category->id}}" >{{$category->title}}</option>
          @endforeach
        </select>
        <div class="mt-2">
          @error('title')
          <h6 class="alert alert-danger">{{ $message }}</h6>
          @enderror
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
@endsection