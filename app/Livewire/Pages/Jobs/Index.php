<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use App\Models\JobPost;

class Index extends Component
{
    private function setMessage($type, $message)
    {
        if ($type === 'success') {
            $this->successMessage = $message;
            $this->errorMessage = null;
        } else {
            $this->errorMessage = $message;
            $this->successMessage = null;
        }
    }

    public function deleteJob($jobId)
    {

        try {
            JobPost::findOrFail($jobId)->delete();
            $this->setMessage('success', 'Skill deleted successfully!');
        } catch (\Exception $e) {
            $this->setMessage('error', 'There was an error deleting the skill.');
        }
    }

    public function render()
    {
        return view('livewire.pages.jobs.index', [
            'jobs' => JobPost::with('skillsList')->get() // Eager load skills
        ]);
    }
}
