<fieldset class="header">
    <div class="wrap">
        {{ Form::text('title') }}
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
            @if (isset($post))
                {{ link_to_route('admin.posts.delete', 'Delete', array($post->id), array('class' => 'btn delete red')) }}
            @endif
        </aside>
    </div>
</fieldset>

<fieldset class="main">
    <div class="wrap">
        {{ Form::textarea('html') }}
    </div>
</fieldset>

<fieldset class="meta split">
    <div class="wrap">
        <p>
            {{ Form::label('slug'); }}
            {{ Form::text('slug'); }}
        </p>
        <p>
            {{ Form::label('description'); }}
            {{ Form::textarea('description'); }}
        </p>
        <p>
            {{ Form::label('status'); }}
            {{ Form::select('status', array( 'draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived')); }}
        </p>
        <p>
            {{ Form::label('category'); }}
        </p>
        <p>
            {{ Form::label('Allow Comments'); }}
            {{ Form::checkbox('comments'); }}
        </p>
    </div>
</fieldset>
