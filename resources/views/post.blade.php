@extends('layouts.blog-post')
@section('content')

<!-- Blog Post -->

<!-- Title -->
<h1>{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{$post->photo->file}}" alt="">

<hr>

<!-- Post Content -->
<p>{{$post->body}}</p>

<hr>

<!-- Blog Comments -->

@if(Session::has('comment_message'))
{{session('comment_message')}}
@endif

@if(Session::has('reply_message'))
{{session('reply_message')}}
@endif

@if(Auth::check())

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
	{!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
	
		<input type="hidden" name="post_id" value="{{$post->id}}">
		<div class="form-group">
			{!! Form::label('body', 'Comment:') !!}
			{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
		</div>
	
		<div class="form-group">
			{!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
		</div>
	
	{!! Form::close() !!}
</div>

@endif

<hr>

<!-- Posted Comments -->

@if(count($comments) > 0)

@foreach($comments as $comment)

<!-- Comment -->
<div class="media">
    <a class="pull-left" href="#">
{{--         <img height="64" class="media-object" src="{{$comment->photo ? $comment->photo->file : 'http://placehold.it/64x64'}}" alt=""> --}}
<img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{$comment->author}}
            <small>{{$comment->created_at->diffForHumans()}}</small>
        </h4>
        <p>{{$comment->body}}</p>

        
                
            <!-- Nested Comment -->
            <div id="nested-comment" class="media">

                @if(count($comment->replies) > 0)
                    @foreach($comment->replies as $reply)

                        @if($reply->is_active == 1)
                            <a class="pull-left" href="#">
                                <img height="64" class="media-object" src="{{$reply->photo->file}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$reply->author}}
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                </h4>
                                <p>{{$reply->body}}</p>
                            </div>
                        @endif
                    @endforeach
                @endif

                <div class="comment-reply-container">
                    
                    <div class="comment-reply col-sm-6">
                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                    
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">    

                        <div class="form-group">
                            {!! Form::label('body', 'Reply:') !!}
                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                        </div>
                    
                        <div class="form-group">
                            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                        </div>
                    
                    {!! Form::close() !!}
                    </div>
                </div>
            <!-- End Nested Comment -->
            </div>

    <button class="reply-field-toggle btn btn-primary pull-right">Reply</button>
    </div>
</div>

@endforeach

@endif

@stop

@section('scripts')
<script>
    $(".reply-field-toggle").click(function(){
        $(".comment-reply-container").slideToggle("slow");
        $(".reply-field-toggle").slideToggle("fast");
    });
</script>
@stop