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
              <div class="mt-1">Nino Gralla</div>
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
              <div class="mt-1">02/06/20 02:10 PM</div>
            </div>
            <ClockIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center pt-5">
            <div>
              <div class="text-gray-600">Created at</div>
              <div class="mt-1">02/06/20 02:10 PM</div>
            </div>
            <UserPlusIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
        </div>
        <!-- END: Account Informations -->
      </div>
      <!-- END: Sidebar -->
      <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
        <!-- BEGIN: Roles & Tags -->
        <div class="intro-y box lg:mt-5">
          <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">Roles & Tags</h2>
            <button class="btn btn-primary btn-sm ml-auto"><SaveIcon class="mr-2 w-5 h-5"></SaveIcon>Save</button>
          </div>
          <div class="p-5">
            <div class="flex flex-col-reverse xl:flex-row flex-col">
              <div class="flex-1 mt-6 xl:mt-0">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xxl:col-span-6">
                    <div>
                      <label for="accounts-role-edit" class="form-label">
                        Role
                      </label>
                      <input
                        id="accounts-role-edit"
                        type="text"
                        class="form-control"
                        placeholder="Your Role"
                      />
                    </div>
                  </div>
                  <div class="col-span-12 xxl:col-span-6">
                    <div>
                      <label class="form-label">
                        Tags
                      </label>
                      <TailSelect
                        v-model="select"
                        :options="{
                          search: true,
                          descriptions: true,
                          hideSelected: true,
                          hideDisabled: true,
                          multiLimit: 15,
                          multiShowCount: false,
                          multiContainer: true,
                          classNames: 'w-full'
                        }"
                        multiple
                      >
                        <option value="1">ITA20b</option>
                        <option value="2">ITA20a</option>
                        <option value="3">Maintainer</option>
                        <option value="4">Co. Worker</option>
                        <option value="5">Author of the Month</option>
                      </TailSelect>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Roles & Tags -->
        <!-- BEGIN: Settings -->
        <div class="intro-y box lg:mt-5">
          <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">Account Settings</h2>
            <button class="btn btn-primary btn-sm ml-auto"><SaveIcon class="mr-2 w-5 h-5"></SaveIcon>Save</button>
          </div>
          <div class="p-5">
            <div class="flex flex-col-reverse xl:flex-row flex-col">
              <div class="flex-1 mt-6 xl:mt-0">
                <div class="grid grid-cols-12 gap-x-5 mb-4">
                  <div class="col-span-12 xxl:col-span-6">
                    <div class="flex items-center">
                      <div class="border-l-2 border-theme-1 pl-4">
                        <a href="" class="font-medium">
                          Verified Emailaddress
                        </a>
                        <div class="text-gray-600">
                          Is the account-email verified?
                        </div>
                      </div>
                      <input class="form-check-switch ml-auto" type="checkbox">
                    </div>
                  </div>
                  <div class="col-span-12 xxl:col-span-6 mb-4">
                    <div class="flex items-center">
                      <div class="border-l-2 border-theme-1 pl-4">
                        <a href="" class="font-medium">
                          Newsletter
                        </a>
                        <div class="text-gray-600">
                          Does the user get newsletter?
                        </div>
                      </div>
                      <input class="form-check-switch ml-auto" type="checkbox">
                    </div>
                  </div>
                  <div class="col-span-12 xxl:col-span-6">
                    <div class="flex items-center">
                      <div class="border-l-2 border-theme-1 pl-4">
                        <a href="" class="font-medium">
                          Security Alerts
                        </a>
                        <div class="text-gray-600">
                          Does the user get Security alerts
                        </div>
                      </div>
                      <input class="form-check-switch ml-auto" type="checkbox">
                    </div>
                  </div>
                  <div class="col-span-12 xxl:col-span-6">
                    <div class="flex items-center">
                      <div class="border-l-2 border-theme-1 pl-4">
                        <a href="" class="font-medium">
                          Posting Informations
                        </a>
                        <div class="text-gray-600">
                          Does the user get Informations about recent Postings?
                        </div>
                      </div>
                      <input class="form-check-switch ml-auto" type="checkbox">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Settings -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Sidebar from './Components/Sidebar.vue'

export default defineComponent({
  components: {
    Sidebar
  },
  setup() {
    const select = ref('1')

    return {
      select
    }
  }
})
</script>
