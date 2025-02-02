<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use Inertia\Inertia;
use Illuminate\Support\Str;

class JobController extends Controller
{
    //
    
        public function index(Request $request)
        {
            // Fetch jobs from the database
            /*$jobs = JobPost::with('skillsList')->get()->map(function ($job) {
                return [
                    'id' => $job->id,
                    'title' => $job->title,
                    'company' => $job->companyName,
                    'experience' => $job->experience,
                    'salary' => $job->salary,
                    'location' => $job->location,
                    'description' => Str::words($job->description, 20),
                    'tags' => $job->skillsList->pluck('name')->toArray(),
                    'logo' => $job->logo ? asset('storage/' . $job->logo) : asset('images/default-logo.png')
                ];
            });
    
            // Pass jobs to Inertia and render Dashboard component
            return Inertia::render('Dashboard', [
                'jobs' => $jobs
            ]);*/// Fetch query parameters for filtering
        $title = $request->input('title');
        $location = $request->input('location');

        // Build the query with optional filters
        $query = JobPost::with('skillsList');

        if (!empty($title)) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if (!empty($location)) {
            $query->where('location', 'like', '%' . $location . '%');
        }

        // Fetch and format the job data
        $jobs = $query->get()->map(function ($job) {
            return [
                'id' => $job->id,
                'title' => $job->title,
                'company' => $job->companyName,
                'experience' => $job->experience,
                'salary' => $job->salary,
                'location' => $job->location,
                'description' => Str::words($job->description, 20),
                'tags' => $job->skillsList->pluck('name')->toArray(),
                'logo' => $job->logo ? asset('storage/' . $job->logo) : asset('images/default-logo.png')
            ];
        });

        // Pass the data to Inertia
        return Inertia::render('Dashboard', [
            'jobs' => $jobs,
            'filters' => [
                'title' => $title,
                'location' => $location,
            ],
        ]);


    }
}
