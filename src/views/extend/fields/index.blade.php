@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Custom Fields</h1>
        <nav>
            {{ link_to_route('admin.extend.fields.create', 'Create a new field', null, array('class' => 'btn')) }}
        </nav>
    </hgroup>
    <section class="wrap">
        <ul class="list">
        @foreach($fields as $field)
            <li>
                <a href="{{ route('admin.extend.fields.edit', $field->id) }}">
                    <strong>{{ $field->label }}</strong>
                    <span>{{ $field->type }} {{ $field->field }}</span>
                </a>
            </li>
        @endforeach
        </ul>
    </section>
@stop
