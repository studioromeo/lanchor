@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Extend</h1>
    </hgroup>
    <section class="wrap">
        <ul class="list">
            <li>
                <a href="#">
                    <strong>Custom Fields</strong>
                    <span>Create additional fields</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.extend.variables.index') }}">
                    <strong>Site Variables</strong>
                    <span>Create additional metadata</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.extend.metadata.show') }}">
                    <strong>Site Metadata</strong>
                    <span>Manage your site data</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <strong>Plugins</strong>
                    <span>Coming soon, yo!</span>
                </a>
            </li>
        </ul>
    </section>
@stop
