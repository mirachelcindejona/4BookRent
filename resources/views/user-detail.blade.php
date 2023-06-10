@extends('layouts.mainlayout')

@section('title', 'Detail User')
    
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row rounded justify-content-center mx-0 g-4">
        <div class="col-sm-12 col-xl-4">
            <div class="bg-light rounded h-100 p-4">
                <h3 class="mb-4">Detail User</h3>
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control bg-dark" readonly value="{{ $user->username }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Phone</label>
                    <input type="text" class="form-control bg-dark" readonly value="{{ $user->phone }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <input type="text" class="form-control bg-dark" readonly value="{{ $user->status }}">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Address</label>
                    <textarea name="" id="" cols="30" rows="3" class="form-control bg-dark" style="resize: none" readonly>{{ $user->address }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <h3 class="mb-4">User's Rent Log</h3>
                <x-rent-log-table :rentlog='$rent_logs' />
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection