@extends('layouts.mainlayout')

@section('title', 'Dashboard')
    
@section('content')
<!-- Additional CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/style-home-page.css') }}" />

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded justify-content-center mx-0">
        <div class="bg-light rounded h-100 p-4">

          <form action="" method="get">
            <div class="row">
              <div class="col-12 col-sm-6 px-5 pt-1">
                <h3>Books</h3>
              </div>
              <div class="col-12 col-sm-6 px-5 pt-3">
                <div class="input-group mb-3">
                  <input type="text" name="title" class="form-control" placeholder="Search book's title">
                  <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
              </div>
            </div>
          </form>

          <!-- ***** Book List ***** -->
          <div class="most-popular bg-light">
            <div class="row">
              <div class="col-lg-12">
                <div class="row">
                  @foreach ($books as $item)
                      <div class="col-lg-3 col-md-3 col-sm-6 col-xs-3 mb-4">
                      <div class="item h-100">
                          <div class="d-flex align-items-center justify-content-center">
                            @if ($item->cover!='')
                              <img src="{{ asset('storage/cover/'.$item->cover) }}" alt="" style="width: 130px" draggable="false"/>
                            @else
                              <img src="{{ asset('assets/img/cover-default.png') }}" alt="">
                            @endif
                          </div>
                          <h4>{{ $item->title }}<br><span>{{ $item->book_code }}</span></h4>
                          <p class="text-end fw-bold {{ $item->status == 'in stock' ? 'text-success' : 'text-danger' }}">{{ $item->status }}</p>
                      </div>
                      </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- ***** Book List End ***** -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endsection