@extends('core::layouts.master')

@section('content')
    <hgroup class="wrap">
        <h1>Editing comment</h1>
    </hgroup>
    <section class="wrap">
    {{ Form::model($comment, array('method' => 'PUT', 'route' => array('admin.comments.update', $comment->id)))}}

        <fieldset class="split">
            <p>
                {{ Form::label('name'); }}
                {{ Form::text('name'); }}
            </p>
            <p>
                {{ Form::label('email'); }}
                {{ Form::text('email'); }}
            </p>
            <p>
                {{ Form::label('text', 'Comment'); }}
                {{ Form::textarea('text'); }}
            </p>
            <p>
                {{ Form::label('status'); }}
                {{ Form::select('status', array( 'approved' => 'Approved', 'pending' => 'Pending', 'spam' => 'Spam')); }}
            </p>
        </fieldset>


        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
            {{ link_to_route('admin.comments.delete', 'Delete', array($comment->id), array('class' => 'btn delete red')) }}
        </aside>
    {{ Form::close(); }}
    </section>
@stop
