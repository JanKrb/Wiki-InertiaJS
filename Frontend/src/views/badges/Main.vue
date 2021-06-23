<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Wiki Badges</h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="javascript:;" data-toggle="modal" data-target="#create-badge-modal" class="btn btn-primary">Add New Badge</a>
      </div>
    </div>

    <!-- BEGIN: Create Badge Modal -->
    <div id="create-badge-modal" data-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form @submit.prevent="addBadge(this.badge)">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Create a new Badge
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="create-badge-modal-name" class="form-label">Title</label>
                <input id="create-badge-modal-name" type="text" class="form-control" placeholder="Your Name" v-model="badge.title"/>
              </div>
              <div class="col-span-12">
                <label for="create-badge-modal-description" class="form-label">Description</label>
                <textarea id="create-badge-modal-description" class="form-control" placeholder="Your Description" v-model="badge.description"/>
              </div>
              <div class="col-span-12">
                <label for="create-badge-modal-color" class="form-label">Color</label>
                <input id="create-badge-modal-color" type="color" class="form-control" v-model="badge.color"/>
              </div>
              <div class="col-span-12">
                <label for="create-badge-modal-icon" class="form-label">Icon</label>
                <input id="create-badge-modal-icon" type="text" class="form-control" placeholder="Your Icon" v-model="badge.icon"/>
              </div>
              <div class="col-span-12">
                <div class="flex items-center mt-3">
                  <div>
                    <a href="" class="font-medium">Is Rolebadge?</a>
                    <div class="text-gray-600">A Rolebadge is binded to a single Role</div>
                  </div>
                  <input class="form-check-switch ml-auto" type="checkbox" :checked="badge.is_role_badge" v-model="badge.is_role_badge">
                </div>
                <div class="col-span-12" v-show="badge.is_role_badge">
                  <hr class="my-5">
                  <label class="form-label">Role</label>
                  <TailSelect
                    v-model="badge.role_id"
                    :class="'form-control' + (this.validation_error?.role_id != null ? ' border-theme-6' : '')"
                    :options="{
                      search: true,
                      classNames: 'w-full'
                    }"
                  >
                    <option :value="role.id" v-for="role in this.roles" v-bind:key="role.id" :selected="role.id === badge.role_id">{{ role.name }}</option>
                  </TailSelect>
                </div>
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
    <!-- END: Create Badge Modal -->
    <!-- BEGIN: Edit Badge Modal -->
    <div id="edit-badge-modal" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true" ref="edit-badge-modal">
      <div class="modal-dialog">
        <form @submit.prevent="editBadge">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Edit a Badge
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="edit-badge-modal-name" class="form-label">Title</label>
                <input id="edit-badge-modal-name" type="text" class="form-control" placeholder="Your Name" v-model="edit_badge.title"/>
              </div>
              <div class="col-span-12">
                <label for="edit-badge-modal-description" class="form-label">Description</label>
                <textarea id="edit-badge-modal-description" class="form-control" placeholder="Your Description" v-model="edit_badge.description"/>
              </div>
              <div class="col-span-12">
                <label for="edit-badge-modal-color" class="form-label">Color</label>
                <input id="edit-badge-modal-color" type="color" class="form-control" v-model="edit_badge.color"/>
              </div>
              <div class="col-span-12">
                <label for="edit-badge-modal-icon" class="form-label">Icon</label>
                <input id="edit-badge-modal-icon" type="text" class="form-control" placeholder="Your Name" v-model="edit_badge.icon"/>
              </div>
              <div class="col-span-12">
                <div class="flex items-center mt-3">
                  <div>
                    <a href="" class="font-medium">Is Rolebadge?</a>
                    <div class="text-gray-600">A Rolebadge is binded to a single Role</div>
                  </div>
                  <input class="form-check-switch ml-auto" type="checkbox" :checked="edit_badge.is_role_badge" v-model="edit_badge.is_role_badge">
                </div>
                <div class="col-span-12" v-show="edit_badge.is_role_badge">
                  <hr class="my-5">
                  <label class="form-label">Role</label>
                  <TailSelect
                    v-model="this.edit_badge.role_id"
                    :class="'form-control' + (this.validation_error?.role_id != null ? ' border-theme-6' : '')"
                    :options="{
                      search: true,
                      classNames: 'w-full'
                    }"
                  >
                    <option :value="role.id" v-for="role in this.roles" v-bind:key="role.id" :selected="role.id === this.edit_badge.role_id">{{ role.name }}</option>
                  </TailSelect>
                </div>
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
    <!-- END: Edit Badge Modal -->
    <!-- BEGIN: Datatable -->
    <table class="table mt-5">
      <thead>
        <tr class="bg-primary-2 dark:bg-blue-800 text-white">
          <th class="whitespace-nowrap">#</th>
          <th class="whitespace-nowrap">Name</th>
          <th class="whitespace-nowrap">Color</th>
          <th class="whitespace-nowrap">Icon</th>
          <th class="whitespace-nowrap">Type</th>
          <th class="whitespace-nowrap">Creator</th>
          <th class="whitespace-nowrap">Updated at</th>
          <th class="whitespace-nowrap">Created at</th>
          <th class="whitespace-nowrap"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="badge in this.badges" v-bind:key="badge.id">
          <td class="border-b dark:border-dark-5">{{ badge.id }}</td>
          <td class="border-b dark:border-dark-5">{{ badge.title }}</td>
          <td class="border-b dark:border-dark-5"><span class="px-3 py-2 rounded-full text-white mr-1" :style="'background: '+ badge.color">{{ badge.color }}</span></td>
          <td class="border-b dark:border-dark-5">{{ badge.icon }}</td>
          <td class="border-b dark:border-dark-5" v-if="badge.is_role_badge">
            <ShieldIcon class="mr-2"></ShieldIcon>{{ badge.role.id }}
          </td>
          <td class="border-b dark:border-dark-5" v-else>
            <ShieldOffIcon class="mr-2"></ShieldOffIcon>No Role badge
          </td>
          <td class="border-b dark:border-dark-5">{{ badge.user.name }}</td>
          <td class="border-b dark:border-dark-5">{{ badge.updated_at }}</td>
          <td class="border-b dark:border-dark-5">{{ badge.created_at }}</td>
          <td class="border-b dark:border-dark-5">
            <a href="javascript:;" @click="this.edit_badge = badge" data-toggle="modal" data-target="#edit-badge-modal" class="text-small">
              <edit2-icon class="w-5 h-5 mr-5 hover:text-blue-700"></edit2-icon>
            </a>
            <a href="javascript:;" @click="deleteBadge(badge.id)" class="text-small">
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
          <button class="flex items-center font-bold" :disabled="!pagination.first_page_url" @click="fetchBadges(pagination.first_page_url)">
            <span class="mx-1"><ChevronsLeftIcon></ChevronsLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchBadges(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
            <span class="mx-1"><ChevronLeftIcon></ChevronLeftIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <a class="font-bold">Page {{ pagination.current_page }} / {{ pagination.last_page }}</a>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" @click="fetchBadges(pagination.next_page_url)" :disabled="!pagination.next_page_url">
            <span class="mx-1"><ChevronRightIcon></ChevronRightIcon></span>
          </button>
        </li>
        <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
          <button class="flex items-center font-bold" :disabled="!pagination.last_page_url" @click="fetchBadges(pagination.last_page_url)">
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
      badges: [],
      roles: [],
      edit_badge: {
        is_role_badge: 0,
        role: {
          id: 0
        }
      },
      badge: {
        name: 'New Badge',
        description: 'New Description',
        color: '#000000',
        icon: 'BadgeIcon',
        is_role_badge: 0,
        role: {
          id: 0
        }
      },
      pagination: {},
      validation_error: {}
    }
  },
  mounted() {
    this.fetchBadges('http://localhost:8000/api/badges')
    this.fetchRoles('http://localhost:8000/api/roles')
  },
  methods: {
    fetchBadges(page) {
      const loader = this.$loading.show()
      axios.get(page)
        .then(response => {
          this.badges = response.data.data
          loader.hide()
          this.makePagination(response.data.meta, response.data.links)
        })
        .catch(error => {
          console.log(error.response)
          console.error(error)
          loader.hide()
        })
    },
    fetchRoles(page) {
      axios.get(page)
        .then(response => {
          this.roles = response.data.data
          this.makePagination(response.data.meta, response.data.links)
        })
        .catch(error => {
          console.error(error)
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
    deleteBadge(id) {
      const loader = this.$loading.show()
      axios.delete('http://localhost:8000/api/badges/' + id)
        .then(response => {
          toast.success('Badge successfully deleted')
          loader.hide()
          this.fetchBadges('http://localhost:8000/api/badges?page=' + this.pagination.current_page)
        })
        .catch(error => {
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    },
    addBadge(badge) {
      let RoleId = null
      if (badge.role.id > 0) {
        RoleId = badge.role.id
      }
      const loader = this.$loading.show()
      axios.post('http://localhost:8000/api/badges', {
        title: badge.title,
        description: badge.description,
        color: badge.color,
        icon: badge.icon,
        is_role_badge: badge.is_role_badge,
        role_id: RoleId
      })
        .then(response => {
          toast.success('Badge successfully added')
          loader.hide()
          this.fetchBadges('http://localhost:8000/api/badges?page=' + this.pagination.current_page)
        })
        .catch(error => {
          console.log(error.response)
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    },
    editBadge() {
      let roleId = null
      if (this.edit_badge.role.id > 0) {
        roleId = this.edit_badge.role.id
      }
      const loader = this.$loading.show()
      axios.put('http://localhost:8000/api/badges/' + this.edit_badge.id, {
        title: this.edit_badge.title,
        description: this.edit_badge.description,
        color: this.edit_badge.color,
        icon: this.edit_badge.icon,
        is_role_badge: this.edit_badge.is_role_badge,
        role_id: roleId
      })
        .then(response => {
          toast.success('Badge successfully updated')
          loader.hide()
          this.fetchBadges('http://localhost:8000/api/badges?page=' + this.pagination.current_page)
        })
        .catch(error => {
          console.log(error.response)
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    }
  }
})
</script>
