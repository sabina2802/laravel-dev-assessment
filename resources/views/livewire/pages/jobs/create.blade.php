<div class="container mx-auto py-6 px-4 md:px-8 lg:px-16">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create new job posting</h1>
    </div>

    @if ($successMessage)
        <div class="bg-green-500 text-white p-3 rounded mb-4 shadow">{{ $successMessage }}</div>
    @endif
    @if ($errorMessage)
        <div class="bg-red-500 text-white p-3 rounded mb-4 shadow">{{ $errorMessage }}</div>
    @endif

    <form wire:submit.prevent="submitForm" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Job details</h2>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium">Title</label>
                <input type="text" wire:model="jobTitle" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300" placeholder="Job posting title">
                @error('jobTitle') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium">Description</label>
                <textarea wire:model="jobDescription" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300" placeholder="Job posting description"></textarea>
                @error('jobDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 text-sm font-medium">Experience</label>
                    <input type="text" wire:model="experience" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300" placeholder="Eg. 1-3 Yrs">
                    @error('experience') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium">Salary</label>
                    <input type="text" wire:model="salary" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300" placeholder="Eg. 2.75-5 Lacs PA">
                    @error('salary') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-gray-700 text-sm font-medium">Location</label>
                    <input type="text" wire:model="location" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300" placeholder="Eg. Remote / Pune">
                    @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-medium">Extra Info</label>
                    <input type="text" wire:model="extraInfo" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300" placeholder="Eg. Full Time, Urgent / Part Time">
                    @error('extraInfo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">Company details</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium">Name</label>
                    <input type="text" wire:model="companyName" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300" placeholder="Company Name">
                    @error('companyName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium">Logo</label>
                    <input type="file" wire:model="companyLogo" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300">
                    @error('companyLogo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-semibold mb-4">Skills</h2>
                <label class="block text-gray-700 text-sm font-medium">Select Skills</label>
                <select wire:model="skills" multiple class="w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-300">
                    @foreach($allSkills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
                @error('skills') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="md:col-span-3 flex justify-start">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded shadow hover:bg-blue-600 transition">Save</button>
        </div>
    </form>
</div>
