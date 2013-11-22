@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Posts</h1>
        <nav>
            {{ link_to_route('admin.posts.create', 'Create a new post', null, array('class' => 'btn')) }}
        </nav>
    </hgroup>
    <section class="wrap">
        <nav class="sidebar">
            {{ link_to_route('admin.posts.index', 'All Categories') }}
            @foreach($categories as $category)
                {{ link_to_route('admin.posts.filter.category', $category->title, $category->slug) }}
            @endforeach
        </nav>
        <ul class="main list">
        @foreach($posts as $post)
            <li>
                <a href="{{ route('admin.posts.edit', $post->id) }}">
                    <strong>{{ $post->title }}</strong>
                    <span>
                        <time>{{ $post->updated_at->diffForHumans() }}</time>
                        <em class="status {{ $post->status }}" title="{{ $post->status }}">{{ $post->status }}</em>
                    </span>
                    <p>{{ $post->description }}</p>
                </a>
            </li>
        @endforeach
        </ul>
    </section>
@stop
