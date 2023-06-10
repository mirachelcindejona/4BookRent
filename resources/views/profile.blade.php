@extends('layouts.mainlayout')

@section('title', 'Profile')
    
@section('content')
<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 90vh;">
        <div class=" col-12 col-md-8 col-lg-8 ">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                <div class="text-center mb-3">
                    <h3>Your Profile</h3>
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
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control bg-dark" readonly value="{{ $user->username }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Phone</label>
                    <input type="text" class="form-control bg-dark" readonly value="{{ $user->phone }}">
                </div>
                <div class="mb-4">
                    <label for="username" class="form-label">Address</label>
                    <textarea name="" id="" cols="30" rows="3" class="form-control bg-dark" style="resize: none" readonly>{{ $user->address }}</textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-secondary me-3" data-bs-toggle="modal" data-bs-target="#EditPasswordModal">Change Password</a>
                    <a href="#" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#EditProfileModal"><i class="fa-solid fa-pen fa-fw me-2"></i>Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Update -->
<form action="edit-profile/{{ Auth::user()->slug }}" method="post">
    @csrf
    @method('put')
<div class="modal fade" id="EditProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfile" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="editProfile">Update Profile</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control bg-dark" value="{{ $user->username }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control bg-dark" value="{{ $user->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" cols="30" rows="3" class="form-control bg-dark" style="resize: none" required>{{ $user->address }}</textarea>
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

<!-- Modal Update -->
<form action="edit-password/{{ Auth::user()->slug }}" method="post">
    @csrf
    @method('put')
<div class="modal fade" id="EditPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editPassword" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-light">
        <div class="modal-header">
          <h3 class="modal-title" id="editPassword">Change Password</h3>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control bg-dark" name="password" id="password" placeholder="Change new password">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="Change" value="Change">
        </div>
      </div>
    </div>
</div>
</form>
<!-- Modal Update End -->

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection