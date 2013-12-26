@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Editing field "{{ $field->label }}"</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::model($field, array('method' => 'PUT', 'route' => array('admin.extend.fields.update', $field->id)))}}
        @include('core::extend/fields/partials/_form')
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
            {{ link_to_route('admin.extend.fields.delete', 'Delete', array($field->id), array('class' => 'btn delete red')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
