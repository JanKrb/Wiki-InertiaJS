import { createRouter, createWebHistory } from 'vue-router'
import TopMenu from '../layouts/top-menu/Main.vue'
import DashboardOverview2 from '../views/dashboard-overview-2/Main.vue'
import Login from '../views/login/Main.vue'
import Register from '../views/register/Main.vue'
import ErrorPage from '../views/error-page/Main.vue'
import UpdateProfile from '../views/update-profile/Main.vue'
import ChangePassword from '../views/change-password/Main.vue'

const routes = [
  {
    path: '/',
    component: TopMenu,
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: DashboardOverview2
      },
      {
        path: 'profile',
        name: 'profile.personal',
        component: UpdateProfile
      },
      {
        path: 'profile/change-password',
        name: 'profile.password',
        component: ChangePassword
      }
    ]
  },
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/error-page',
    name: 'error-page',
    component: ErrorPage
  },
  {
    path: '/:pathMatch(.*)*',
    component: ErrorPage
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { left: 0, top: 0 }
  }
})

export default router
