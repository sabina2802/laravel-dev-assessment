<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\JobPost;
use App\Models\Skill;

class Create extends Component
{
    use WithFileUploads;

    public $jobTitle, $jobDescription, $experience, $salary, $location,$extraInfo;
    public $companyName, $companyLogo, $skills = [];
    public $successMessage, $errorMessage;
    public $allSkills = [];

    protected $rules = [
        'jobTitle' => 'required|string|min:3|max:255',
        'jobDescription' => 'required|string|min:10',
        'experience' => 'required|string',
        'salary' => 'required|string',
        'location' => 'required|string',
        'extraInfo' => 'nullable',
        'companyName' => 'required|string',
        'companyLogo' => 'nullable|image|max:1024',
        'skills' => 'required|array|min:1',
    ];

    public function mount()
    {
        $this->allSkills = Skill::all();
    }

    public function submitForm()
    {
        $this->validate();

        try {
            $job = new JobPost();
            $job->title = $this->jobTitle;
            $job->description = $this->jobDescription;
            $job->experience = $this->experience;
            $job->salary = $this->salary;
            $job->location = $this->location;
            $job->extraInfo = $this->extraInfo;

            $job->companyName = $this->companyName;

            if ($this->companyLogo) {
                $job->logo = $this->companyLogo->store('company-logos', 'public');
            }

            $job->save();

            $job->skills()->attach($this->skills);

            $this->reset(['jobTitle', 'jobDescription', 'experience', 'salary', 'location', 'extraInfo', 'companyName', 'companyLogo', 'skills']);
            $this->successMessage = "Job posted successfully!";
            $this->errorMessage = null;
            
        } catch (\Exception $e) {
            $this->errorMessage = "Something went wrong! " . $e->getMessage();
            $this->successMessage = null;
        }
    }

    public function render()
    {
        return view('livewire.pages.jobs.create');
    }
}
