@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Site Metadata</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::open(array('route' => 'admin.extend.variables.store'))}}
        <fieldset class="split">
            <p>
                {{ Form::label('sitename', 'Site Name') }}
                {{ Form::text('sitename', $meta['sitename']) }}
            </p>
            <p>
                {{ Form::label('description', 'Site Description') }}
                {{ Form::textarea('description', $meta['description']) }}
            </p>
            <p>
                {{ Form::label('posts_per_page') }}
                {{ Form::input('range', 'posts_per_page', $meta['posts_per_page'], array('min' => 1, 'max' => 15)) }}
            </p>
        </fieldset>
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
