<div class="container mx-auto py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Skills</h1>
    </div>

    @if ($successMessage)
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4 shadow">
            {{ $successMessage }}
        </div>
    @endif
    @if ($errorMessage)
        <div id="error-message" class="bg-red-500 text-white p-4 rounded mb-4 shadow">
            {{ $errorMessage }}
        </div>
    @endif

    <div class="flex flex-wrap space-x-6">
        <div class="flex-1 bg-white rounded-lg shadow-md p-6">
            <table class="min-w-full table-auto border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                    <tr>
                        <th class="text-left px-6 py-3">Skill Name</th>
                        <th class="text-right px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($skills as $skill)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $skill->name }}</td>
                            <td class="px-4 py-3 text-right">
                                <button class="text-blue-500 hover:underline" wire:click="editSkill({{ $skill->id }})">
                                    Edit
                                </button>
                                <span class="mx-1"></span>
                                <button class="text-red-500 hover:underline" onclick="confirmDelete({{ $skill->id }})">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 flex justify-end">
                {{ $skills->links() }}
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md w-96 self-start">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">
                {{ $editingSkillId ? 'Edit Skill' : 'Add new skill' }}
            </h2>
            <form wire:submit.prevent="{{ $editingSkillId ? 'updateSkill' : 'createSkill' }}" class="space-y-4">
                <div>
                    <label for="skillName" class="block text-gray-700 text-sm font-medium">Name</label>
                    <input type="text" id="skillName" wire:model="skillName"
                        class="p-2 border border-gray-300 rounded mt-2 w-full focus:ring focus:ring-blue-300 @error('skillName') border-red-500 @enderror"
                        placeholder="Enter skill name"/>
                    <span id="skillNameError" class="text-red-500 text-sm hidden">Skill name is required.</span>
                    @error('skillName')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600 transition">
                    Save
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.addEventListener('livewire:update', function () {
        setTimeout(() => {
            if (document.getElementById('success-message')) {
                document.getElementById('success-message').style.display = 'none';
            }
            if (document.getElementById('error-message')) {
                document.getElementById('error-message').style.display = 'none';
            }
        }, 3000);
    });

    function confirmDelete(skillId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.deleteSkill(skillId);
                Swal.fire('Deleted!', 'Your skill has been deleted.', 'success');
            }
        });
    }

    /*function validateSkillName() {
        const skillNameInput = document.getElementById('skillName');
        const skillNameError = document.getElementById('skillNameError');
        const skillName = skillNameInput.value.trim();

        if (skillName === '') {
            skillNameError.classList.remove('hidden');
            skillNameInput.classList.add('border-red-500');
            return false;
        } else {
            skillNameError.classList.add('hidden');
            skillNameInput.classList.remove('border-red-500');
            return true;
        }
    }*/
</script>