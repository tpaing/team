@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Teams</div>

                <div class="card-body">
                 	@if($teams->count())
                        @foreach($teams as $team)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('teams.show', $team->id) }}">{{ $team->name }}</a>
                            @if($team->OwnByCurrentUser())
                              <span class="badge badge-primary badge-pill">Admin</span>
                            @endif
                        </li>
                        @endforeach
                    @else
                        <p class="mb-0">You are not part of any team</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Create a Team</div>

                <div class="card-body">
                 	<form action="{{ route('teams.store') }}" method="POST">
                 		@csrf
                 		<div class="form-group">
                 			<label for="name">Team Name</label>
                 			<input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name">
                 			@if($errors->has('name'))
                 				<span class="invalid-feedback">
                 					<strong>{{ $errors->first('name') }}</strong>
                 				</span>
                 			@endif
                 		</div>

                 		<button type="submit" class="btn btn-primary">Create Team</button>
                 	</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
