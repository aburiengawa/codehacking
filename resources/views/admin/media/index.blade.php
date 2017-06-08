@extends('layouts.admin')
@section('content')
<h1>Media</h1>
<form method="post" action="delete/media" class="form-inline">
{{csrf_field()}}
	<div class="form-group">
		<select name="checkboxArray" class="form-control">
			<option value="">Delete</option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" name="delete_all" class="btn-primary">
	</div>
	<table class="table">
		<thead>
			<tr>
				<th><input type="checkbox" id="options"></th>
				<th>ID</th>
				<th>Name</th>
				<th>Created</th>
			</tr>
		</thead>
		<tbody>
			@foreach($photos as $photo)
			<tr>
				<td><input class="checkboxes" type="checkbox" name="checkboxArray[]" value="{{$photo->id}}"></td>
				<td>{{$photo->id}}</td>
				<td><img height="100" src="{{$photo->file}}" alt=""></td>
				<td>{{$photo->created_at ? $photo->created_at : "No date"}}</td>
				<td>
					<input type="hidden" name="photo" value="{{$photo->id}}">
					<div class="form-group">
						<input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
					</div>
{{-- 					{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}
					
						<div class="form-group">
							{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
						</div>
					
					{!! Form::close() !!} --}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</form>

@stop

@section('scripts')
<script>
	$(document).ready(function(){
		$('#options').click(function(){
			if(this.checked){
				$('.checkboxes').each(function(){
					this.checked = true;
				});
			} else {
				$('.checkboxes').each(function(){
					this.checked = false;
				});
			}
		});
	});
</script>
@stop