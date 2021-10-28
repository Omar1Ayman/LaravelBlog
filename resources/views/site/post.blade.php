@extends('base')

@section('content')
  <!--Start Body-->
  
        <div class="col-md-8">
          
 
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
       
        <div>
          
           
         
          <div>
       
              @foreach ($post->comment as $com)
                <small class="text-muted">Posted on: {{carbon\carbon::parse($com->created_at)->format('d  M ,Y')}}</small>
                <p class="border-bottom">{{ $com->content }}</p>                
                @endforeach
          </div>
        
        </div>
         @if (Auth::check())
          <form method="POST" action="{{ url("post/{$post->id}/comment/store") }}">
            @csrf
            <div class="form-group row">
                  <div class="col-lg-9">
                  <input type="text" name="content" id="content" class="form-control mb-2">
                  <input type="text" hidden value="{{ Auth::user()->id}}" name="user_id" id="content" class="form-control">
                  </div>
                  <div class="col-lg-3">
                    <input type="submit" value="add" class="btn btn-primary">
                  </div>
                  
            </div>
          </form>
          @else
           <a href="/register">if you want to comment click here to register</a>
         @endif


        </div>
    




        


        
      </div>
    </div>
  </section>
<!--End Body-->
    
@endsection