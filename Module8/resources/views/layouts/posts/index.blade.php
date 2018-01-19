@extends('layouts.master')

@section('title', '|All Motors')
    
@section('content')
    <br><br><br>
    <div class="row">
        <div class="col-md-10">
            <h2>All Motors</h2>
        </div>
        @if(Auth::user()["name"]==="root")	
        <div class="col-md-2">
            <a href="{{ route('posts.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create New</a>
        </div>
        @endif    
        <div class="col-md-12">
            <hr>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12">
            <table class="table  table-striped">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Created at</th>
                    <th></th>
                </thead>
                <tbody>
                    
                    
                    @foreach ($posts as $post)
                    
                        <tr>
                            <th>{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->brand }}</td>
                            <td>{{ $post->price }}</td>
                            <td>{{ date('M j, Y',strtotime($post->created_at)) }}</td>
                            <td><a href="{{route('posts.show',$post->id) }}" class="btn btn-default">View</a></td>
                        </tr>
                        
                    @endforeach
                    
                    
                </tbody>    
                
            </table>
        </div>
    </div>
    
@stop