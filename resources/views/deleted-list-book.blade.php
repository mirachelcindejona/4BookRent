@extends('layouts.mainlayout')

@section('title', 'Book Deleted List')
    
@section('content')

<link href="{{ asset('assets/css/select-multiple.css') }}" rel="stylesheet" />

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Deleted Book List</h3>
            <div class="my-3 d-flex justify-content-end">
                <a href="/books" class="btn btn-primary me-2">Book List</a>
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
                    @foreach ($deletedBooks as $item)
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
                            <a href="#" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#RestoreBook-{{ $item->slug }}"><i class="fa-solid fa-trash-arrow-up fa-fw me-2"></i>Restore</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($deletedBooks as $item)
<!-- Modal Restore -->
<form action="book-restore/{{$item->slug}}" method="post">
    @csrf
<div class="modal fade" id="RestoreBook-{{$item->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreBook" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="restoreBook">Restore User</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <h5>Are you sure to restore {{ $item->title }} ?</h5>
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="Restore" value="Restore">
        </div>
      </div>
    </div>
</div>
</form>
<!-- Modal Restore End -->
@endforeach


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

@endsection