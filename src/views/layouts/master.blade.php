<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="{{ asset('packages/anchor/core/css/reset.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/anchor/core/css/admin.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/anchor/core/css/login.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/anchor/core/css/notifications.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/anchor/core/css/forms.css') }}" />
    </head>
    <body class="admin">
        <header class="top">
            <div class="wrap">
                <nav>
                    <ul>
                        <li class="logo">
                            {{ link_to_route('admin.posts.index', 'Anchor CMS') }}
                        </li>
                        <li {{ (!Request::is('admin/posts*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.posts.index', 'Posts') }}
                        </li>
                        <li {{ (!Request::is('admin/comments*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.comments.index', 'Comments') }}
                        </li>
                        <li {{ (!Request::is('admin/pages*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.pages.index', 'Pages') }}
                        </li>
                        <li {{ (!Request::is('admin/categories*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.categories.index', 'Categories') }}
                        </li>
                        <li {{ (!Request::is('admin/users*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.users.index', 'Users') }}
                        </li>
                        <li {{ (!Request::is('admin/extend*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.extend.index', 'Extend') }}
                        </li>
                    </ul>
                </nav>
                {{ link_to_route('posts.index', 'Visit your site', null, array('class' => 'btn', 'target' => '_blank')) }}
            </div>
        </header>
        @yield('content')
        <footer class="wrap bottom">
            <small>Powered by Anchor</small>
            <em>Make blogging beautiful.</em>
        </footer>

        <script src="{{ asset('packages/anchor/core/js/zepto.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/custom-fields.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/dragdrop.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/editor.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/focus-mode.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/page-name.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/redirect.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/slug.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/sortable.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/text-resize.js') }}"></script>
        <script src="{{ asset('packages/anchor/core/js/upload-fields.js') }}"></script>
    </body>
</html>
