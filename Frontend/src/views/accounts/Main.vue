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
        <form @submit.prevent="">
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
                <input id="create-account-modal-username" type="text" class="form-control" placeholder="Your Username"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-firstname" class="form-label">Firstname</label>
                <input id="create-account-modal-firstname" type="text" class="form-control" placeholder="Your Firstname"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-lastname" class="form-label">Lastname</label>
                <input id="create-account-modal-lastname" type="text" class="form-control" placeholder="Your Lastname"/>
              </div>
              <div class="col-span-12">
                <label for="create-account-modal-email" class="form-label">Email</label>
                <input id="create-account-modal-email" type="text" class="form-control" placeholder="Your Email address"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-password" class="form-label">Password</label>
                <input id="create-account-modal-password" type="password" class="form-control" placeholder="Your Password"/>
              </div>
              <div class="col-span-6">
                <label for="create-account-modal-password_confirmation" class="form-label">Password Confirmation</label>
                <input id="create-account-modal-password_confirmation" type="password" class="form-control" placeholder="Your Password again"/>
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
          Showing 1 to 10 of 150 entries
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
        v-for="(faker, fakerKey) in $f()"
        :key="fakerKey"
        class="intro-y col-span-12 md:col-span-6"
      >
        <div class="box">
          <div class="flex flex-col lg:flex-row items-center p-5">
            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
              <img
                alt="Icewall Tailwind HTML Admin Template"
                class="rounded-full"
                :src="require(`@/assets/images/${faker.photos[0]}`)"
              />
            </div>
            <div
              class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0"
            >
              <a href="" class="font-medium">{{ faker.users[0].name }}</a>
              <div class="text-gray-600 text-xs mt-0.5">
                {{ faker.jobs[0] }}
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
                    <a :href="'http://localhost:8080/admin/accounts/' + faker.totals[0] + '/view'" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                      <Edit2Icon class="w-4 h-4 mr-2"/> Edit
                    </a>
                    <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                      <SlashIcon class="w-4 h-4 mr-2"/> Bans
                    </a>
                    <a
                      href="javascript:;"
                      class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"
                      data-toggle="modal"
                      data-target="#create-account-modal"
                    >
                      <Trash2Icon class="w-4 h-4 mr-2"/> Delete
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- BEGIN: Users Layout -->
      <!-- END: Pagination -->
      <div
        class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
      >
        <ul class="pagination">
          <li>
            <a class="pagination__link" href="">
              <ChevronsLeftIcon class="w-4 h-4" />
            </a>
          </li>
          <li>
            <a class="pagination__link" href="">
              <ChevronLeftIcon class="w-4 h-4" />
            </a>
          </li>
          <li>
            <a class="pagination__link" href="">...</a>
          </li>
          <li>
            <a class="pagination__link" href="">1</a>
          </li>
          <li>
            <a class="pagination__link pagination__link--active" href="">2</a>
          </li>
          <li>
            <a class="pagination__link" href="">3</a>
          </li>
          <li>
            <a class="pagination__link" href="">...</a>
          </li>
          <li>
            <a class="pagination__link" href="">
              <ChevronRightIcon class="w-4 h-4" />
            </a>
          </li>
          <li>
            <a class="pagination__link" href="">
              <ChevronsRightIcon class="w-4 h-4" />
            </a>
          </li>
        </ul>
        <select class="w-20 form-select box mt-3 sm:mt-0">
          <option>10</option>
          <option>25</option>
          <option>35</option>
          <option>50</option>
        </select>
      </div>
      <!-- END: Pagination -->
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  data() {
    return {
      users: {}
    }
  },
  mounted() {
    this.fetchAccounts()
  },
  methods: {
    fetchAccounts() {
      console.log('Fetch Accounts')
    }
  }
})
</script>
