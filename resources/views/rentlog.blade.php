@extends('layouts.mainlayout')

@section('title', 'Rent Logs')
    
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Rent Logs</h3>
            <x-rent-log-table :rentlog='$rent_logs' />
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection