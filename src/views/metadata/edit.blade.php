@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Editing variable "{{ $meta->key() }}"</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::model($meta, array('method' => 'PUT', 'route' => array('admin.extend.variables.update', $meta->key)))}}
        <fieldset class="split">
            <p>
                {{ Form::label('key', 'Name') }}
                {{ Form::text('key', $meta->key()) }}
            </p>
            <p>
                {{ Form::label('value') }}
                {{ Form::textarea('value') }}
            </p>
        </fieldset>
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
            {{ link_to_route('admin.extend.metadata.delete', 'Delete', array($meta->key), array('class' => 'btn delete red')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
