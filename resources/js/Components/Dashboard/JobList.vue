<script setup>
    import { defineProps, computed } from 'vue';
    
    const props = defineProps({
      jobs: Array
    });
    
    // Ensure jobs is reactive
    const jobList = computed(() => props.jobs || []);
    </script>
    
  <template>
  <div class="container mx-auto py-6">
    <!-- Job Listing Grid -->
    <div class="grid md:grid-cols-2 gap-6">
      <div 
        v-for="job in jobList" 
        :key="job.id" 
        class="bg-white shadow-md rounded-2xl p-6 border border-gray-200"
      >
        <!-- Header: Company Logo & Job Title -->
        <div class="flex items-center gap-4">
          <img :src="job.logo" class="h-14 w-14 rounded-full object-cover" alt="Company Logo" />
          <div>
            <h2 class="text-lg font-semibold text-gray-800">{{ job.title }}</h2>
            <p class="text-gray-500 text-sm">{{ job.company }}</p>
          </div>
        </div>

        <!-- Job Details -->
        <div class="flex items-center gap-3 text-sm text-gray-500 mt-3">
          <span class="flex items-center gap-1">
            📅 <span>{{ job.experience }} Yrs</span>
          </span>
          <span class="flex items-center gap-1">
            💰 <span>{{ job.salary }}</span>
          </span>
          <span class="flex items-center gap-1">
            📍 <span>{{ job.location }}</span>
          </span>
        </div>

        <!-- Job Description -->
        <p class="text-gray-600 mt-3 text-sm leading-relaxed">
          {{ job.description }}
        </p>

        <!-- Tags/Skills -->
        <div class="flex flex-wrap gap-2 mt-4">
          <span 
            v-for="tag in job.tags" 
            :key="tag"
            class="bg-gray-200 text-xs px-3 py-1 rounded-full text-gray-700"
          >
            {{ tag }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

    