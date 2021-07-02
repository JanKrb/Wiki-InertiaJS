<template>
  <div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12">
      <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
        <div class="intro-y col-span-12 sm:col-span-12 md:col-span-12 xxl:col-span-12">
          <div class="file box rounded-md px-5 pt-2 pb-5 px-3 sm:px-5 relative bg-gray-600">
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
      <!-- BEGIN: File Manager Menu -->
      <div class="intro-y box p-5 mt-6">
        <h2 class="intro-y text-lg font-medium mr-auto mt-2">
          Search Filter
        </h2>
        <div class="border-t border-gray-200 dark:border-dark-5 mt-4 pt-4">
          <a href="" class="flex items-center px-3 py-2 rounded-md">
            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
            Postings
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
            Categories
          </a>
          <a href="" class="flex items-center px-3 py-2 mt-2 rounded-md">
            <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
            Authors
          </a>
        </div>
      </div>
      <!-- END: File Manager Menu -->
    </div>
    <div class="col-span-12 lg:col-span-9 xxl:col-span-10">
      <!-- BEGIN: List all results -->
      <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
        <!-- BEGIN: Category Results -->
        <div
          v-for="result in this.search_results.categories"
          :key="result"
          class="intro-y col-span-12 sm:col-span-12 md:col-span-12 xxl:col-span-12"
        >
          <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative border-l-2 border-theme-9 pl-4">
            <div class="relative flex items-center">
              <div class="w-12 h-12 flex-none image-fit">
                <img alt="" class="rounded" :src="result.thumbnail ? result.thumbnail : './assets/images/placeholder.png'">
              </div>
              <div class="ml-4 mr-auto">
                <a href="javascript:;" class="font-medium" @click="this.$router.push({ name: 'categories.subcategory', params: { id: result.id } })">
                  {{ result.title }}
                </a>
                <div class="text-gray-600 mr-5 sm:mr-5">
                  {{ result.description.substring(0,400)+"..." }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Category Results -->
        <!-- BEGIN: Category Results -->
        <div
          v-for="result in this.search_results.posts"
          :key="result"
          class="intro-y col-span-12 sm:col-span-12 md:col-span-12 xxl:col-span-12"
        >
          <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative border-l-2 border-theme-11 pl-4">
            <div class="relative flex items-center">
              <div class="w-12 h-12 flex-none image-fit">
                <img alt="" class="rounded" :src="result.thumbnail ? result.thumbnail : './assets/images/placeholder.png'">
              </div>
              <div class="ml-4 mr-auto">
                <a href="javascript:;" class="font-medium" @click="this.$router.push({ name: 'categories.subcategory', params: { id: result.id } })">
                  {{ result.title }}
                </a>
                <div class="text-gray-600 mr-5 sm:mr-5">
                  {{ result.content.substring(0,400)+"..." }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Category Results -->
      </div>
      <!-- END: List all results -->
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
import axios from 'axios'

export default defineComponent({
  data() {
    return {
      search_results: {
        categories: [],
        posts: [],
        users: []
      }
    }
  },
  mounted() {
    this.search('Lorem')
  },
  methods: {
    search(keywords) {
      axios.get('http://localhost:8000/api/search', {
        params: {
          keywords: keywords
        }
      })
        .then(response => {
          console.log(response)
          this.search_results.categories = response.data.data.cats
          this.search_results.posts = response.data.data.posts
          this.search_results.users = response.data.data.users
        })
        .catch(error => {
          console.error(error)
          console.error(error.response)
        })
    }
  }
})
</script>
