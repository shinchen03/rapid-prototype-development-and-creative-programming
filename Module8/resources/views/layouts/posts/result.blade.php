  
@extends('layouts.master')

@section('title','| search')

@section('content')
  
  <br><br><br>
  <div class="panel panel-default">
        
        
        {!! Form::open(['method'=>'GET','url'=>'result','class'=>'navbar-form navbar-left','role'=>'search'])  !!}

    <div class="input-group custom-search-form">
    <input type="text" class="form-control" name="search" placeholder="Search...">
    <span class="input-group-btn">
        <button class="btn btn-default-sm" type="submit">
            <i class="fa fa-search">search</i>
        </button>
    </span>
</div>
{!! Form::close() !!}






<hr>
<h2>result:</h2>

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