@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Editing "{{ $category->title }}"</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::model($category, array('method' => 'PUT', 'route' => array('admin.categories.update', $category->id)))}}
        @include('core::categories/partials/_form')
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
            {{ link_to_route('admin.categories.delete', 'Delete', array($category->id), array('class' => 'btn delete red')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
