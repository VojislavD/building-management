<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_index_page_can_open_only_authenticated_user()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_index_page_shows_correct_info()
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('tasks.index'));

        $response->assertOk()
            ->assertViewIs('tasks.index')
            ->assertSee(__('All Tasks'));
    }
}
