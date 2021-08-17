<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Update Profile</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <!-- BEGIN: Sidebar -->
      <Sidebar :user="this.user"></Sidebar>
      <!-- END: Sidebar -->
      <!-- BEGIN: Recent Postings -->
      <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-6 mt-5">
          <div
            v-for="post in this.postings"
            :key="post.id"
            class="intro-y col-span-12 md:col-span-6"
          >
            <div class="box">
              <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
                <div class="w-10 h-10 flex-none image-fit">
                  <img
                    alt=""
                    class="rounded-full"
                    :src="post?.user?.profile_picture"
                  />
                </div>
                <div class="ml-3 mr-auto">
                  <a href="javascript:;" class="font-medium">{{ post?.user?.name }}</a>
                  <div class="flex text-gray-600 truncate text-xs mt-0.5">
                    <a class="text-theme-1 dark:text-theme-10 inline-block truncate">
                      {{ post.created_at }}
                    </a>
                  </div>
                </div>
                <div class="dropdown ml-3">
                  <a href="javascript:;" class="dropdown-toggle w-5 h-5 text-gray-600 dark:text-gray-300" aria-expanded="false">
                    <MoreVerticalIcon class="w-5 h-5"/>
                  </a>
                  <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                      <a href="" data-dismiss="dropdown" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <FileIcon class="w-4 h-4 mr-2"/> View Post
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="p-5">
                <a class="block font-medium text-base">
                  {{ post.title }}
                </a>
                <div class="text-gray-700 dark:text-gray-600 mt-2" v-html="post.content !== null ? post?.content?.substring(0,200) + '...' : 'This post has no content!'"></div>
              </div>
              <div class="px-5 pt-3 pb-5 border-t border-gray-200 dark:border-dark-5">
                <div class="w-full flex text-gray-600 text-xs sm:text-sm">
                  <div class="mr-2">
                    <HeartIcon class="mr-1 h-4 w-4"></HeartIcon>{{ post.like_votes_count }}
                  </div>
                  <div class="mr-2">
                    <MessageCircleIcon class="mr-1 h-4 w-4"></MessageCircleIcon>{{ post.comments_count }}
                  </div>
                  <div class="mr-2">
                    <ClockIcon class="mr-1 h-4 w-4"></ClockIcon>{{ post.histories_count }}
                  </div>
                  <div class="ml-auto">
                    <span v-if="post.approved_at"><span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1">Public</span></span>
                    <span v-else><span class="px-2 py-1 rounded-full bg-theme-12 text-white mr-1">Not Approved</span></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-if="this?.postings?.length <= 0" class="intro-y col-span-12">
            <div class="box">
              <div class="p-5 text-center">
                <FolderIcon class="w-16 h-16 text-theme-1 mx-auto mt-5"/>
                <div class="text-3xl mt-5">No recent Posts</div>
                <div class="text-gray-600 mt-2 mb-5">
                  You have no Posts, but you can create a new one!
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Recent Postings -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'
import Sidebar from './Components/Sidebar'

export default defineComponent({
  components: {
    Sidebar
  },
  data() {
    return {
      user: {},
      postings: [],
      validation_error: {}
    }
  },
  mounted() {
    this.user = JSON.parse(localStorage.getItem('user'))
    this.fetchPostings(this.user.id)
  },
  methods: {
    fetchPostings(id) {
      axios.get('users/' + id + '/posts?paginate=0')
        .then(response => {
          this.postings = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
})
</script>
