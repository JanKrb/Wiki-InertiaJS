<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Update Profile</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
        <!-- BEGIN: Sidebar -->
        <Sidebar></Sidebar>
        <!-- END: Sidebar -->
        <!-- BEGIN: Account Informations -->
        <div class="intro-y box mt-5 p-5">
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
            <div>
              <div class="text-gray-600">Name</div>
              <div class="mt-1">{{ this.user.name }}</div>
            </div>
            <UserIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
            <div>
              <div class="text-gray-600">Role</div>
              <div class="mt-1">Administrator</div>
            </div>
            <ShieldIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
            <div>
              <div class="text-gray-600">Updated at</div>
              <div class="mt-1">{{ this.user.updated_at }}</div>
            </div>
            <ClockIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center pt-5">
            <div>
              <div class="text-gray-600">Created at</div>
              <div class="mt-1">{{ this.user.created_at }}</div>
            </div>
            <UserPlusIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
        </div>
        <!-- END: Account Informations -->
      </div>
      <!-- END: Sidebar -->
      <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
          <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">Display Information</h2>
          </div>
          <div class="p-5">
            <form @submit.prevent="updatedUser(user)">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xxl:col-span-6">
                      <div>
                        <label for="update-profile-form-1" class="form-label">
                          Display Name
                        </label>
                        <input
                          id="update-profile-form-1"
                          type="text"
                          class="form-control"
                          placeholder="Enter Username"
                          v-model="user.name"
                        />
                      </div>
                      <div class="mt-3">
                        <label for="accounts-firstname-edit" class="form-label">
                          Firstname
                        </label>
                        <input
                          id="accounts-firstname-edit"
                          type="text"
                          class="form-control"
                          placeholder="Enter Firstname"
                          v-model="user.pre_name"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="accounts-email-edit" class="form-label">
                          Email address
                        </label>
                        <input
                          id="accounts-email-edit"
                          type="text"
                          class="form-control"
                          placeholder="Enter Email"
                          v-model="user.email"
                        />
                      </div>
                      <div class="mt-3">
                        <label for="accounts-lastname-edit" class="form-label">
                          Lastname
                        </label>
                        <input
                          id="accounts-lastname-edit"
                          type="text"
                          class="form-control"
                          placeholder="Enter Lastname"
                          v-model="user.last_name"
                        />
                      </div>
                    </div>
                    <div class="col-span-12">
                      <hr class="mt-5 mb-3">
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="accounts-email_verify-edit" class="form-label">
                          Email verified at
                        </label>
                        <input
                          id="accounts-email_verify-edit"
                          type="text"
                          class="form-control"
                          placeholder="Input text"
                          :value="user.email_verified_at ? user.email_verified_at : 'Unknown'"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="accounts-id-edit" class="form-label">
                          Account ID
                        </label>
                        <input
                          id="accounts-id-edit"
                          type="text"
                          class="form-control"
                          placeholder="Input text"
                          :value="user.id"
                          disabled
                        />
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-end mt-4">
                    <button type="button" class="btn btn-primary w-20 mr-auto">
                      Save
                    </button>
                    <a href="" class="text-theme-6 flex items-center">
                      <Trash2Icon class="w-4 h-4 mr-1"/> Delete Account
                    </a>
                  </div>
                </div>
                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                  <div
                    class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5"
                  >
                    <div
                      class="h-40 relative image-fit cursor-pointer zoom-in mx-auto"
                    >
                      <img
                        class="rounded-md"
                        alt="Icewall Tailwind HTML Admin Template"
                        :src="require(`@/assets/images/${$f()[0].photos[0]}`)"
                      />
                      <Tippy
                        tag="div"
                        content="Remove this profile photo?"
                        class="w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"
                      >
                        <xIcon class="w-4 h-4" />
                      </Tippy>
                    </div>
                    <div class="mx-auto cursor-pointer relative mt-5">
                      <button type="button" class="btn btn-primary w-full">
                        Change Photo
                      </button>
                      <input
                        type="file"
                        class="w-full h-full top-0 left-0 absolute opacity-0"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- END: Display Information -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import Sidebar from './Components/Sidebar.vue'
import axios from 'axios'

export default defineComponent({
  components: {
    Sidebar
  },
  mounted() {
    this.fetchUser(this.$route.params.id)
  },
  data() {
    return {
      user: {}
    }
  },
  methods: {
    fetchUser(id) {
      axios.get('http://localhost:8000/api/users/' + id)
        .then(response => {
          this.user = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    updatedUser(user) {
      axios.put('http://localhost:8000/api/users/' + user.id, {
        name: user.name,
        pre_name: user.pre_name,
        last_name: user.last_name,
        email: user.email,
        profile_picture: user.profile_picture
      })
        .then(response => {
          this.fetchUser(this.$route.params.id)
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
})
</script>
