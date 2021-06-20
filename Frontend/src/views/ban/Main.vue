<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Ban Overview</h2>
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
                  :src="this.ban.target?.profile_picture"
                />
              </div>
              <div class="ml-5">
                <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                  {{ this.ban.target.name }}
                </div>
                <div class="text-gray-600">{{ this.ban.target.pre_name }} {{ this.ban.target.last_name }}</div>
              </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
              <div class="font-medium text-center lg:text-left lg:mt-3">
                User Details
              </div>
              <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                <div class="truncate sm:whitespace-normal flex items-center">
                  <MailIcon class="w-4 h-4 mr-2"/>{{ this.ban.target.email }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                  <ShieldIcon class="w-4 h-4 mr-2"/>{{ this.ban.target.role?.name }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                  <HashIcon class="w-4 h-4 mr-2"/>User-ID: {{ this.ban.target.id }}
                </div>
              </div>
            </div>
            <div class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  {{ this.bancount.global }}
                </div>
                <div class="text-gray-600">Global Bans</div>
              </div>
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  {{ this.bancount.comments }}
                </div>
                <div class="text-gray-600">Comment Bans</div>
              </div>
              <div class="text-center rounded-md w-40 py-3">
                <div class="font-medium text-theme-1 dark:text-theme-10 text-xl">
                  {{ this.bancount.posts }}
                </div>
                <div class="text-gray-600">Posting Bans</div>
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
              <h2 class="font-medium text-base mr-auto">Selected Ban</h2>
              <button class="btn btn-primary btn-sm ml-auto"><SaveIcon class="w-4 h-4 mr-3"></SaveIcon>Update</button>
            </div>
            <div class="p-5">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5 mb-4">
                    <div class="col-span-12 xxl:col-span-12 mb-4">
                      <div>
                        <label for="create-reason-ban" class="form-label">
                          Reason
                        </label>
                        <input
                          id="create-reason-ban"
                          type="text"
                          class="form-control"
                          placeholder="Enter ban reason"
                          v-model="ban.reason"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-12 mb-4">
                      <div>
                        <label for="create-description-ban" class="form-label">
                          Description
                        </label>
                        <textarea
                          id="create-description-ban"
                          type="text"
                          class="form-control"
                          placeholder="Enter a ban description"
                          v-model="ban.description"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6 mb-4">
                      <div>
                        <label for="create-date-ban" class="form-label">
                          Unban Date
                        </label>
                        <input
                          id="create-date-ban"
                          type="date"
                          class="form-control"
                          v-model="ban_time.date"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6 mb-4">
                      <div>
                        <label for="create-time-ban" class="form-label">
                          Ban Time
                        </label>
                        <input
                          id="create-time-ban"
                          type="time"
                          class="form-control"
                          v-model="ban_time.time"
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6 mb-4">
                      <div>
                        <label for="create-type-ban" class="form-label">
                          Ban type
                        </label>
                        <TailSelect
                          v-model="ban.type"
                          :options="{
                            classNames: 'w-full'
                          }"
                        >
                          <option :selected="ban.type === 0">Global Ban</option>
                          <option :selected="ban.type === 1">Comment Ban</option>
                          <option :selected="ban.type === 2">Posting Ban</option>
                        </TailSelect>
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-3 mb-4">
                      <div>
                        <label for="create-target-ban" class="form-label">
                          Target
                        </label>
                        <input
                          id="create-target-ban"
                          type="text"
                          class="form-control"
                          :value="ban.target.name"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-3 mb-4">
                      <div>
                        <label for="create-staff-ban" class="form-label">
                          Staff
                        </label>
                        <input
                          id="create-staff-ban"
                          type="text"
                          class="form-control"
                          :value="ban.staff.name"
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
              <h2 class="font-medium text-base mr-auto">Current Ban</h2>
              <button class="btn btn-danger btn-sm ml-auto"><Trash2Icon class="mr-2 w-5 h-5"></Trash2Icon>Delete</button>
            </div>
            <div class="p-5">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5 mb-4">
                    <div class="col-span-12">
                      <div class="p-5 text-center">
                        <CheckCircleIcon class="w-16 h-16 text-theme-9 mx-auto mt-3" />
                        <div class="text-3xl mt-5">Unbanned</div>
                        <div class="text-gray-600 mt-2">
                          This user is currently Unbanned!
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

export default defineComponent({
  data() {
    return {
      bancount: {},
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
    this.fetchBan(this.$route.params.id)
  },
  methods: {
    fetchBan(id) {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/bans/' + id)
        .then(response => {
          // Set General ban
          this.ban = response.data.data
          // Split Ban time
          this.ban_time.date = response.data.data.ban_until.split(' ')[0]
          this.ban_time.time = response.data.data.ban_until.split(' ')[1]
          // Stop Animation, Load other values
          loader.hide()
          this.fetchBanCount(response.data.data.target.id)
          this.fetchRole(response.data.data.target.role_id)
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    fetchBanCount(id) {
      axios.get('http://localhost:8000/api/users/' + id + '/bans/count')
        .then(response => {
          this.bancount = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    fetchRole(id) {
      axios.get('http://localhost:8000/api/roles/' + id)
        .then(response => {
          this.ban.target.role = response.data.data
        })
        .catch(error => {
          console.error(error)
        })
    }
  }
})
</script>
