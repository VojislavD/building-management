<?php

namespace Tests\Feature\Projects;

use App\Models\Project;
use App\Enums\ProjectStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EditProjectLivewireComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_all_required_fields_are_present()
    {
        $project = Project::factory()->create();

        Livewire::test('projects.edit-project', [
                'project' => $project
            ])
            ->assertSeeInOrder([
                __('Internal Code'),
                __('Address'),
                __('Status'),
                __('Name'),
                __('Price'),
                __('Rates'),
                __('Amount Payed'),
                __('Amount Left'),
                __('Start Paying'),
                __('End Paying'),
            ])
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_validation()
    {
        $project = Project::factory()->create();

        Livewire::test('projects.edit-project', [
                'project' => $project
            ])
            ->set('status', '')
            ->set('name', '')
            ->set('price', '')
            ->set('rates', '')
            ->set('amount_payed', '')
            ->set('amount_left', '')
            ->set('start_paying', '')
            ->set('end_paying', '')
            ->call('submit')
            ->assertHasErrors([
                'status' => 'required',
                'name' => 'required',
                'price' => 'required',
                'rates' => 'required',
                'amount_payed' => 'required',
                'amount_left' => 'required',
                'start_paying' => 'required',
                'end_paying' => 'required'
            ]);

        Livewire::test('projects.edit-project', [
                'project' => $project
            ])
            ->set('status', 'not integer')
            ->set('name', 1)
            ->set('price', 'not integer')
            ->set('rates', 'not integer')
            ->set('amount_payed', 'not integer')
            ->set('amount_left', 'not integer')
            ->set('start_paying', 'not date')
            ->set('end_paying', 'not date')
            ->call('submit')
            ->assertHasErrors([
                'status' => 'integer',
                'name' => 'string',
                'price' => 'integer',
                'rates' => 'integer',
                'amount_payed' => 'integer',
                'amount_left' => 'integer',
                'start_paying' => 'date',
                'end_paying' => 'date'
            ]);

        Livewire::test('projects.edit-project', [
                'project' => $project
            ])
            ->set('status', 0)
            ->set('name', 'abcde')
            ->set('price', -1)
            ->set('rates', -1)
            ->set('amount_payed', -1)
            ->set('amount_left', -1)
            ->set('start_paying', now())
            ->set('end_paying', now())
            ->call('submit')
            ->assertHasErrors([
                'status' => 'in',
                'name' => 'min',
                'price' => 'min',
                'rates' => 'min',
                'amount_payed' => 'min',
                'amount_left' => 'min',
            ]);
        
        Livewire::test('projects.edit-project', [
                'project' => $project
            ])
            ->set('status', ProjectStatus::Pending())
            ->set('name', 'More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters. More than 255 characters.')
            ->set('price', 100)
            ->set('rates', 10)
            ->set('amount_payed', 20)
            ->set('amount_left', 80)
            ->set('start_paying', now())
            ->set('end_paying', now())
            ->call('submit')
            ->assertHasErrors([
                'name' => 'max',
            ]);
        
        Livewire::test('projects.edit-project', [
                'project' => $project
            ])
            ->set('status', ProjectStatus::Pending())
            ->set('name', 'Example')
            ->set('price', 100)
            ->set('rates', 10)
            ->set('amount_payed', 20)
            ->set('amount_left', 80)
            ->set('start_paying', now())
            ->set('end_paying', now())
            ->call('submit')
            ->assertHasNoErrors();
    }

    /**
     * @test
     */
    public function test_edit_project()
    {
        $project = Project::factory()->pending()->create();

        Livewire::test('projects.edit-project', [
                'project' => $project
            ])
            ->set('status', ProjectStatus::Finished())
            ->set('name', 'Example')
            ->set('price', 100)
            ->set('rates', 10)
            ->set('amount_payed', 20)
            ->set('amount_left', 80)
            ->set('start_paying', today())
            ->set('end_paying', today())
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('projects', [
            'status' => $project->status->value,
            'name' => $project->name,
            'price' => $project->price,
            'rates' => $project->rates,
            'amount_payed' => $project->amount_payed,
            'amount_left' => $project->amount_left,
            'start_paying' => $project->start_paying,
            'end_paying' => $project->end_paying,
        ]);

        $this->assertDatabaseHas('projects', [
            'status' => ProjectStatus::Finished(),
            'name' => 'Example',
            'price' => 100,
            'rates' => 10,
            'amount_payed' => 20,
            'amount_left' => 80,
            'start_paying' => today(),
            'end_paying' => today(),
        ]);
    }
}
