@extends('layouts.admin')
@section('content')
<h1>Media</h1>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Created</th>
		</tr>
	</thead>
	<tbody>
		@foreach($photos as $photo)
		<tr>
			<td>{{$photo->id}}</td>
			<td><img height="100" src="{{$photo->file}}" alt=""></td>
			<td>{{$photo->created_at ? $photo->created_at : "No date"}}</td>
			<td>
				{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}
				
					<div class="form-group">
						{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
					</div>
				
				{!! Form::close() !!}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop