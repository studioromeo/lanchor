@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Editing {{ $user->username }}'s Profile</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::model($user, array('method' => 'PUT', 'route' => array('admin.users.update', $user->id)))}}

        @include('core::users/partials/_form')

        <aside class="buttons">
            {{ Form::button('Create', array('class' => 'btn', 'type' => 'submit')) }}
            {{ link_to_route('admin.users.delete', 'Delete', array($user->id), array('class' => 'btn delete red')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
