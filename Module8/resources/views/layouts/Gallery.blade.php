@extends('layouts.master')

@section('title','| Gallery')

@section('content')
    
   <br><br><br>
    <div class="row">
        <div class="col-md-10">
            <h2>Gallery</h2>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-12">
            <table class="table" width="100%">
                <tbody>
                    <?php $i=0; ?>
                    @foreach ($posts as $post)
                    
                        
                            <td width="30%"> <img src="{{ asset('img/' . $post->img) }}" width="300" hight="240">
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<a href="{{route('posts.show',$post->id) }}" class="btn btn-default">{{ $post->title }}</a></td>
                            <?php
                                $i++;
                                if($i%3===0){
                                echo '<tr>';
                                }
                            ?>
                            
                        
                    @endforeach
                    
                    
                </tbody>    
                
            </table>
        </div>
    </div>
    
@stop