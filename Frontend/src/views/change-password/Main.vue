<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Change Password</h2>
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
                {{ $f()[0].users[0].name }}
              </div>
              <div class="text-gray-600">{{ $f()[0].jobs[0] }}</div>
            </div>
          </div>
          <div class="p-5 border-t border-gray-200 dark:border-dark-5">
            <router-link :to="{ name: 'profile.personal' }">
              <a class="flex items-center mt-5" href="">
                <UserIcon class="w-4 h-4 mr-2"/> Personal Information
              </a>
            </router-link>
            <router-link :to="{ name: 'profile.password' }">
              <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="">
                <LockIcon class="w-4 h-4 mr-2"/> Change Password
              </a>
            </router-link>
          </div>
          <div class="p-5 border-t border-gray-200 dark:border-dark-5">
            <a class="flex items-center" href="">
              <MailIcon class="w-4 h-4 mr-2"/> Email Settings
            </a>
            <a class="flex items-center mt-5" href="">
              <InboxIcon class="w-4 h-4 mr-2"/> Social Networks
            </a>
          </div>
        </div>
      </div>
      <!-- END: Profile Menu -->
      <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <!-- BEGIN: Change Password -->
        <div class="intro-y box lg:mt-5">
          <div
            class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
          >
            <h2 class="font-medium text-base mr-auto">Change Password</h2>
          </div>
          <div class="p-5">
            <form @submit.prevent="handleSubmit">
              <div>
                <label for="change-password-form-1" class="form-label">
                  Old Password
                </label>
                <input
                  id="change-password-form-1"
                  type="password"
                  class="form-control"
                  placeholder="Input text"
                  v-model="old_password"
                />
              </div>
              <div class="mt-3">
                <label for="change-password-form-2" class="form-label">
                  New Password
                </label>
                <input
                  id="change-password-form-2"
                  type="password"
                  class="form-control"
                  placeholder="Input text"
                  v-model="password"
                />
              </div>
              <div class="mt-3">
                <label for="change-password-form-3" class="form-label">
                  Confirm New Password
                </label>
                <input
                  id="change-password-form-3"
                  type="password"
                  class="form-control"
                  placeholder="Input text"
                  v-model="password_confirmation"
                />
              </div>
              <button type="submit" class="btn btn-primary mt-4">
                Change Password
              </button>
            </form>
          </div>
        </div>
        <!-- END: Change Password -->
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { defineComponent } from 'vue'

export default defineComponent({
  data() {
    return {
      email: '',
      old_password: '',
      password: '',
      password_confirmation: ''
    }
  },
  methods: {
    handleSubmit(e) {
      e.preventDefault()
      axios.post('http://127.0.0.1:8000/api/auth/password/change', {
        email: this.email,
        old_password: this.old_password,
        password: this.password,
        password_confirmation: this.password_confirmation
      })
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          console.error(error.message)
        })
    }
  }
})
</script>
