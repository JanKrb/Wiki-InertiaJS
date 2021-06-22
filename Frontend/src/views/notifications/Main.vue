<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Notification Overview</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
        <!-- BEGIN: Roles & Tags -->
        <div class="intro-y box px-5 pt-5 mt-5">
          <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
              <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                <img
                  alt=""
                  class="rounded-full"
                  :src="this.user?.profile_picture"
                />
              </div>
              <div class="ml-5">
                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                  {{ this.user.name }}
                </div>
                <div class="text-gray-600">{{ this.user.pre_name }} {{ this.user.last_name }}</div>
              </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
              <div class="font-medium text-center lg:text-left lg:mt-3">
                User Details
              </div>
              <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="truncate sm:whitespace-normal flex items-center">
                  <MailIcon class="w-4 h-4 mr-2"/>{{ this.user.email }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                  <ShieldIcon class="w-4 h-4 mr-2"/>{{ this.user.role_id }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                  <HashIcon class="w-4 h-4 mr-2"/>User-ID: {{ this.user.id }}
                </div>
              </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  1
                </div>
                <div class="text-gray-600">Global Notifications</div>
              </div>
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  1
                </div>
                <div class="text-gray-600">Comment Notifications</div>
              </div>
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  1
                </div>
                <div class="text-gray-600">Posting Notifications</div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Roles & Tags -->
        <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
          <!-- BEGIN: Chat Side Menu -->
          <div class="col-span-12 lg:col-span-4 xxl:col-span-3">
            <div class="intro-y pr-1">
              <div class="box p-2">
                <div class="chat__tabs nav nav-tabs justify-center" role="tablist">
                  <a
                    id="profile-tab"
                    data-toggle="tab"
                    data-target="#profile"
                    href="javascript:;"
                    class="flex-1 py-2 rounded-md text-center active"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="true"
                  >
                    Latest Notifications
                  </a>
                  <a
                    id="create-notification-tab"
                    data-toggle="tab"
                    data-target="#create-notification"
                    href="javascript:;"
                    class="flex-1 py-2 rounded-md text-center"
                    role="tab"
                    aria-controls="create-notification"
                    aria-selected="false"
                  >
                    Create Notification
                  </a>
                  <a
                    id="chats-tab"
                    data-toggle="tab"
                    data-target="#chats"
                    href="javascript:;"
                    class="flex-1 py-2 rounded-md text-center"
                    role="tab"
                    aria-controls="chats"
                    aria-selected="false"
                  >
                    User Histories
                  </a>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <div
                id="chats"
                class="tab-pane"
                role="tabpanel"
                aria-labelledby="chats-tab"
              >
                <div class="pr-1">
                  <div class="box px-5 pt-5 pb-5 lg:pb-0 mt-5">
                    <div class="relative text-gray-700 dark:text-gray-300">
                      <input
                        type="text"
                        class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                        placeholder="Search for messages or users..."
                      />
                      <SearchIcon
                        class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0"
                      />
                    </div>
                    <div class="overflow-x-auto scrollbar-hidden">
                      <div class="flex mt-5">
                        <a
                          v-for="(faker, fakerKey) in $_.take($f(), 10)"
                          :key="fakerKey"
                          href=""
                          class="w-10 mr-4 cursor-pointer"
                        >
                          <div class="w-10 h-10 flex-none image-fit rounded-full">
                            <img
                              alt="Icewall Tailwind HTML Admin Template"
                              class="rounded-full"
                              :src="require(`@/assets/images/${faker.photos[0]}`)"
                            />
                            <div
                              class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"
                            ></div>
                          </div>
                          <div class="text-xs text-gray-600 truncate text-center mt-2">
                            {{ faker.users[0].name }}
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                  <div
                    v-for="(faker, fakerKey) in $_.take($f(), 10)"
                    :key="fakerKey"
                    class="intro-x cursor-pointer box relative flex items-center p-5"
                    :class="{ 'mt-5': fakerKey }"
                    @click="showChatBox"
                  >
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt="Icewall Tailwind HTML Admin Template"
                        class="rounded-full"
                        :src="require(`@/assets/images/${faker.photos[0]}`)"
                      />
                      <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="javascript:;" class="font-medium">{{
                            faker.users[0].name
                          }}</a>
                        <div class="text-xs text-gray-500 ml-auto">
                          {{ faker.times[0] }}
                        </div>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        {{ faker.news[0].shortContent }}
                      </div>
                    </div>
                    <div v-if="faker.trueFalse[0]" class="w-5 h-5 flex items-center justify-center absolute top-0 right-0 text-xs text-white rounded-full bg-theme-1 font-medium -mt-1 -mr-1">
                      {{ faker.notificationCount }}
                    </div>
                  </div>
                </div>
              </div>
              <div
                id="create-notification"
                class="tab-pane"
                role="tabpanel"
                aria-labelledby="create-notification-tab"
              >
                <div class="pr-1">
                  <div class="box p-5 mt-5">
                    <div class="relative text-gray-700 dark:text-gray-300">
                      <input
                        type="text"
                        class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                        placeholder="Search Username..."
                      />
                      <SearchIcon class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0"/>
                    </div>
                    <button type="button" class="btn btn-primary w-full mt-3">
                      Search
                    </button>
                  </div>
                </div>
                <div class="chat__user-list overflow-y-auto scrollbar-hidden pr-1 pt-1">
                  <div class="cursor-pointer box relative flex items-center p-5 mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt="Icewall Tailwind HTML Admin Template"
                        class="rounded-full"
                        :src="require(`@/assets/images/${$f()[0].photos[0]}`)"
                      />
                      <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="" class="font-medium">
                          {{ $f()[0].users[0].name }}
                        </a>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        Last seen 2 hours ago
                      </div>
                    </div>
                    <div class="dropdown ml-auto">
                      <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false">
                        <MoreHorizontalIcon class="w-5 h-5 text-gray-600 dark:text-gray-300"/>
                      </a>
                      <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <Share2Icon class="w-4 h-4 mr-2" />
                            Share Contact
                          </a>
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <CopyIcon class="w-4 h-4 mr-2" /> Copy Contact
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="cursor-pointer box relative flex items-center p-5 mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt="Icewall Tailwind HTML Admin Template"
                        class="rounded-full"
                        :src="require(`@/assets/images/${$f()[1].photos[0]}`)"
                      />
                      <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="" class="font-medium">
                          {{ $f()[1]["users"][0]["name"] }}
                        </a>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        Last seen 2 hours ago
                      </div>
                    </div>
                    <div class="dropdown ml-auto">
                      <a
                        class="dropdown-toggle w-5 h-5 block"
                        href="javascript:;"
                        aria-expanded="false"
                      >
                        <MoreHorizontalIcon class="w-5 h-5 text-gray-600 dark:text-gray-300"/>
                      </a>
                      <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <Share2Icon class="w-4 h-4 mr-2"/>Share Contact
                          </a>
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <CopyIcon class="w-4 h-4 mr-2"/> Copy Contact
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="cursor-pointer box relative flex items-center p-5 mt-5"
                  >
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt="Icewall Tailwind HTML Admin Template"
                        class="rounded-full"
                        :src="require(`@/assets/images/${$f()[3].photos[0]}`)"
                      />
                      <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="" class="font-medium">
                          {{ $f()[3]["users"][0]["name"] }}
                        </a>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        Last seen 2 hours ago
                      </div>
                    </div>
                    <div class="dropdown ml-auto">
                      <a
                        class="dropdown-toggle w-5 h-5 block"
                        href="javascript:;"
                        aria-expanded="false"
                      >
                        <MoreHorizontalIcon
                          class="w-5 h-5 text-gray-600 dark:text-gray-300"
                        />
                      </a>
                      <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <Share2Icon class="w-4 h-4 mr-2"/>Share Contact
                          </a>
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <CopyIcon class="w-4 h-4 mr-2"/>Copy Contact
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="cursor-pointer box relative flex items-center p-5 mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt=""
                        class="rounded-full"
                        :src="require(`@/assets/images/${$f()[4].photos[0]}`)"
                      />
                      <div
                        class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"
                      ></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="" class="font-medium">
                          {{ $f()[4]["users"][0]["name"] }}
                        </a>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        Last seen 2 hours ago
                      </div>
                    </div>
                    <div class="dropdown ml-auto">
                      <a
                        class="dropdown-toggle w-5 h-5 block"
                        href="javascript:;"
                        aria-expanded="false"
                      >
                        <MoreHorizontalIcon class="w-5 h-5 text-gray-600 dark:text-gray-300"/>
                      </a>
                      <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <Share2Icon class="w-4 h-4 mr-2"/>Share Contact
                          </a>
                          <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <CopyIcon class="w-4 h-4 mr-2"/>Copy Contact
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                id="profile"
                class="tab-pane active"
                role="tabpanel"
                aria-labelledby="profile-tab"
              >
                <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                  <div
                    v-for="notification in this.notifications"
                    v-bind:key="notification.id"
                    class="intro-x cursor-pointer box relative flex items-center p-5"
                    @click="showChatBox"
                  >
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt=""
                        class="rounded-full"
                        :src="notification.user.profile_picture"
                      />
                      <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="javascript:;" class="font-medium">{{
                            faker.users[0].name
                          }}</a>
                        <div class="text-xs text-gray-500 ml-auto">
                          {{ faker.times[0] }}
                        </div>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        {{ faker.news[0].shortContent }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END: Chat Side Menu -->
          <!-- BEGIN: Chat Content -->
          <div class="intro-y col-span-12 lg:col-span-8 xxl:col-span-9">
            <div class="chat__box box">
              <!-- BEGIN: Chat Default -->
              <div class="h-full">
                <div class="p-5">
                  <div class="flex flex-col-reverse xl:flex-row flex-col">
                    <div class="flex-1 mt-6 xl:mt-0">
                      <div class="grid grid-cols-12 gap-x-5 mb-4">
                        <div class="col-span-12 xxl:col-span-12 mb-4">
                          <div>
                            <label for="update-reason-notification" class="form-label">
                              Reason
                            </label>
                            <input
                              id="update-reason-notification"
                              type="text"
                              :class="'form-control' + (this.validation_error?.reason != null ? ' border-theme-6' : '')"
                              placeholder="Enter notification reason"
                              v-model="test"
                            />
                            <div v-if="this.validation_error?.reason != null" class="text-theme-6 mt-2 mb-4">
                              {{ this.validation_error?.reason[0] }}
                            </div>
                          </div>
                        </div>
                        <div class="col-span-12 xxl:col-span-12 mb-4">
                          <div>
                            <label for="update-description-notification" class="form-label">
                              Description
                            </label>
                            <textarea
                              id="update-description-notification"
                              :class="'form-control' + (this.validation_error?.description != null ? ' border-theme-6' : '')"
                              placeholder="Enter a notification description"
                              v-model="test"
                            />
                            <div v-if="this.validation_error?.description != null" class="text-theme-6 mt-2 mb-4">
                              {{ this.validation_error?.description[0] }}
                            </div>
                          </div>
                        </div>
                        <div class="col-span-12 xxl:col-span-6 mb-4">
                          <div>
                            <label for="update-date-notification" class="form-label">
                              Unnotification Date
                            </label>
                            <input
                              id="update-date-notification"
                              type="date"
                              :class="'form-control' + (this.validation_error?.notification_until != null ? ' border-theme-6' : '')"
                              v-model="test"
                            />
                            <div v-if="this.validation_error?.notification_until != null" class="text-theme-6 mt-2 mb-4">
                              {{ this.validation_error?.notification_until[0] }}
                            </div>
                          </div>
                        </div>
                        <div class="col-span-12 xxl:col-span-6 mb-4">
                          <div>
                            <label for="update-time-notification" class="form-label">
                              Notification Time
                            </label>
                            <input
                              id="update-time-notification"
                              type="time"
                              :class="'form-control' + (this.validation_error?.notification_until != null ? ' border-theme-6' : '')"
                              v-model="test"
                            />
                            <div v-if="this.validation_error?.notification_until != null" class="text-theme-6 mt-2 mb-4">
                              {{ this.validation_error?.notification_until[0] }}
                            </div>
                          </div>
                        </div>
                        <div class="col-span-12 xxl:col-span-6 mb-4">
                          <div>
                            <label for="update-type-notification" class="form-label">
                              Notification type
                            </label>
                            <TailSelect
                              id="update-type-notification"
                              v-model="test"
                              :class="'form-control' + (this.validation_error?.type != null ? ' border-theme-6' : '')"
                              :options="{
                            classNames: 'w-full'
                            }"
                            >
                              <option value="0">Global Notification</option>
                              <option value="1">Comment Notification</option>
                              <option value="2">Posting Notification</option>
                            </TailSelect>
                            <div v-if="this.validation_error?.type != null" class="text-theme-6 mt-2 mb-4">
                              {{ this.validation_error?.type[0] }}
                            </div>
                          </div>
                        </div>
                        <div class="col-span-12 xxl:col-span-3 mb-4">
                          <div>
                            <label for="update-target-notification" class="form-label">
                              Target
                            </label>
                            <input
                              id="update-target-notification"
                              type="text"
                              class="form-control"
                              value="value"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-span-12 xxl:col-span-3 mb-4">
                          <div>
                            <label for="update-staff-notification" class="form-label">
                              Staff
                            </label>
                            <input
                              id="update-staff-notification"
                              type="text"
                              class="form-control"
                              value="value"
                              disabled
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Chat Default -->
            </div>
          </div>
          <!-- END: Chat Content -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import axios from 'axios'
import { useToast } from 'vue-toastification'
const toast = useToast()

export default defineComponent({
  data() {
    return {
      test: '',
      notificationCount: {},
      user: {},
      notifications: [],
      validation_error: {},
      ban_time: {
        date: '',
        time: ''
      },
      ban: {
        id: 0,
        target: {
          id: 0,
          name: '',
          pre_name: '',
          last_name: '',
          email: '',
          email_verified_at: null,
          created_at: '',
          updated_at: '',
          role_id: 0,
          role: {},
          deleted_at: null,
          profile_picture: ''
        },
        staff: {
          id: 0,
          name: '',
          pre_name: '',
          last_name: '',
          email: '',
          email_verified_at: null,
          created_at: '',
          updated_at: '',
          role_id: 0,
          deleted_at: null,
          profile_picture: ''
        },
        reason: '',
        description: '',
        ban_until: '',
        type: 0,
        active: false,
        created_at: '',
        updated_at: ''
      }
    }
  },
  mounted() {
    this.fetchUser()
    this.fetchNotifications('http://localhost:8000/api/notifications')
  },
  methods: {
    fetchNotifications(page) {
      const loader = this.$loading.show()
      axios.get(page)
        .then(response => {
          this.notifications = response.data.data
          loader.hide()
        })
        .catch(error => {
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          console.error(error)
          loader.hide()
        })
    },
    fetchUser() {
      axios.get('http://localhost:8000/api/auth/user')
        .then(response => {
          this.user = response.data.data.user
        })
        .catch(error => {
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          console.error(error)
        })
    }
  }
})
</script>
