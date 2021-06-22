<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Wiki Tags</h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="javascript:;" data-toggle="modal" data-target="#create-tag-modal" class="btn btn-primary">Add New Tag</a>
      </div>
    </div>

    <!-- BEGIN: Create Tag Modal -->
    <div id="create-tag-modal" data-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form @submit.prevent="addTag(this.tag)">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Create a new Tag
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="create-tag-modal-name" class="form-label">Name</label>
                <input id="create-tag-modal-name" type="text" class="form-control" placeholder="Your Name" v-model="tag.name"/>
              </div>
              <div class="col-span-12">
                <label for="create-tag-modal-description" class="form-label">Description</label>
                <textarea id="create-tag-modal-description" class="form-control" placeholder="Your Description" v-model="tag.description"/>
              </div>
              <div class="col-span-12">
                <label for="create-tag-modal-color" class="form-label">Color</label>
                <input id="create-tag-modal-color" type="color" class="form-control" v-model="tag.color"/>
              </div>
              <div class="col-span-12">
                <label for="create-tag-modal-icon" class="form-label">Icon</label>
                <input id="create-tag-modal-icon" type="text" class="form-control" placeholder="Your Icon" v-model="tag.icon"/>
              </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
              <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">
                Cancel
              </button>
              <button type="submit" class="btn btn-primary w-20" data-dismiss="modal">
                Create
              </button>
            </div>
            <!-- END: Modal Footer -->
          </div>
        </form>
      </div>
    </div>
    <!-- END: Create Tag Modal -->
    <!-- BEGIN: Edit Tag Modal -->
    <div id="edit-tag-modal" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true" ref="edit-tag-modal">
      <div class="modal-dialog">
        <form @submit.prevent="editTag">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Edit a Tag
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="edit-tag-modal-name" class="form-label">Name</label>
                <input id="edit-tag-modal-name" type="text" class="form-control" placeholder="Your Name" v-model="edit_tag.name"/>
              </div>
              <div class="col-span-12">
                <label for="edit-tag-modal-description" class="form-label">Description</label>
                <textarea id="edit-tag-modal-description" class="form-control" placeholder="Your Description" v-model="edit_tag.description"/>
              </div>
              <div class="col-span-12">
                <label for="edit-tag-modal-color" class="form-label">Color</label>
                <input id="edit-tag-modal-color" type="color" class="form-control" v-model="edit_tag.color"/>
              </div>
              <div class="col-span-12">
                <label for="edit-tag-modal-icon" class="form-label">Icon</label>
                <input id="edit-tag-modal-icon" type="text" class="form-control" placeholder="Your Name" v-model="edit_tag.icon"/>
              </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
              <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">
                Cancel
              </button>
              <button type="submit" class="btn btn-primary w-20" data-dismiss="modal">
                Save
              </button>
            </div>
            <!-- END: Modal Footer -->
          </div>
        </form>
      </div>
    </div>
    <!-- END: Edit Tag Modal -->
    <!-- BEGIN: Datatable -->
    <table class="table mt-5">
      <thead>
        <tr class="bg-primary-2 dark:bg-blue-800 text-white">
          <th class="whitespace-nowrap">#</th>
          <th class="whitespace-nowrap">Name</th>
          <th class="whitespace-nowrap">Description</th>
          <th class="whitespace-nowrap">Color</th>
          <th class="whitespace-nowrap">Icon</th>
          <th class="whitespace-nowrap">Updated at</th>
          <th class="whitespace-nowrap">Created at</th>
          <th class="whitespace-nowrap"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tag in this.tags" v-bind:key="tag.id">
          <td class="border-b dark:border-dark-5">{{ tag.id }}</td>
          <td class="border-b dark:border-dark-5">{{ tag.name }}</td>
          <td class="border-b dark:border-dark-5">{{ tag.description }}</td>
          <td class="border-b dark:border-dark-5"><span class="px-3 py-2 rounded-full text-white mr-1" :style="'background: '+ tag.color">{{ tag.color }}</span></td>
          <td class="border-b dark:border-dark-5">{{ tag.icon }}</td>
          <td class="border-b dark:border-dark-5">{{ tag.updated_at }}</td>
          <td class="border-b dark:border-dark-5">{{ tag.created_at }}</td>
          <td class="border-b dark:border-dark-5">
            <a href="javascript:;" @click="this.edit_tag = tag" data-toggle="modal" data-target="#edit-tag-modal" class="text-small">
              <edit2-icon class="w-5 h-5 mr-5 hover:text-blue-700"></edit2-icon>
            </a>
            <a href="javascript:;" @click="deleteTag(tag.id)" class="text-small">
              <Trash2Icon class="w-5 h-5 hover:text-blue-700"></Trash2Icon>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- END: Datatable -->
    <!-- BEGIN: Datatable Pagination -->
    <div class="flex flex-col items-center mt-5">
      <ul class="flex">
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" :disabled="!pagination.first_page_url" @click="fetchTags(pagination.first_page_url)">
            <span class="mx-1"><ChevronsLeftIcon></ChevronsLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchTags(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
            <span class="mx-1"><ChevronLeftIcon></ChevronLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <a class="font-bold">Page {{ pagination.current_page }} / {{ pagination.last_page }}</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchTags(pagination.next_page_url)" :disabled="!pagination.next_page_url">
            <span class="mx-1"><ChevronRightIcon></ChevronRightIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" :disabled="!pagination.last_page_url" @click="fetchTags(pagination.last_page_url)">
            <span class="mx-1"><ChevronsRightIcon></ChevronsRightIcon></span>
          </button>
        </li>
      </ul>
    </div>
    <!-- END: Datatable Pagination -->
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
      tags: [],
      edit_tag: {},
      tag: {
        name: 'New Tag',
        description: 'New Description',
        color: '#000000',
        icon: 'TagIcon'
      },
      pagination: {},
      validation_error: {}
    }
  },
  mounted() {
    this.fetchTags('http://localhost:8000/api/tags')
  },
  methods: {
    fetchTags(page) {
      const loader = this.$loading.show()
      axios.get(page)
        .then(response => {
          this.tags = response.data.data
          loader.hide()
          this.makePagination(response.data.meta, response.data.links)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    makePagination(meta, links) {
      const pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        last_page_url: links.last,
        first_page_url: links.first,
        next_page_url: links.next,
        prev_page_url: links.prev
      }
      this.pagination = pagination
    },
    deleteTag(id) {
      const loader = this.$loading.show()
      axios.delete('http://localhost:8000/api/tags/' + id)
        .then(response => {
          toast.success('Tag successfully deleted')
          loader.hide()
          this.fetchTags('http://localhost:8000/api/tags?page=' + this.pagination.current_page)
        })
        .catch(error => {
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    },
    addTag(tag) {
      const loader = this.$loading.show()
      axios.post('http://localhost:8000/api/tags', {
        name: tag.name,
        description: tag.description,
        color: tag.color,
        icon: tag.icon
      })
        .then(response => {
          toast.success('Tag successfully added')
          loader.hide()
          this.fetchTags('http://localhost:8000/api/tags?page=' + this.pagination.current_page)
        })
        .catch(error => {
          console.log(error.response)
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    },
    editTag() {
      const loader = this.$loading.show()
      axios.put('http://localhost:8000/api/tags/' + this.edit_tag.id, {
        name: this.edit_tag.name,
        description: this.edit_tag.description,
        color: this.edit_tag.color,
        icon: this.edit_tag.icon
      })
        .then(response => {
          toast.success('Tag successfully updated')
          loader.hide()
          this.fetchTags('http://localhost:8000/api/tags?page=' + this.pagination.current_page)
        })
        .catch(error => {
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    }
  }
})
</script>
