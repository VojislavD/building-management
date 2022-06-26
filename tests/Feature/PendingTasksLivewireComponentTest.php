<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PendingTasksLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_that_component_shows_correct_data()
    {
        $task1 = Task::factory()->pending()->create([
            'created_at' => now()->subDay(),
        ]);
        Task::factory(4)->pending()->create();
        $task2 = Task::factory()->pending()->create();
        $completedTask = Task::factory()->completed()->create();
        $cancelledTask = Task::factory()->cancelled()->create();

        Livewire::test('tasks.pending-tasks')
            ->assertSee(__('Pending Tasks'))
            ->assertSee(str($task2->description)->limit(40))
            ->assertDontSee([
                str($task1->description)->limit(40),
                str($completedTask->description)->limit(40),
                str($cancelledTask->description)->limit(40),
            ]);
    }
}
