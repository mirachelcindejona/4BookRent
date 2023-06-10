@extends('layouts.mainlayout')

@section('title', 'Users')
    
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Users List</h3>
            <div class="my-3 d-flex justify-content-end">
                <a href="/users-banned" class="btn btn-warning me-2">View Banned User</a>
                <a href="/registered-users" class="btn btn-primary">New Registered User</a>
            </div>
            <div class="mt-2">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
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
                    @foreach ($users as $item)
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
                            <a href="/user-detail/{{ $item->slug }}" class="btn btn-info me-3"><i class="fa-solid fa-circle-info fa-fw me-2"></i>Detail</a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#BanUser-{{ $item->slug }}"><i class="fa-solid fa-ban fa-fw me-2"></i>Ban User</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@foreach ($users as $item)
<!-- Modal Delete -->
<form action="ban-user/{{$item->slug}}" method="post">
    @csrf
<div class="modal fade" id="BanUser-{{$item->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="banUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="banUser">Banned User</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <h5>Are you sure to banned {{ $item->username }} ?</h5>
            </div> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-danger" name="Ban" value="Ban">
        </div>
      </div>
    </div>
</div>
</form>
<!-- Modal Delete End -->
@endforeach


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection