@extends('base')

@section('content')
  <!--Start Body-->
  
        <div class="col-md-8">
          

                @foreach ($posts as $post)
                    <div class="mb-3 border-bottom">
                  
                            <div class="card-title">
                                <a href="#" class="text-warning">
                                <h6>{{ $post->user->name }}</h6>
                                </a>  
                                <img src="../uploads/{{ $post->user->image }}" width="50px" alt="image authr"><br>
                                <small class="text-muted">Posted on: {{carbon\carbon::parse($post->created_at)->format('d  M ,Y')}}</small>
                                
                                <h3 class="text-dark"><a href="{{ url("post/{$post->id}") }}">{{ $post->title }}</a></h3>
                            </div>
                            <div class="card-text">
                                <p class="text-dark">
                                    {{ $post->body }}
                                    {{ $post->cat_id }}
                                </p>
                            </div>
                      
                    </div>
                @endforeach
      
        
            @if ($errors->any())
              <ul>
                 @foreach ($errors->all() as $er)
                   <li class="m-2">{{ $er }}</li>
                 @endforeach
              </ul>
            @endif
             @if (Auth::check())
             
                <div class="mb-3 d-flex justify-content-end">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    add post
                  </button>
        
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="{{ url("category/{$cat->id}/post/store") }}">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                    <input type="text" name="user_id" value="
                                    @if (Auth::check())
                                        {{ Auth::user()->id }}
                                    @endif
                                    " hidden id="title" class="form-control">
                                </div>
                                <div class="form-group">
                                <label for="body">Body:</label>
                                <input type="text" name="body" id="body" class="form-control">
                                </div>
                                <input type="submit" value="add post" class="btn btn-primary">
                              </form>
                                  @else
                              <a href="{{ url('/register') }}">if you want make posts you have to register</a>
                              @endif

                        
                          </div>
                      




                          


                          
                        </div>
                      </div>
</section>
<!--End Body-->
    
@endsection