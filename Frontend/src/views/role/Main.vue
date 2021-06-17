<template>
  <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Edit Role</h2>
      <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <button
          type="button"
          class="btn box text-gray-700 dark:text-gray-300 mr-2 flex items-center ml-auto sm:ml-0"
        >
          <SaveIcon class="w-4 h-4 mr-2"/> Save
        </button>
        <div class="dropdown">
          <button
            class="dropdown-toggle btn btn-primary shadow-md flex items-center"
            aria-expanded="false"
          >
            <SettingsIcon class="w-4 h-4 mr-2"></SettingsIcon> Edit <ChevronDownIcon class="w-4 h-4 ml-2" />
          </button>
          <div class="dropdown-menu w-40">
            <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
              <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                <SettingsIcon class="w-4 h-4 mr-2"/> Setting
              </a>
              <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                <SlidersIcon class="w-4 h-4 mr-2"/> Other Setting
              </a>
              <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                <Trash2Icon class="w-4 h-4 mr-2"/> Delete Role
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
      <!-- BEGIN: Post Content -->
      <div class="intro-y col-span-12 lg:col-span-9">
        <div class="intro-y">
          <div class="box p-2">
            <div class="pos__tabs nav nav-tabs justify-center" role="tablist">
              <a
                id="ticket-tab"
                data-toggle="tab"
                data-target="#ticket"
                href="javascript:;"
                class="flex-1 py-2 rounded-md text-center active"
                role="tab"
                aria-controls="ticket"
                aria-selected="true"
              >
                Content
              </a>
              <a
                id="details-tab"
                data-toggle="tab"
                data-target="#details"
                href="javascript:;"
                class="flex-1 py-2 rounded-md text-center"
                role="tab"
                aria-controls="details"
                aria-selected="false"
              >
                Permissions
              </a>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div
            id="ticket"
            class="tab-pane active"
            role="tabpanel"
            aria-labelledby="ticket-tab"
          >
            <div class="box p-5 mt-5">
              <!-- BEGIN: Role Title/Color -->
              <div class="grid lg:grid-cols-2 gap-6 my-5">
                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                  <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                    <p>
                      <label for="name" class="bg-white text-gray-600 px-1">Name</label>
                    </p>
                  </div>
                  <p>
                    <input id="name" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 text-gray-900 outline-none block h-full w-full">
                  </p>
                </div>
                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                  <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                    <p>
                      <label for="lastname" class="bg-white text-gray-600 px-1">Color</label>
                    </p>
                  </div>
                  <p>
                    <input id="color" autocomplete="false" tabindex="0" type="color" class="py-1 px-1 outline-none block h-full w-full">
                  </p>
                </div>
              </div>
              <!-- END: Role Title/Color -->
              <br>
              <!-- BEGIN: Role Description -->
              <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1 mb-5">
                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                  <p>
                    <label class="bg-white text-gray-600 px-1">Description</label>
                  </p>
                </div>
                <p>
                  <textarea autocomplete="false" tabindex="0" class="py-1 px-1 text-gray-900 outline-none block h-full w-full"></textarea>
                </p>
              </div>
              <!-- END: Role Description -->
            </div>
          </div>
          <div
            id="details"
            class="tab-pane"
            role="tabpanel"
            aria-labelledby="details-tab"
          >
            <div class="box p-5 mt-5">
              <div
                class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5"
              >
                <div>
                  <div class="text-gray-600">Time</div>
                  <div class="mt-1">02/06/20 02:10 PM</div>
                </div>
                <ClockIcon class="w-4 h-4 text-gray-600 ml-auto" />
              </div>
              <div
                class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5"
              >
                <div>
                  <div class="text-gray-600">Customer</div>
                  <div class="mt-1">{{ $f()[0].users[0].name }}</div>
                </div>
                <UserIcon class="w-4 h-4 text-gray-600 ml-auto" />
              </div>
              <div
                class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5"
              >
                <div>
                  <div class="text-gray-600">People</div>
                  <div class="mt-1">3</div>
                </div>
                <UsersIcon class="w-4 h-4 text-gray-600 ml-auto" />
              </div>
              <div class="flex items-center pt-5">
                <div>
                  <div class="text-gray-600">Table</div>
                  <div class="mt-1">21</div>
                </div>
                <MicIcon class="w-4 h-4 text-gray-600 ml-auto" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- END: Post Content -->
      <!-- BEGIN: Post Info -->
      <div class="col-span-12 lg:col-span-3">
        <div class="box p-5">
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 pb-5">
            <div>
              <div class="text-gray-600">Role ID</div>
              <div class="mt-1">1</div>
            </div>
            <ShieldIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
            <div>
              <div class="text-gray-600">Created by</div>
              <div class="mt-1">Nikko Grallo</div>
            </div>
            <UserIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center border-b border-gray-200 dark:border-dark-5 py-5">
            <div>
              <div class="text-gray-600">Created at</div>
              <div class="mt-1">02/06/20 02:10 PM</div>
            </div>
            <PlusCircleIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
          <div class="flex items-center pt-5">
            <div>
              <div class="text-gray-600">Updated at</div>
              <div class="mt-1">02/06/20 02:10 PM</div>
            </div>
            <ClockIcon class="w-4 h-4 text-gray-600 ml-auto" />
          </div>
        </div>
      </div>
      <!-- END: Post Info -->
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({

})
</script>
