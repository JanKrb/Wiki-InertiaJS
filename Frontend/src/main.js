import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueLoading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
import globalComponents from './global-components'
import utils from './utils'
import './libs'
import moment from 'moment'

// SASS Theme
import './assets/sass/app.scss'
import { DateTime } from 'litepicker/dist/types/datetime'

const app = createApp(App)
  .use(store)
  .use(router)

globalComponents(app)
utils(app)

app.mount('#app')
app.use(VueLoading, {
  color: '#6772E4',
  loader: 'spinner',
  width: 64,
  height: 64,
  backgroundColor: '#ffffff',
  opacity: 0.5,
  zIndex: 999
}, {})

var formatter = {
  date: function (value, format) {
    if (value) {
      return moment(String(value)).format(format || 'MM/DD/YY')
    }
  },
  time: function (value, format) {
    if (value) {
      return moment(String(value)).format(format || 'h:mm A')
    }
  },
  full_beauty: function (value, format) {
    if (value) {
      return moment(String(value)).format(format || 'MMM Do YYYY - hh:mm')
    }
  },
  time_ago: function (value) {
    if (value) {
      const date = moment(value, 'YYYY-MM-DD HH:mm:ss')

      const seconds = Math.floor((new Date() - date) / 1000)

      let interval = seconds / 31536000

      if (interval > 1) {
        return Math.floor(interval) + ' years'
      }
      interval = seconds / 2592000

      if (interval > 1) {
        return Math.floor(interval) + ' months'
      }
      interval = seconds / 86400

      if (interval > 1) {
        return Math.floor(interval) + ' days'
      }
      interval = seconds / 3600

      if (interval > 1) {
        return Math.floor(interval) + ' hours'
      }
      interval = seconds / 60

      if (interval > 1) {
        return Math.floor(interval) + ' minutes'
      }

      return Math.floor(seconds) + ' seconds'
    }
  }
}

app.component('format', {
  template: '<span>{{ formatter[fn](value, format) }}</span>',
  props: ['value', 'fn', 'format'],
  computed: {
    formatter() {
      return formatter
    }
  }
})
