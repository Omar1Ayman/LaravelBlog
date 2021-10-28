<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showpostincat($id){
        $cat = Category::findOrfail($id);
        #$posts = $cat->post;
        $posts = Post::where('cat_id',$id)->get()->reverse();
        #dd($cat);
        return view('site.cat_post' , compact('posts' , 'cat'));
    }
}
