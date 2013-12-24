@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Comments</h1>
    </hgroup>
    <section class="wrap">
        <nav class="sidebar statuses">

            <a href="{{ route('admin.comments.index')}}"{{ (!Request::is('admin/comments')) ?: ' class="active"' }}>
                <span class="icon"></span>
                All
            </a>

            <a href="{{ route('admin.comments.filter.status', array('pending'))}}" class="pending{{ (Request::is('admin/comments/status/pending*')) ? ' active' : '' }}">
                <span class="icon"></span>
                Pending
            </a>

            <a href="{{ route('admin.comments.filter.status', array('approved'))}}" class="approved{{ (Request::is('admin/comments/status/approved*')) ? ' active' : '' }}">
                <span class="icon"></span>
                Approved
            </a>

            <a href="{{ route('admin.comments.filter.status', array('spam'))}}" class="spam{{ (Request::is('admin/comments/status/spam*')) ? ' active' : '' }}">
                <span class="icon"></span>
                Spam
            </a>

        </nav>
        <ul class="main list">
        @foreach($comments as $comment)
            <li>
                <a href="{{ route('admin.comments.edit', $comment->id) }}">
                    <strong>{{ $comment->text }}</strong>
                    <span><time>{{ $comment->date->diffForHumans() }}</time></span>
                    <span class="highlight">{{ $comment->status }}</span>
                </a>
            </li>
        @endforeach
        </ul>
        {{ $comments->links('core::pagination/admin') }}
    </section>
@stop
