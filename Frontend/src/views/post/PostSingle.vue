<template>
  <div>
    <div class="intro-y news xl:w-4/5 p-10 box mt-8">
      <!-- BEGIN: Blog Layout -->
      <h2 class="intro-y font-medium text-xl sm:text-2xl">
        {{ this.post?.title }}
      </h2>
      <div class="intro-y text-gray-700 dark:text-gray-600 mt-3 text-xs sm:text-sm">
        {{ this.post?.created_at }} <span class="mx-1">•</span>
        <router-link class="text-theme-1 dark:text-theme-10" :to="{ name: 'categories.subcategory', params: { 'id': this.post?.parent?.id } }">
            {{ this.post?.parent?.title }}
        </router-link>
        <span class="mx-1">•</span> {{ this.post?.content.split(' ').length / 800 * 60 }} Min read
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
          tag="a"
          href=""
          class="intro-x w-8 h-8 sm:w-10 sm:h-10 flex flex-none items-center justify-center rounded-full border border-gray-400 dark:border-dark-5 dark:bg-dark-5 dark:text-gray-300 text-gray-600 mr-3"
          content="Bookmark"
        >
          <BookmarkIcon class="w-3 h-3" />
        </Tippy>
        <div class="intro-x flex mr-3">
          <div class="intro-x w-8 h-8 sm:w-10 sm:h-10 image-fit">
            <Tippy
              tag="img"
              alt=""
              class="rounded-full border border-white zoom-in"
              src="https://images.pexels.com/photos/937481/pexels-photo-937481.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
              :content="$f()[0].users[0].name"
            />
          </div>
          <div class="intro-x w-8 h-8 sm:w-10 sm:h-10 image-fit -ml-4">
            <Tippy
              tag="img"
              alt=""
              class="rounded-full border border-white zoom-in"
              src="https://images.pexels.com/photos/7410003/pexels-photo-7410003.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
              :content="$f()[0].users[1].name"
            />
          </div>
          <div class="intro-x w-8 h-8 sm:w-10 sm:h-10 image-fit -ml-4">
            <Tippy
              tag="img"
              alt=""
              class="rounded-full border border-white zoom-in"
              src="https://images.pexels.com/photos/8412730/pexels-photo-8412730.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
              :content="$f()[0].users[2].name"
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
            tag="a"
            href=""
            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in"
            content="Like"
          >
            <ThumbsUpIcon class="w-3 h-3 fill-current" />
          </Tippy>
          <Tippy
            tag="a"
            href=""
            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in"
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
              <a href="" class="ml-auto text-xs text-gray-600">Reply</a>
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
      comment: ''
    }
  },
  mounted() {
    this.loadPost(this.$route.params.id)
  },
  methods: {
    loadPost(id) {
      axios.get('http://localhost:8000/api/posts/' + id)
        .then(response => {
          this.post = response.data.data
          console.log(response)
          this.loadComments(id)
        })
        .catch(error => {
          console.error(error)
        })
    },
    loadComments(id) {
      axios.get('http://localhost:8000/api/posts/' + id + '/comments')
        .then(response => {
          this.post.post_comments = response.data.data
          console.log(response)
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
    }
  }
})
</script>
