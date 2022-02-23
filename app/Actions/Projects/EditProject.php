<?php

namespace App\Actions\Projects;

use App\Contracts\Actions\EditsProject;
use App\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EditProject implements EditsProject
{
    public function __invoke(Project $project, array $input): void
    {
        Validator::make($input, [
            'status' => ['required', 'integer', Rule::in([
                ProjectStatus::Pending(), 
                ProjectStatus::Processing(), 
                ProjectStatus::Finished(), 
                ProjectStatus::Cancelled(), 
            ])],
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'rates' => ['required', 'integer', 'min:0'],
            'amount_payed' => ['required', 'integer', 'min:0'],
            'amount_left' => ['required', 'integer', 'min:0',],
            'start_paying' => ['required', 'date'],
            'end_paying' => ['required', 'date']
        ])->validate();

        $project->update([
            'status' => $input['status'],
            'name' => $input['name'],
            'price' => $input['price'],
            'rates' => $input['rates'],
            'amount_payed' => $input['amount_payed'],
            'amount_left' => $input['amount_left'],
            'start_paying' => $input['start_paying'],
            'end_paying' => $input['end_paying']
        ]);
    }
}