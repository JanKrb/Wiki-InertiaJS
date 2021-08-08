<template>
  <div>
    <div class="grid grid-cols-12 gap-6 mt-5">
      <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:mr-auto">
          <!-- BEGIN: Search Filter -->
          <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
            <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
              <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700 dark:text-gray-300"/>
              <input
                type="text"
                class="form-control w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-13"
                placeholder="Search..."
                v-model='keywords'
              />
            </div>
          </div>
          <!-- END: Search Filter -->
        </div>
      </div>
      <!-- BEGIN: Data List -->
      <div class="col-span-12">
        <div class="grid grid-cols-12 gap-5 mt-6 -mb-6">
          <div
            v-for="post in this.filteredPosts"
            v-bind:key="post.id"
            class="intro-y blog col-span-12 md:col-span-4 box"
          >
            <div class="blog__preview image-fit">
              <img
                :alt="'Thumbnail of ' + post?.title"
                class="rounded-t-md"
                :src="post?.thumbnail ? post?.thumbnail : require('@/assets/images/placeholder.png')"
              />
              <div class="absolute w-full flex items-center px-5 pt-6 z-10">
                <div class="w-10 h-10 flex-none image-fit">
                  <img
                    :alt="'Profile Picture of ' + post?.user?.name"
                    class="rounded-full"
                    :src="post?.user?.profile_picture"
                  />
                </div>
                <div class="ml-3 text-white mr-auto">
                  <a href="" class="font-medium">{{ post?.user?.name }}</a>
                  <div class="text-xs mt-0.5">{{ post?.updated_at }}</div>
                </div>
                <div class="dropdown ml-3" v-if='this.permissions?.posts_update'>
                  <a
                    href='javascript:'
                    class="blog__action dropdown-toggle w-8 h-8 flex items-center justify-center rounded-full"
                    aria-expanded="false"
                  >
                    <MoreVerticalIcon class="w-4 h-4 text-white"/>
                  </a>
                  <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                      <a href="javascript:;" data-dismiss="dropdown" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" @click="approvePost(post)">
                        <ShareIcon class="w-4 h-4 mr-2"/> Publish
                      </a>
                      <a href="javascript:;" @click="this.$router.push({ name: 'moderation.posts.edit', params: { id: post.id } })" data-dismiss="dropdown" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <Edit2Icon class="w-4 h-4 mr-2"/> Edit
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="absolute bottom-0 text-white px-5 pb-6 z-10">
                <a href="javascript:;" class="block font-medium text-xl mt-3" @click="this.$router.push({ name: 'posts.view', params: { id: post.id } })">
                  {{ post?.title }}
                </a>
              </div>
            </div>
            <div class="px-5 pt-3 pb-5 border-b border-gray-200 dark:border-dark-5">
              <div class="w-full flex text-gray-600 text-xs sm:text-sm">
                <div class="mr-3">
                  <span class="font-medium">{{ this.formatDate(post.created_at) }}</span>
                </div>
                <div class="ml-auto">
                  <span class="px-2 py-1 rounded-full bg-theme-6 text-white" v-if="!post.approved_at">Unauthorized</span>
                </div>
              </div>
            </div>
            <div class="p-5 text-gray-700 dark:text-gray-600" v-html="post?.content?.substring(0,200)"></div>{{ post.content?.length > 200 ? '...' : '' }}
          </div>
        </div>
      </div>
        <!-- END: Posts Layout -->
      <!-- END: Data List -->
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'
import moment from 'moment'
import { useToast } from 'vue-toastification'

const toast = useToast()
export default defineComponent({
  data() {
    return {
      posts: [],
      keywords: '',
      permissions: [],
      search_type: 0
    }
  },
  mounted() {
    this.testPagePermissions()
    this.fetchPosts()
  },
  computed: {
    unauthorizedPosts: function () {
      return this.posts.filter((post) => {
        return !post.approved_by && !post.approved_at
      })
    },
    filteredPosts: function () {
      return this.unauthorizedPosts.filter((post) => {
        return post.title.toLowerCase().match(this.keywords.toLowerCase()) || post.content.toLowerCase().match(this.keywords.toLowerCase())
      })
    }
  },
  methods: {
    fetchPosts() {
      axios.get('http://localhost:8000/api/posts')
        .then((response) => {
          this.posts = response.data.data
        })
        .catch((error) => {
          console.error(error)
        })
    },
    approvePost(post) {
      axios.put('http://localhost:8000/api/posts/' + post.id, {
        title: post.title,
        content: post.content,
        thumbnail: post.thumbnail,
        approve: true
      })
        .then(response => {
          toast.success('Post successfully approved')
          this.fetchPosts()
        })
        .catch(error => {
          console.error(error)
          console.log(error.response)
        })
    },
    formatDate(timeString) {
      return moment(String(timeString)).format('MMM Do YYYY  hh:mm')
    },
    testPagePermissions() {
      axios.post('http://localhost:8000/api/permissions/test', {
        permissions: [
          'posts_update'
        ]
      })
        .then((response) => {
          this.permissions = response.data.data
        })
        .catch((err) => {
          console.error(err)
        })
    }
  },
  watch: {
    search: function (val) {
      this.searchBadges(val)
    },
    per_page: function (val) {
      this.fetchBadges('http://localhost:8000/api/badges?page=' + this.pagination.meta.current_page)
    }
  }
})
</script>
