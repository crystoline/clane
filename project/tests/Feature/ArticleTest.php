<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    private $token = '';

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
        $response = $this->doLogin();
    }


    public function testLogin()
    {
        $response = $this->postJson('api/auth/login', ['email' => 'crystoline@hotmail.com', 'password' => 'password']);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "access_token" => "token_type", "expires_in"
        ]);

    }

    public function testCreateArticles()
    {
        $this->doLogin();

        $response = $this->postJson('api/articles',
            [
                'title' => 'test title',
                'slug' => 'test-slug',
                'description' => 'test description',
                'content' => 'test content'
            ],
            [
                "authorization: Bearer {$this->token}"
            ]
        );

        $response->assertStatus(201);
        $response->assertJsonStructure(["title", "slug", "description", "content", "updated_at", "created_at", "id", "avg_rating"]);

    }

    public function testUpdateArticle()
    {
        $this->doLogin();

        $response = $this->putJson('api/articles/1', [
            'title' => 'test title',
            'slug' => 'test-slug',
            'description' => 'test description',
            'content' => 'test content'
        ], [
            "authorization: Bearer {$this->token}"
        ]);
        //dump($response->getContent());
        $response->assertStatus(200);
        $response->assertJsonStructure(["title", "slug", "description", "content", "updated_at", "created_at", "id", "avg_rating"]);

    }

    public function testListArticles()
    {
        $response = $this->get('api/articles');
        $response->assertStatus(200);
    }

    public function testShowArticle()
    {
        $response = $this->get('api/articles/1');
        $response->assertStatus(200);
        $response->assertJsonStructure(["title", "slug", "description", "content", "updated_at", "created_at", "id", "avg_rating"]);
    }

    public function testRateArticle()
    {
        $response = $this->post('api/articles/1/rating', ['rate' => 4]);
        $response->assertStatus(200);
        $response->assertJsonStructure(["title", "slug", "description", "content", "updated_at", "created_at", "id", "avg_rating"]);
    }

    public function testDeleteArticle()
    {
        $this->doLogin();

        $response = $this->deleteJson('api/articles/1', [], [
            "authorization: Bearer {$this->token}"
        ]);
        //dump($response->getContent());
        $response->assertStatus(200);
        $response->assertJson([ 'message' => 'record was deleted']);

    }

    private function doLogin(): TestResponse
    {
        $response = $this->postJson('api/auth/login', ['email' => 'crystoline@hotmail.com', 'password' => 'password']);
        $data = json_decode($response->getContent(), true);

        if (!empty($data['access_token'])) {
            $this->token = $data['access_token'];
        }
        return $response;
    }
}
