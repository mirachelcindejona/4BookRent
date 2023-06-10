@extends('layouts.mainlayout')

@section('title', 'Dashboard')
    
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-xl-4 col-md-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-book-bookmark fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Books</p>
                    <h6 class="mb-0">{{$book_count}}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-layer-group fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Categories</p>
                    <h6 class="mb-0">{{$category_count}}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-users fa-3x text-primary"></i>
                <div class="ms-3 text-end">
                    <p class="mb-2">Users</p>
                    <h6 class="mb-0">{{$user_count-1}}</h6>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Rent Logs</h3>
            <x-rent-log-table :rentlog='$rent_logs' />
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Book List</h3>
            <table class="table table-bordered table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Title</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">
            <h3 class="mb-4">Users List</h3>
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Phone</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection