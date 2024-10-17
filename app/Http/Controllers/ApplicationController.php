<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Candidate;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store (Request $request)
    {
        $candidate = Candidate::where('user_id', auth()->id())->firstOrFail();

        if ($candidate->is_active) {

            Application::create([
                'candidate_id' => $candidate->id,
                'work_id'      => $request->work['id'],
                'company_id'   => $request->company['id'],
            ]);

            return redirect()->back();
        }

        return redirect('/candidates/' . $candidate->id . '/edit')->with('message', [
            'type'    => 'warning',
            'content' => 'You must complete your profile before applying.'
        ]);
    }

    public function update (Request $request, Application $application)
    {
        $application->update(['status' => $request->status]);

        return redirect()->back()->with('message', [
            'type'    => 'success',
            'content' => 'The application has been ' . $request->status . '.'
        ]);
    }

    public function destroy (Application $application)
    {
        $application->delete();
            
        return redirect()->back()->with('message', [
            'type'    => 'info',
            'content' => 'Application cancelled. You can reapply at any time.'
        ]);
    }
}
