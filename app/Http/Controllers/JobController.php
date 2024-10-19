<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Jobs\GenerateApplications;

class JobController extends Controller
{
    public function index()
    {
        $all = Job::with('company')->filter(request([
                'title', 'cities', 'companies', 'salaries', 'schedules', 'models'
        ]));

        return inertia('Jobs/Index',[
            'jobs' => $all->clone()->latest()->paginate(12)->withQueryString(),
            'filters' => [
                'title'     => array_values($all->orderBy('title')->pluck('title')->unique()->toArray()),
                'cities'    => array_values($all->get()->pluck('company.city')->unique()->sort()->toArray()),
                'companies' => array_values($all->get()->pluck('company.name')->unique()->sort()->toArray()),
                'salaries'  => [
                    'min' => Job::pluck('salary')->min(),
                    'max' => $all->pluck('salary')->max(),
                ],
                'schedules' => $all->reorder('schedule')->pluck('schedule')->unique(),
                'models'    => $all->reorder('model')->pluck('model')->unique(),
            ],
            'selected' => request()->query(),
        ]);
    }

    public function create()
    {
        return inertia('Jobs/Create', [
            'company_id' => auth()->user()->company->id
        ]);
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'company_id' => ['required'],
            'title'      => ['required'],
            'salary'     => ['required'],
            'schedule'   => ['required'],
            'model'      => ['required'],
            'about'      => ['required'],
            'tags'       => ['required', 'array']
        ]);

        $job = Job::create($validated);

        GenerateApplications::dispatch($job);

        return redirect('/jobs/' . $job->id)->with('message', [
            'type'    => 'success',
            'content' => 'The job has been created successfully'
        ]);
    }

    public function show(Job $job)
    {
        return inertia('Jobs/Show', [
            'job'         => $job->loadMissing('company'),
            'application' => $job->applications()->where('candidate_id', auth()->user()?->candidate?->id)->first(),
        ]);
    }

    public function edit (Job $job)
    {
        return inertia('Jobs/Edit', [
            'job' => $job
        ]);
    }

    public function update (Job $job, Request $request)
    {
        $validated = $request->validate([
            'title'    => ['required'],
            'salary'   => ['required'],
            'schedule' => ['required'],
            'model'    => ['required'],
            'about'    => ['required'],
            'tags'     => ['required', 'array'],
        ]);

        $job->update($validated);
        
        return redirect('/jobs/' . $job->id)->with('message', [
            'type'    => 'success',
            'content' => 'The job has been updated successfully'
        ]);
    }

    public function destroy (Job $job)
    {
        $job->delete();
        
        return redirect('/companies/' . $job->company_id . '/jobs')->with('message', [
            'type'    => 'success',
            'content' => 'The job has been deleted successfully'
        ]);
    }
}
