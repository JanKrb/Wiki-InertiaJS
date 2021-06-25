<template>
  <div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12 lg:col-span-3 xxl:col-span-2">
      <h2 class="intro-y text-lg font-medium mr-auto mt-2">Wiki Settings</h2>
      <Sidebar :title="this.details.name"></Sidebar>
    </div>
    <div class="col-span-12 lg:col-span-9 xxl:col-span-10">
      <div class="intro-y text-right items-center">
        <Tippy
          tag="a"
          href="javascript:;"
          class="tooltip btn px-2 box text-gray-700 dark:text-gray-300"
          content="These are the security wiki settings, here you can customize your wiki around the topic of security, please pay close attention to what you do here!"
        >
          <span class="flex items-center justify-center">
            <InfoIcon class="w-5 h-5 mr-2"/>Informations
          </span>
        </Tippy>
      </div>
      <!-- BEGIN: Submit Database Modal -->
      <div
        id="submit-mail-modal"
        class="modal"
        tabindex="-1"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="p-5 text-center">
                <AlertCircleIcon class="w-16 h-16 text-theme-6 mx-auto mt-3" />
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">
                  Are you really sure you want to change the <br>security settings, this can do a lot of damage!
                </div>
              </div>
              <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">
                  Cancel
                </button>
                <button type="button" data-dismiss="modal" class="btn btn-danger w-24">
                  Submit
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- BEGIN: Submit Database Modal -->
      <!-- BEGIN: Database Settings -->
      <div class="intro-y inbox box mt-5">
        <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
          <h2 class="font-medium text-base mr-auto">Security Settings</h2>
        </div>
        <div class="overflow-x-auto sm:overflow-x-visible">
          <div class="intro-y p-5">
            <form @submit.prevent="">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xxl:col-span-6 mb-5">
                      <div class="mt-3 xxl:mt-0">
                        <label for="update-security-password_lenght" class="form-label">
                          Minimum password length
                        </label>
                        <input
                          id="update-security-password_lenght"
                          type="number"
                          min="4"
                          max="32"
                          class="form-control"
                          placeholder="Enter minimum password lenght"
                          v-model="security.password_lenght"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6 mb-5">
                      <div class="mt-3 xxl:mt-0">
                        <label class="form-label">
                          Default role
                        </label>
                        <TailSelect
                          v-model="security.default_role"
                          class="form-control"
                          :options="{
                            search: true,
                            classNames: 'w-full'
                          }"
                        >
                          <option :value=role.id v-for="role in this.roles" v-bind:key="role.id" :selected="role.id === this.security.default_role">{{ role.name }}</option>
                        </TailSelect>
                      </div>
                    </div>
                    <div class="col-span-12">
                      <hr class="mt-5 mb-3">
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="update-security-terms_of_service" class="form-label">
                          Terms of Service
                        </label>
                        <input
                          id="update-security-terms_of_service"
                          type="text"
                          class="form-control"
                          placeholder="Enter Directlink"
                          v-model="security.terms_of_service"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="update-security-privacy_policy" class="form-label">
                          Privacy Policy
                        </label>
                        <input
                          id="update-security-privacy_policy"
                          type="text"
                          class="form-control"
                          placeholder="Enter Directlink"
                          v-model="security.privacy_policy"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-end mt-4">
                    <a href="javascript:;" data-toggle="modal" data-target="#submit-mail-modal" class="btn btn-danger w-20 mr-auto">
                      Save
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="p-3 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
          <div class="sm:ml-auto mt-5 sm:mt-0 dark:text-gray-300">
            Please be aware of what you are doing here. These settings can cause a lot of damage!
          </div>
        </div>
      </div>
      <!-- END: Database Settings -->
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import Sidebar from './Components/Sidebar'
import axios from 'axios'

export default defineComponent({
  components: {
    Sidebar
  },
  data() {
    return {
      details: {
        name: process.env.VUE_APP_NAME,
        logo: process.env.VUE_APP_LOGO,
        description: process.env.VUE_APP_DESCRIPTION
      },
      security: {
        password_lenght: 6,
        default_role: 1,
        terms_of_service: '',
        privacy_policy: ''
      },
      roles: [],
      validation_error: {}
    }
  },
  mounted() {
    this.fetchRoles()
  },
  methods: {
    fetchRoles() {
      axios.get('http://localhost:8000/api/roles?per_page=10000')
        .then(response => {
          this.roles = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
})
</script>
