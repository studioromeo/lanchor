@extends('core::layouts.master')

@section('content')
    {{ Form::open(array('route' => 'admin.posts.store'))}}
        @include('core::posts/partials/_form');
    {{ Form::close(); }}
@stop
