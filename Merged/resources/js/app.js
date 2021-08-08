import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'

// Libs
import Toast, { POSITION, TYPE } from 'vue-toastification'
import 'vue-toastification/dist/index.css'
import Chart from './chart/Main.vue'
import GoogleMapLoader from './google-map-loader/Main.vue'
import Highlight from './highlight/Main.vue'
import Litepicker from './litepicker/Main.vue'
import Tippy from './tippy/Main.vue'
import TippyContent from './tippy-content/Main.vue'
import TailSelect from './tail-select/Main.vue'
import LoadingIcon from './loading-icon/Main.vue'
import TinySlider from './tiny-slider/Main.vue'
import CKEditor from './ckeditor/Main.vue'
import Dropzone from './dropzone/Main.vue'
import FullCalendar from './calendar/Main.vue'
import FullCalendarDraggable from './calendar/Draggable.vue'
import * as featherIcons from '@zhuowenli/vue-feather-icons'

// Utils & Helpers
import faker from './utils/faker'
import helper from './utils/helper'
import lodash from './utils/lodash'
import './libs/zoom'
import './libs/tw-starter'
import store from './store'

const toastOptions = {
    toastDefaults: {
        [TYPE.ERROR]: {
            timeout: 10000,
            closeButton: false
        },
        [TYPE.SUCCESS]: {
            timeout: 5000,
            hideProgressBar: true
        }
    },
    position: POSITION.TOP_RIGHT
}

InertiaProgress.init()

createInertiaApp({
    resolve: name => require(`./pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)

        // Libs & Componentes
        app.use(Toast, toastOptions)
        app.component('Chart', Chart)
        app.component('GoogleMapLoader', GoogleMapLoader)
        app.component('Highlight', Highlight)
        app.component('Litepicker', Litepicker)
        app.component('Tippy', Tippy)
        app.component('TippyContent', TippyContent)
        app.component('TailSelect', TailSelect)
        app.component('LoadingIcon', LoadingIcon)
        app.component('TinySlider', TinySlider)
        app.component('Dropzone', Dropzone)
        app.component('CKEditor', CKEditor)
        app.component('FullCalendar', FullCalendar)
        app.component('FullCalendarDraggable', FullCalendarDraggable)

        for (const [key, icon] of Object.entries(featherIcons)) {
            icon.props.size.default = '24'
            app.component(key, icon)
        }

        // Utils & Helper
        app.use(faker)
        app.use(helper)
        app.use(lodash)
        app.use(store)

        app.mount(el)
    },
})
