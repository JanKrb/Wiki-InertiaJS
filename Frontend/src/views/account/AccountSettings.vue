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
        <form @submit.prevent="submitCredentials(this.user)">
          <div class="intro-y box lg:mt-5">
            <div class="flex items-center p-3 border-b border-gray-200 dark:border-dark-5">
              <h2 class="font-medium text-base mr-auto">Roles & Tags</h2>
              <button class="btn btn-primary btn-sm ml-auto" type="submit"><SaveIcon class="mr-2 w-5 h-5"></SaveIcon>Save</button>
            </div>
            <div class="p-5">
              <div class="flex flex-col-reverse xl:flex-row flex-col">
                <div class="flex-1 mt-6 xl:mt-0">
                  <div class="grid grid-cols-12 gap-x-5">
                    <div class="col-span-12 xxl:col-span-6">
                      <div>
                        <label class="form-label">
                          Role
                        </label>
                        <TailSelect
                          v-model="user_role"
                          :options="{
                            search: true,
                            classNames: 'w-full'
                          }"
                        >
                          <option :value="role.id" v-for="role in roles" v-bind:key="role.id" :selected="role.id === this.user.role.id">{{ role.name }}</option>
                        </TailSelect>
                      </div>
                    </div>
                    <div class="col-span-12 xxl:col-span-6">
                      <div>
                        <label class="form-label">
                          Tags
                        </label>
                        <TailSelect
                          v-model="new_badges"
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
                          <option :value=badge.id v-for="badge in this.badges" v-bind:key="badge.id">{{ badge.title }}</option>
                        </TailSelect>
                        {{new_badges}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
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
import { defineComponent } from 'vue'
import Sidebar from './Components/Sidebar.vue'
import axios from 'axios'

export default defineComponent({
  components: {
    Sidebar
  },
  data() {
    return {
      user_role: '',
      new_badges: [],
      user_badges: [],
      user: {
        role: {
          id: 0
        }
      },
      badges: [],
      roles: []
    }
  },
  mounted() {
    this.fetchRoles()
    this.fetchBadges()
    this.fetchUser(this.$route.params.id)
    this.fetchUserBadges(this.$route.params.id)
  },
  methods: {
    submitCredentials(user) {
      const loader = this.$loading.show()

      // update Userrole
      this.updateUser(user)

      // Filter Badges
      const deleteBadges = []
      const createBadges = []

      for (const item in this.user_badges) {
        const badge = this.user_badges[item]
        if (!this.new_badges.map((item) => { return parseInt(item) }).includes(badge.id)) {
          deleteBadges.push(badge.id)
        }
      }

      const userBadgesId = this.user_badges.map((item) => { return item.id })

      for (const item in this.new_badges) {
        const badge = this.new_badges[item]
        if (!userBadgesId.includes(parseInt(badge))) {
          createBadges.push(badge)
        }
      }
      console.log('Creating Badges:')
      console.log(createBadges)
      console.log('Deleting Badges:')
      console.log(deleteBadges)

      // Delete old Badges
      if (deleteBadges.length > 0) {
        this.deleteUserBadges(deleteBadges)
      }

      // Create new Badges
      if (createBadges.length > 0) {
        this.createUserBadges(createBadges)
      }
      loader.hide()
    },
    deleteUserBadges(badges) {
      const loader = this.$loading.show()
      axios.delete('http://localhost:8000/api/users/' + this.$route.params.id + '/badges/multiple', {
        badges: badges
      })
        .then(response => {
          console.log(response)
          loader.hide()
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    createUserBadges(badges) {
      const loader = this.$loading.show()
      axios.post('http://localhost:8000/api/users/' + this.$route.params.id + '/badges/multiple', {
        badges: badges
      })
        .then(response => {
          console.log(response)
          loader.hide()
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    updateUser(user) {
      axios.put('http://localhost:8000/api/users/' + user.id, {
        name: user.name,
        pre_name: user.pre_name,
        last_name: user.last_name,
        email: user.email,
        role_id: this.user_role
      })
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          console.error(error)
        })
    },
    fetchUser(id) {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/users/' + id)
        .then(response => {
          this.user = response.data.data
          this.user_role = response.data.data.role.id
          loader.hide()
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    fetchRoles() {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/roles')
        .then(response => {
          this.roles = response.data.data
          loader.hide()
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    fetchBadges() {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/badges')
        .then(response => {
          this.badges = response.data.data
          loader.hide()
        })
        .catch(error => {
          console.error(error)
          loader.hide()
        })
    },
    fetchUserBadges(id) {
      const loader = this.$loading.show()
      axios.get('http://localhost:8000/api/users/' + id + '/badges')
        .then(response => {
          this.user_badges = response.data.data
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
