<template>
  <div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12">
      <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
        <div class="intro-y col-span-12 sm:col-span-12 md:col-span-12 xxl:col-span-12">
          <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative" style="background-image: url(https://images.pexels.com/photos/3183183/pexels-photo-3183183.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260)">
            <div class="relative text-lg bg-transparent text-gray-800">
              <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                <input class="bg-transparent border-none mr-3 px-2 leading-tight focus:outline-none text-white" type="text" placeholder="Search">
                <button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
                  <SearchIcon class="text-white mb-5"></SearchIcon>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-span-12 lg:col-span-3 xxl:col-span-2">
      <h2 class="intro-y text-lg font-medium mr-auto mt-2">
        Search Filter
      </h2>
      <!-- BEGIN: File Manager Menu -->
      <div class="intro-y box p-5 mt-6">
        <div class="mt-1">
          <a href="" class="flex items-center px-3 py-2 rounded-md bg-theme-1 text-white font-medium">
            <PaperclipIcon class="w-4 h-4 mr-2" /> Postings
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <UserIcon class="w-4 h-4 mr-2" /> Authors
          </a>
        </div>
        <div class="border-t border-gray-200 dark:border-dark-5 mt-4 pt-4">
          <a href="" class="flex items-center px-3 py-2 rounded-md">
            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
            Custom Work
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
            Important Meetings
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
            Work
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
            Design
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <div class="w-2 h-2 bg-theme-6 rounded-full mr-3"></div>
            Next Week
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <PlusIcon class="w-4 h-4 mr-2" /> Add New Label
          </a>
        </div>
      </div>
      <!-- END: File Manager Menu -->
    </div>
    <div class="col-span-12 lg:col-span-9 xxl:col-span-10">
      <!-- BEGIN: Directory & Files -->
      <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
        <div
          v-for="(faker, fakerKey) in $f()"
          :key="fakerKey"
          class="intro-y col-span-12 sm:col-span-12 md:col-span-12 xxl:col-span-12"
        >
          <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative">
            <div class="relative flex items-center">
              <div class="w-12 h-12 flex-none image-fit">
                <img alt="" class="rounded" src="https://images.pexels.com/photos/257736/pexels-photo-257736.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260">
              </div>
              <div class="ml-4 mr-auto">
                <a href="" class="font-medium">
                  New Post
                </a>
                <div class="text-gray-600 mr-5 sm:mr-5">
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Directory & Files -->
      <!-- BEGIN: Pagination -->
      <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-6">
        <ul class="pagination">
          <li>
            <a class="pagination__link" href="">
              <ChevronsLeftIcon class="w-4 h-4" />
            </a>
          </li>
          <li>
            <a class="pagination__link" href="">
              <ChevronLeftIcon class="w-4 h-4" />
            </a>
          </li>
          <li>
            <a class="pagination__link" href="">...</a>
          </li>
          <li>
            <a class="pagination__link" href="">1</a>
          </li>
          <li>
            <a class="pagination__link pagination__link--active" href="">2</a>
          </li>
          <li>
            <a class="pagination__link" href="">3</a>
          </li>
          <li>
            <a class="pagination__link" href="">...</a>
          </li>
          <li>
            <a class="pagination__link" href="">
              <ChevronRightIcon class="w-4 h-4" />
            </a>
          </li>
          <li>
            <a class="pagination__link" href="">
              <ChevronsRightIcon class="w-4 h-4" />
            </a>
          </li>
        </ul>
        <select class="w-20 form-select box mt-3 sm:mt-0">
          <option>10</option>
          <option>25</option>
          <option>35</option>
          <option>50</option>
        </select>
      </div>
      <!-- END: Pagination -->
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({ })
</script>
