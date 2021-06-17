<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Wiki Permissions</h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="javascript:;" data-toggle="modal" data-target="#create-permission-modal" class="btn btn-primary">Add New Permission</a>
      </div>
    </div>
    <!-- BEGIN: Create Permission Modal -->
    <div id="create-permission-modal" class="modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form @submit.prevent="addPermission(this.permission)">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Create a new Permission
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="create-permission-modal-name" class="form-label">Name</label>
                <input id="create-permission-modal-name" type="text" class="form-control" placeholder="Your Name" v-model="permission.name"/>
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
    <!-- END: Create Permission Modal -->
    <!-- BEGIN: Edit Permission Modal -->
    <div id="edit-permission-modal" class="modal" tabindex="-1" aria-hidden="true" ref="edit-permission-modal">
      <div class="modal-dialog">
        <form @submit.prevent="editPermission">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Edit a Permission
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="edit-permission-modal-name" class="form-label">Name</label>
                <input id="edit-permission-modal-name" type="text" class="form-control" placeholder="Your Name" v-model="edit_permission.name"/>
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
    <!-- END: Edit Permission Modal -->
    <!-- BEGIN: Datatable -->
    <table class="table mt-5">
      <thead>
      <tr class="bg-gray-700 dark:bg-dark-1 text-white">
        <th class="whitespace-nowrap">#</th>
        <th class="whitespace-nowrap">Name</th>
        <th class="whitespace-nowrap">Updated at</th>
        <th class="whitespace-nowrap">Created at</th>
        <th class="whitespace-nowrap"></th>
      </tr>
      </thead>
      <tbody>
        <tr v-for="permission in this.permissions" v-bind:key="permission.id">
          <td class="border-b dark:border-dark-5">{{ permission.id }}</td>
          <td class="border-b dark:border-dark-5">{{ permission.name }}</td>
          <td class="border-b dark:border-dark-5">{{ permission.updated_at }}</td>
          <td class="border-b dark:border-dark-5">{{ permission.created_at }}</td>
          <td class="border-b dark:border-dark-5">
            <a href="javascript:;" @click="show_editPermission(permission)" data-toggle="modal" data-target="#edit-permission-modal" class="text-small">
              <edit2-icon class="mr-5 hover:text-blue-700"></edit2-icon>
            </a>
            <Trash2Icon class="hover:text-blue-700" @click="deletePermission(permission.id)"></Trash2Icon>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- END: Datatable -->
    <!-- BEGIN: Datatable Pagination -->
    <div class="flex flex-col items-center mt-5">
      <ul class="flex">
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" :disabled="!pagination.first_page_url" @click="fetchPermissions(pagination.first_page_url)">
            <span class="mx-1"><ChevronsLeftIcon></ChevronsLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchPermissions(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
            <span class="mx-1"><ChevronLeftIcon></ChevronLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <a class="font-bold">Page {{ pagination.current_page }} / {{ pagination.last_page }}</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchPermissions(pagination.next_page_url)" :disabled="!pagination.next_page_url">
            <span class="mx-1"><ChevronRightIcon></ChevronRightIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" :disabled="!pagination.last_page_url" @click="fetchPermissions(pagination.last_page_url)">
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

export default defineComponent({
  data() {
    return {
      permissions: [],
      edit_permission: {},
      permission: {
        name: 'New Permission'
      },
      pagination: {}
    }
  },
  mounted() {
    this.fetchPermissions('http://localhost:8000/api/permissions')
  },
  methods: {
    fetchPermissions(page) {
      const loader = this.$loading.show()
      axios.get(page)
        .then(response => {
          this.permissions = response.data.data.data
          loader.hide()
          this.makePagination(response.data.data)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
      return this.permissions
    },
    makePagination(meta) {
      const pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: meta.next_page_url,
        prev_page_url: meta.prev_page_url
      }
      this.pagination = pagination
    },
    deletePermission(id) {
      const loader = this.$loading.show()
      axios.delete('http://localhost:8000/api/permissions/' + id)
        .then(response => {
          loader.hide()
          this.fetchPermissions('http://localhost:8000/api/permissions?page=' + this.pagination.current_page)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    addPermission(permission) {
      const loader = this.$loading.show()
      axios.post('http://localhost:8000/api/permissions', {
        name: permission.name,
        description: permission.description,
        color_code: permission.color_code
      })
        .then(response => {
          loader.hide()
          this.fetchPermissions('http://localhost:8000/api/permissions?page=' + this.pagination.current_page)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    editPermission() {
      const loader = this.$loading.show()
      axios.put('http://localhost:8000/api/permissions/' + this.edit_permission.id, {
        name: this.edit_permission.name,
        description: this.edit_permission.description,
        color_code: this.edit_permission.color_code
      })
        .then(response => {
          loader.hide()
          this.fetchPermissions('http://localhost:8000/api/permissions?page=' + this.pagination.current_page)
        })
        .catch(error => {
          loader.hide()
          console.log(error)
        })
    },
    show_editPermission(permission) {
      this.edit_permission = permission
    }
  }
})
</script>
