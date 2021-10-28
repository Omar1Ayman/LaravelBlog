@extends('base')

@section('content')
  <!--Start Body-->
  
        <div class="col-md-8">
          
        <div class="card-body text-center bg-white">
          <h2 class="card-header">All Users</h2>
        </div>

         <table class="table table-hover">
           <thead class="thead-dark">
             <tr>
               <th>#</th>
               <th>Name</th>
               <th>Emil</th>
               <th>Admin</th>
               <th>Supervisor</th>
               <th>User</th>
             </tr>
           </thead>
           <tbody>
             @php
               $counter = 0;
             @endphp
             @foreach ($users as $user)
             <form method="POST" action="{{ url("/add-role") }}">
              @csrf
              <input type="hidden" name="email" value="{{ $user->email }}">
               <tr>
                 <td>{{ ++$counter }}</td>
                 <td>{{ $user->name }}</td>
                 <td>{{ $user->email }}</td>
                 <td>
                    <input type="checkbox" name="r_admin" onchange="this.form.submit()" {{ 
                        $user->hasRole('admin') ? 'checked' : ''
                      }}>
                 </td>
                 <td>
                    <input type="checkbox" name="r_visor" onchange="this.form.submit()" {{ 
                      $user->hasRole('supervisor') ? 'checked' : ''
                    }}>
                 </td>
                 <td>
                    <input type="checkbox"  name="r_user" onchange="this.form.submit()" {{ 
                      $user->hasRole('User') ? 'checked' : ''
                    }}>
                 </td>
                </tr>
              </form> 
             @endforeach
             
           </tbody>
         </table>

     <div class="d-flex justify-content-end mt-5 mb-2">
                    <!-- Button trigger modal -->
                   
        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i>
        </button>
        <h5>add category</h5>

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
                  @if ($errors->any())
                    @foreach ($errors->all() as $err)
                      <p>{{ $err }}</p>
                    @endforeach
                  @endif
                  <form method="POST" action="{{ url("category/add") }}">
                    @csrf
                    <div class="form-group">
                      <label>category name</label>
                      <input type="text" class="form-control" name="name">
                    </div>
                    <div class="modal-footer">
                      <input type="submit" value="add" class="btn btn-primary">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                  </form>
                </div>
                
              </div>
            </div>
          </div>
    </div>
      <table class="table">
         <thead class="thead-dark">
          
            <tr>
              <th>#</th>
              <th class="text-center">name</th>
              <th class="text-center">control</th>
            </tr>
         </thead>
         <tbody>
          @php
          $count = 0;
          @endphp
           @foreach ($cats as $cat)
           <tr>
            <td>{{ ++$count }}</td>
            <td class="text-center">{{ $cat->name }}</td>
            <td class="text-center">
                          <!-- Button trigger modal -->
<!-- Button trigger modal -->
    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#o{{$cat->id}}">
      <i class="fas fa-trash-alt"></i>
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="o{{$cat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delet Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are You Shure  You Want To Delete <b class="text-red text-bold text-uppercase"> ({{$cat->name}})</b>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{url("category/{$cat->id}/delete")}}" class="btn btn-danger mr-3">Delete</a>
          </div>
        </div>
      </div>
  </div>
              
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-light" data-toggle="modal" data-target="#u{{$cat->id}}">
    <i class="far fa-edit"></i>
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="u{{$cat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ url("category/{$cat->id}/update") }}">
            @csrf
             <div class="form-group">
               <input type="text" class="form-control" name="name" value="{{ $cat->name }}">
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
                           
                  
            </td>
          </tr>
           @endforeach
         </tbody>
      </table>
         

        </div>
    




        


        
      </div>
    </div>
  </section>
<!--End Body-->
    
@endsection