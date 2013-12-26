<fieldset class="split">
    <p>
        {{ Form::label('type') }}
        {{ Form::select('type', array('post' => 'post', 'page' => 'page')) }}
    </p>
    <p>
        {{ Form::label('field') }}
        {{ Form::select('field', array('text' => 'text', 'html' => 'html', 'image' => 'image', 'file' => 'file')) }}
    </p>
    <p>
        {{ Form::label('key', 'Unique Key') }}
        {{ Form::text('key') }}
    </p>
    <p>
        {{ Form::label('label') }}
        {{ Form::textarea('label') }}
    </p>
    <p class="hide attributes_type">
        {{ Form::label('attributes[type]', 'File types') }}
        {{ Form::text('attributes[type]') }}
    </p>
    <p class="hide attributes_width">
        {{ Form::label('attributes[size][width]', 'Image max width') }}
        {{ Form::text('attributes[size][width]') }}
    </p>
    <p class="hide attributes_height">
        {{ Form::label('attributes[size][height]', 'Image max height') }}
        {{ Form::text('attributes[size][height]') }}
    </p>
</fieldset>
