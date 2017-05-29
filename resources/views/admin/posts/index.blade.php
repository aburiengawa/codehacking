@extends('layouts.admin')
@section('content')
<h1>Posts</h1>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>User</th>
			<th>Category</th>
			<th>Photo</th>
			<th>Title</th>
			<th>Body</th>
			<th></th>
			<th>Post link</th>
			<th>Comments</th>
			<th>Created</th>
			<th>Update</th>
		</tr>
	</thead>
	<tbody>
	@if($posts)
		@foreach($posts as $post)
	
		<tr>
			<td>{{$post->id}}</td>
			<td>{{$post->user->name}}</td>
			<td>{{$post->category_id ? $post->category->name : "Uncategorized"}}</td>
			<td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400'}}" alt=""></td>
			<td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
			<td>{{str_limit($post->body, 30)}}</td>
			<td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
			<td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
			<td>{{$post->created_at->diffForHumans()}}</td>
			<td>{{$post->updated_at->diffForHumans()}}</td>
		</tr>

		@endforeach
	@endif
	</tbody>
</table>
@stop