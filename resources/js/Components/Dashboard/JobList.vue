<template>
  <div class="py-12">
    <div class="container mx-auto px-6">
      <!-- Job Listing Grid -->
      <div v-if="jobs.length" class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2">
        <div
          v-for="job in jobs"
          :key="job.id"
          class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200 hover:shadow-2xl transition duration-300"
        >
          <!-- Job Details -->
          <div class="flex items-start gap-6">
            <!-- Company Logo -->
            <div class="flex-shrink-0">
              <img
                :src="job.logo"
                class="h-14 w-14 rounded-lg object-cover"
                alt="Company Logo"
              />
            </div>

            <!-- Job Content -->
            <div class="flex-1">
              <!-- Job Title and Location on the Same Line -->
              <div class="flex justify-between items-center">
                <div>
                  <h2 class="text-xl font-semibold text-gray-900">{{ job.title }}</h2>
                  <p class="text-gray-500 text-sm mt-1">{{ job.company }}</p>
                </div>
                <!-- Location with Rounded Gray Shadow -->
                <div class="flex items-center gap-1 text-sm text-gray-500 bg-gray-100 rounded-full py-1 px-3 shadow-sm">
                  <!-- FontAwesome Icon for Location -->
                  <i class="fa-solid fa-location-dot text-gray-400"></i>
                  <span>{{ job.location }}</span>
                </div>
              </div>

              <!-- Labels -->
              <div class="flex gap-2 flex-wrap mt-3">
                <span
                  v-for="label in job.labels"
                  :key="label"
                  class="bg-gray-100 text-xs font-medium px-2.5 py-1 rounded-full text-gray-600"
                >
                  {{ label }}
                </span>
              </div>

              <!-- Job Meta Details -->
              <div class="flex items-center gap-5 text-sm text-gray-500 mt-3">
                <!-- Experience with FontAwesome Icon -->
                <span class="flex items-center gap-1.5">
                  <!-- FontAwesome Icon for Experience -->
                  <i class="fa-solid fa-briefcase text-gray-400"></i>
                  {{ job.experience }} Yrs
                </span>

                <!-- Salary with FontAwesome Icon -->
                <span class="flex items-center gap-1.5">
                  <!-- FontAwesome Icon for Salary -->
                  <i class="fa-solid fa-dollar-sign text-gray-400"></i>
                  {{ job.salary }}
                </span>
              </div>

              <!-- Job Description with FontAwesome Icon -->
              <div class="flex items-start gap-1 mt-3 text-sm text-gray-600">
                <!-- FontAwesome Icon for Description -->
                <i class="fa-solid fa-file-alt text-gray-400"></i>
                <p class="leading-relaxed line-clamp-2">{{ job.description }}</p>
              </div>

              <!-- Skills/Tags -->
              <div class="flex flex-wrap gap-2 mt-4">
                <span
                  v-for="tag in job.tags"
                  :key="tag"
                  class="bg-gray-100 text-xs font-medium px-3 py-1 rounded-full text-gray-600"
                >
                  {{ tag }}
                </span>
              </div>

              <!-- Time Ago -->
              <p class="text-xs text-gray-400 text-right mt-4">
                {{ job.timeAgo }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- No Jobs Available -->
      <div v-else class="text-center py-20">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">No Jobs Available</h2>
        <p class="text-gray-600 text-sm">Currently, there are no jobs matching your search criteria. Please check back later.</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    jobs: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style scoped>
/* Custom styles for pixel-perfect alignment */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
