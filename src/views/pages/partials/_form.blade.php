<fieldset class="header">
    <div class="wrap">
        {{ Form::text('title') }}
        <aside class="buttons">
            {{ Form::button('Save', array('class' => 'btn', 'type' => 'submit')) }}
            <button class="btn secondary" type="button">Redirect</button>
            @if (isset($page))
                {{ link_to_route('admin.pages.delete', 'Delete', array($page->id), array('class' => 'btn delete red')) }}
            @endif
        </aside>
    </div>
</fieldset>

<fieldset class="redirect">
    <div class="wrap">
        {{ Form::text('redirect', null, array('placeholder' => 'Redirect Url')) }}
    </div>
</fieldset>

<fieldset class="main">
    <div class="wrap">
        {{ Form::textarea('content') }}
    </div>
</fieldset>

<fieldset class="meta split">
    <div class="wrap">
        <p>
            {{ Form::label('show_in_menu'); }}
            {{ Form::checkbox('show_in_menu'); }}
        </p>
        <p>
            {{ Form::label('name'); }}
            {{ Form::text('name'); }}
        </p>
        <p>
            {{ Form::label('slug'); }}
            {{ Form::text('slug'); }}
        </p>
        <p>
            {{ Form::label('status'); }}
            {{ Form::select('status', array( 'draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived')); }}
        </p>
        <p>
            {{ Form::label('parent'); }}
            {{ Form::select('parent', $pages); }}
        </p>
    </div>
</fieldset>
