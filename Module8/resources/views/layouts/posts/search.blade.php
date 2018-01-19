  
  @extends('layouts.master')

@section('title','| Gallery')

@section('content')
  
  <br><br><br>
  
  <h2>Search the Motor name</h2><hr>
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

      
        
        @stop