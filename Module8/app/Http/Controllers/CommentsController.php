<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $name = Auth::user();
        $this->validate($request, array(
            'design'     =>  'required',
            'engine'   =>  'required',
            'comfort'   =>  'required',
            'fuel'   =>  'required',
            'costperformance'   =>  'required',
            'satisfaction'   =>  'required',
            'comment'   =>  'required',
            ));
        $post = Post::find($post_id);
        $comment = new Comment();
        $comment->name = $name["name"];
        $comment->design = $request->design;
        $comment->engine = $request->engine;
        $comment->comfort = $request->comfort;
        $comment->fuel = $request->fuel;
        $comment->costperformance = $request->costperformance;
        $comment->satisfaction = $request->satisfaction;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);
        $comment->save();
        Session::flash('success', 'Comment was added');
        return redirect()->route('posts.show', $comment->post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
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
        $name = Auth::user();
        $comment = Comment::find($id);
        $this->validate($request, array('comment' => 'required'));
        
        
        $comment->name = $name["name"];
        $comment->design = $request->design;
        $comment->engine = $request->engine;
        $comment->comfort = $request->comfort;
        $comment->fuel = $request->fuel;
        $comment->costperformance = $request->costperformance;
        $comment->satisfaction = $request->satisfaction;
        $comment->comment = $request->comment;
        $comment->approved = true;
        
        
        
        
        $comment->save();
        Session::flash('success', 'Comment updated');
        return redirect()->route('posts.show', $comment->post->id);
    }

    
    
    
    
    
    public function delete($id)
    {
        $comment = Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();
        Session::flash('success', 'Deleted Comment');
        return redirect()->route('posts.show', $post_id);
    }
}
