<template>
  <div>
    <div class="intro-y flex items-center mt-8">
      <h2 class="text-lg font-medium mr-auto">Notification</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
      <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Success Notification -->
        <div id="success-notification" class="p-5">
          <div class="preview">
            <div class="text-center">
              <!-- BEGIN: Notification Content -->
              <div id="notification-content" class="toastify-content hidden flex">
                <CheckCircleIcon v-if="this.type === 'success'" class="text-theme-9"/>
                <AlertTriangleIcon v-elseif="this.type === 'warning'" class="text-theme-12"/>
                <AlertCircleIcon v-elseif="this.type === 'danger'" class="text-theme-6"/>
                <XCircleIcon v-elseif="this.type === 'failed'" class="text-theme-6"/>
                <SlashIcon v-elseif="this.type === 'invalid'" class="text-theme-6"/>
                <HelpCircleIcon else class="text-theme-1"/>
                <div class="ml-4 mr-4">
                  <div class="font-medium">{{ this.title }}</div>
                  <div class="text-gray-600 mt-1">
                    {{ this.message }}
                  </div>
                </div>
              </div>
              <!-- END: Notification Content -->
              <!-- BEGIN: Notification Toggle -->
              <button
                id="success-notification-toggle"
                class="btn btn-primary"
                @click="successNotificationToggle"
              >
                Show Notification
              </button>
              <!-- END: Notification Toggle -->
            </div>
          </div>
        </div>
        <!-- END: Success Notification -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import Toastify from 'toastify-js'

export default defineComponent({
  props: [
    'title',
    'message',
    'type'
  ],
  setup() {
    const successNotificationToggle = () => {
      Toastify({
        node: cash('#notification-content')
          .clone()
          .removeClass('hidden')[0],
        duration: 300,
        newWindow: true,
        close: true,
        gravity: 'top',
        position: 'right',
        stopOnFocus: true
      }).showToast()
    }

    return {
      successNotificationToggle
    }
  },
  methods: {
    pushNotification() {
      Toastify({
        node: cash('#success-notification-content')
          .clone()
          .removeClass('hidden')[0],
        duration: 300,
        newWindow: true,
        close: true,
        gravity: 'top',
        position: 'right',
        stopOnFocus: true
      }).showToast()
    }
  }
})
</script>
