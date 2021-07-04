<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Update Profile</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <!-- BEGIN: Sidebar -->
      <Sidebar :user="this.user"></Sidebar>
      <!-- END: Sidebar -->
      <!-- BEGIN: Recent Bookmarks -->
      <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <div class="grid grid-cols-12 gap-4 mt-5">
          <div
            v-for="bookmark in this.bookmarks"
            :key="bookmark.id"
            class="intro-y col-span-12 md:col-span-6"
          >
            <router-link :to="{ name: bookmark.is_post ? 'posts.view' : 'categories.subcategory', params: { id: bookmark.is_post ? bookmark?.post?.id : bookmark?.category?.id }}">
              <div class="intro-y">
                <div class="box px-4 py-4 flex items-center zoom-in">
                  <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                    <img alt="" :src="bookmark?.post?.thumbnail ? bookmark?.post?.thumbnail : require('@/assets/images/placeholder.png')" v-if="bookmark?.is_post">
                    <img alt="" :src="bookmark?.category?.thumbnail ? bookmark?.category?.thumbnail : require('@/assets/images/placeholder.png')" v-if="bookmark?.is_category">
                  </div>
                  <div class="ml-4 mr-auto">
                    <div class="font-medium">
                      {{ bookmark?.post?.title }} {{ bookmark?.category?.title }}
                    </div>
                    <div class="text-gray-600 text-xs mt-0.5">
                      {{ bookmark.created_at }}
                    </div>
                  </div>
                  <div class="py-1 px-2 text-gray-600 cursor-pointer font-medium">
                    <span v-if="bookmark.is_category">
                        <FolderIcon class="mr-3"></FolderIcon>Category
                    </span>
                    <span v-if="bookmark.is_post">
                        <FileTextIcon class="mr-3"></FileTextIcon>Post
                    </span>
                  </div>
                </div>
              </div>
            </router-link>
          </div>
          <div v-if="this.bookmarks.length <= 0" class="intro-y col-span-12">
            <div class="box">
              <div class="p-5 text-center">
                <BookmarkIcon class="w-16 h-16 text-theme-1 mx-auto mt-5"/>
                <div class="text-3xl mt-5">No recent Bookmarks</div>
                <div class="text-gray-600 mt-2 mb-5">
                  You have no Bookmarks, but you can subscribe to a new one!
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Recent Bookmarks -->
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
      bookmarks: [],
      validation_error: {}
    }
  },
  mounted() {
    this.fetchUser()
  },
  methods: {
    fetchUser() {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/auth/user')
        .then(response => {
          this.user = response.data.data.user
          loader.hide()
          this.fetchBookmarks(response.data.data.user.id)
        })
        .catch(error => {
          console.log(error)
          loader.hide()
        })
    },
    fetchBookmarks() {
      axios.get('http://localhost:8000/api/users/' + this.user.id + '/bookmarks')
        .then(response => {
          console.log(response)
          this.bookmarks = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
})
</script>
