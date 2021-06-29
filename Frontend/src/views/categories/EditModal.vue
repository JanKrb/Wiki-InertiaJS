<template>
  <div class="modal-dialog modal-xl">
    <form>
      <div class="modal-content">
        <!-- BEGIN: Edit Category -->
        <div class="intro-y col-span-12">
          <div class="post intro-y overflow-hidden box mt-5">
            <div
              class="post__tabs nav nav-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600"
              role="tablist"
            >
              <Tippy
                id="properties-tab"
                tag="a"
                content="Customize the category properties"
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
              <Tippy
                id="assignment-tab"
                tag="a"
                content="Customize the post & categories assignment"
                data-toggle="tab"
                data-target="#assignment"
                href="javascript:;"
                class="w-full sm:w-40 py-4 text-center flex justify-center items-center"
                role="tab"
                aria-selected="false"
              >
                <LayersIcon class="w-4 h-4 mr-2" /> Assignment
              </Tippy>
              <Tippy
                id="settings-tab"
                tag="a"
                content="Manage the category settings"
                data-toggle="tab"
                data-target="#settings"
                href="javascript:;"
                class="w-full sm:w-40 py-4 text-center flex justify-center items-center"
                role="tab"
                aria-selected="false"
              >
                <SettingsIcon class="w-4 h-4 mr-2" /> Settings
              </Tippy>
            </div>
            <div class="post__content tab-content">
              <div
                id="properties"
                class="tab-pane active"
                role="tabpanel"
                aria-labelledby="properties-tab"
              >
                <div class="p-5">
                  <div class="font-medium flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
                    <ChevronDownIcon class="w-4 h-4 mr-2" /> Category settings
                  </div>
                  <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <div class="flex-1 mt-6 xl:mt-0">
                      <p class="mt-3">Category Title</p>
                      <input type="text" :class="'form-control mt-2' + (this.validation_error?.title != null ? ' border-theme-6' : '')" placeholder="Title" v-model="this.edit_category.title"/>
                      <div v-if="this.validation_error?.description != null" class="text-theme-6 mt-2 mb-4">
                        {{ this.validation_error?.title[0] }}
                      </div>
                      <p class="mt-3">Category Title</p>
                      <textarea rows="7" :class="'form-control mt-2' + (this.validation_error?.description != null ? ' border-theme-6' : '')" placeholder="Description" v-model="this.edit_category.description"></textarea>
                      <div v-if="this.validation_error?.description != null" class="text-theme-6 mt-2 mb-4">
                        {{ this.validation_error?.description[0] }}
                      </div>
                    </div>
                    <div class="w-52 mx-auto xl:mr-0 xl:ml-6 mt-5 mr-3">
                      <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                          <img
                            class="rounded-md"
                            alt=""
                            :src="this.category.thumbnail ? this.edit_category.thumbnail : 'https://apsec.iafor.org/wp-content/uploads/sites/37/2017/02/IAFOR-Blank-Avatar-Image.jpg'"
                          />
                        </div>
                        <div class="mx-auto cursor-pointer relative mt-5">
                          <button type="button" class="btn btn-primary w-full">
                            Change Thumbnail
                          </button>
                          <input
                            type="file"
                            class="w-full h-full top-0 left-0 absolute opacity-0"
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
            <div class="modal-footer text-right">
              <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">
                Cancel
              </button>
              <button type="submit" class="btn btn-primary w-20" data-dismiss="modal">
                Save
              </button>
            </div>
          </div>
        </div>
        <!-- END: Edit Category -->
      </div>
    </form>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'
import { useToast } from 'vue-toastification'

const toast = useToast()

export default defineComponent({
  props: ['category'],
  data() {
    return {
      categories: [],
      edit_category: {
        title: '',
        description: '',
        thumbnail: ''
      }
    }
  },
  mounted() {
    this.fetchCategories()
  },
  methods: {
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
          this.edit_category.thumbnail = res.data.data.url
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
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
})
</script>
