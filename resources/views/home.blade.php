<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>4BookRent</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/style-home-page.css') }}" />

    <!-- fontawesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>

  <body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="main-nav">
              <!-- ***** Logo Start ***** -->
              <a href="#" class="navbar-brand">
                <h2 class="text-primary text-center">
                  <i class="fa-solid fa-book fa-fw me-2"></i>4BookRent
                </h2>
              </a>
              <!-- ***** Logo End ***** -->
              <div class="d-flex align-items-center ms-auto">
                <a href="register" class="btn btn-outline-primary rounded-pill mx-1 px-4"><i class="fa-solid fa-right-to-bracket fa-fw me-2"></i>Register</a>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-content mb-5">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner">
              <div class="row">
                <div class="col-lg-7">
                  <div class="header-text">
                    <h6>Welcome to 4BookRent</h6>
                    <h4><em>Rent</em> Library<br>Books Here</h4>
                    <div class="main-button ">
                      <a href="login">Start Renting</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Banner End ***** -->

            <!-- ***** Book List ***** -->
            <div class="most-popular mt-5" id="#bookList">
              <div class="row">
                <div class="col-lg-12">
                  <div class="heading-section">
                    <h4>Book List</h4>
                  </div>
                  <div class="row">
                    @foreach ($books as $item)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-3 mb-4">
                        <div class="item h-100">
                            <div class="d-flex align-items-center justify-content-center">
                              @if ($item->cover!='')
                                <img src="{{ asset('storage/cover/'.$item->cover) }}" alt="" style="width: 130px" draggable="false"/>
                              @else
                                  (Cover Not Found)
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
    </div>

    <!-- Scripts -->
  </body>
</html>
