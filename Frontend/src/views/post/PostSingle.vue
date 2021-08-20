<template>
  <div>
    <!-- BEGIN: Report Post Modal -->
    <div
      id="report-post-modal"
      class="modal"
      tabindex="-1"
      aria-hidden="true"
    >
      <form @submit.prevent="this.sendReport(this.report.content)">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body pt-5 mt-10">
              <div class="p-5 text-center">
                <AlertCircleIcon class="w-16 h-16 text-theme-6 mx-auto mt-3" />
                <div class="text-3xl mt-5">Please write a Report reason!</div>
                <div class="text-gray-600 mt-2">
                  <textarea rows="3" class="form-control" v-model="report.content" required></textarea>
                </div>
              </div>
              <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">
                  Cancel
                </button>
                <button type="submit" data-dismiss="modal" class="btn btn-danger w-24">
                  Submit
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- BEGIN: Report Post Modal -->
    <!-- BEGIN: Post History Slide -->
    <div id="post-history-slider" class="modal modal-slide-over" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header p-5">
            <h2 class="font-medium text-base mr-auto">
              Post History
            </h2>
          </div>
          <div class="modal-body">
            <div class="report-timeline mt-5 relative">
              <div class="intro-x relative flex items-center mb-3" v-for="history in this.histories" v-bind:key="history.id">
                <div class="report-timeline__image">
                  <div
                    class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden"
                  >
                    <img
                      alt=""
                      :src="history?.user?.profile_picture"
                    />
                  </div>
                </div>
                <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                  <div class="flex items-center">
                    <div class="font-medium">
                      {{ history?.title }}
                    </div>
                    <div class="text-xs text-gray-500 ml-auto">{{ this.formatDate(history?.created_at) }}</div>
                  </div>
                  <div class="text-gray-600 mt-1" v-html="history?.content"></div>
                </div>
              </div>
            </div>
            <div class="p-5 text-center" v-if="this.histories.length === 0">
              <XCircleIcon class="w-16 h-16 text-theme-6 mx-auto mt-3" />
              <div class="text-3xl mt-5">No History!</div>
              <div class="text-gray-600 mt-2">
                This post has no recent History
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Post History Slide -->
    <div class="col-span-12 grid grid-cols-12 gap-6 mt-8">
      <div class="col-span-12 lg:col-span-8 intro-y">
        <div class="box news p-5">
          <div class="flex items-center px-5 py-4">
            <div class="mr-auto">
              <h2 class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">
                {{ this.post?.title }}
              </h2>
              <div class="flex text-gray-600 truncate text-xs mt-0.5">
                {{ this.formatDate(this.post?.created_at) }} <span class="mx-1">•</span>
                <router-link class="text-theme-1 dark:text-theme-10" :to="{ name: 'categories.subcategory', params: { 'id': this.post?.parent?.id } }">
                  {{ this.post?.parent?.title }}
                </router-link>
                <span class="mx-1">•</span> {{ Math.round(this.post?.content.split(' ').length / 3000 * 60 * 100) / 100 }} Min read
              </div>
            </div>
            <div class="dropdown ml-3">
              <a href="javascript:;" class="dropdown-toggle w-5 h-5 text-gray-600 dark:text-gray-300" aria-expanded="false">
                <MoreVerticalIcon></MoreVerticalIcon>
              </a>
              <div class="dropdown-menu w-40">
                <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                  <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" data-toggle="modal" data-target="#report-post-modal" data-dismiss="dropdown">
                    <SlashIcon class="mr-3"></SlashIcon>
                    Report Post
                  </a>
                  <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" data-toggle="modal" data-target="#post-history-slider" data-dismiss="dropdown">
                    <ClockIcon class="mr-3"></ClockIcon>
                    Post History
                  </a>
                  <a v-if="this.permissions?.posts_update" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" @click="this.$router.push({ name: 'moderation.posts.edit', params: { id: this.post.id }})" data-dismiss="dropdown">
                    <Edit2Icon class="mr-3"></Edit2Icon>
                    Edit
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="intro-y mt-6">
            <div class="news__preview image-fit">
              <img
                alt=""
                class="rounded-md"
                :src="this.post?.thumbnail ? this.post?.thumbnail : require('@/assets/images/placeholder.png')"
              />
            </div>
          </div>
          <div class="intro-y flex relative pt-16 sm:pt-6 items-center pb-6">
            <Tippy
              tag="div"
              :class="'intro-x w-8 h-8 sm:w-10 sm:h-10 flex flex-none items-center justify-center rounded-full mr-3 border dark:bg-dark-5 ' + (this.isBookmarked !== 0 ? 'border-blue-500 dark:border-blue-500 text-blue-500' : 'border-gray-400 text-gray-600 dark:border-dark-5 dark:text-gray-300')"
              content="Bookmark"
              v-on:click='this.bookmarkPost()'
            >
              <BookmarkIcon class="w-3 h-3" />
            </Tippy>
            <div class="intro-x flex mr-3">
              <div
                class="intro-x w-8 h-8 sm:w-10 sm:h-10 image-fit"
                v-for='(item, index) in this.bookmarks'
                v-bind:key='index'
              >
                <Tippy
                  tag="img"
                  alt=""
                  :class="'rounded-full border border-white zoom-in ' + (index !== 0 ? ' -ml-' + (index * 4) : '')"
                  :src="item.user?.profile_picture"
                  :content="item.user?.pre_name + ' ' + item.user?.last_name"
                />
              </div>
            </div>
            <div class="absolute sm:relative -mt-12 sm:mt-0 w-full flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm">
              <div class="intro-x sm:mr-3 ml-auto">
                Comments: <span class="font-medium mr-4">{{ this.post?.comments_count }}</span>
                Changes: <span class="font-medium mr-4">{{ this.post?.histories_count }}</span>
                Likes: <span class="font-medium">{{ this.post?.like_votes_count }} / {{ this.post?.dislike_votes_count }}</span>
              </div>
            </div>
          </div>
          <div class="intro-y text-justify leading-relaxed" v-html="this.post?.content"></div>
          <!-- END: Blog Layout -->
        </div>
      </div>
      <div class="col-span-12 lg:col-span-4 intro-y">
        <!-- BEGIN: Rating -->
        <div class="box p-5 news mb-6">
          <div class="intro-y flex text-xs sm:text-sm flex-col sm:flex-row items-center" v-bind:class="{ 'border-b border-gray-200 dark:border-dark-5 mb-3 pb-5' : post.tags.length > 0 }">
            <div class="flex items-center">
              <div class="w-12 h-12 flex-none image-fit">
                <img
                  alt=""
                  class="rounded-full"
                  :src="this.post?.user?.profile_picture"
                />
              </div>
              <div class="ml-3 mr-auto">
                <a class="font-medium">
                  {{ this.post?.user?.name }}
                </a>, {{ this.post?.user?.role?.name }}
                <div class="text-gray-600">{{ this.post?.user?.email }}</div>
              </div>
            </div>
            <div
              class="flex items-center text-gray-700 dark:text-gray-600 sm:ml-auto mt-5 sm:mt-0"
            >
              <div class="hidden xl:block">Rate this Post:</div>
              <Tippy
                tag="div"
                v-on:click='this.votePost(1)'
                :class="'w-12 h-12 md:w-9 md:h-9 rounded-full flex items-center justify-center ml-2 zoom-in ' + (this.post?.liked === 1 ? 'border border-blue-500 text-blue-500' : 'border dark:border-dark-5 text-gray-500')"
                content="Like"
              >
                <ThumbsUpIcon class="w-5 h-5 md:w-3 md:h-3 fill-current" />
              </Tippy>
              <Tippy
                tag="div"
                v-on:click='this.votePost(2)'
                :class="'w-12 h-12 md:w-9 md:h-9 rounded-full flex items-center justify-center ml-2 zoom-in ' + (this.post?.liked === 2 ? 'border border-blue-500 text-blue-500' : 'border dark:border-dark-5 text-gray-500')"
                content="Dislike"
              >
                <ThumbsDownIcon class="w-5 h-5 md:w-3 md:h-3 fill-current" />
              </Tippy>
            </div>
          </div>
          <!-- BEGIN: Post Tags -->
          <div v-if="this.post.tags.length > 0">
            <button
              class="bg-gray-200 py-1 px-2 rounded-lg mr-2 flex"
              :style="'color: ' + tag.color + ';'"
              v-for="tag in this.post.tags"
              v-bind:key="tag.id"
            >
              <component :is="tag.icon" class="mr-1 h-4 w-4"></component>{{ tag.name }}
            </button>
          </div>
          <!-- END: Post Tags -->
        </div>
        <!-- END: Rating -->

        <!-- BEGIN: Comment Box -->
        <div class="box p-5 news">
          <!-- BEGIN: Comments -->
          <div class="intro-y my-5">
            <div class="text-base sm:text-lg font-medium">
              Comments
            </div>
            <form @submit.prevent="writeComment()">
              <div class="news__input relative mt-5">
                <MessageCircleIcon class="w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"/>
                <input
                  type="text"
                  class="form-control border-transparent bg-gray-300 pl-16 py-6 placeholder-theme-13 resize-none"
                  rows="1"
                  placeholder="Post a comment..."
                  v-model='comment'
                >
                <Button type="submit">
                  <SendIcon class="w-5 h-5 absolute my-auto inset-y-0 mr-6 right-0 text-gray-600"/>
                </Button>
              </div>
            </form>
          </div>
          <div class="pb-3" v-for="comment in this.post.post_comments" v-bind:key="comment.id">
            <div class="flex box p-3 bg-gray-200">
              <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit">
                <img
                  alt=""
                  class="rounded-full"
                  :src="comment?.user?.profile_picture"
                />
              </div>
              <div class="ml-3 flex-1">
                <div class="flex items-center">
                  <a href="" class="font-medium">{{ comment?.user?.name }}</a>
                  <button
                    class="ml-auto text-xs text-gray-600"
                    v-on:click='this.comment = "@" + comment?.user?.name'
                  >
                    Reply
                  </button>
                </div>
                <div class="text-gray-600 text-xs sm:text-sm">
                  {{ comment?.created_at }}
                </div>
                <div class="mt-2">{{ comment?.content }}</div>
              </div>
            </div>
          </div>
          <!-- END: Comments -->
        </div>
        <!-- END: Comment Box -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'
import { useToast } from 'vue-toastification'
import moment from 'moment'

const toast = useToast()

export default defineComponent({
  data() {
    return {
      post: {
        title: '',
        content: '',
        parent: {},
        tags: [],
        post_comments: []
      },
      comment: '',
      permissions: {},
      bookmarks: [], // Recent 5
      isBookmarked: false,
      report: {
        content: ''
      },
      histories: []
    }
  },
  mounted() {
    this.loadPost(this.$route.params.id)
  },
  methods: {
    loadPost(id) {
      axios.get('posts/' + id)
        .then(response => {
          this.post = response.data.data
          this.loadComments(id)
          this.testPagePermissions()
          this.loadBookmarks(id)
          this.loadHistory()
        })
        .catch(error => {
          console.error(error)
          toast.error(error.response.data.message)
          this.$router.push({ name: 'categories' })
        })
    },
    loadComments(id) {
      axios.get('posts/' + id + '/comments?paginate=0&sort.column=updated_at&sort.method=desc')
        .then(response => {
          this.post.post_comments = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    loadBookmarks(id) {
      axios.get('posts/' + id + '/bookmarks', {
        params: {
          recent: 5
        }
      })
        .then(response => {
          this.bookmarks = response.data.data

          const isBookmarkedArr = this.bookmarks.filter((item) => {
            return item.user.id === JSON.parse(localStorage.getItem('user')).id
          })

          this.isBookmarked = (isBookmarkedArr.length > 0) ? isBookmarkedArr[0].id : 0
        })
        .catch(error => {
          console.error(error)
        })
    },
    votePost(vote) {
      if (vote === this.post?.liked) {
        vote = 0
      }

      axios.post('posts/' + this.$route.params.id + '/votes', {
        vote: vote
      })
        .then(response => {
          this.post.liked = response.data.data.vote
        })
        .catch(error => {
          console.error(error)
        })
    },
    bookmarkPost() {
      if (this.isBookmarked !== 0) {
        axios.delete('bookmarks/' + this.isBookmarked)
          .then(response => {
            this.loadBookmarks(this.$route.params.id)
            toast.success('Post has been unbookmarked')
          })
          .catch(error => {
            console.error(error)
          })

        return
      }

      axios.post('bookmarks', {
        is_post: 1,
        post_id: this.$route.params.id
      })
        .then(response => {
          this.loadBookmarks(this.$route.params.id)
          toast.success('Post has been bookmarked')
        })
        .catch(error => {
          console.error(error)
        })
    },
    writeComment() {
      const comment = this.comment
      this.comment = ''

      axios.post('posts/' + this.$route.params.id + '/comments', {
        content: comment
      })
        .then(response => {
          this.post.post_comments.push(response.data.data)
          toast.success('Comment has successfully been posted.')
        })
        .catch(error => {
          console.error(error)
        })
    },
    sendReport(content) {
      axios.post('posts/' + this.$route.params.id + '/reports', {
        content: content
      })
        .then(response => {
          toast.success('The post was successfully reported')
        })
    },
    loadHistory() {
      axios.get('posts/' + this.$route.params.id + '/histories')
        .then(response => {
          this.histories = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    testPagePermissions() {
      axios.post('permissions/test', {
        permissions: [
          'categories_update',
          'categories_delete',
          'posts_update',
          'posts_delete'
        ]
      })
        .then((response) => {
          this.permissions = response.data.data
        })
        .catch((error) => {
          console.error(error)
        })
    },
    formatDate(timeString) {
      return moment(String(timeString)).format('MMM Do YYYY  hh:mm')
    }
  }
})
</script>
