<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>All posts!</h1>
        {{ link_to_route('admin.posts.create', 'Create Post') }}
        @foreach($posts as $post)
            <li>
                {{ link_to_route('admin.posts.edit', $post->title, array($post->id)) }}
                {{ link_to_route('admin.posts.delete', '(Delete)', array($post->id)) }}
            </li>
        @endforeach
    </body>
</html>
