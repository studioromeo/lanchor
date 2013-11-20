<?php

class PostsControllerTest extends Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();

        Config::set('database.connections.sqlite.database', ':memory:');
        Config::set('database.default', 'sqlite');

        Artisan::call('migrate', array('--path' => '../../../../../src/migrations'));
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');
    }

    protected function getPackageProviders()
    {
        return array('Anchor\Core\CoreServiceProvider');
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

