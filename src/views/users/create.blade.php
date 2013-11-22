@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Add a new user</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::open(array('route' => 'admin.users.store'))}}

        @include('core::users/partials/_form')

        <aside class="buttons">
            {{ Form::button('Create', array('class' => 'btn', 'type' => 'submit')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
