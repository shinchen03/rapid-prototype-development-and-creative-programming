@extends('layouts.master')

@section('title', '|All Motors')
    
@section('content')
    
        <br><br><br>
    <div class="row">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
    
        <div class="col-md-12">
            {{ Form::label('title','Title:')}}
            {{ Form::text('title', null, ["class" => 'form-control input-lg']) }}
            {{ Form::label('brand','Brand:', ["class" =>'form-spacing-top'])}}
            {{ Form::text('brand', null, ["class" => 'form-control']) }}
            {{ Form::label('price','Price:', ["class" =>'form-spacing-top'])}}
            {{ Form::text('price', null, ["class" => 'form-control']) }}
            {{ Form::label('body','Body:', ["class" =>'form-spacing-top'])}}
            {{ Form::textarea('body',null, ["class" => 'form-control']) }}
        </div>
            <div class="col-md-8">
                <div class="well">
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-danger btn-block')) !!}
                            
                        </div>
                        <div class="col-sm-6">
                            {{ Form::submit('Save',['class'=>'btn btn-success btn-block']) }}

                        </div>
                    </div>
                
                </div>
            </div>
            {!! Form::close() !!}
    </div>
    
    
    
    
@stop