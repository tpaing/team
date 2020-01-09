@extends('layouts.team')

@section('teamcontent')
    <div class="row justify-content-center">
        <div class="col-md-3">
                @include('teams.partials._nav')
        </div>
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">
                    Roles
                </div>
                <div class="card-body">
                    @if($user->isOnlyAdminInTeam($team)) 
                        <p class="mb-0">
                            <strong>
                                {{ $user->name }} is only admin left in your team. Assign the admin role to another user first.
                            </strong>
                        </p>
                    @else
                        <form action="{{ route('teams.users.roles.update', [$team, $user]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <select name="role" id="role" class="form-control">
                                    @foreach($roles as $role => $data)
                                    <option 
                                        value="{{ $role }}"
                                        {{$user->hasRole($role) ? 'selected' : ''}}
                                    >
                                        {{$data['name']}}
                                    </option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
