<template>
  <div>
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
                    <div class="text-xs text-gray-500 ml-auto">{{ history?.created_at }}</div>
                  </div>
                  <div class="text-gray-600 mt-1">{{ history?.content }}</div>
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
            <div class="modal-body p-0">
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
    <div class="intro-y news xl:w-4/5 p-10 box mt-8">
      <!-- BEGIN: Blog Layout -->
      <div class="flex items-center px-5 py-4">
        <div class="mr-auto">
          <h2 class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">
            {{ this.post?.title }}
          </h2>
          <div class="flex text-gray-600 truncate text-xs mt-0.5">
            {{ this.post?.created_at }} <span class="mx-1">•</span>
            <router-link class="text-theme-1 dark:text-theme-10" :to="{ name: 'categories.subcategory', params: { 'id': this.post?.parent?.id } }">
              {{ this.post?.parent?.title }}
            </router-link>
            <span class="mx-1">•</span> {{ this.post?.content.split(' ').length / 800 * 60 }} Min read
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
            </div>
          </div>
        </div>
      </div>
      <div class="intro-y mt-6">
        <div class="news__preview image-fit">
          <img
            alt=""
            class="rounded-md"
            src="https://images.pexels.com/photos/2469122/pexels-photo-2469122.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
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
              :class="'rounded-full border border-white zoom-in' + (index !== 0 ? ' -ml-' + (index * 4) : '')"
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
      <div class="intro-y text-justify leading-relaxed">
        <p>{{ this.post?.content }}</p>
      </div>
      <div
        class="intro-y flex text-xs sm:text-sm flex-col sm:flex-row items-center mt-5 pt-5 border-t border-gray-200 dark:border-dark-5"
      >
        <div class="flex items-center">
          <div class="w-12 h-12 flex-none image-fit">
            <img
              alt=""
              class="rounded-full"
              :src="this.post?.user?.profile_picture"
            />
          </div>
          <div class="ml-3 mr-auto">
            <a href="" class="font-medium">
              {{ this.post?.user?.name }}
            </a>, Author
            <div class="text-gray-600">{{ this.post?.user?.email }}</div>
          </div>
        </div>
        <div
          class="flex items-center text-gray-700 dark:text-gray-600 sm:ml-auto mt-5 sm:mt-0"
        >
          Rate this Post:
          <Tippy
            tag="div"
            v-on:click='this.votePost(1)'
            :class="'w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center ml-2 zoom-in ' + (this.post?.liked === 1 ? 'border border-blue-500 text-blue-500' : 'border dark:border-dark-5 text-gray-500')"
            content="Like"
          >
            <ThumbsUpIcon class="w-3 h-3 fill-current" />
          </Tippy>
          <Tippy
            tag="div"
            v-on:click='this.votePost(2)'
            :class="'w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center ml-2 zoom-in ' + (this.post?.liked === 2 ? 'border border-blue-500 text-blue-500' : 'border dark:border-dark-5 text-gray-500')"
            content="Dislike"
          >
            <ThumbsDownIcon class="w-3 h-3 fill-current" />
          </Tippy>
        </div>
      </div>
      <!-- END: Blog Layout -->
      <!-- BEGIN: Comments -->
      <div class="intro-y my-5 pt-5 border-t border-gray-200 dark:border-dark-5">
        <div class="text-base sm:text-lg font-medium">
          Comments
        </div>
        <div class="news__input relative mt-5">
          <MessageCircleIcon
            class="w-5 h-5 absolute my-auto inset-y-0 ml-6 left-0 text-gray-600"
          />

          <textarea
            class="form-control border-transparent bg-gray-300 pl-16 py-6 placeholder-theme-13 resize-none"
            rows="1"
            placeholder="Post a comment..."
            v-model='comment'
          ></textarea>

          <SendIcon
            class="w-5 h-5 absolute my-auto inset-y-0 mr-6 right-0 text-gray-600"
            v-on:click='writeComment()'
          />
        </div>
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
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'
import { useToast } from 'vue-toastification'

const toast = useToast()

export default defineComponent({
  data() {
    return {
      post: {
        title: '',
        content: '',
        parent: {},
        post_comments: []
      },
      comment: '',
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
    this.loadHistory()
  },
  methods: {
    loadPost(id) {
      axios.get('http://localhost:8000/api/posts/' + id)
        .then(response => {
          this.post = response.data.data
          this.loadComments(id)
          this.loadBookmarks(id)
        })
        .catch(error => {
          console.error(error)
        })
    },
    loadComments(id) {
      axios.get('http://localhost:8000/api/posts/' + id + '/comments', {
        params: {
          sort: {
            column: 'updated_at',
            method: 3
          }
        }
      })
        .then(response => {
          this.post.post_comments = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    loadBookmarks(id) {
      axios.get('http://localhost:8000/api/posts/' + id + '/bookmarks', {
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
          console.log(error.response)
        })
    },
    votePost(vote) {
      if (vote === this.post?.liked) {
        vote = 0
      }

      axios.post('http://localhost:8000/api/posts/' + this.$route.params.id + '/votes', {
        vote: vote
      })
        .then(response => {
          this.post.liked = response.data.data.vote
        })
        .catch(error => {
          console.error(error)
          console.log(error.response)
        })
    },
    bookmarkPost() {
      if (this.isBookmarked !== 0) {
        axios.delete('http://localhost:8000/api/bookmarks/' + this.isBookmarked)
          .then(response => {
            this.loadBookmarks(this.$route.params.id)
            toast.success('Post has been unbookmarked')
          })
          .catch(error => {
            console.error(error)
          })

        return
      }

      axios.post('http://localhost:8000/api/bookmarks', {
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

      axios.post('http://localhost:8000/api/posts/' + this.$route.params.id + '/comments', {
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
      axios.post('http://localhost:8000/api/posts/' + this.$route.params.id + '/reports', {
        content: content
      })
        .then(response => {
          toast.success('The post was successfully reported')
        })
    },
    loadHistory() {
      axios.get('http://localhost:8000/api/posts/' + this.$route.params.id + '/histories')
        .then(response => {
          this.histories = response.data.data
          console.log(response)
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
})
</script>
