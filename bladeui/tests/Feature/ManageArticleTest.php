<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;

class ManageArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_create_a_article()
    {
        $data = [
            'title' => $this->faker->word(),
            'content' => $this->faker->sentence(),
            'image' => $this->faker->image(
                dir: storage_path('app'),
                width: 250,
                height: 250,
                fullPath: false),
        ];
      
        $user = User::factory()->create(); 
      
        $this
            ->actingAs($user)
            ->post(route('articles.store'), $data)
            ->assertStatus(302);
    }

    public function user_can_browse_article_index_page()
    {
        $user_account = User::factory()->create(); 
        $this
            ->actingAs($user_account)
            ->get(route('articles.index'))
            ->assertStatus(200)
            ->assertSee('title')
            ->assertSee('content')
            ->assertSee('image');
    }

       /** @test */
       public function user_can_edit_existing_article()
       {
           $user = User::factory()->create();
           $this->actingAs($user);
           $article = Article::factory()->create();
           $data = [
                'title' => $this->faker->word(),
                'content' => $this->faker->sentence(),
                'image' => $this->faker->image(
                    dir: storage_path('app'),
                    width: 250,
                    height: 250,
                    fullPath: false),
           ];
           $this
               ->put(route('articles.update', $article->id), $data)
               ->assertStatus(302);
       }

       public function user_can_delete_existing_article()
       {
           $user = User::factory()->create();
           $this->actingAs($user);
           $article = Article::factory()->create();
           $this->delete(route('articles.destroy', $article->id))
               ->assertStatus(302)
               ->assertRedirect()
               ->assertSessionHas('success', 'Data Deleted Successfully');
       }
}
