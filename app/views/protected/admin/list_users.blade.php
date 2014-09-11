@extends('layouts.bootstrap.admin')

@section('title', 'List Users')

@section('content')

	<h2>Registered Users</h2>
	<p>Here you would normally search for users but since this is just a demo, I'm listing all of them.</p>

	@if (Session::has('flash_message'))
		<div class="form-group">
			<p style="padding: 5px" class="bg-success">{{ Session::get('flash_message') }}</p>
		</div>
	@endif

	<table class="table table-striped table-bordered table-hover">
		<thead>
	        <tr>
	          <th>id</th>
	          <th>Email</th>
	          <th>First Name</th>
	          <th>Last Name</th>
	          <th>Status</th>
	          <th>Actions</th>
	        </tr>
      	</thead>

      	<tbody>
      		@foreach ($users as $user)
      		<tr>
	      		<td>{{ $user->id }}</td>
		        <td>
		        	{{ link_to_route('admin.profiles.show', $user->email, $user->id) }}<br>
			        @if ($user->inGroup($admin))
			        	<span class="label label-success">{{ 'Admin' }}</span>
			        @endif
		        </td>
		        <td>{{ $user->first_name }}</td>
		        <td>{{ $user->last_name }}</td>
		        <td>
			        @if ($user->isBanned())
			        	<span class="label label-danger">Banned</span>
			        @else
			        	<span class="label label-success">Clean</span>
			        @endif
	        	</td>
	        	<td>
			        @if ($user->isBanned())
			        	{{ link_to_route('admin.profiles.unban', 'unban user', $user->id) }}
			        @else
			        	{{ link_to_route('admin.profiles.ban', 'ban user', $user->id) }}
			        @endif

			        &nbsp;|&nbsp;

			        {{ Form::open(array('route' => array('admin.profiles.destroy', $user->id), 'method' => 'delete')) }}
			        	<button type="submit" href="{{ URL::route('admin.profiles.destroy', $user->id) }}">Delete</button>
					{{ Form::close() }}
	        	</td>
		     </tr>
			@endforeach

      	</tbody>
	</table>

@stop