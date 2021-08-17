<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">User Account</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <Sidebar :user="this.user"></Sidebar>
      <!-- BEGIN: Postings -->
      <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-6 mt-5">
          <div
            v-for="post in this.posts"
            :key="post.id"
            class="intro-y col-span-12 md:col-span-6"
          >
            <div class="box">
              <div class="flex items-center border-b border-gray-200 dark:border-dark-5 px-5 py-4">
                <div class="w-10 h-10 flex-none image-fit">
                  <img
                    alt=""
                    class="rounded-full"
                    :src="post.user.profile_picture ? post.user.profile_picture : require('@/assets/images/placeholder.png')"
                  />
                </div>
                <div class="ml-3 mr-auto">
                  <router-link :to="{ name: 'admin.accounts.informations', params: { 'id': post.id }}">
                    <a href="javascript:;" class="font-medium">{{ post.user.name }}</a>
                  </router-link>
                  <div class="flex text-gray-600 truncate text-xs mt-0.5">
                    <router-link :to="{ name: 'categories.subcategory', params: { 'id': post?.parent?.id }}">
                      <a class="text-theme-1 dark:text-theme-10 inline-block truncate">
                        {{ post?.parent?.title }}
                      </a>
                    </router-link>
                    <span class="mx-1">•</span> {{ post.created_at }}
                  </div>
                </div>
                <div class="dropdown ml-3">
                  <a href="javascript:;" class="dropdown-toggle w-5 h-5 text-gray-600 dark:text-gray-300" aria-expanded="false">
                    <MoreVerticalIcon class="w-5 h-5"/>
                  </a>
                  <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                      <router-link :to="{ name: 'posts.view', params: { 'id': post.id }}">
                        <a href="" data-dismiss="dropdown" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                          <FileIcon class="w-4 h-4 mr-2"/> View Post
                        </a>
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>
              <div class="p-5">
                <a class="block font-medium text-base">
                  {{ post.title }}
                </a>
                <div class="text-gray-700 dark:text-gray-600 mt-2" v-html="post?.content?.substring(0,200) + '...'"></div>
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
                    <span v-if="post.approved_at"><span class="px-2 py-1 rounded-full bg-theme-9 text-white mr-1 dark:text-black">Public</span></span>
                    <span v-else><span class="px-2 py-1 rounded-full bg-theme-12 text-white mr-1 dark:text-black">Not Approved</span></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div v-if="this.posts.length <= 0" class="intro-y col-span-12">
          <div class="box">
            <div class="p-5 text-center">
              <FolderIcon class="w-16 h-16 text-theme-1 mx-auto mt-5"/>
              <div class="text-3xl mt-5">No recent Posts</div>
              <div class="text-gray-600 mt-2 mb-5">
                This user have no Posts!
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Postings-->
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Sidebar from './Components/Sidebar.vue'
import axios from 'axios'

export default defineComponent({
  components: {
    Sidebar
  },
  setup() {
    const select = ref('1')
    return {
      select
    }
  },
  data() {
    return {
      user: {},
      posts: []
    }
  },
  mounted() {
    this.fetchUser(this.$route.params.id)
  },
  methods: {
    fetchUser(id) {
      const loader = this.$loading.show()
      axios.get('users/' + id)
        .then(response => {
          this.user = response.data.data
          loader.hide()
          this.fetchPosts(id)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
          this.$router.push({ name: 'admin.accounts' })
        })
    },
    fetchPosts(id) {
      const loader = this.$loading.show()
      axios.get('users/' + id + '/posts?paginate=0')
        .then(response => {
          this.posts = response.data.data
          loader.hide()
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    }
  }
})
</script>
