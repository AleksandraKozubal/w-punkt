import './bootstrap'
import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy'
import Toast from "vue-toastification"
import "vue-toastification/dist/index.css"

const appName = import.meta.env.VITE_APP_NAME || 'W punkt'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
        .use(Toast, {
          position: 'top-right',
          timeout: 2000,
          closeOnClick: true,
          pauseOnFocusLoss: false,
          pauseOnHover: true,
          draggable: true,
          draggablePercent: 0.6,
          showCloseButtonOnHover: false,
          hideProgressBar: true,
          closeButton: 'button',
          icon: true,
          rtl: false,
          transition: 'Vue-Toastification__bounce',
          maxToasts: 10,
          newestOnTop: true,
          filterBeforeCreate: (toast, toasts) => {
            if (toasts.filter(
                t => t.type === toast.type,
            ).length !== 0) {
              return false
            }

            return toast
          },
        })
      .mount(el)
  },
  progress: {
    color: '#4B5563',
  },
})
