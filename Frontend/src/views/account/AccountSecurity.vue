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
        <!-- BEGIN: Security / Passwords -->
        <div class="intro-y box lg:mt-5">
          <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">Security</h2>
            <button class="btn btn-primary btn-sm ml-auto"><LockIcon class="mr-2 w-4 h-4"></LockIcon>Change Password</button>
          </div>
          <div class="p-5">
            <div class="flex flex-col-reverse xl:flex-row flex-col">
              <div class="flex-1 mt-6 xl:mt-0">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xxl:col-span-6">
                    <div>
                      <label for="accounts-new_password-edit" class="form-label">
                        New Password
                      </label>
                      <input
                        id="accounts-new_password-edit"
                        type="password"
                        class="form-control"
                        placeholder="Your new Password"
                      />
                    </div>
                  </div>
                  <div class="col-span-12 xxl:col-span-6">
                    <div>
                      <label for="accounts-password_confirmation-edit" class="form-label">
                        New Password confirmation
                      </label>
                      <input
                        id="accounts-password_confirmation-edit"
                        type="password"
                        class="form-control"
                        placeholder="Your new Password confirmation"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Security / Passwords -->
        <!-- BEGIN: Verification -->
        <div class="intro-y box lg:mt-5">
          <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">Verification</h2>
          </div>
          <div class="p-5">
            <div class="flex flex-col-reverse xl:flex-row flex-col">
              <div class="flex-1 mt-6 xl:mt-0">
                <div class="grid grid-cols-12 gap-x-5">
                  <div class="col-span-12 xxl:col-span-6">
                    <div class="flex items-center">
                      <div class="border-l-2 border-theme-1 pl-4">
                        <a href="" class="font-medium">
                          Verify Email
                        </a>
                        <div class="text-gray-600">
                          Send a Email for verification
                        </div>
                      </div>
                      <button class="btn btn-primary btn-sm ml-auto">Send</button>
                    </div>
                  </div>
                  <div class="col-span-12 xxl:col-span-6">
                    <div class="flex items-center">
                      <div class="border-l-2 border-theme-1 pl-4">
                        <a href="" class="font-medium">
                          Password Reset
                        </a>
                        <div class="text-gray-600">
                          Send a Password Reset link
                        </div>
                      </div>
                      <button class="btn btn-primary btn-sm ml-auto">Send</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Verification -->
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
