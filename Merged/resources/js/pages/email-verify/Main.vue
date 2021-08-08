<template>
  <div>
    <DarkModeSwitcher />
    <div class="container sm:px-10">
      <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
          <a href="" class="-intro-x flex items-center pt-5">
            <img
              alt="Icewall Tailwind HTML Admin Template"
              class="w-6"
              :src="require(`@/assets/images/logo.svg`)"
            />
            <span class="text-white text-lg ml-3">
              Ru<span class="font-medium">bick</span>
            </span>
          </a>
          <div class="my-auto">
            <img
              alt="Icewall Tailwind HTML Admin Template"
              class="-intro-x w-1/2 -mt-16"
              :src="require(`@/assets/images/illustration.svg`)"
            />
            <div
              class="-intro-x text-white font-medium text-4xl leading-tight mt-10"
            >
              A few more clicks to <br />
              sign in to your account.
            </div>
            <div
              class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500"
            >
              Manage all your e-commerce accounts in one place
            </div>
          </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
          <div
            class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto"
          >
            <h2
              class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left"
            >
              Please Wait...
            </h2>
            <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">
              A few more click to reset your password.
            </div>
          </div>
        </div>
        <!-- END: Login Form -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import DarkModeSwitcher from '@/components/dark-mode-switcher/Main.vue'
import axios from 'axios'
import { useToast } from 'vue-toastification'
const toast = useToast()

export default defineComponent({
  components: {
    DarkModeSwitcher
  },
  mounted() {
    cash('body')
      .removeClass('main')
      .removeClass('error-page')
      .addClass('login')

    if (!this.$route.query.token) {
      toast.error('Invalid token')
      this.$router.push({ name: 'login' })
    }

    axios.post('http://127.0.0.1:8000/api/auth/email/confirm', {
      token: this.$route.query.token
    })
      .then(response => {
        toast.success(response.data.message)
        this.$router.push({ name: 'login' })
      })
      .catch(error => {
        console.log(error.response)
        toast.error(error.response.data.message)
        this.$router.push({ name: 'login' })
      })
  }
})
</script>
