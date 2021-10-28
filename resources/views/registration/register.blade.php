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
  
  
    <div class="container mt-3">
       <div class="row d-flex justify-content-center">
         <div class="col-lg-8">
            <div class="card-header bg-white text-center">
                <h3>Register</h3>
            </div>
            <div class="card">
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>    
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ url("/register") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                          <label for="name">name:</label>
                          <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                         <label for="email">Email:</label>
                         <input type="email" name="email" id="email" class="form-control">
                       </div>
                       <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label for="image">choose image:</label>
                        <input type="file" name="image" id="image" class="form-control">
                      </div>
                       <input type="submit" class="btn btn-primary mb-2" value="register"><br>
                       <a href="{{ url("/login") }}">if you have an account you can login from here!</a>
                    </form>
                </div>
            </div>
         </div>
       </div>
    </div>
 


  

       <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
   

</body>
</html>