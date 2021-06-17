<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Edit Role</h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <button type="button" @click="editRole" class="btn box text-gray-700 dark:text-gray-300 mr-2 flex items-center ml-auto sm:ml-0">
          <SaveIcon class="w-4 h-4 mr-2"/> Save
        </button>
        <div class="dropdown">
          <button
            class="dropdown-toggle btn btn-primary shadow-md flex items-center"
            aria-expanded="false"
          >
            <SettingsIcon class="w-4 h-4 mr-2"></SettingsIcon> Settings <ChevronDownIcon class="w-4 h-4 ml-2" />
          </button>
          <div class="dropdown-menu w-40">
            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
              <a href="#" @click="deleteRole" aria-expanded="false" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                <Trash2Icon class="w-4 h-4 mr-2"/> Delete Role
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <!-- BEGIN: Post Content -->
      <div class="intro-y col-span-12 lg:col-span-9">
        <div class="intro-y">
          <div class="box p-2">
            <div class="pos__tabs nav nav-tabs justify-center" role="tablist">
              <a
                id="content-tab"
                data-toggle="tab"
                data-target="#content"
                href="javascript:;"
                class="flex-1 py-2 rounded-md text-center active"
                role="tab"
                aria-controls="content"
                aria-selected="true"
              >
                Content
              </a>
              <a
                id="permissions-tab"
                data-toggle="tab"
                data-target="#permissions"
                href="javascript:;"
                class="flex-1 py-2 rounded-md text-center"
                role="tab"
                aria-controls="permissions"
                aria-selected="false"
              >
                Permissions
              </a>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div
            id="content"
            class="tab-pane active"
            role="tabpanel"
            aria-labelledby="content-tab"
          >
            <div class="box p-5 mt-5">
              <!-- BEGIN: Role Title/Color -->
              <div class="grid lg:grid-cols-2 gap-6 my-5">
                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                  <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                    <p>
                      <label for="name" class="bg-white text-gray-600 px-1">Name</label>
                    </p>
                  </div>
                  <p>
                    <input id="name" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 text-gray-900 outline-none block h-full w-full" v-model="role.name">
                  </p>
                </div>
                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                  <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                    <p>
                      <label for="lastname" class="bg-white text-gray-600 px-1">Color</label>
                    </p>
                  </div>
                  <p>
                    <input id="color" autocomplete="false" tabindex="0" type="color" class="py-1 px-1 outline-none block h-full w-full" v-model="role.color_code">
                  </p>
                </div>
              </div>
              <!-- END: Role Title/Color -->
              <br>
              <!-- BEGIN: Role Description -->
              <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1 mb-5">
                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                  <p>
                    <label class="bg-white text-gray-600 px-1">Description</label>
                  </p>
                </div>
                <p>
                  <textarea autocomplete="false" tabindex="0" class="py-1 px-1 text-gray-900 outline-none block h-full w-full" v-model="role.description"></textarea>
                </p>
              </div>
              <!-- END: Role Description -->
            </div>
          </div>
          <div
            id="permissions"
            class="tab-pane"
            role="tabpanel"
            aria-labelledby="permissions-tab"
          >
            <div class="box p-5 mt-5">
              <!-- BEGIN: Table Buttons -->
              <div class="intro-y flex flex-col sm:flex-row items-center">
                <h2 class="text-lg font-medium mr-auto">Permissions</h2>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                  <a href="javascript:;" data-toggle="modal" data-target="#create-role-modal" class="btn btn-primary"><PlusIcon class="mr-2"></PlusIcon>Permission</a>
                </div>
              </div>
              <!-- END: Table Buttons -->
              <!-- BEGIN: Datatable -->
              <table class="table mt-5">
                <thead>
                <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                  <th class="whitespace-nowrap">#</th>
                  <th class="whitespace-nowrap">Name</th>
                  <th class="whitespace-nowrap">Creator</th>
                  <th class="whitespace-nowrap">Updated at</th>
                  <th class="whitespace-nowrap">Created at</th>
                  <th class="whitespace-nowrap"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td class="border-b dark:border-dark-5">1</td>
                  <td class="border-b dark:border-dark-5">role.permission</td>
                  <td class="border-b dark:border-dark-5">Nikko</td>
                  <td class="border-b dark:border-dark-5">Now</td>
                  <td class="border-b dark:border-dark-5">2 days ago</td>
                  <td class="border-b dark:border-dark-5">
                    <a class="text-small">
                      <edit2-icon class="mr-5 hover:text-blue-700"></edit2-icon>
                    </a>
                    <Trash2Icon class="hover:text-blue-700"></Trash2Icon>
                  </td>
                </tr>
                </tbody>
              </table>
              <!-- END: Datatable -->
              <!-- BEGIN: Datatable Pagination -->
              <div class="flex flex-col items-center mt-5">
                <ul class="flex">
                  <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
                    <button class="flex items-center font-bold">
                      <span class="mx-1"><ChevronsLeftIcon></ChevronsLeftIcon></span>
                    </button>
                  </li>
                  <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
                    <button class="flex items-center font-bold">
                      <span class="mx-1"><ChevronLeftIcon></ChevronLeftIcon></span>
                    </button>
                  </li>
                  <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
                    <a class="font-bold">Page 1 / 1</a>
                  </li>
                  <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
                    <button class="flex items-center font-bold">
                      <span class="mx-1"><ChevronRightIcon></ChevronRightIcon></span>
                    </button>
                  </li>
                  <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
                    <button class="flex items-center font-bold">
                      <span class="mx-1"><ChevronsRightIcon></ChevronsRightIcon></span>
                    </button>
                  </li>
                </ul>
              </div>
              <!-- END: Datatable Pagination -->
            </div>
          </div>
        </div>
      </div>
      <!-- END: Post Content -->
      <!-- BEGIN: Post Info -->
      <div class="col-span-12 lg:col-span-3">
        <div class="box p-5">
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
            <div>
              <div class="text-gray-600">Role ID</div>
              <div class="mt-1">{{ this.role.id ? this.role.id : 'Unknown' }}</div>
            </div>
            <ShieldIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
            <div>
              <div class="text-gray-600">Created by</div>
              <div class="mt-1">{{ this.role.user_id ? this.role.user_id : 'Unknown' }}</div>
            </div>
            <UserIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
            <div>
              <div class="text-gray-600">Created at</div>
              <div class="mt-1">{{ this.role.created_at ? this.role.created_at : 'Unknown' }}</div>
            </div>
            <PlusCircleIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center pt-5">
            <div>
              <div class="text-gray-600">Updated at</div>
              <div class="mt-1">{{ this.role.updated_at ? this.role.updated_at : 'Unknown' }}</div>
            </div>
            <ClockIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
        </div>
      </div>
      <!-- END: Post Info -->
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'

export default defineComponent({
  data() {
    return {
      role: {},
      pagination: {}
    }
  },
  mounted() {
    this.fetchRole(this.$route.params.id)
  },
  methods: {
    makePagination(meta) {
      const pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: meta.next_page_url,
        prev_page_url: meta.prev_page_url
      }
      this.pagination = pagination
    },
    deleteRole() {
      const loader = this.$loading.show()
      axios.delete('http://localhost:8000/api/roles/' + this.role.id)
        .then(response => {
          loader.hide()
          this.$router.push({ name: 'admin.roles' })
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    editRole() {
      const loader = this.$loading.show()
      axios.put('http://localhost:8000/api/roles/' + this.role.id, {
        name: this.role.name,
        description: this.role.description,
        color_code: this.role.color_code
      })
        .then(response => {
          loader.hide()
          this.fetchRole(this.role.id)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    fetchRole(id) {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/roles/' + id)
        .then(response => {
          this.role = response.data.data
          loader.hide()
          this.makePagination(response.data.data)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
          this.$router.push({ name: 'admin.roles' })
        })
    }
  }
})
</script>
