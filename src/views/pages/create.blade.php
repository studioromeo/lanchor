@extends('core::layouts.master')

@section('content')
    {{ Form::open(array('route' => 'admin.pages.store'))}}
        @include('core::pages/partials/_form');
    {{ Form::close(); }}
@stop
