<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    public function create()
    {
        return inertia('Sign-Up');
    }
    
    public function store (Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'role_id'  => ['required'],
            'email'    => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6']
        ]);

        $user = User::create($validated);

        Auth::login($user);

        if ($validated['role_id'] === 1) {

            $candidate = Candidate::create(['user_id' => $user->id]);

            return redirect('/candidates/' . $candidate->id . '/edit');

        } else {
            $company = Company::create(['user_id' => $user->id]);

            return redirect('/companies/' . $company->id . '/edit');
        }
    }

    public function edit (User $user)
    {
        return inertia('Users/Edit', [
            'user' => $user
        ]);
    }

    public function update (Request $request, User $user)
    {
        $validated = ($request->validate([
            'email'            => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['required', 'current_password'],
            'password'         => ['sometimes', 'min:6']
        ]));

        $user->update(Arr::except($validated, 'current_password'));

        return redirect('/')->with('message', [
            'type'    => 'success',
            'content' => 'Your profile has been updated successfully.'
        ]);
    }

    public function destroy (User $user)
    {
        Auth::logout();

        $user->delete();

        return redirect('/')->with('message', [
            'type'    => 'success',
            'content' => 'Your profile has been deleted successfully.'
        ]);
    }
}
