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
                  :src="this.notification.target?.profile_picture"
                />
              </div>
              <div class="ml-5">
                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                  {{ this.notification.target.name }}
                </div>
                <div class="text-gray-600">{{ this.notification.target.pre_name }} {{ this.notification.target.last_name }}</div>
              </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
              <div class="font-medium text-center lg:text-left lg:mt-3">
                User Details
              </div>
              <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="truncate sm:whitespace-normal flex items-center">
                  <MailIcon class="w-4 h-4 mr-2"/>{{ this.notification.target.email }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                  <ShieldIcon class="w-4 h-4 mr-2"/>{{ this.notification.target.role?.name }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                  <HashIcon class="w-4 h-4 mr-2"/>User-ID: {{ this.notification.target.id }}
                </div>
              </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  {{ this.notificationCount.global }}
                </div>
                <div class="text-gray-600">Global Notifications</div>
              </div>
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  {{ this.notificationCount.comments }}
                </div>
                <div class="text-gray-600">Comment Notifications</div>
              </div>
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  {{ this.notificationCount.posts }}
                </div>
                <div class="text-gray-600">Posting Notifications</div>
              </div>
            </div>
          </div>
        </div>
        <!-- END: Roles & Tags -->
        <!-- BEGIN: Settings -->
        <div class="grid grid-cols-12 gap-6 mt-5">
          <!-- BEGIN: Latest Uploads -->
          <div class="intro-y box col-span-12 lg:col-span-9">
            <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
              <h2 class="font-medium text-base mr-auto">Selected Notification</h2>
              <button class="btn btn-primary btn-sm ml-auto" @click="updateNotification(this.notification)"><SaveIcon class="w-4 h-4 mr-3"></SaveIcon>Update</button>
            </div>
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
                          v-model="notification.reason"
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
                          v-model="notification.description"
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
                          v-model="notification_time.date"
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
                          v-model="notification_time.time"
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
                          v-model="notification.type"
                          :class="'form-control' + (this.validation_error?.type != null ? ' border-theme-6' : '')"
                          :options="{
                            classNames: 'w-full'
                            }"
                          >
                          <option value="0" :selected="notification.type === 0">Global Notification</option>
                          <option value="1" :selected="notification.type === 1">Comment Notification</option>
                          <option value="2" :selected="notification.type === 2">Posting Notification</option>
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
                          :value="notification.target.name"
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
                          :value="notification.staff.name"
                          disabled
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="intro-y box col-span-12 lg:col-span-3">
            <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
              <h2 class="font-medium text-base mr-auto">Current Notification</h2>
            </div>
            <div class="p-5">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5 mb-4">
                    <div class="col-span-12">
                      <div v-if="this.isNotificationned === false" class="p-5 text-center">
                        <CheckCircleIcon class="w-16 h-16 text-theme-9 mx-auto mt-3"/>
                        <div class="text-3xl mt-5">Unnotificationned</div>
                        <div class="text-gray-600 mt-2">
                          This user is currently Unnotificationned!
                        </div>
                      </div>
                      <div v-else class="p-5 text-center">
                        <XCircleIcon class="w-16 h-16 text-theme-6 mx-auto mt-3"/>
                        <div class="text-3xl mt-5">Notificationned</div>
                        <div class="text-gray-600 mt-2">
                          This user is currently Notificationned!
                          <hr class="mt-4">
                          <div class="mt-4 flex-1 dark:text-gray-300 px-5 pt-5 lg:pt-0">
                            <div class="font-medium text-center lg:text-left lg:mt-3">
                              Most recent Notification:
                            </div>
                            <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                              <div class="truncate sm:whitespace-normal flex items-center">
                                <LockIcon class="w-4 h-4 mr-2"/>Type: {{ this.lastNotification.type === 0 ? 'Global Notification' : this.lastNotification.type === 1 ? 'Comment Notification' : 'Post Notification' }}
                              </div>
                              <div class="truncate sm:whitespace-normal flex items-center mt-3">
                                <AlignLeftIcon class="w-4 h-4 mr-2" />Reason: {{ this.lastNotification.reason }}
                              </div>
                              <div class="truncate sm:whitespace-normal flex items-center mt-3">
                                <ClockIcon class="w-4 h-4 mr-2" />Until: {{ this.lastNotification.notification_until }}
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
      notificationCount: {},
      validation_error: {},
      isNotificationned: false,
      lastNotification: {},
      notification_time: {
        date: '',
        time: ''
      },
      notification: {
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
        notification_until: '',
        type: 0,
        active: false,
        created_at: '',
        updated_at: ''
      }
    }
  },
  mounted() {
    this.fetchNotification(this.$route.params.id)
  },
  methods: {
    fetchNotification(id) {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/notifications/' + id)
        .then(response => {
          // Set General notification
          this.notification = response.data.data
          // Split Notification time
          this.notification_time.date = response.data.data.notification_until.split(' ')[0]
          this.notification_time.time = response.data.data.notification_until.split(' ')[1]
          // Stop Animation, Load other values
          loader.hide()
          this.fetchNotificationCount(response.data.data.target.id)
          this.fetchRole(response.data.data.target.role_id)
          this.checkNotifications(response.data.data.target.id)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    fetchNotificationCount(id) {
      axios.get('http://localhost:8000/api/users/' + id + '/notifications/count')
        .then(response => {
          this.notificationCount = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    fetchRole(id) {
      axios.get('http://localhost:8000/api/roles/' + id)
        .then(response => {
          this.notification.target.role = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    updateNotification(notification) {
      const loader = this.$loading.show()
      axios.put('http://localhost:8000/api/notifications/' + this.$route.params.id, {
        target_id: notification.target.id,
        reason: notification.reason,
        description: notification.description,
        type: notification.type,
        notification_until: this.notification_time.date + ' ' + this.notification_time.time
      })
        .then(response => {
          this.checkNotifications(notification.target.id)
          toast.success('Notification successfully updated')
          loader.hide()
        })
        .catch(error => {
          this.validation_error = error.response.data.data.errors
          toast.error(error.response.data.message)
          loader.hide()
        })
    },
    checkNotifications(id) {
      this.isNotificationned = false
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/users/' + id + '/notifications')
        .then(response => {
          for (let notification in response.data.data.sort((a, b) => { return new Date(a.created_at) - new Date(b.created_at) })) {
            notification = response.data.data[notification]
            if (notification.active === true) {
              this.isNotificationned = true
              this.lastNotification = notification
            }
          }
          loader.hide()
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    }
  }
})
</script>
