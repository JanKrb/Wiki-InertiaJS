<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Update Profile</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <!-- BEGIN: Profile Menu -->
      <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
        <div class="intro-y box mt-5">
          <div class="relative flex items-center p-5">
            <div class="w-12 h-12 image-fit">
              <img
                alt="Icewall Tailwind HTML Admin Template"
                class="rounded-full"
                :src="require(`@/assets/images/${$f()[0].photos[0]}`)"
              />
            </div>
            <div class="ml-4 mr-auto">
              <div class="font-medium text-base">
                {{ user.name }}
              </div>
              <div class="text-gray-600">{{ user.email }}</div>
            </div>
          </div>
          <div class="p-5 border-t border-gray-200 dark:border-dark-5">
            <router-link :to="{ name: 'profile.personal' }">
              <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="">
                <UserIcon class="w-4 h-4 mr-2"/> Personal Information
              </a>
            </router-link>
            <router-link :to="{ name: 'profile.password' }">
              <a class="flex items-center mt-3" href="">
                <LockIcon class="w-4 h-4 mr-2"/> Change Password
              </a>
            </router-link>
            <a class="flex items-center mt-3" href="">
              <MailIcon class="w-4 h-4 mr-2"/> Email Settings
            </a>
          </div>
          <div class="p-5 border-t border-gray-200 dark:border-dark-5">
            <a class="flex items-center" href="">
              <BookIcon class="w-4 h-4 mr-2"/> Terms of service
            </a>
            <a class="flex items-center mt-3" href="">
              <ServerIcon class="w-4 h-4 mr-2"/> Privacy policy
            </a>
          </div>
        </div>
      </div>
      <!-- END: Profile Menu -->
      <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
          <div
            class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
          >
            <h2 class="font-medium text-base mr-auto">Display Information</h2>
          </div>
          <div class="p-5">
            <form @submit.prevent="handleSubmit">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xxl:col-span-6">
                      <div>
                        <label for="update-profile-form-1" class="form-label">
                          Firstname
                        </label>
                        <input
                          id="update-profile-form-1"
                          type="text"
                          class="form-control"
                          placeholder="Firstname"
                          v-model="user.pre_name"
                        />
                      </div>
                      <div class="mt-3">
                        <label for="update-profile-form-1" class="form-label">
                          Username
                        </label>
                        <input
                          id="update-profile-form-2"
                          type="text"
                          class="form-control"
                          placeholder="Username"
                          v-model="user.name"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="update-profile-form-1" class="form-label">
                          Lastname
                        </label>
                        <input
                          id="update-profile-form-3"
                          type="text"
                          class="form-control"
                          placeholder="Lastname"
                          v-model="user.last_name"
                        />
                      </div>
                      <div class="mt-3">
                        <label for="update-profile-form-4" class="form-label">
                          Email
                        </label>
                        <input
                          id="update-profile-form-5"
                          type="text"
                          class="form-control"
                          placeholder="Email"
                          v-model="user.email"
                        />
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-20 mt-3">
                    Save
                  </button>
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
import { defineComponent, ref } from 'vue'
import axios from 'axios'

export default defineComponent({
  data() {
    return {
      user: {}
    }
  },
  mounted() {
    this.user = JSON.parse(localStorage.getItem('user'))
  },
  methods: {
    handleSubmit(e) {
      e.preventDefault()
      const loader = this.$loading.show()
      axios.post('http://127.0.0.1:8000/api/auth/update-details/' + this.user.id, {
        name: this.user.name,
        pre_name: this.user.pre_name,
        last_name: this.user.last_name,
        email: this.user.email
      })
        .then(response => {
          loader.hide()
          this.fetchUser()
        })
        .catch(error => {
          console.log(error)
        })
    },
    fetchUser() {
      axios.get('http://localhost:8000/api/auth/user')
        .then(response => {
          localStorage.setItem('user', JSON.stringify(response.data.data.user))
        })
        .catch(error => {
          console.log(error)
        })
    }
  },
  setup() {
    const select = ref('1')

    return {
      select
    }
  }
})
</script>
