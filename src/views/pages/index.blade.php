@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Pages</h1>
        <nav>
            {{ link_to_route('admin.pages.create', 'Create a new page', null, array('class' => 'btn')) }}
        </nav>
    </hgroup>
    <section class="wrap">
        <nav class="sidebar statuses">

            <a href="{{ route('admin.pages.index')}}"{{ (!Request::is('admin/pages')) ?: ' class="active"' }}>
                <span class="icon"></span>
                All
            </a>

            <a href="{{ route('admin.pages.filter.status', array('published'))}}"{{ (!Request::is('admin/pages/status/published*')) ?: ' class="active"' }}>
                <span class="icon"></span>
                Published
            </a>

            <a href="{{ route('admin.pages.filter.status', array('draft'))}}"{{ (!Request::is('admin/pages/status/draft*')) ?: ' class="active"' }}>
                <span class="icon"></span>
                Draft
            </a>

            <a href="{{ route('admin.pages.filter.status', array('archived'))}}"{{ (!Request::is('admin/pages/status/archived*')) ?: ' class="active"' }}>
                <span class="icon"></span>
                Archived
            </a>

        </nav>
        <ul class="main list">
        @foreach($pages as $page)
            <li>
                <a href="{{ route('admin.pages.edit', $page->id) }}">
                    <strong>{{ $page->name }}</strong>
                    <span>
                        {{ $page->slug }}
                        <em class="status {{ $page->status }}" title="{{ $page->status }}">{{ $page->status }}</em>
                    </span>
                </a>
            </li>
        @endforeach
        </ul>

        {{ $pages->links('core::pagination/admin') }}
    </section>
@stop
