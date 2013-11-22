@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Categories</h1>
        <nav>
            {{ link_to_route('admin.categories.create', 'Create a new category', null, array('class' => 'btn')) }}
        </nav>
    </hgroup>
    <section class="wrap">
        <ul class="list">
        @foreach($categories as $category)
            <li>
                <a href="{{ route('admin.categories.edit', $category->id) }}">
                    <strong>{{ $category->title }}</strong>
                    <span>{{ $category->slug }}</span>
                </a>
            </li>
        @endforeach
        </ul>
    </section>
@stop
