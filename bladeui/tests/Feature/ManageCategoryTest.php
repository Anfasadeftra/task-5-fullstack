<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tests\TestCase;
use App\Models\User;

class ManageCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_create_a_category()
    {
        $data = [
            'name' => $this->faker->word(),
        ];
      
        $user = User::factory()->create(); 
      
        $this
            ->actingAs($user)
            ->post(route('categories.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success', 'Data added successfully');
    }

    /** @test */
    public function user_can_browse_categories_index_page()
    {
        $user_account = User::factory()->create(); 
        $this
            ->actingAs($user_account)
            ->get(route('categories.index'))
            ->assertStatus(200)
            ->assertSee('name');
    }

    /** @test */
    public function user_can_edit_existing_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $data = [
            'name' => $this->faker->word(),
        ];
        $this
            ->actingAs($user)
            ->put(route('categories.update', $category->id), $data)
            ->assertStatus(302)
            ->assertRedirect(route('categories.index'))
            ->assertSessionHas('success', 'Data updated successfully');
    }

    /** @test */
    public function user_can_delete_existing_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create();
        $this->delete(route('categories.destroy', $category->id))
            ->assertStatus(302)
            ->assertRedirect()
            ->assertSessionHas('success', 'Data Deleted Successfully');
    }
}
