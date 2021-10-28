<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Like;
use App\Post;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function addlikes(Request $request){
        dd($request);
        return back();
    }
    public function admin(){
        $users = User::get();
        $cats = Category::get();
        return view('admin.admindasboard' , compact('users' , 'cats'));
    }
    public function add_role(Request $request){
        $user = User::where('email' , $request['email'])->first();
        $user->roles()->detach();
        if($request['r_user']){
            $user->roles()->attach(Role::where('name','user')->first());
        }
        if($request['r_visor']){
            $user->roles()->attach(Role::where('name','supervisor')->first());
        }
        if($request['r_admin']){
            $user->roles()->attach(Role::where('name','admin')->first());
        }

        return redirect()->back();
    }
    public function deleteCategory($id){
        $cat = Category::where('id' , $id);
        $posts = Post::select('name')->where('cat_id' , $id)->count();
         if($posts == 0){
             $cat->delete();
         }
        return back();
    }
    public function addCategory(Request $request){
        $request->validate([
            'name' => 'required|string|'
        ]);

        Category::create([
            'name' =>  $request->name,
            
        ]);

        return back();
    }

    public function updateCategory(Request $request , $id){
        $request->validate([
            'name' => 'required|string|'
        ]);

       $update = Category::findOrFail($id);
       $update->update(['name'=>$request->name]);

        return back();
    }



    public function editor(){
        return view('admin.editordashboard');
    }
    public function posts(){
        $cats = Category::get();
        $posts = Post::get()->reverse();
        return view('site.index' , compact('posts' , 'cats'));
    }

    public function addpost(Request $request){
        $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'required|string|',
        ]);

        Post::create([
            'title' =>  $request->title,
            'body'  =>  $request->body,
            'cat_id' => $request->cat_id,
            'user_id' =>$request->user_id
        ]);

        return back();
    }

    public function post($id){
        $post = Post::findOrFail($id);
        $comment = Comment::where('post_id' , $id)->get();
       
        return view('site.post' , compact('post' , 'comment'));
    }


    public function StorePost(Request $request , $cat_id){
            $request->validate([
                'title' => 'required|string|max:200',
                'body' => 'required|string|min:50',
            ]);

            Post::create([
                'title' =>  $request->title,
                'body'  =>  $request->body,
                'cat_id' => $request->cat_id,
                'user_id' =>$request->user_id
            ]);

            return back();
    }

    public function like(Request $request){
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $user_id = Auth::user()->id;
        $change_like =0;
        $like = DB::table('likes')
                    ->where('post_id',$post_id)
                    ->where('user_id',$user_id)
                    ->first();

        if(!$like){
            $newlike = new Like;
            $newlike->post_id = $post_id;
            $newlike->user_id = $user_id;
            $newlike->like = 1;
            $newlike->save();
            $is_like = 1;
        }
        elseif($like->like == 1){
            DB::table('likes')
                    ->where('post_id',$post_id)
                    ->where('user_id',$user_id)
                    ->delete();
            $is_like = 0;
        }
        elseif($like->like == 0){
            DB::table('likes')
                    ->where('post_id',$post_id)
                    ->where('user_id',$user_id)
                    ->update(['like' => 1 ]);
            $is_like = 1;
            $change_like = 1;
        }
        
        $response = array(
            'is_like' => $is_like,
            'change_like' => $change_like,

        );
       return response()->json($response, 200);
    }


    public function dislike(Request $request){
        $like_s = $request->like_s;
        $post_id = $request->post_id;
        $user_id = Auth::user()->id;
        $change_dislike = 0;
        $dislike = DB::table('likes')
                    ->where('post_id',$post_id)
                    ->where('user_id',$user_id)
                    ->first();

        if(!$dislike){
            $newlike = new Like;
            $newlike->post_id = $post_id;
            $newlike->user_id = $user_id;
            $newlike->like = 0;
            $newlike->save();
            $is_dislike = 1;
        }
        elseif($dislike->like == 0){
            DB::table('likes')
                    ->where('post_id',$post_id)
                    ->where('user_id',$user_id)
                    ->delete();
            $is_dislike = 0;
        }
        elseif($dislike->like == 1){
            DB::table('likes')
                    ->where('post_id',$post_id)
                    ->where('user_id',$user_id)
                    ->update(['like' => 0 ]);
            $is_dislike = 1;
            $change_dislike = 1;
        }
        
        $response = array(
            'is_dislike' => $is_dislike,
            'change_dislike' =>$change_dislike,

        );
       return response()->json($response, 200);
    }


    public function profile($user_id){
        $user = User::findOrFail($user_id);
        return view('site.profile' ,compact('user'));
    }

    public function deletePost($id){
        $post = Post::where('id' , $id);
        $post->delete();
        return back();
    }

    public function updatePost(Request $request , $id){
        $request->validate([
            'title' => 'required|string|max:200',
            'body' => 'required|string|min:50',
        ]);

       $post = Post::findOrFail($id);
       $post->update([
           'title' =>$request->title,
           'body' =>$request->body,
       ]);
        return back();
    }

}
