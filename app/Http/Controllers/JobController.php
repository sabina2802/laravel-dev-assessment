<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {
        
        $title = $request->input('title');
        $location = $request->input('location');

        $query = JobPost::with('skillsList');

        if (!empty($title)) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if (!empty($location)) {
            $query->where('location', 'like', '%' . $location . '%');
        }

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
                'logo' => $job->logo ? asset('storage/' . $job->logo) : asset('images/default-logo.png'),
                'timeAgo' => Carbon::parse($job->created_at)->diffForHumans()
                
            ];
        });

        return Inertia::render('Dashboard', [
            'jobs' => $jobs,
            'filters' => [
                'title' => $title,
                'location' => $location,
            ],
        ]);
    }
}
