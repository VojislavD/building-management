<?php

namespace Tests\Feature\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
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

    /**
     * @test
     */
    public function test_show_page_can_open_only_authenticated_user()
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.show', $task));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_show_page_shows_correct_info()
    {
        $task = Task::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->get(route('tasks.show', $task));

        $response->assertOk()
            ->assertViewIs('tasks.show')
            ->assertSee(__('View Task Details'))
            ->assertSeeInOrder([
                $task->user->name,
                $task->building->address,
                $task->description,
                $task->comment,
                $task->created_at->format('d.m.Y'),
                $task->updated_at->format('d.m.Y'),
                __('Comment'),
                __('Mark As Completed'),
                __('Mark As Cancelled')
            ]);
    }

    /**
     * @test
     */
    public function test_update_can_do_only_authenticated_user()
    {
        $task = Task::factory()->create();

        $response = $this->patch(route('tasks.update', $task));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_update_task_validation()
    {
        $task = Task::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->patch(route('tasks.update', $task), [
                'comment' => 1
            ]);

        $response->assertSessionHasErrors([
            'comment'
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->patch(route('tasks.update', $task), [
                'comment' => "Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters.Comment greater than 1000 characters."
            ]);

        $response->assertSessionHasErrors([
            'comment'
        ]);

        $response = $this->actingAs(User::factory()->create())
            ->patch(route('tasks.update', $task), [
                'comment' => "Some random comment."
            ]);

        $response->assertSessionHasNoErrors();
    }

    /**
     * @test
     */
    public function test_update_task()
    {
        $task = Task::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->patch(route('tasks.update', $task), [
                'comment' => 'Some random comment'
            ]);

        $response->assertRedirect(route('tasks.index'))
            ->assertSessionHas('taskUpdated');

        $this->assertDatabaseMissing('tasks', [
            'comment' => $task->comment
        ]);

        $this->assertDatabaseHas('tasks', [
            'comment' => 'Some random comment'
        ]);
    }

    /**
     * @test
     */
    public function test_update_task_status_as_completed()
    {
        $task = Task::factory()->pending()->create();

        $response = $this->actingAs(User::factory()->create())
            ->patch(route('tasks.completed', $task));

        $response->assertRedirect(route('tasks.index'))
            ->assertSessionHas('taskCompleted');

        $this->assertDatabaseMissing('tasks', [
            'status' => TaskStatus::Pending->value
        ]);

        $this->assertDatabaseHas('tasks', [
            'status' => TaskStatus::Completed->value
        ]);
    }

    /**
     * @test
     */
    public function test_update_task_status_as_cancelled()
    {
        $task = Task::factory()->pending()->create();

        $response = $this->actingAs(User::factory()->create())
            ->patch(route('tasks.cancelled', $task));

        $response->assertRedirect(route('tasks.index'))
            ->assertSessionHas('taskCancelled');

        $this->assertDatabaseMissing('tasks', [
            'status' => TaskStatus::Pending->value
        ]);

        $this->assertDatabaseHas('tasks', [
            'status' => TaskStatus::Cancelled->value
        ]);
    }

    /**
     * @test
     */
    public function test_status_completed_can_mark_only_authenticated_user()
    {
        $task = Task::factory()->create();

        $response = $this->patch(route('tasks.completed', $task));

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function test_status_cancelled_can_mark_only_authenticated_user()
    {
        $task = Task::factory()->create();

        $response = $this->patch(route('tasks.cancelled', $task));

        $response->assertRedirect(route('login'));
    }
}
