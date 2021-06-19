<template>
  <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
    <!-- END: Sidebar navigation -->
    <div class="intro-y box mt-5">
      <div class="relative flex items-center p-5">
        <div class="w-12 h-12 image-fit">
          <img
            alt=""
            class="rounded-full"
            :src="this.user.profile_picture"
          />
        </div>
        <div class="ml-4 mr-auto">
          <div class="font-medium text-base">
            {{ this.user.name }}
          </div>
          <div class="text-gray-600">
            {{ this.user.role?.name }}
          </div>
        </div>
        <div class="dropdown">
          <a
            class="dropdown-toggle w-5 h-5 block"
            href="javascript:;"
            aria-expanded="false"
          >
            <MoreHorizontalIcon class="w-5 h-5 text-gray-600 dark:text-gray-300"/>
          </a>
          <div class="dropdown-menu w-56">
            <div class="dropdown-menu__content box dark:bg-dark-1">
              <div class="p-4 border-b border-gray-200 dark:border-dark-5 font-medium">
                Export Options
              </div>
              <div class="p-2">
                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                  <ActivityIcon class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"/>English
                </a>
                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                  <BoxIcon class="w-4 h-4 text-gray-700 dark:text-gray-300 mr-2"/>German
                  <div class="text-xs text-white px-1 rounded-full bg-theme-6 ml-auto">
                    10
                  </div>
                </a>
              </div>
              <div class="px-3 py-3 border-t border-gray-200 dark:border-dark-5 font-medium flex">
                <button type="button" class="btn btn-primary py-1 px-2 ml-auto">
                  View Profile
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="p-5 border-t border-gray-200 dark:border-dark-5">
        <router-link :to="{ 'name': 'admin.accounts.informations', 'params': { id: '1' }}">
          <a :class="'flex items-center ' + (this.$route.name === 'admin.accounts.informations' ? 'text-theme-1 dark:text-theme-10 font-medium' : '')" href="">
            <UserIcon class="w-4 h-4 mr-2"/> Account Informations
          </a>
        </router-link>
        <router-link :to="{ 'name': 'admin.accounts.settings', 'params': { id: '1' }}">
          <a :class="'flex items-center mt-5 ' + (this.$route.name === 'admin.accounts.settings' ? 'text-theme-1 dark:text-theme-10 font-medium' : '')" href="">
            <BoxIcon class="w-4 h-4 mr-2"/> Account Settings
          </a>
        </router-link>
        <router-link :to="{ 'name': 'admin.accounts.security', 'params': { id: '1' }}">
          <a :class="'flex items-center mt-5 ' + (this.$route.name === 'admin.accounts.security' ? 'text-theme-1 dark:text-theme-10 font-medium' : '')" href="">
            <LockIcon class="w-4 h-4 mr-2"/> Change Password
          </a>
        </router-link>
      </div>
      <div class="p-5 border-t border-gray-200 dark:border-dark-5">
        <router-link :to="{ 'name': 'admin.accounts.postings', 'params': { id: '1' }}">
          <a class="flex items-center" href="">
            <PaperclipIcon class="w-4 h-4 mr-2"/> Postings
          </a>
        </router-link>
        <a class="flex items-center mt-5" href="">
          <SlashIcon class="w-4 h-4 mr-2"/> Bans
        </a>
      </div>
    </div>
    <!-- END: Sidebar navigation -->
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
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  props: ['user']
})
</script>
