@extends('core::layouts.master')

@section('content')
    {{ Form::model($page, array('method' => 'PUT', 'route' => array('admin.pages.update', $page->id))) }}
        @include('core::pages/partials/_form')
    {{ Form::close() }}
@stop
