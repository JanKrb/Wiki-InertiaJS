<template>
  <!-- END: Sidebar navigation -->
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
          NinoKrb
        </div>
        <div class="text-gray-600">
          Administrator
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
        <a class="flex items-center text-theme-1 dark:text-theme-10 font-medium" href="">
          <UserIcon class="w-4 h-4 mr-2"/> Account Informations
        </a>
      </router-link>
      <router-link :to="{ 'name': 'admin.accounts.settings', 'params': { id: '1' }}">
        <a class="flex items-center mt-5" href="">
          <BoxIcon class="w-4 h-4 mr-2"/> Account Settings
        </a>
      </router-link>
      <router-link :to="{ 'name': 'admin.accounts.security', 'params': { id: '1' }}">
      <a class="flex items-center mt-5" href="">
        <LockIcon class="w-4 h-4 mr-2"/> Change Password
      </a>
      </router-link>
    </div>
    <div class="p-5 border-t border-gray-200 dark:border-dark-5">
      <router-link :to="{ 'name': 'admin.accounts.postings', 'params': { id: '1' }}">
        <a class="flex items-center" href="">
          <PaperclipIcon class="w-4 h-4 mr-2" /> Postings
        </a>
      </router-link>
      <a class="flex items-center mt-5" href="">
        <SlashIcon class="w-4 h-4 mr-2" /> Bans
      </a>
    </div>
  </div>
  <!-- END: Sidebar navigation -->
</template>
