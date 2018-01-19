
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $post = Post::like('title', '%$request')->get();
        
        return view('posts.result')->withPosts($posts);
    
        
    }
}
