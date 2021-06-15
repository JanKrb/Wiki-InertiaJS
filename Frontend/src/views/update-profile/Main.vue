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
                {{ $f()[0].users[0].name }}
              </div>
              <div class="text-gray-600">{{ $f()[0].jobs[0] }}</div>
            </div>
          </div>
          <div class="p-5 border-t border-gray-200 dark:border-dark-5">
            <router-link :to="{ name: 'profile.personal' }">
              <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="">
                <UserIcon class="w-4 h-4 mr-2"/> Personal Information
              </a>
            </router-link>
            <router-link :to="{ name: 'profile.password' }">
              <a class="flex items-center mt-5" href="">
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
        <!-- BEGIN: Display Information -->
        <div class="intro-y box lg:mt-5">
          <div
            class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5"
          >
            <h2 class="font-medium text-base mr-auto">Display Information</h2>
          </div>
          <div class="p-5">
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
                        placeholder="Input text"
                        :value="$f()[0].users[0].name"
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
                        placeholder="Input text"
                        :value="$f()[0].users[0].name"
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
                        placeholder="Input text"
                        :value="$f()[0].users[0].name"
                      />
                    </div>
                    <div class="mt-3">
                      <label for="update-profile-form-4" class="form-label">
                        Phone Number
                      </label>
                      <input
                        id="update-profile-form-4"
                        type="text"
                        class="form-control"
                        placeholder="Input text"
                        value="65570828"
                      />
                    </div>
                  </div>
                  <div class="col-span-12">
                    <div class="mt-3">
                      <label for="update-profile-form-5" class="form-label">
                        Email
                      </label>
                      <input
                        id="update-profile-form-5"
                        type="text"
                        class="form-control"
                        placeholder="Input text"
                        :value="$f()[0].users[0].email"
                      />
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-primary w-20 mt-3">
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
          </div>
        </div>
        <!-- END: Display Information -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue'

export default defineComponent({
  setup() {
    const select = ref('1')

    return {
      select
    }
  }
})
</script>
