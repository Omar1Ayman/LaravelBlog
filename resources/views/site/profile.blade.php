@extends('base')

@section('content')
  <!--Start Body-->
            

        <div class="col-md-8">
            <div class="d-flex justify-content-end">
                <h2>posts: {{ count($user->post) }}</h2>
            </div>
            @foreach ($user->post as $post)
            <div class="my-3 border-top">
                   <div class="d-flex justify-content-end pt-3">
                   

                    <!-- Button trigger modal -->
  <button type="button" class="btn btn-light" data-toggle="modal" data-target="#u{{$post->id}}">
    <i class="far fa-edit"></i>
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="u{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update posts</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ url("post/{$post->id}/update") }}">
            @csrf
             <div class="form-group">
                 <label for="name">name</label>
               <input type="text" id="name" class="form-control" name="title" value="{{ $post->title }}">
             </div>
             <div class="form-group">
                 <label for="body">body</label>
                <input type="text" id="body" class="form-control" name="body" value="{{ $post->body }}">
              </div>
             <div class="modal-footer">
              <input type="submit" value="update" class="btn btn-primary">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
             
          </form>
        </div>
       
      </div>
    </div>
</div>


                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#o{{$post->id}}">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                      
                      <!-- Modal -->
                      <div class="modal fade" id="o{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delet Post</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are You Shure  You Want To Delete <b class="text-red text-bold text-uppercase"> ({{$post->title}})</b>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <a href="{{url("post/{$post->id}/delete")}}" class="btn btn-danger mr-3">Delete</a>
                            </div>
                          </div>
                        </div>
                    </div>
                   </div>
                    <div class="card-title">
                        <a href="#" class="text-warning">
                        <h6>{{ $user->name }}</h6>
                        </a>  
                        <img src="../uploads/{{ $user->image }}" width="50px" alt="image authr"><br>
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

            <div class="border-top">
               <h6>Comments:</h6>
       
              @foreach ($post->comment as $com)
               ( {{$com->user->name}} ) 
               <small class="text-muted">Posted on: {{carbon\carbon::parse($com->created_at)->format('d  M ,Y')}}</small>
                <p>{{ $com->content }}</p>                
                @endforeach
          </div>
            
            
        @endforeach

           

      
        </div>

        
    




        


        
      </div>
    </div>
  </section>
<!--End Body-->
    
@endsection