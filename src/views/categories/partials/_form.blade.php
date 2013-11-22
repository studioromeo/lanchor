<fieldset class="split">
    <p>
        {{ Form::label('title'); }}
        {{ Form::text('title'); }}
    </p>
    <p>
        {{ Form::label('slug'); }}
        {{ Form::text('slug'); }}
    </p>
    <p>
        {{ Form::label('description'); }}
        {{ Form::textarea('description'); }}
    </p>
</fieldset>
