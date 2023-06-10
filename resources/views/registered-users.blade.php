@extends('layouts.mainlayout')

@section('title', 'New Registered Users')
    
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">New Registered User List</h3>
            <div class="my-3 d-flex justify-content-end">
                <a href="/users" class="btn btn-primary">Approved User List</a>
            </div>
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registeredUsers as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>
                            @if ($item->phone)
                                {{ $item->phone }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="#" class="btn btn-info me-3" data-bs-toggle="modal" data-bs-target="#DetailUsers-{{ $item->slug }}"><i class="fa-solid fa-circle-info fa-fw me-2"></i>Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
@foreach ($registeredUsers as $data)
<div class="modal fade" id="DetailUsers-{{ $data->slug }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailUsers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="detailUsers">Detail Users</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input type="text" class="form-control bg-dark" readonly value="{{ $data->username }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Phone</label>
                <input type="text" class="form-control bg-dark" readonly value="{{ $data->phone }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <input type="text" class="form-control bg-dark" readonly value="{{ $data->status }}">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Address</label>
                <textarea name="" id="" cols="30" rows="3" class="form-control bg-dark" style="resize: none" readonly>{{ $data->address }}</textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="/user-approve/{{ $data->slug }}" class="btn btn-primary">Approve User</a>
        </div>
      </div>
    </div>
</div>
@endforeach
<!-- Modal Detail End-->


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection