@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Site Variables</h1>
        <nav>
            {{ link_to_route('admin.extend.variables.create', 'Create a new variable', null, array('class' => 'btn')) }}
        </nav>
    </hgroup>
    <section class="wrap">
        <ul class="list">
        @foreach($metadata as $meta)
            <li>
                <a href="{{ route('admin.extend.variables.edit', $meta->key) }}">
                    <strong>{{ $meta->key() }}</strong>
                    <span>{{ $meta->value }}</span>
                </a>
            </li>
        @endforeach
        </ul>
    </section>
@stop
