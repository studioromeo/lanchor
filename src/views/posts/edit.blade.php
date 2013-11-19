{{ Form::model($post, array('method' => 'PUT', 'route' => array('admin.posts.update', $post->id))) }}
    @include('core::posts/partials/_form')
{{ Form::close() }}
