<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_guest_cannot_access_posts_routes()
    {
        $post = Post::factory()->create();

        $this->getJson('/api/posts')->assertUnauthorized();
        $this->postJson('/api/posts', [])->assertUnauthorized();
        $this->getJson("/api/posts/{$post->id}")->assertUnauthorized();
        $this->putJson("/api/posts/{$post->id}", [])->assertUnauthorized();
        $this->deleteJson("/api/posts/{$post->id}")->assertUnauthorized();
    }

    public function test_can_list_posts()
    {
        Sanctum::actingAs(User::factory()->create());
        Post::factory()->count(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertOk()
            ->assertJsonStructure(['data']);
    }

    public function test_can_create_post()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $payload = [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];

        $response = $this->postJson('/api/posts', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.title', $payload['title'])
            ->assertJsonPath('data.body', $payload['body']);
        $this->assertDatabaseHas('posts', [
            'title' => $payload['title'],
            'body' => $payload['body'],
            'user_id' => $user->id,
        ]);
    }

    public function test_can_show_post()
    {
        Sanctum::actingAs(User::factory()->create());
        $post = Post::factory()->create();

        $response = $this->getJson("/api/posts/{$post->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $post->id);
    }

    public function test_can_update_own_post()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $post = Post::factory()->for($user)->create();

        $payload = [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ];

        $response = $this->putJson("/api/posts/{$post->id}", $payload);

        $response->assertOk()
            ->assertJsonPath('data.title', $payload['title'])
            ->assertJsonPath('data.body', $payload['body']);
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => $payload['title'],
            'body' => $payload['body'],
        ]);
    }

    public function test_cannot_update_others_post()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        Sanctum::actingAs($user);
        $post = Post::factory()->for($otherUser)->create();

        $payload = [
            'title' => 'Hacked Title',
            'body' => 'Hacked Body',
        ];

        $response = $this->putJson("/api/posts/{$post->id}", $payload);

        $response->assertForbidden();
    }

    public function test_can_delete_own_post()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $post = Post::factory()->for($user)->create();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertOk()
            ->assertJson(['message' => 'Post deleted successfully']);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_cannot_delete_others_post()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        Sanctum::actingAs($user);
        $post = Post::factory()->for($otherUser)->create();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertForbidden();
        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }
}
