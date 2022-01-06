<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        Livewire::test('tasks-table')
            ->assertSee($pending->limited_description)
            ->assertDontSee($completed->limited_description)
            ->assertDontSee($cancelled->limited_description)
            ->assertHasNoErrors();
    }
}
