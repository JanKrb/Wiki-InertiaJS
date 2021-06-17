<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Wiki Roles</h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="javascript:;" data-toggle="modal" data-target="#create-role-modal" class="btn btn-primary">Add New Role</a>
      </div>
    </div>

    <!-- BEGIN: Create Role Modal -->
    <div id="create-role-modal" class="modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form @submit.prevent="addRole(this.role)">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Create a new Role
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="create-role-modal-name" class="form-label">Name</label>
                <input id="create-role-modal-name" type="text" class="form-control" placeholder="example@gmail.com" v-model="role.name"/>
              </div>
              <div class="col-span-12">
                <label for="create-role-modal-description" class="form-label">Description</label>
                <textarea id="create-role-modal-description" class="form-control" placeholder="example@gmail.com" v-model="role.description"/>
              </div>
              <div class="col-span-12">
                <label for="create-role-modal-color" class="form-label">Color</label>
                <input id="create-role-modal-color" type="color" class="form-control" v-model="role.color"/>
              </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
              <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">
                Cancel
              </button>
              <button type="submit" class="btn btn-primary w-20">
                Create
              </button>
            </div>
            <!-- END: Modal Footer -->
          </div>
        </form>
      </div>
    </div>
    <!-- END: Create Role Modal -->
    <!-- BEGIN: Edit Role Modal -->
    <div id="edit-role-modal" class="modal" tabindex="-1" aria-hidden="true" ref="edit-role-modal">
      <div class="modal-dialog">
        <form @submit.prevent="editRole">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Edit a Role
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="edit-role-modal-name" class="form-label">Name</label>
                <input id="edit-role-modal-name" type="text" class="form-control" placeholder="Your Name" v-model="edit_role.name"/>
              </div>
              <div class="col-span-12">
                <label for="edit-role-modal-description" class="form-label">Description</label>
                <textarea id="edit-role-modal-description" class="form-control" placeholder="Your Description" v-model="edit_role.description"/>
              </div>
              <div class="col-span-12">
                <label for="edit-role-modal-color" class="form-label">Color</label>
                <input id="edit-role-modal-color" type="color" class="form-control" v-model="edit_role.color"/>
              </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
              <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">
                Cancel
              </button>
              <button type="submit" class="btn btn-primary w-20">
                Save
              </button>
            </div>
            <!-- END: Modal Footer -->
          </div>
        </form>
      </div>
    </div>
    <!-- END: Edit Role Modal -->
    <!-- BEGIN: Datatable -->
    <table class="table mt-5">
      <thead>
      <tr class="bg-gray-700 dark:bg-dark-1 text-white">
        <th class="whitespace-nowrap">#</th>
        <th class="whitespace-nowrap">Name</th>
        <th class="whitespace-nowrap">Description</th>
        <th class="whitespace-nowrap">Color</th>
        <th class="whitespace-nowrap">Updated at</th>
        <th class="whitespace-nowrap">Created at</th>
        <th class="whitespace-nowrap"></th>
      </tr>
      </thead>
      <tbody>
        <tr v-for="role in this.roles" v-bind:key="role.id">
          <td class="border-b dark:border-dark-5">{{ role.id }}</td>
          <td class="border-b dark:border-dark-5">{{ role.name }}</td>
          <td class="border-b dark:border-dark-5">{{ role.description }}</td>
          <td class="border-b dark:border-dark-5">{{ role.color_code }}</td>
          <td class="border-b dark:border-dark-5">{{ role.updated_at }}</td>
          <td class="border-b dark:border-dark-5">{{ role.created_at }}</td>
          <td class="border-b dark:border-dark-5">
            <a href="javascript:;" @click="show_editRole(role)" data-toggle="modal" data-target="#edit-role-modal" class="text-small">
              <edit2-icon class="mr-5 hover:text-blue-700"></edit2-icon>
            </a>
            <Trash2Icon class="hover:text-blue-700" @click="deleteRole(role.id)"></Trash2Icon>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- END: Datatable -->
    <!-- BEGIN: Datatable Pagination -->
    <div class="flex flex-col items-center mt-5">
      <ul class="flex">
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" :disabled="!pagination.first_page_url" @click="fetchRoles(pagination.first_page_url)">
            <span class="mx-1"><ChevronsLeftIcon></ChevronsLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchRoles(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
            <span class="mx-1"><ChevronLeftIcon></ChevronLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <a class="font-bold">Page {{ pagination.current_page }} / {{ pagination.last_page }}</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchRoles(pagination.next_page_url)" :disabled="!pagination.next_page_url">
            <span class="mx-1"><ChevronRightIcon></ChevronRightIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" :disabled="!pagination.last_page_url" @click="fetchRoles(pagination.last_page_url)">
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
      roles: [],
      edit_role: {},
      role: {
        name: 'New Role',
        description: null,
        color_code: '000000'
      },
      pagination: {}
    }
  },
  mounted() {
    this.fetchRoles('http://localhost:8000/api/roles')
  },
  methods: {
    fetchRoles(page) {
      axios.get(page)
        .then(response => {
          this.roles = response.data.data.data
          this.makePagination(response.data.data)
        })
        .catch(error => {
          console.error(error)
        })
      return this.roles
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
    deleteRole(id) {
      axios.delete('http://localhost:8000/api/roles/' + id)
        .then(
          this.fetchRoles('http://localhost:8000/api/roles?page=' + this.pagination.current_page)
        )
        .catch(error => {
          console.error(error)
        })
    },
    addRole(role) {
      axios.post('http://localhost:8000/api/roles', {
        name: role.name,
        description: role.description,
        color_code: role.color_code
      })
        .then(response => {
          console.log(response)
          this.fetchRoles('http://localhost:8000/api/roles?page=' + this.pagination.current_page)
        })
        .catch(error => {
          console.error(error)
        })
    },
    editRole() {
      axios.put('http://localhost:8000/api/roles/' + this.edit_role.id, {
        name: this.edit_role.name,
        description: this.edit_role.description,
        color_code: this.edit_role.color_code
      })
        .then(response => {
          console.log(response)
          this.fetchRoles('http://localhost:8000/api/roles?page=' + this.pagination.current_page)
        })
        .catch(error => {
          console.error(error)
        })
    },
    show_editRole(role) {
      this.edit_role = role
    }
  }
})
</script>
