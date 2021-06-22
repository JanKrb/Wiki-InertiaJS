<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Notification Overview</h2>
    </div>
    <div class="grid grid-cols-12 gap-6">
      <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
        <!-- BEGIN: Notification Page -->
        <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
          <!-- BEGIN: Notification Side Menu -->
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
                    id="histories-tab"
                    data-toggle="tab"
                    data-target="#histories"
                    href="javascript:;"
                    class="flex-1 py-2 rounded-md text-center"
                    role="tab"
                    aria-controls="histories"
                    aria-selected="false"
                  >
                    User Histories
                  </a>
                </div>
              </div>
            </div>
            <div class="tab-content">
              <!-- BEGIN: Notification Histories Menu -->
              <div
                id="histories"
                class="tab-pane"
                role="tabpanel"
                aria-labelledby="histories-tab"
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
                      <div class="flex mt-3">
                        <a
                          v-for="user in this.users"
                          v-bind:key="user.id"
                          href=""
                          class="w-14 mr-4 cursor-pointer mb-3"
                        >
                          <div class="w-14 h-14 flex-none image-fit rounded-full">
                            <img
                              alt=""
                              class="rounded-full"
                              :src="user.profile_picture"
                            />
                            <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                          </div>
                          <div class="text-xs text-gray-600 truncate text-center mt-2">
                            {{ user.name }}
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1">
                  <div
                    v-for="user in this.users"
                    v-bind:key="user.id"
                    class="intro-x cursor-pointer box relative flex items-center p-5 mt-4"
                    @click="showChatBox"
                  >
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt=""
                        class="rounded-full"
                        :src="user?.profile_picture"
                      />
                      <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="javascript:;" class="font-medium">
                          {{ user.name }}
                        </a>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        {{ user.email }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ENG: Notification Histories Menu -->
              <!-- BEGIN: Notification Creation Menu -->
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
                  <div
                    class="cursor-pointer box relative flex items-center p-5 mt-5"
                    v-for="user in this.users"
                    v-bind:key="user.id"
                  >
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                      <img
                        alt=""
                        class="rounded-full"
                        :src="user?.profile_picture"
                      />
                      <div class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a class="font-medium">
                          {{ user.name }}
                        </a>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        {{ user.email }}
                      </div>
                    </div>
                    <div class="dropdown ml-auto" v-if='this.permissions?.users_update'>
                      <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false">
                        <MoreHorizontalIcon class="w-5 h-5 text-gray-600 dark:text-gray-300"/>
                      </a>
                      <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                          <router-link :to="{ name: 'admin.accounts.informations', params: { 'id': user.id }}">
                            <a href="javascript:;" data-dismiss="dropdown" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                              <UserIcon class="w-4 h-4 mr-2"/>View Profile
                            </a>
                          </router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Notification Creation Menu -->
              <!-- BEGIN: Notification Userhistory Menu -->
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
                    @click="showSingleNotification(notification)"
                  >
                    <div class="w-12 h-12 flex-none mr-1" v-if="notification.type === 1">
                      <a class="flex items-center absolute top-0 bottom-0">
                        <component class="w-8 h-8 text-gray-600" :is="notification?.icon"/>
                      </a>
                    </div>
                    <div class="w-12 h-12 flex-none image-fit mr-1" v-if="notification.type === 2">
                      <img
                        alt=""
                        class="rounded-full"
                        :src="notification.target_user?.profile_picture"
                      />
                    </div>
                    <div class="ml-2 overflow-hidden">
                      <div class="flex items-center">
                        <a href="javascript:;" class="font-medium">
                          {{ notification.title }}
                        </a>
                        <div class="text-xs text-gray-500 ml-auto">
                          {{ notification.created_at }}
                        </div>
                      </div>
                      <div class="w-full truncate text-gray-600 mt-0.5">
                        {{ notification.content }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Notification Userhistory Menu -->
            </div>
          </div>
          <!-- END: Notification Side Menu -->

          <!-- BEGIN: Notification Default Tab -->
          <div class="intro-y col-span-12 lg:col-span-8 xxl:col-span-9" v-if="this.active_tab === 0">
            <div class="chat__box box">
              <div class="h-full flex items-center">
                <div class="mx-auto text-center">
                  <div class="w-24 h-24 flex-none overflow-hidden mx-auto">
                    <AlertTriangleIcon class="w-24 h-24"/>
                  </div>
                  <div class="mt-3">
                    <div class="font-medium">
                      Warning!
                    </div>
                    <div class="text-gray-600 mt-1">
                      Please select a notification to receive more information
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END: Notification Default Tab -->
          <!-- BEGIN: Notification Singlepage Tab -->
          <div class="intro-y col-span-12 lg:col-span-8 xxl:col-span-9" v-if="this.active_tab === 1">
            <div class="chat__box box h-4 flex-grow">
              <div class="h-full flex flex-col">
                <div class="overflow-y-scroll scrollbar-hidden px-5 pt-5 flex-1">
                  <div class="intro-y box px-5 pt-5">
                    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
                      <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                          <img
                            alt=""
                            class="rounded-full"
                            :src="this.single_notification.user?.profile_picture"
                          />
                        </div>
                        <div class="ml-5">
                          <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                            {{ this.single_notification.user?.name }}
                          </div>
                          <div class="text-gray-600">{{ this?.single_notification?.user.role?.name }}</div>
                        </div>
                      </div>
                      <div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                        <div class="font-medium text-center lg:text-left lg:mt-3">
                          Contact Details
                        </div>
                        <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                          <div class="truncate sm:whitespace-normal flex items-center">
                            <MailIcon class="w-4 h-4 mr-2"/>{{ this?.single_notification?.user.email }}
                          </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <UserIcon class="w-4 h-4 mr-2"/>{{ this?.single_notification?.user?.pre_name }} {{ this?.single_notification?.user?.last_name }}
                          </div>
                          <div class="truncate sm:whitespace-normal flex items-center mt-3">
                            <HashIcon class="w-4 h-4 mr-2"/>User ID: {{ this?.single_notification?.user.id }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="p-5">
                    <div class="flex flex-col-reverse xl:flex-row flex-col">
                      <div class="flex-1 mt-6 xl:mt-0">
                        <div class="grid grid-cols-12 gap-x-5 mb-3">
                          <div class="col-span-12 xxl:col-span-12 mb-4">
                            <div>
                              <label for="update-title-notification" class="form-label">
                                Title
                              </label>
                              <input
                                id="update-title-notification"
                                type="text"
                                :class="'form-control' + (this.validation_error?.title != null ? ' border-theme-6' : '')"
                                placeholder="Enter Title"
                                v-model="this.single_notification.title"
                              />
                              <div v-if="this.validation_error?.title != null" class="text-theme-6 mt-2 mb-4">
                                {{ this.validation_error?.title[0] }}
                              </div>
                            </div>
                          </div>
                          <div class="col-span-12 xxl:col-span-12 mb-4">
                            <div>
                              <label for="update-title-notification" class="form-label">
                                Content
                              </label>
                              <textarea
                                id="update-content-notification"
                                :class="'form-control' + (this.validation_error?.content != null ? ' border-theme-6' : '')"
                                placeholder="Enter Content"
                                rows="5"
                                v-model="this.single_notification.content"
                              />
                              <div v-if="this.validation_error?.content != null" class="text-theme-6 mt-2 mb-4">
                                {{ this.validation_error?.content[0] }}
                              </div>
                            </div>
                          </div>
                          <div class="col-span-12 xxl:col-span-6 mb-4">
                            <div>
                              <label for="update-color-notification" class="form-label">
                                Color
                              </label>
                              <input
                                id="update-color-notification"
                                type="color"
                                :class="'form-control' + (this.validation_error?.color != null ? ' border-theme-6' : '')"
                                placeholder="Enter notification reason"
                                v-model="this.single_notification.color"
                              />
                              <div v-if="this.validation_error?.color != null" class="text-theme-6 mt-2 mb-4">
                                {{ this.validation_error?.color[0] }}
                              </div>
                            </div>
                          </div>
                          <div class="col-span-12 xxl:col-span-6 mb-4">
                            <div>
                              <label class="form-label">
                                Type
                              </label>
                              <TailSelect
                                v-model="this.single_notification.type"
                                :class="'form-control' + (this.validation_error?.type != null ? ' border-theme-6' : '')"
                                :options="{
                                search: true,
                                classNames: 'w-full'
                              }"
                              >
                                <option value=1>Icon</option>
                                <option value=2>User</option>
                              </TailSelect>
                              <div v-if="this.validation_error?.type != null" class="text-theme-6 mt-2 mb-4">
                                {{ this.validation_error?.type[0] }}
                              </div>
                              {{ this.single_notification.type }}
                            </div>
                          </div>
                          <div class="col-span-12 xxl:col-span-12">
                            <hr class="my-5">
                          </div>
                          <div class="col-span-12 xxl:col-span-6 mb-4">
                            <div>
                              <label for="update-icon-notification" class="form-label">
                                Icon
                              </label>
                              <input
                                id="update-icon-notification"
                                type="text"
                                :class="'form-control' + (this.validation_error?.icon != null ? ' border-theme-6' : '')"
                                placeholder="Enter Icon"
                                v-model="this.single_notification.icon"
                                :disabled="parseInt(this.single_notification.type) !== 1"
                              />
                              <div v-if="parseInt(this.single_notification.type) !== 1" class="text-theme-6 mt-2 mb-4">
                                User Badge is selected!
                              </div>
                              <div v-if="this.validation_error?.icon != null" class="text-theme-6 mt-2 mb-4">
                                {{ this.validation_error?.type[0] }}
                              </div>
                            </div>
                          </div>
                          <div class="col-span-12 xxl:col-span-6 mb-4">
                            <div>
                              <label class="form-label">
                                User
                              </label>
                              <TailSelect
                                :class="'form-control' + (this.validation_error?.target_id != null ? ' border-theme-6' : '')"
                                :options="{
                                  search: true,
                                  classNames: 'w-full'
                                }"
                              >
                                <option :value="user.id" v-for="user in this.users" v-bind:key="user.id" :selected="this.single_notification.target_id === user.id">
                                  {{ user.name }}
                                </option>
                              </TailSelect>
                              <div v-if="parseInt(this.single_notification.type) !== 2" class="text-theme-6 mt-2 mb-4">
                                Icon Badge is selected!
                              </div>
                              <div v-if="this.validation_error?.target_id != null" class="text-theme-6 mt-2 mb-4">
                                {{ this.validation_error?.type[0] }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END: Notification Singlepage Tab -->
          <!-- BEGIN: Notification Creation Tab -->
          <div class="intro-y col-span-12 lg:col-span-8 xxl:col-span-9" v-if="this.active_tab === 2">
            <div class="chat__box box">
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
            </div>
          </div>
          <!-- END: Notification Creation Tab -->
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
      active_tab: 0,
      user: {},
      users: [],
      notifications: [],
      validation_error: {},
      permissions: {}
    }
  },
  mounted() {
    this.fetchUser()
    this.fetchNotifications('http://localhost:8000/api/notifications?per_page=100000')
    this.fetchUsers('http://localhost:8000/api/users?per_page=100000')
    this.testPagePermissions()
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
    fetchUsers(page) {
      const loader = this.$loading.show()
      axios.get(page)
        .then(response => {
          this.users = response.data.data
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
    },
    testPagePermissions() {
      axios.post('http://localhost:8000/api/permissions/test', {
        permissions: [
          'users_update'
        ]
      })
        .then((response) => {
          this.permissions = response.data.data
        })
        .catch((err) => {
          console.error(err)
          console.log(err.response)
        })
    },
    showSingleNotification(notification) {
      this.single_notification = notification
      this.active_tab = 1
    }
  }
})
</script>
