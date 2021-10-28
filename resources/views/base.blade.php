<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Hello, world!</title>
  </head>
  <body>
     <!--Start Navbar--> 
 <header style="box-shadow: 2px 4px 7px rgb(185, 162, 162);">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand text-warning" href="{{ url("/") }}"><i class="fa fa-home"></i>Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url("/") }}">Home <span class="sr-only">(current)</span></a>
          </li>
            

             
             
          @if (Auth::check())

         <li class="nav-item">
          <a class="nav-link">{{ Auth::user()->name }}</a>
         </li>
         <li class="nav-item">
           <img  class="nav-link" width="40px" height="40px" src="{{url("uploads/".Auth::user()->image)}}" alt="user image">
         </li>
          @endif
         
        </ul>
        <ul class="navbar-nav bg-dark">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              registration
            </a>
            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">

              
              @if (Auth::check())
               @php
                  $user_id = Auth::user()->id;
               @endphp
              <a class="dropdown-item text-warning" href="{{ url("profile/{$user_id}") }}">My Profile</a>
                @if (Auth::user()->hasRole('admin'))
                  <a class="dropdown-item text-warning" href="{{ url("/admin") }}">Admin</a>
                @endif
              <div class="border"></div>
              <a class="dropdown-item text-warning" href="{{ url("/logout") }}">logout</a>
              @else
              <a class="dropdown-item text-warning" href="{{ url("/register") }}">register</a>
              <a class="dropdown-item text-warning" href="{{ url("/login") }}">login</a>
              @endif
    
             
            </div>
          </li>
        </ul>
      </div>
      <!--
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      -->
    </nav>
  </header>
<!--End Navbar--> 
 
  <section>
    <div class="container mt-3 m-1">
      <div class="row">
         <div class="col-md-4">
          <div class="list-group">
            <a data-toggle="collapse" href="#p" class="list-group-item list-group-item-action bg-warning  rounded-lg" aria-current="true">
              Categories
            </a>
          
            <div class="collapse show rounded-lg" id="p">
                
                   @foreach ($cats as $cat)
                   <a href="{{ url("category/{$cat->id}") }}" class="list-group-item list-group-item-action">{{ $cat->name }}</a>                     
                   @endforeach
              
          </div>
          </div>
          
         </div>
        


 
    @yield('content')


<footer class="bg-dark mt-4 text-center text-warning" style="border-top: 5px solid #ffc107 !important">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-2">
        <!-- Facebook -->
        <a
          class="btn btn-primary btn-floating m-1"
          style="background-color: #3b5998;"
          href="#!"
          role="button"
          ><i class="fab fa-facebook-f"></i
        ></a>
  
        <!-- Twitter -->
        <a
          class="btn btn-primary btn-floating m-1"
          style="background-color: #55acee;"
          href="#!"
          role="button"
          ><i class="fab fa-twitter"></i
        ></a>
  
        <!-- Google -->
        <a
          class="btn btn-primary btn-floating m-1"
          style="background-color: #dd4b39;"
          href="#!"
          role="button"
          ><i class="fab fa-google"></i
        ></a>
  
        <!-- Instagram -->
        <a
          class="btn btn-primary btn-floating m-1"
          style="background-color: #ac2bac;"
          href="#!"
          role="button"
          ><i class="fab fa-instagram"></i
        ></a>
  
        <!-- Linkedin -->
        <a
          class="btn btn-primary btn-floating m-1"
          style="background-color: #0082ca;"
          href="#!"
          role="button"
          ><i class="fab fa-linkedin-in"></i
        ></a>
        <!-- Github -->
        <a
          class="btn btn-primary btn-floating m-1"
          style="background-color: #333333;"
          href="#!"
          role="button"
          ><i class="fab fa-github"></i
        ></a>
      </section>
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->
  
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  
       <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
       <script src="{{url('js/like.js')}}"></script>
        
       <script>
         var url = "{{ route('like') }}";
         var token = "{{ Session::token() }}";
         var urld = "{{ route('dislike') }}";
         var token = "{{ Session::token() }}";
         
       </script>
</body>
</html>