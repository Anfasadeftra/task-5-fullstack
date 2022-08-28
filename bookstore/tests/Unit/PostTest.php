<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Laravel\Passport\Passport;


class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function test_can_make_post()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $file = [
                'title' => $this->faker->word(),
                'content' => $this->faker->sentence(),
                'image' => $this->faker->imageUrl(),
        ];
        $this->post(route('posts.store'), $file)
            ->assertStatus(200)
            ->assertJsonFragment($file);

    }


    public function test_can_update_post()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $post = Post::factory()->create();
        $data = [
            'success' => true,
        ];
        $this->put(route('posts.update', $post->id), $data)
            ->assertStatus(200)
            ->assertJson($data);
      }


      public function test_can_show_post(){
        $user = User::factory()->create();
        Passport::actingAs($user);
        $post = Post::factory()->create();
        $this->get(route('posts.show', $post->id))
            ->assertStatus(200);
      }
    
      public function test_can_delete_post(){
        $user = User::factory()->create();
        Passport::actingAs($user);
        $post = Post::factory()->create();
        $this->delete(route('posts.destroy', $post->id))
            ->assertStatus(200);
      }
    
    
      public function test_can_show_list_posts(){
        $user = User::factory()->create();
        Passport::actingAs($user);
        $posts = Post::factory()->create();
        $file = [
            'title' => $posts->title,
            'content' => $posts->content,
            'image' => $posts->image,
        ];
        $this->get(route('posts.index'))
             ->assertOk()
             ->assertJsonFragment($file);
      }
}
