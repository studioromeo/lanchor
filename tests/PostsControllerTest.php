<?php

class PostsControllerTest extends Orchestra\Testbench\TestCase
{
    public function getEnvironmentSetUp($app)
    {
        // SET UP DB & TABLES BEFORE WE LOAD THE SERVICE PROVIDER
        // THIS IS BECAUSE WE HAVE DYNAMIC ROUTING BASED ON WHATS IN
        // THE DATABASE!
        //
        // NOT SURE IF THIS IS RIGHT BUT IT WORKS FOR NOW
        // COULD ALWAYS MAKE A CLASS AND STUB THE METHOD?
        Config::set('database.connections.sqlite.database', ':memory:');
        Config::set('database.default', 'sqlite');

        Artisan::call('migrate', array('--path' => '../../../../../src/migrations'));
        Artisan::call('db:seed', array('--class' => 'Anchor\Core\Database\Seeds\PageSeeder'));
        Artisan::call('db:seed', array('--class' => 'Anchor\Core\Database\Seeds\MetadataSeeder'));
        $providers = array_merge($this->getApplicationProviders(), array('Anchor\Core\CoreServiceProvider'));

        $app->getProviderRepository()->load($app, $providers);
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
    }

    public function testDisplayAdminPostsList()
    {
        $this->call('GET', 'admin/posts');
        $this->assertResponseOk();
    }

    public function testDisplayAdminPostsListByCategory()
    {
        $this->call('GET', 'admin/posts/category/uncategorised');
        $this->assertResponseOk();
    }

    public function testDisplayAdminPostCreate()
    {
        $this->call('GET', 'admin/posts/create');
        $this->assertResponseOk();
    }

    public function testCreatesNewPost()
    {
        $postData = array(
            'title' => 'My First Post',
            'slug' => 'my-first-post',
            'description' => 'Lorem ipsum',
            'author' => 1,
            'category' => 1,
            'status' => 'draft',
            'comments' => 1
        );

        $this->call('POST', 'admin/posts', $postData);
        $this->assertRedirectedToRoute('admin.posts.index');
    }

    public function testDeleteExistingPost()
    {
        $this->call('DELETE', 'admin/posts/1');

        $this->assertRedirectedToRoute('admin.posts.index');
    }
}

