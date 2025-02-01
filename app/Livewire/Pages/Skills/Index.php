<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Skill;

class Index extends Component
{
    use WithPagination;

    public $skillName;
    public $editingSkillId = null;
    public $successMessage;
    public $errorMessage;

    // Validate skill
    private function validateSkill()
    {
        return $this->validate([
            'skillName' => 'required|string|max:255|unique:skills,name' . 
                ($this->editingSkillId ? ',' . $this->editingSkillId : ''),
        ], [
            'skillName.required' => 'The skill name is required.',
            'skillName.string' => 'The skill name must be a string.',
            'skillName.max' => 'The skill name should not exceed 255 characters.',
            'skillName.unique' => 'The skill name already exists. Please choose a different name.',
        ]);
    }

    // Success/Error message 
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

    //Reset form
    private function resetForm()
    {
        $this->skillName = '';
        $this->editingSkillId = null;
    }

    //This function used for create skill
    public function createSkill()
    {
        $this->validateSkill();

        try {
            Skill::create(['name' => $this->skillName]);
            $this->setMessage('success', 'Skill added successfully!');
            $this->resetForm();
        } catch (\Exception $e) {
            $this->setMessage('error', 'There was an error adding the skill.');
        }
    }

    //This function used for edit skill
    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skillName = $skill->name;
        $this->editingSkillId = $skill->id;
    }

    //This function used to update skill
    public function updateSkill()
    {
        $this->validateSkill();

        try {
            Skill::findOrFail($this->editingSkillId)->update(['name' => $this->skillName]);
            $this->setMessage('success', 'Skill updated successfully!');
            $this->resetForm();
        } catch (\Exception $e) {
            $this->setMessage('error', 'There was an error updating the skill.');
        }
    }

    //This funtion used to delete skill
    public function deleteSkill($id)
    {
        try {
            Skill::findOrFail($id)->delete();
            $this->setMessage('success', 'Skill deleted successfully!');
        } catch (\Exception $e) {
            $this->setMessage('error', 'There was an error deleting the skill.');
        }
    }

    public function render()
    {
        return view('livewire.pages.skills.index', [
            'skills' => Skill::paginate(10)
        ]);
    }
}
