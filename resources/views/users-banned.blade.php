@extends('layouts.mainlayout')

@section('title', 'Banned Users')
    
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Banned User List</h3>
            <div class="my-3 d-flex justify-content-end">
                <a href="/users" class="btn btn-primary">User List</a>
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
                    @foreach ($bannedUsers as $item)
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
                            <a href="#" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#RestoreUser-{{ $item->slug }}"><i class="fa-solid fa-trash-arrow-up fa-fw me-2"></i>Restore</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach ($bannedUsers as $item)
<!-- Modal Restore -->
<form action="user-restore/{{$item->slug}}" method="post">
    @csrf
<div class="modal fade" id="RestoreUser-{{$item->slug}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="restoreUser" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="restoreUser">Restore User</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <h5>Are you sure to restore {{ $item->username }} ?</h5>
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