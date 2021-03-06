<?php

namespace Tests\Feature\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TasksTableLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_show_only_pending_tasks_at_begining()
    {
        $pending = Task::factory()->pending()->create();
        $completed = Task::factory()->completed()->create();
        $cancelled = Task::factory()->cancelled()->create();

        Livewire::test('tasks.tasks-table')
            ->assertSee($pending->limited_description)
            ->assertDontSee($completed->limited_description)
            ->assertDontSee($cancelled->limited_description)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_completed_tasks()
    {
        $pending = Task::factory()->pending()->create();
        $completed = Task::factory()->completed()->create();
        $cancelled = Task::factory()->cancelled()->create();

        Livewire::test('tasks.tasks-table')
            ->set('status', TaskStatus::Completed())
            ->assertSee($completed->limited_description)
            ->assertDontSee($pending->limited_description)
            ->assertDontSee($cancelled->limited_description)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_cancelled_tasks()
    {
        $pending = Task::factory()->pending()->create();
        $completed = Task::factory()->completed()->create();
        $cancelled = Task::factory()->cancelled()->create();

        Livewire::test('tasks.tasks-table')
            ->set('status', TaskStatus::Cancelled())
            ->assertSee($cancelled->limited_description)
            ->assertDontSee($completed->limited_description)
            ->assertDontSee($pending->limited_description)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_all_tasks()
    {
        $pending = Task::factory()->pending()->create();
        $completed = Task::factory()->completed()->create();
        $cancelled = Task::factory()->cancelled()->create();

        Livewire::test('tasks.tasks-table')
            ->set('status', null)
            ->assertSee($pending->limited_description)
            ->assertSee($completed->limited_description)
            ->assertSee($cancelled->limited_description)
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_show_number_of_tasks_when_per_page_change()
    {
        $task = Task::factory()->pending()->create([
            'created_at' => now()->subDay(),
        ]);

        $task2 = Task::factory()->pending()->create();
        Task::factory(8)->pending()->create();
        $task3 = Task::factory()->pending()->create();

        Livewire::test('tasks.tasks-table')
            ->assertDontSee($task->limited_description)
            ->assertSee($task2->limited_description)
            ->assertSee($task3->limited_description)
            ->assertHasNoErrors();

        Livewire::test('tasks.tasks-table')
            ->set('perPage', 15)
            ->assertSee($task->limited_description)
            ->assertSee($task2->limited_description)
            ->assertSee($task3->limited_description)
            ->assertHasNoErrors();
    }
}
