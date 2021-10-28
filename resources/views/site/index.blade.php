@extends('base')

@section('content')
  <!--Start Body-->
  
        <div class="col-md-8">
         
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
                        <h5 class="modal-title" id="exampleModalLabel">ad post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="{{ url("category/post/store") }}">
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
                          <div class="form-group">
                            <select class="custom-select" name="cat_id">
                              @foreach ($cats as $cat)
                               <option value="{{ $cat->id }}">{{ $cat->name }}</option>           
                              @endforeach
                            </select>
                          </div>
                          <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="add post">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          </form>
                      </div>
                      
                    </div>
                  </div>
                </div>
   
           </div>
          @endif
         
           @foreach ($posts as $post)
             <div class="mb-3 border-bottom">
                
                  <div class="card-title">
                  <a href="#" class="text-warning">
                    <h6>{{ $post->user->name }}</h6>
                  </a>  
                  <img src="uploads/{{ $post->user->image }}" width="50px" alt="image authr"><br>
                  <small class="text-muted">Posted on: {{carbon\carbon::parse($post->created_at)->format('d  M ,Y')}}</small>
                  
                    <h3 class="text-dark"><a href="{{ url("post/{$post->id}") }}">{{ $post->title }}</a></h3>
                </div>
                <div class="card-text">
                    <p class="text-dark">
                        {{ $post->body }}
                    </p>
                </div>
                @php
                $like_count   =   0;
                $dislike_count =   0;
                $like_status = 'btn-secondary';
                $dislike_status = 'btn-secondary';
                @endphp      

                @foreach ($post->likes as $like)

                      
                     @php
                       if($like->like == 1){
                           $like_count++;
                       }
                       if($like->like == 0){
                         $dislike_count++;
                       }

                       if(Auth::check()){
                        if($like->like == 1 && $like->user_id == Auth::user()->id){
                         $like_status ='btn-success';
                       }
                       if($like->like == 0 && $like->user_id == Auth::user()->id){
                         $dislike_status ='btn-danger';
                       }
                       }
                     @endphp
                @endforeach             
              
              <div class="d-flex justify-content-end mb-3">
                <button data-postid="{{ $post->id }}_d" data-dislike="{{ $dislike_status }}" class="btn {{ $dislike_status }} mr-1 dislike"><i class="far fa-thumbs-down"></i>Dislike<b class="dislikeb"> {{ $dislike_count }}</b></button>
                <button data-postid="{{ $post->id }}_l" data-like="{{ $like_status }}" class="btn {{ $like_status }} like"><i class="far fa-thumbs-up"></i>Like<b class="likeb"> {{ $like_count }}</b></button>
              </div>
        
             </div>
           @endforeach
    



      
        </div>

        
    




        


        
      </div>
    </div>
  </section>
<!--End Body-->
    
@endsection