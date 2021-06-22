<template>
  <div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12 lg:col-span-3 xxl:col-span-2">
      <h2 class="intro-y text-lg font-medium mr-auto mt-2">Wiki Settings</h2>
      <Sidebar :title="this.details.name"></Sidebar>
    </div>
    <div class="col-span-12 lg:col-span-9 xxl:col-span-10">
      <div class="intro-y text-right items-center">
        <button class="btn px-2 box text-gray-700 dark:text-gray-300">
          <span class="flex items-center justify-center">
            <InfoIcon class="w-5 h-5 mr-2"/>Informations
          </span>
        </button>
      </div>
      <!-- END: Inbox Filter -->
      <!-- BEGIN: Inbox Content -->
      <div class="intro-y inbox box mt-5">
        <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
          <h2 class="font-medium text-base mr-auto">General Wiki</h2>
        </div>
        <div class="overflow-x-auto sm:overflow-x-visible">
          <div class="intro-y p-5">
            <form @submit.prevent="">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xxl:col-span-12">
                      <div>
                        <label for="update-profile-form-1" class="form-label">
                          Name
                        </label>
                        <input
                          id="update-profile-form-1"
                          type="text"
                          class="form-control"
                          placeholder="Enter Wiki-Name"
                        />
                      </div>
                      <div class="mt-3 xxl:mt-5">
                        <label for="accounts-email-edit" class="form-label">
                          Description
                        </label>
                        <textarea
                          id="accounts-email-edit"
                          type="text"
                          class="form-control"
                          placeholder="Enter Wiki-Description"
                        />
                      </div>
                    </div>
                    <div class="col-span-12">
                      <hr class="mt-5 mb-3">
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="accounts-email_verify-edit" class="form-label">
                          Placeholder
                        </label>
                        <input
                          id="accounts-email_verify-edit"
                          type="text"
                          class="form-control"
                          placeholder="Input Placeholder"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div class="mt-3 xxl:mt-0">
                        <label for="accounts-id-edit" class="form-label">
                          Placeholder
                        </label>
                        <input
                          id="accounts-id-edit"
                          type="text"
                          class="form-control"
                          placeholder="Input Placeholder"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-end mt-4">
                    <button type="submit" class="btn btn-primary w-20 mr-auto">
                      Save
                    </button>
                  </div>
                </div>
                <div class="w-52 mx-auto xl:mr-0 xl:ml-6">
                  <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                      <img class="rounded-md" alt="" :src="this.details.logo"/>
                      <Tippy
                        tag="div"
                        content="Remove this logo?"
                        class="w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"
                      >
                        <xIcon class="w-4 h-4"/>
                      </Tippy>
                    </div>
                    <div class="mx-auto cursor-pointer relative mt-5">
                      <button type="button" class="btn btn-primary w-full">
                        Change Logo
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
        <div class="p-3 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
          <div class="sm:ml-auto mt-5 sm:mt-0 dark:text-gray-300">
            Last update: 36 minutes ago
          </div>
        </div>
      </div>
      <!-- END: Inbox Content -->
      <div class="intro-y inbox box mt-5">
        <div class="p-5 flex flex-col-reverse sm:flex-row text-gray-600 border-b border-gray-200 dark:border-dark-1">
          <h2 class="font-medium text-base mr-auto">Settings</h2>
        </div>
        <div class="overflow-x-auto sm:overflow-x-visible">
          <div class="intro-y p-5">
            <div class="grid grid-cols-12 gap-x-5">
              <div class="col-span-6">
                <div class="flex items-center">
                  <div class="border-l-2 border-theme-1 pl-4">
                    <a href="" class="font-medium">
                      Allow Darkmode
                    </a>
                    <div class="text-gray-600">
                      This setting allows you to Disable a Darkmode for the Wiki
                    </div>
                  </div>
                  <input class="form-check-switch ml-auto" type="checkbox">
                </div>
              </div>
              <div class="col-span-6">
                <div class="flex items-center">
                  <div class="border-l-2 border-theme-1 pl-4">
                    <a href="" class="font-medium">
                      Allow Anonym usage
                    </a>
                    <div class="text-gray-600">
                      This setting allows you to force a login for all Users
                    </div>
                  </div>
                  <input class="form-check-switch ml-auto" type="checkbox">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="p-3 flex flex-col sm:flex-row items-center text-center sm:text-left text-gray-600">
          <div class="sm:ml-auto mt-5 sm:mt-0 dark:text-gray-300">
            Last update: 36 minutes ago
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import Sidebar from './Components/Sidebar'

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
      }
    }
  },
  mounted() {
    console.log('Wikisettings')
  },
  methods: {
    changeDetails() {
      console.log('ChangeDetails')
    }
  }
})
</script>
