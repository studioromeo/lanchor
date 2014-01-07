<fieldset class="header">
    <div class="wrap">
        @if (Session::has('message'))
            <div class="notifications">
                <p class="success">@lang(Session::get('message'))</p>
            </div>
        @endif
        {{ Form::text('title', null, array('placeholder' => Lang::get('core::posts.title'), 'autocomplete'=> 'off', 'autofocus' => 'true')) }}
        <aside class="buttons">
            {{ Form::button(Lang::get('core::global.save'), array('class' => 'btn', 'type' => 'submit')) }}
            @if (isset($post))
                {{ link_to_route('admin.posts.delete', Lang::get('core::global.delete'), array($post->id), array('class' => 'btn delete red')) }}
            @endif
        </aside>
    </div>
</fieldset>

<fieldset class="main">
    <div class="wrap">
        {{ Form::textarea('html', null, array('placeholder' => Lang::get('core::posts.content_explain'))) }}
    </div>
</fieldset>

<fieldset class="meta split">
    <div class="wrap">
        <p>
            {{ Form::label('slug', Lang::get('core::posts.slug')) }}
            {{ Form::text('slug') }}
            <em>@lang('core::posts.slug_explain')</em>
        </p>
        <p>
            {{ Form::label('description', Lang::get('core::posts.description')) }}
            {{ Form::textarea('description') }}
            <em>@lang('core::posts.description_explain')</em>
        </p>
        <p>
            {{ Form::label('status', Lang::get('core::posts.status')) }}
            {{ Form::select('status', array( 'draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived')) }}
            <em>@lang('core::posts.status_explain')</em>
        </p>
        <p>
            {{ Form::label('category', Lang::get('core::posts.category')) }}
            {{ Form::select('category', $categories)}}
            <em>@lang('core::posts.category_explain')</em>
        </p>
        <p>
            {{ Form::label('comments', Lang::get('core::posts.allow_comments')) }}
            {{ Form::checkbox('comments'); }}
            <em>@lang('core::posts.allow_comments_explain')</em>
        </p>
        <p>
            {{ Form::label('css', Lang::get('core::posts.custom_css')) }}
            {{ Form::textarea('css') }}
            <em>@lang('posts.custom_css_explain')</em>
        </p>
        <p>
            {{ Form::label('js', Lang::get('core::posts.custom_js')) }}
            {{ Form::textarea('js') }}
            <em>@lang('posts.custom_js_explain')</em>
        </p>
    </div>
</fieldset>
