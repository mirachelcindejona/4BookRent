@extends('layouts.mainlayout')

@section('title', 'Books')
    
@section('content')

<link href="{{ asset('assets/css/select-multiple.css') }}" rel="stylesheet" />

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Book List</h3>
            <div class="my-3 d-flex justify-content-end">
                <a href="/deleted-list-book" class="btn btn-warning me-2">View Deleted Book</a>
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddBookModal"><i class="fa-solid fa-plus fa-fw me-2"></i>Add Data</a>
            </div>
            <div class="mt-2">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>
            <table class="table table-bordered table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Title</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($book as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->book_code }}</td>
                        <td>{{ $item->title }}</td>
                        <td>
                            @if ($item->cover!='')
                                <img src="{{ asset('storage/cover/'.$item->cover) }}" alt="" width="80px">
                            @else
                                (Cover Not Found)
                            @endif
                        </td>
                        <td>
                            @foreach ($item->categories as $category)
                                {{ $category->name }} <br>
                            @endforeach
                        </td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="#" class="btn btn-info my-1" data-bs-toggle="modal" data-bs-target="#EditBookModal-{{$item->slug}}"><i class="fa-solid fa-pen fa-fw"></i></a>
                            <a href="#" class="btn btn-danger my-1" data-bs-toggle="modal" data-bs-target="#DeleteBookModal-{{$item->slug}}"><i class="fa-solid fa-trash fa-fw"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<form action="add-book" method="post" enctype="multipart/form-data">
    @csrf
<div class="modal fade" id="AddBookModal" data-bs-backdrop="static" tabindex="-1" data-bs-keyboard="false" aria-labelledby="addNewBook" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="addNewBook">Add New Book</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control bg-dark" id="code" name="book_code" value="{{ old('book_code') }}" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Book's Title</label>
                <input type="text" class="form-control bg-dark" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            <div class="mb-3">
                <label for="select-category" class="form-label">Category</label>
                <select name="categories[]" id="select-category" class="form-control" multiple>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">image</label>
                <input type="file" class="form-control bg-dark" id="image" name="image">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="Save" value="Save">
        </div>
      </div>
    </div>
</div>
</form>
<!-- Modal Add End-->

<!-- Modal Update -->
@foreach ($book as $books)
<form action="edit-book/{{ $books->slug }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
<div class="modal fade" id="EditBookModal-{{ $books->slug }}" data-bs-backdrop="static" tabindex="-1" data-bs-keyboard="false" aria-labelledby="editBook" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="editBook">Edit Book</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control bg-dark" id="code" name="book_code" value="{{ $books->book_code }}" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Book's Title</label>
                <input type="text" class="form-control bg-dark" id="title" name="title" value="{{ $books->title }}" required>
            </div>
            <div class="mb-3">
                <label for="select-category-edit" class="form-label">Category</label>
                <select name="categories[]" id="select-category-edit" class="form-control bg-dark" multiple>
                    @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">image</label>
                <input type="file" class="form-control bg-dark" id="image" name="image">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="Update" value="Update">
        </div>
      </div>
    </div>
</div>
</form>
@endforeach
<!-- Modal Update End -->


@foreach ($book as $data)
<!-- Modal Delete -->
<form action="delete-book/{{ $data->slug }}" method="post">
    @csrf
<div class="modal fade" id="DeleteBookModal-{{$data->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteBook" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="deleteBook">Delete Book</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <h5>Are you sure to delete book {{$data->title}} ?</h5>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-danger" name="Delete" value="Delete">
        </div>
      </div>
    </div>
</div>
</form>
<!-- Modal Delete End -->
@endforeach

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="{{ asset('assets/js/select-multiple.js') }}"></script>
<script>
    new MultiSelectTag('select-category', {
        rounded: true,
        shadow: true
    });

    new MultiSelectTag('select-category-edit', {
        rounded: true,
        shadow: true
    });
</script>


@endsection