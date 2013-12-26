@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Create a new field</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::open(array('route' => 'admin.extend.fields.store'))}}
        @include('core::extend/fields/partials/_form')
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
