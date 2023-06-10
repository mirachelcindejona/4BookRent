@extends('layouts.mainlayout')

@section('title', 'Category')
    
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Category List</h3>
            <div class="my-3 d-flex justify-content-end">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCategoryModal"><i class="fa-solid fa-plus fa-fw me-2"></i>Add Data</a>
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
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="#" class="btn btn-info me-3" data-bs-toggle="modal" data-bs-target="#EditCategoryModal-{{$item->slug}}"><i class="fa-solid fa-pen fa-fw me-2"></i>Edit</a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteCategoryModal-{{$item->slug}}"><i class="fa-solid fa-trash fa-fw me-2"></i>Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<form action="add-category" method="post">
    @csrf
<div class="modal fade" id="AddCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addNewCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="addNewCategory">Add New Category</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control bg-dark" id="name" name="name" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="save" value="save">
        </div>
      </div>
    </div>
</div>
</form>
<!-- Modal Add End-->

@foreach ($category as $data)
<!-- Modal Update -->
<form action="edit-category/{{ $data->slug }}" method="post">
    @csrf
    @method('put')
<div class="modal fade" id="EditCategoryModal-{{ $data->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="editCategory">Update Category</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control bg-dark" id="name" name="name" value="{{ $data->name }}" required>
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
<!-- Modal Update End -->
@endforeach


@foreach ($category as $cate)
<!-- Modal Delete -->
<form action="delete-category/{{$cate->slug}}" method="post">
    @csrf
<div class="modal fade" id="DeleteCategoryModal-{{$cate->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="deleteCategory">Delete Category</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <h5>Are you sure to delete category {{$cate->name}} ?</h5>
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
@endsection