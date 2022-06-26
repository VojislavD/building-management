<?php

namespace App\Http\Controllers;

use App\Contracts\Actions\DeletesAdmin;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function index(): Renderable
    {
        return view('admins.index');
    }

    public function create(): Renderable
    {
        return view('admins.create');
    }

    public function edit(User $user): Renderable
    {
        return view('admins.edit', [
            'admin' => $user,
        ]);
    }

    public function destroy(User $user, DeletesAdmin $deleter): RedirectResponse
    {
        $deleter($user);

        return to_route('admins.index')->with('adminDeleted', __('Admin is successfully deleted.'));
    }
}
