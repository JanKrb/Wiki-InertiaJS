<template>
  <div>
    <!-- BEGIN: Delete Modal -->
    <div id="delete-account-modal" class="modal" tabindex="-1" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="p-5 text-center">
              <XCircleIcon
                class="w-16 h-16 text-theme-6 mx-auto mt-3"
              />
              <div class="text-3xl mt-5">Are you sure?</div>
              <div class="text-gray-600 mt-2">
                Do you really want to delete this Account? <br/>
                This process cannot be undone.
              </div>
            </div>
            <div class="px-5 pb-8 text-center">
              <button
                type="button"
                data-dismiss="modal"
                class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1"
              >
                Cancel
              </button>
              <button type="button" class="btn btn-danger w-24">
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Delete Modal -->
    <!-- BEGIN: Create Modal -->
    <div id="create-account-modal" data-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form @submit.prevent="createAccount(this.account)">
          <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
              <h2 class="font-medium text-base mr-auto">
                Create a new Account
              </h2>
            </div>
            <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
              <div class="col-span-12">
                <label for="create-account-modal-username" class="form-label">Username</label>
                <input id="create-account-modal-username" type="text" class="form-control" placeholder="Your Username" v-model="account.name"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-firstname" class="form-label">Firstname</label>
                <input id="create-account-modal-firstname" type="text" class="form-control" placeholder="Your Firstname" v-model="account.pre_name"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-lastname" class="form-label">Lastname</label>
                <input id="create-account-modal-lastname" type="text" class="form-control" placeholder="Your Lastname" v-model="account.last_name"/>
              </div>
              <div class="col-span-12">
                <label for="create-account-modal-email" class="form-label">Email</label>
                <input id="create-account-modal-email" type="text" class="form-control" placeholder="Your Email address" v-model="account.email"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-password" class="form-label">Password</label>
                <input id="create-account-modal-password" type="password" class="form-control" placeholder="Your Password" v-model="account.password"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-password_confirmation" class="form-label">Password Confirmation</label>
                <input id="create-account-modal-password_confirmation" type="password" class="form-control" placeholder="Your Password again" v-model="account.password_confirmation"/>
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
    <!-- END: Create Modal -->
    <h2 class="intro-y text-lg font-medium mt-10">Wiki Accounts</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
      <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
        <a href="javascript:;" data-toggle="modal" data-target="#create-account-modal" class="btn btn-primary">Create new Account</a>
        <div class="hidden md:block mx-auto text-gray-600">
          Showing {{ this.pagination.showing_from }} to {{ this.pagination.showing_to }} of {{ this.pagination.total }} entries
        </div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
          <div class="w-56 relative text-gray-700 dark:text-gray-300">
            <input
              type="text"
              class="form-control w-56 box pr-10 placeholder-theme-13"
              placeholder="Search..."
            />
            <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"/>
          </div>
        </div>
      </div>
      <!-- BEGIN: Users Layout -->
      <div
        v-for="account in this.accounts"
        v-bind:key="account.id"
        class="intro-y col-span-12 md:col-span-6"
      >
        <div class="box">
          <div class="flex flex-col lg:flex-row items-center p-5">
            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
              <img
                alt=""
                class="rounded-full"
                :src="account.profile_picture"
              />
            </div>
            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
              <a href="" class="font-medium">{{ account.name }}</a>
              <div class="text-gray-600 text-xs mt-0.5">
                {{ account.role.name }}
              </div>
            </div>
            <div class="flex mt-4 lg:mt-0">
              <div class="dropdown">
                <button class="dropdown-toggle btn btn-transparent border-0 shadow-none py-1 px-1 mr-2" aria-expanded="false">
                  <span class="w-5 h-5 flex items-center justify-center">
                    <SettingsIcon class="w-4 h-4"/>
                  </span>
                </button>
                <div class="dropdown-menu w-40">
                  <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                    <router-link :to="{ 'name': 'admin.accounts.informations', 'params': { 'id': account.id }}">
                      <a href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <Edit2Icon class="w-4 h-4 mr-2"/> Edit
                      </a>
                    </router-link>
                    <router-link :to="{ 'name': 'admin.accounts.bans', 'params': { 'id': account.id }}">
                      <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <SlashIcon class="w-4 h-4 mr-2"/> Bans
                      </a>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- BEGIN: Users Layout -->
      <!-- BEGIN: Datatable Pagination -->
      <div class="intro-y col-span-12 items-center">
        <div class="flex flex-col items-center mt-5">
          <ul class="flex">
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
              <button class="flex items-center font-bold" :disabled="!pagination.first_page_url" @click="fetchAccounts(pagination.first_page_url)">
                <span class="mx-1"><ChevronsLeftIcon></ChevronsLeftIcon></span>
              </button>
            </li>
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
              <button class="flex items-center font-bold" @click="fetchAccounts(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                <span class="mx-1"><ChevronLeftIcon></ChevronLeftIcon></span>
              </button>
            </li>
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
              <a class="font-bold">Page {{ pagination.current_page }} / {{ pagination.last_page }}</a>
            </li>
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
              <button class="flex items-center font-bold" @click="fetchAccounts(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                <span class="mx-1"><ChevronRightIcon></ChevronRightIcon></span>
              </button>
            </li>
            <li class="mx-1 px-3 py-2 bg-gray-200 text-gray-700 hover:bg-gray-700 hover:text-gray-200 rounded-lg">
              <button class="flex items-center font-bold" :disabled="!pagination.last_page_url" @click="fetchAccounts(pagination.last_page_url)">
                <span class="mx-1"><ChevronsRightIcon></ChevronsRightIcon></span>
              </button>
            </li>
          </ul>
        </div>
      </div>
    <!-- END: Datatable Pagination -->
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'

export default defineComponent({
  data() {
    return {
      pagination: {},
      accounts: {},
      account: {}
    }
  },
  mounted() {
    this.fetchAccounts('http://localhost:8000/api/users')
  },
  methods: {
    fetchAccounts(url) {
      const loader = this.$loading.show()
      axios.get(url)
        .then(response => {
          console.log(response)
          this.accounts = response.data.data
          loader.hide()
          this.makePagination(response.data.meta, response.data.links)
        })
        .catch(error => {
          console.log(error)
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
        prev_page_url: links.prev,
        showing_from: meta.from,
        showing_to: meta.to,
        total: meta.total
      }
      this.pagination = pagination
    },
    createAccount(account) {
      const loader = this.$loading.show()
      if (account.password === account.password_confirmation && account.password.length > 0) {
        axios.post('http://127.0.0.1:8000/api/auth/register', {
          name: account.name,
          email: account.email,
          password: account.password,
          password_confirmation: account.password_confirmation
        })
          .then(response => {
            console.log(response)
            loader.hide()
          })
          .catch(error => {
            console.error(error)
            loader.hide()
          })
      } else {
        console.log('Passwords doesn`t match')
      }
    }
  }
})
</script>
