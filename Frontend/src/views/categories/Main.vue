<template>
  <div class="grid grid-cols-12 gap-5">
    <div class="col-span-12 xxl:col-span-10">
      <div class="grid grid-cols-12 gap-5 mt-6 -mb-6">
        <!-- BEGIN: Blog Layout -->
        <div
          v-for="category in this.categories"
          v-bind:key="category.id"
          class="intro-y blog col-span-12 md:col-span-4 box"
        >
          <div class="blog__preview image-fit">
            <img
              :alt="'Thumbnail of ' + category.title"
              class="rounded-t-md"
              :src="category.thumbnail"
            />
            <div class="absolute w-full flex items-center px-5 pt-6 z-10">
              <div class="w-10 h-10 flex-none image-fit">
                <img
                  :alt="'Thumbnail of ' + category.title"
                  class="rounded-full"
                  :src="category.user?.profile_picture"
                />
              </div>
              <div class="ml-3 text-white mr-auto">
                <a href="" class="font-medium">{{ category.user?.name }}</a>
                <div class="text-xs mt-0.5">{{ category.updated_at }}</div>
              </div>
              <div class="dropdown ml-3" v-if='this.permissions?.categories_update'>
                <a
                  href="javascript:;"
                  class="blog__action dropdown-toggle w-8 h-8 flex items-center justify-center rounded-full"
                  aria-expanded="false"
                >
                  <MoreVerticalIcon class="w-4 h-4 text-white"/>
                </a>
                <div class="dropdown-menu w-40">
                  <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                      <Edit2Icon class="w-4 h-4 mr-2"/> Edit
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
              <a href="javascript:;" class="block font-medium text-xl mt-3" @click="this.showSubcategories(category)">
                {{ category.title }}
              </a>
            </div>
          </div>
          <div class="p-5 text-gray-700 dark:text-gray-600">
            {{ category.description.substring(0,200)+"..." }}
          </div>
          <div class="px-5 pt-3 pb-5 border-t border-gray-200 dark:border-dark-5">
            <div class="w-full flex text-gray-600 text-xs sm:text-sm">
              <div class="mr-3">
                <FolderIcon class="mr-1 w-5 h-5"></FolderIcon><span class="font-medium">Category</span>
              </div>
              <div class="ml-auto">
                <HeartIcon class="mr-1 ml-4 w-5 h-5"></HeartIcon><span class="font-medium">1</span>
                <EyeIcon class="mr-1 ml-4 w-5 h-5"></EyeIcon><span class="font-medium">1k</span>
                <BookmarkIcon class="mr-1 ml-4 w-5 h-5"></BookmarkIcon><span class="font-medium">3k</span>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Blog Layout -->
      </div>
    </div>
    <div class="col-span-12 xxl:col-span-2">
      <div class="xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-5">
          <div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3" v-if="this.selectedSubcategory !== 0">
            <div class="mt-5 intro-x">
              <button class="btn btn-primary shadow-md mr-2" @click="this.categories = this.all_categories; this.selectedSubcategory = 0">Back to Dashboard</button>
            </div>
          </div>
          <!-- BEGIN: Announcements -->
          <div class="col-span-12 md:col-span-6 xl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
            <div class="intro-x flex items-center h-10">
              <h2 class="text-lg font-medium truncate mr-auto">
                Announcements
              </h2>
              <button
                data-carousel="important-notes"
                data-target="prev"
                class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2"
                @click="prevImportantNotes"
              >
                <ChevronLeftIcon class="w-4 h-4" />
              </button>
              <button
                data-carousel="important-notes"
                data-target="next"
                class="tiny-slider-navigator btn px-2 border-gray-400 text-gray-700 dark:text-gray-300 mr-2"
                @click="nextImportantNotes"
              >
                <ChevronRightIcon class="w-4 h-4" />
              </button>
            </div>
            <div class="mt-5 intro-x">
              <div class="box zoom-in">
                <TinySlider ref-key="announcementsRef" v-if='!this.announcementsLoading'>
                  <div
                    class="p-5"
                    v-for='announce in this.announcements'
                    v-bind:key='announce.id'
                  >
                    <div class="text-base font-medium truncate">
                      {{ announce.title }}
                    </div>
                    <div class="text-gray-500 mt-1">20 Hours ago</div>
                    <div class="text-gray-600 text-justify mt-1">
                      {{ announce.description }}
                    </div>
                  </div>
                </TinySlider>
              </div>
            </div>
          </div>
          <!-- END: Announcements -->

          <!-- BEGIN: Transactions -->
          <div
            class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8"
          >
            <div class="intro-x flex items-center h-10">
              <h2 class="text-lg font-medium truncate mr-5">Recent Posts</h2>
            </div>
            <div class="mt-5">
              <div
                v-for="activity in this.recent"
                :key="activity.id"
                class="intro-x"
              >
                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                  <div
                    class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                  >
                    <img
                      alt=""
                      :src="activity?.user?.profile_picture"
                    />
                  </div>
                  <div class="ml-4 mr-auto">
                    <div class="font-medium">
                      {{ activity?.title }}
                    </div>
                    <div class="text-gray-600 text-xs mt-0.5">
                      {{ activity?.user?.name }}
                    </div>
                  </div>
                </div>
              </div>
              <a
                href=""
                class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600"
              >View More</a
              >
            </div>
          </div>
          <!-- END: Transactions -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, provide } from 'vue'
import axios from 'axios'

export default defineComponent({
  data() {
    return {
      recent: [],
      announcements: [],
      categories: [],
      all_categories: [],
      announcementsLoading: true,
      permissions: {},
      selectedSubcategory: 0
    }
  },
  mounted() {
    this.loadCategories()
    this.loadAnnouncements()
    this.loadRecent()
    this.testPagePermissions()
  },
  methods: {
    loadRecent() {
      axios.get('http://localhost:8000/api/posts?recent=5')
        .then((res) => {
          this.recent = res.data.data
        })
        .catch((err) => {
          console.log(err)
        })
    },
    loadAnnouncements() {
      axios.get('http://localhost:8000/api/announcements')
        .then((res) => {
          this.announcements = res.data.data
          this.announcementsLoading = false
        })
        .catch((err) => {
          console.log(err)
        })
    },
    loadCategories() {
      this.selectedSubcategory = 0
      axios.get('http://localhost:8000/api/categories/structured')
        .then((res) => {
          this.all_categories = res.data.data
          this.categories = res.data.data
        })
        .catch((err) => {
          console.log(err)
        })
    },
    showSubcategories(category) {
      if (category.children.length > 0) {
        this.loadPosts(category.id)
        this.categories = category.children
        this.selectedSubcategory = category.id
      }
    },
    loadPosts(id) {
      axios.get()
    },
    testPagePermissions() {
      axios.post('http://localhost:8000/api/permissions/test', {
        permissions: [
          'categories_update'
        ]
      })
        .then((response) => {
          this.permissions = response.data.data
        })
        .catch((err) => {
          console.error(err)
          console.log(err.response)
        })
    }
  },
  setup() {
    const announcementsRef = ref()

    provide('bind[announcementsRef]', el => {
      announcementsRef.value = el
    })

    const prevImportantNotes = () => {
      const el = announcementsRef.value
      el.tns.goTo('prev')
    }
    const nextImportantNotes = () => {
      const el = announcementsRef.value
      el.tns.goTo('next')
    }

    return {
      prevImportantNotes,
      nextImportantNotes
    }
  }
})
</script>
