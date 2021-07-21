<template>
  <div>
    <div class="intro-y news xl:w-5/5 p-10 box mt-8">
      <!-- BEGIN: Blog Layout -->
      <div class="flex items-center py-4">
        <div class="mr-auto">
          <h2 class="text-3xl font-medium leading-8 mt-6">
            Terms and Conditions of Use
          </h2>
          <div class="flex text-gray-600 truncate text-xs mt-0.5">
             Sunday, 04/07/2021<span class="mx-1">•</span> www.ita-wiki.de
          </div>
        </div>
      </div>
      <div class="intro-y text-justify leading-relaxed">
        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">1. Terms</div>
        <div class="text-base text-gray-600 mt-1">By accessing this Website, accessible from https://www.ita-wiki.de/, you are agreeing to be bound by these Website Terms and Conditions of Use and agree that you are responsible for the agreement with any applicable local laws. If you disagree with any of these terms, you are prohibited from accessing this site. The materials contained in this Website are protected by copyright and trade mark law.</div>

        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">2. Use License</div>
        <div class="text-base text-gray-600 mt-1">Permission is granted to temporarily download one copy of the materials on ITA Wiki's Website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</div>

        <br>

        <ul class=" list-reset flex flex-col">
          <li class="rounded-t relative -mb-px block border p-4 border-grey">modify or copy the materials;</li>
          <li class="relative -mb-px block border p-4 border-grey">use the materials for any commercial purpose or for any public display;</li>
          <li class="relative -mb-px block border p-4 border-grey">attempt to reverse engineer any software contained on ITA Wiki's Website;</li>
          <li class="relative -mb-px block border p-4 border-grey">remove any copyright or other proprietary notations from the materials; or</li>
          <li class="rounded-b relative block border p-4 border-grey">transferring the materials to another person or "mirror" the materials on any other server.</li>
        </ul>

        <br>
        <div class="text-base text-gray-600 mt-1">This will let ITA Wiki to terminate upon violations of any of these restrictions. Upon termination, your viewing right will also be terminated and you should destroy any downloaded materials in your possession whether it is printed or electronic format. These Terms of Service has been created with the help of the <a href="https://www.termsofservicegenerator.net">Terms Of Service Generator</a>.</div>
        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">3. Disclaimer</div>
        <div class="text-base text-gray-600 mt-1">All the materials on ITA Wiki’s Website are provided "as is". ITA Wiki makes no warranties, may it be expressed or implied, therefore negates all other warranties. Furthermore, ITA Wiki does not make any representations concerning the accuracy or reliability of the use of the materials on its Website or otherwise relating to such materials or any sites linked to this Website.</div>

        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">4. Limitations</div>
        <div class="text-base text-gray-600 mt-1">ITA Wiki or its suppliers will not be hold accountable for any damages that will arise with the use or inability to use the materials on ITA Wiki’s Website, even if ITA Wiki or an authorize representative of this Website has been notified, orally or written, of the possibility of such damage. Some jurisdiction does not allow limitations on implied warranties or limitations of liability for incidental damages, these limitations may not apply to you.</div>

        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">5. Revisions and Errata</div>
        <div class="text-base text-gray-600 mt-1">The materials appearing on ITA Wiki’s Website may include technical, typographical, or photographic errors. ITA Wiki will not promise that any of the materials in this Website are accurate, complete, or current. ITA Wiki may change the materials contained on its Website at any time without notice. ITA Wiki does not make any commitment to update the materials.</div>

        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">6. Links</div>
        <div class="text-base text-gray-600 mt-1">ITA Wiki has not reviewed all of the sites linked to its Website and is not responsible for the contents of any such linked site. The presence of any link does not imply endorsement by ITA Wiki of the site. The use of any linked website is at the user’s own risk.</div>

        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">7. Site Terms of Use Modifications</div>
        <div class="text-base text-gray-600 mt-1">ITA Wiki may revise these Terms of Use for its Website at any time without prior notice. By using this Website, you are agreeing to be bound by the current version of these Terms and Conditions of Use.</div>

        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">8. Your Privacy</div>
        <div class="text-base text-gray-600 mt-1">Please read our Privacy Policy.</div>

        <br>

        <div class="intro-y font-medium text-xl sm:text-2xl ml-auto ml-3">9. Governing Law</div>
        <div class="text-base text-gray-600 mt-1">Any claim related to ITA Wiki's Website shall be governed by the laws of de without regards to its conflict of law provisions.</div>
      </div>
      <!-- END: Blog Layout -->
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
