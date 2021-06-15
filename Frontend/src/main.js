import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VueLoading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
import globalComponents from './global-components'
import utils from './utils'
import './libs'

// SASS Theme
import './assets/sass/app.scss'

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
