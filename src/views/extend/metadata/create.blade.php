@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Create a new variable</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::open(array('route' => 'admin.extend.variables.store'))}}
        <fieldset class="split">
            <p>
                {{ Form::label('key', 'Name') }}
                {{ Form::text('key') }}
            </p>
            <p>
                {{ Form::label('value') }}
                {{ Form::textarea('value') }}
            </p>
        </fieldset>
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
