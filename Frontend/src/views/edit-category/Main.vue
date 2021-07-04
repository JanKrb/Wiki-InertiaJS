<template>
  <div>
    <form @submit.prevent="handleSubmit">
      <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">Update a Post</h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
          <button class="btn btn-primary shadow-md flex items-center" type="submit">
            <SaveIcon class="w-5 h-5 mr-2"></SaveIcon>Save
          </button>
        </div>
      </div>
      <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Create Post -->
        <div class="intro-y col-span-12 lg:col-span-8">
          <div class="post intro-y overflow-hidden box">
            <div
              class="post__tabs nav nav-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600"
              role="tablist"
            >
              <Tippy
                id="properties-tab"
                tag="a"
                content="Customize the post properties"
                data-toggle="tab"
                data-target="#properties"
                href="javascript:;"
                class="w-full sm:w-40 py-4 text-center flex justify-center items-center active"
                role="tab"
                aria-controls="properties"
                aria-selected="true"
              >
                <FileTextIcon class="w-4 h-4 mr-2" /> Properties
              </Tippy>
            </div>
            <div class="post__content tab-content">
              <div
                id="properties"
                class="tab-pane p-5 active"
                role="tabpanel"
                aria-labelledby="properties-tab"
              >
                <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                  <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                    <ChevronDownIcon class="w-4 h-4 mr-2" /> Post settings
                  </div>
                  <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <div class="flex-1 mt-6 xl:mt-0">
                      <p class="mt-3">Post Title</p>
                      <input type="text" :class="'form-control mt-2' + (this.validation_error?.title != null ? ' border-theme-6' : '')" placeholder="Title" v-model="this.post.title"/>
                      <div v-if="this.validation_error?.title != null" class="text-theme-6 mt-2 mb-4">
                        {{ this.validation_error?.title[0] }}
                      </div>
                      <p class="mt-3">Post Content</p>
                      <!-- BEGIN: Standard Editor -->
                      <div class="col-span-12 lg:col-span-6">
                        <div id="standard-editor">
                          <div class="preview">
                            <CKEditor
                              v-model="this.post.content"
                              :editor="classicEditor"
                              :config="editorConfig"
                            />
                          </div>
                        </div>
                      </div>
                      <!-- END: Standard Editor -->
                      <div v-if="this.validation_error?.content != null" class="text-theme-6 mt-2 mb-4">
                        {{ this.validation_error?.content[0] }}
                      </div>
                    </div>
                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                      <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                          <img
                            class="rounded-md"
                            alt=""
                            :src="this.post.thumbnail ? this.post.thumbnail : 'https://apsec.iafor.org/wp-content/uploads/sites/37/2017/02/IAFOR-Blank-Avatar-Image.jpg'"
                          />
                        </div>
                        <div class="mx-auto cursor-pointer relative mt-5">
                          <button type="button" class="btn btn-primary w-full">
                            Change Thumbnail
                          </button>
                          <input
                            type="file"
                            class="w-full h-full top-0 left-0 absolute opacity-0"
                            @change="changePicture"
                          />
                        </div>
                      </div>
                    </div>
                    <div v-if="this.validation_error?.thumbnail != null" class="text-theme-6 mt-2 mb-4">
                      The thumbnail is required.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Post Content -->
        <!-- BEGIN: Post Info -->
        <div class="col-span-12 lg:col-span-4">
          <div class="intro-y box p-5">
            <div>
              <label class="form-label">Created by</label>
              <div class="dropdown">
                <div class="dropdown-toggle btn w-full btn-outline-secondary dark:bg-dark-2 dark:border-dark-2 flex items-center justify-start" role="button" aria-expanded="false">
                  <div class="w-6 h-6 image-fit mr-3">
                    <img class="rounded" alt="" :src="this.user?.profile_picture"/>
                  </div>
                  <div class="truncate">{{ this.user?.name }}</div>
                  <UserIcon class="w-4 h-4 ml-auto"/>
                </div>
              </div>
            </div>
            <div class="mt-4">
              <label class="form-label">Title</label>
              <div class="dropdown">
                <div class="dropdown-toggle btn w-full btn-outline-secondary dark:bg-dark-2 dark:border-dark-2 flex items-center justify-start" role="button" aria-expanded="false">
                  <div class="truncate">{{ this.post?.title?.substring(0,75) }}</div>
                  <TagIcon class="w-4 h-4 ml-auto"/>
                </div>
              </div>
            </div>
            <div class="mt-4">
              <label class="form-label">Parent Category</label>
              <div class="dropdown">
                <TailSelect
                  v-model="this.post.parent.id"
                  :options="{
                  search: true,
                  classNames: 'w-full'
                }"
                >
                  <option :value="category.id" v-for="category in this.categories" v-bind:key="category.id" :selected="category.id === this.post?.parent?.id">{{ category.title }}</option>
                </TailSelect>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Post Info -->
      </div>
    </form>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import axios from 'axios'
import { useToast } from 'vue-toastification'
import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor'
import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials'
import BoldPlugin from '@ckeditor/ckeditor5-basic-styles/src/bold'
import ItalicPlugin from '@ckeditor/ckeditor5-basic-styles/src/italic'
import UnderlinePlugin from '@ckeditor/ckeditor5-basic-styles/src/underline'
import StrikethroughPlugin from '@ckeditor/ckeditor5-basic-styles/src/strikethrough'
import CodePlugin from '@ckeditor/ckeditor5-basic-styles/src/code'
import SubscriptPlugin from '@ckeditor/ckeditor5-basic-styles/src/subscript'
import SuperscriptPlugin from '@ckeditor/ckeditor5-basic-styles/src/superscript'
import LinkPlugin from '@ckeditor/ckeditor5-link/src/link'
import ParagraphPlugin from '@ckeditor/ckeditor5-paragraph/src/paragraph'
import SimpleUploadAdapter from '@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter'
import EasyImagePlugin from '@ckeditor/ckeditor5-easy-image/src/easyimage'
import ImagePlugin from '@ckeditor/ckeditor5-image/src/image'
import ImageUploadPlugin from '@ckeditor/ckeditor5-image/src/imageupload'
import ImageInsert from '@ckeditor/ckeditor5-image/src/imageinsert'
import ImageToolbar from '@ckeditor/ckeditor5-image/src/imagetoolbar'
import ImageCaption from '@ckeditor/ckeditor5-image/src/imagecaption'
import ImageStyle from '@ckeditor/ckeditor5-image/src/imagestyle'
import ImageAlternateText from '@ckeditor/ckeditor5-image/src/imagetextalternative'
import ImageCrop from '@ckeditor/ckeditor5-image/src/imageresize'
import CloudServicesPlugin from '@ckeditor/ckeditor5-cloud-services/src/cloudservices'
import Font from '@ckeditor/ckeditor5-font/src/font'
import Heading from '@ckeditor/ckeditor5-heading/src/heading'
import HeadingButtonsUI from '@ckeditor/ckeditor5-heading/src/headingbuttonsui'
import Highlight from '@ckeditor/ckeditor5-highlight/src/highlight'

const toast = useToast()

export default defineComponent({
  data() {
    return {
      post: {
        title: '',
        content: '',
        parent: {
          id: 0
        }
      },
      user: {},
      categories: [],
      validation_error: {}
    }
  },
  mounted() {
    this.user = JSON.parse(localStorage.getItem('user'))
    this.fetchPost()
    this.fetchCategories()
  },
  methods: {
    handleSubmit(e) {
      e.preventDefault()
      const loader = this.$loading.show()
      axios.put('http://localhost:8000/api/posts/' + this.$route.params.id, {
        title: this.post.title,
        content: this.post.content,
        thumbnail: this.post.thumbnail,
        category_id: this.post.parent.id,
        approve: false
      })
        .then(response => {
          toast.success('Post was updated successfully!')
          loader.hide()
          this.$router.push({ name: 'categories' })
        })
        .catch(error => {
          console.log(error.response)
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    },
    changePicture(event) {
      if (event.target.files.length <= 0) return
      const files = event.target.files
      const data = new FormData()

      data.append('image', files[0])

      const loader = this.$loading.show()

      axios.post('http://localhost:8000/api/storage/uploadImage',
        data,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then((res) => {
          this.post.thumbnail = res.data.data.url
          toast.success('Thumbnail successfully uploaded')
          loader.hide()
        })
        .catch((err) => {
          console.error(err)
          toast.error(err.response.data.message)
          loader.hide()
        })
    },
    fetchCategories() {
      axios.get('http://localhost:8000/api/categories?paginate=0')
        .then(response => {
          this.categories = response.data
          console.log(response.data)
        })
        .catch(error => {
          console.error(error)
        })
    },
    fetchPost() {
      axios.get('http://localhost:8000/api/posts/' + this.$route.params.id)
        .then(response => {
          this.post = response.data.data
          console.log(response)
        })
        .catch(error => {
          console.error(error)
        })
    }
  },
  setup() {
    const date = ref('')
    const classicEditor = ClassicEditor

    const editorConfig = {
      plugins: [
        Font,
        EssentialsPlugin,
        BoldPlugin,
        UnderlinePlugin,
        StrikethroughPlugin,
        ItalicPlugin,
        LinkPlugin,
        ParagraphPlugin,
        CodePlugin,
        SubscriptPlugin,
        SuperscriptPlugin,
        SimpleUploadAdapter,
        EasyImagePlugin,
        ImagePlugin,
        ImageUploadPlugin,
        ImageInsert,
        ImageToolbar,
        ImageCaption,
        ImageStyle,
        ImageAlternateText,
        ImageCrop,
        CloudServicesPlugin,
        Heading,
        HeadingButtonsUI,
        Highlight
      ],
      toolbar: {
        items: [
          'fontSize',
          'fontFamily',
          'fontColor',
          'fontBackgroundColor',
          'bold',
          'italic',
          'underline',
          'strikethrough',
          'code',
          'subscript',
          'superscript',
          'link',
          'undo',
          'redo',
          '|',
          'insertImage',
          'imageStyle:full',
          'imageStyle:side',
          '|',
          'highlight'
        ]
      },
      simpleUpload: {
        uploadUrl: 'http://localhost:8000/api/storage/uploadEditor',
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }
    }
    const editorData = ref('<p>Content of the editor.</p>')

    return {
      date,
      classicEditor,
      editorConfig,
      editorData
    }
  }
})
</script>
