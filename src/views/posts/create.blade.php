{{ Form::open(array('route' => 'admin.posts.store'))}}

    @include('core::posts/partials/_form');

{{ Form::close(); }}
