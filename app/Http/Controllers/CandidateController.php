<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isNull;

class CandidateController extends Controller
{
public function show (Candidate $candidate)
    {
        return inertia('Candidates/Show', [
            'candidate' => $candidate,
        ]);
    }

    public function edit (Candidate $candidate) {
        return inertia('Candidates/Edit', [
            'candidate' => $candidate
        ]);
    }

    public function update (Request $request, Candidate $candidate)
    {
        $validated = $request->validate([
            'avatar'     => ['nullable'],
            'name'       => ['required'],
            'headline'   => ['required'],
            'email'      => ['required', Rule::unique('candidates')->ignore($candidate->id)],
            'phone'      => ['required', Rule::unique('candidates')->ignore($candidate->id)],
            'street'     => ['required'],
            'city'       => ['required'],
            'state'      => ['required'],
            'summary'    => ['required'],
            'experience' => ['required'],
            'skills'     => ['required'],
            'education'  => ['required'],
        ]);

        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => ['image', 'max:2048'],
            ]);

            if ($candidate->avatar) {
                Storage::disk('public')->delete($candidate->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');

        } elseif (is_string($request->avatar)) {
            $request->validate([
                'avatar' => ['string'],
            ]);
            
        } elseif (is_null($request->avatar)) {
            if ($candidate->avatar) {
                Storage::disk('public')->delete($candidate->avatar);
            }
        }

        $candidate->update($validated);

        return redirect('/candidates/' . $candidate->id)->with('message', [
            'type'    => 'success',
            'content' => 'Your resume has been updated successfully.'
        ]);
    }

    public function applications (Candidate $candidate)
    {   
        $statusCount = $candidate->applications()->select('status')->get();

        return Inertia('Candidates/Applications', [
            'candidate'    => $candidate,
            'applications' => $candidate->applications()->latest()->filter(request('status'))->with('work.company')->paginate(10)->withQueryString(),
            'status'       => $statusCount->countBy('status')->merge(['total' => $statusCount->count(), 'active' => request('status')]),
        ]);
    }
}
