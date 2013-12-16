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
                        <li {{ (!Request::is('admin/categories*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.categories.index', 'Categories') }}
                        </li>
                        <li {{ (!Request::is('admin/pages*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.pages.index', 'Pages') }}
                        </li>
                        <li {{ (!Request::is('admin/users*')) ?: 'class="active"' }}>
                            {{ link_to_route('admin.users.index', 'Users') }}
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        @yield('content')
        <footer class="wrap bottom">
            <small>Powered by Anchor</small>
            <em>Make blogging beautiful.</em>
        </footer>
    </body>
</html>
