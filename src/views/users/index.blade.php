@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Users</h1>
        <nav>
            {{ link_to_route('admin.users.create', 'Create a new user', null, array('class' => 'btn')) }}
        </nav>
    </hgroup>
    <section class="wrap">
        <ul class="list">
        @foreach($users as $user)
            <li>
                <a href="{{ route('admin.users.edit', $user->id) }}">
                    <strong>{{ $user->real_name }}</strong>
                    <span>Username: {{ $user->username }}</span>
                </a>
            </li>
        @endforeach
        </ul>
    </section>
@stop
