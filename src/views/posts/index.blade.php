@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>@lang('core::posts.posts')</h1>
        <nav>
            {{ link_to_route('admin.posts.create', Lang::get('core::posts.create_post'), null, array('class' => 'btn')) }}
        </nav>
    </hgroup>
    <section class="wrap">
        @if(Session::has('message'))
            <div class="notifications">
                <p class="success">@lang(Session::get('message'))</p>
            </div>
        @endif

        <nav class="sidebar">
            {{ link_to_route('admin.posts.index', Lang::get('core::posts.all.cats'), null, array('class' => Request::is('admin/posts') ? 'active' : '')) }}
            @foreach($categories as $category)
                {{ link_to_route('admin.posts.filter.category', $category->title, $category->slug, array('class' => Request::is('admin/posts/category/' . $category->slug) ? 'active' : '')) }}
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
        {{ $posts->links('core::pagination/admin') }}
    </section>
@stop
