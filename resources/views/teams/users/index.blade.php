@extends('layouts.team')

@section('teamcontent')
    <div class="row justify-content-center">
        <div class="col-md-3">
                @include('teams.partials._nav')
        </div>
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">
                    Users
                </div>
                <div class="card-body">

                    @include('teams.subscriptions.partials._usage')
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Joined</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($team->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if($team->OwnBy($user))
                                            <span class="badge badge-primary badge-pill">Admin</span>
                                        @else
                                            <span class="badge badge-secondary badge-pill">Member</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                    <td>
                                        @permission(['delete users','change user roles'], $team->id)
                                        <div class="d-flex">
                                            <div class="dropdown mr-1">
                                                <a 
                                                    href="" 
                                                    class="dropdown-toggle"
                                                    data-toggle="dropdown"
                                                >
                                                    Actions
                                                </a>

                                                <div class="dropdown-menu">
                                                    @permission('delete users', $team->id)
                                                    @if(!$user->isOnlyAdminInTeam($team))
                                                    <a 
                                                        href="{{ route('teams.users.delete', [$team, $user]) }}"
                                                        class="dropdown-item" 
                                                    >
                                                        Delete
                                                    </a>
                                                    @endif
                                                    @endpermission

                                                    @permission('change user roles', $team->id)

                                                    <a 
                                                        href="{{ route('teams.users.roles.edit', [$team, $user]) }}"
                                                        class="dropdown-item" 
                                                    >
                                                        Change role
                                                    </a>
                                                    @endpermission
                                                </div>
                                            </div>
                                        </div>
                                        @endpermission
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                @permission('add users', $team->id)

                    <div class="card">
                        <div class="card-header">Add a user</div>

                        <div class="card-body">
                            @if($team->hasReachedLimit())
                                <p>
                                    <a href="{{ route('teams.subscriptions.index', $team) }}">Upgrade</a> to add more users.
                                </p>
                            @else
                            <form action="{{ route('teams.users.store', $team) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email">
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Add User</button>
                            </form>
                            @endif
                        </div>
                    </div>
                @endpermission
        </div>
    </div>
@endsection
