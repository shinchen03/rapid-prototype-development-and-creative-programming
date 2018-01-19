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
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->withPosts($posts);
    
        
    }
    
    
    
        public function gallery()
    {
        $posts = Post::all();
        return view('Gallery')->withPosts($posts);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, array(
            'title' => 'required | max:225',
            'body' => 'required',
            'price' => 'required',
            'brand' => 'required'
                                        ));
        $post = new Post;
        $post ->title = $request -> title;
        $post ->body = $request -> body;
        $post ->price = $request -> price;
        $post ->brand = $request -> brand;
        
        $post ->save();
        
        //$request -> session()->flash('success', 'successfully save!');
        Session::flash('success', 'successfully save!');
        

        return redirect()->route('posts.show', $post->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, array(
            'title' => 'required | max:225',
            'body' => 'required',
            'price' => 'required',
            'brand' => 'required'));
         
         $post = Post::find($id);
         
         $post->title = $request ->input('title');
         $post->brand = $request ->input('brand');
         $post->price = $request ->input('price');
         $post->body = $request ->input('body');
         
         $post->save();
         
         Session::flash('success', 'This post was successfully saved!');
         
         return redirect()->route('posts.show', $post->$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $post = Post::find($id);
         $post -> delete();
         Session::flash('success', 'The Motor has been deleted');
         return redirect()->route('posts.index');

    }
    
        public function search()
    {
        $search = \Request::get('search');
        $posts = Post::where('title', 'like','%'.$search.'%')->get();
        
        return view('posts.result')->withPosts($posts);
    
        
    }
    
    
    
    
    
    
}
