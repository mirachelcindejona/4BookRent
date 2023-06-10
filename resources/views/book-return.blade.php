@extends('layouts.mainlayout')

@section('title', 'Book Return')
    
@section('content')
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" />

<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 90vh;">
        <div class=" col-12 col-md-8 col-lg-8 ">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                <div class="text-center mb-3">
                    <h3>Book Return Form</h3>
                </div>
                @if (session('message'))
                    <div class="alert {{session('alert-class')}}">
                        {{ session('message') }}
                    </div>
                @endif
                <form action="book-return" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="user" class="form-label">User</label>
                        <br>
                        <select name="user_id" id="user" class="form-control select2-input bg-dark">
                            <option value="">Select User</option>
                            @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->username }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="book" class="form-label">Book</label>
                        <select name="book_id" id="book" class="form-control select2-input bg-dark">
                            <option value="">Select Book</option>
                            @foreach ($books as $item)
                            <option value="{{ $item->id }}">{{ $item->book_code }} {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2-input').select2();
    });
</script>

@endsection