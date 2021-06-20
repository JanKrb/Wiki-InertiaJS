import { createRouter, createWebHistory } from 'vue-router'
import axios from 'axios'
import TopMenu from '../layouts/top-menu/Main.vue'
import DashboardOverview2 from '../views/dashboard-overview-2/Main.vue'
import Roles from '../views/roles/Main.vue'
import Role from '../views/role/Main.vue'
import Permissions from '../views/permissions/Main.vue'
import Bans from '../views/bans/Main.vue'
import Ban from '../views/ban/Main.vue'
import Accounts from '../views/accounts/Main.vue'
import AccountInformations from '../views/account/AccountInformations.vue'
import AccountSettings from '../views/account/AccountSettings.vue'
import AccountSecurity from '../views/account/AccountSecurity.vue'
import AccountPostings from '../views/account/AccountPostings.vue'
import AccountBans from '../views/account/AccountBans.vue'
import SettingsGeneral from '../views/settings/Main.vue'
import Login from '../views/login/Main.vue'
import Register from '../views/register/Main.vue'
import ErrorPage from '../views/error-page/Main.vue'
import ProfileInformations from '../views/profile/ProfileInformations.vue'
import ProfileSecurity from '../views/profile/ProfileSecurity.vue'

const routes = [
  {
    path: '/',
    component: TopMenu,
    meta: {
      title: 'Wiki',
      auth: false,
      isAuth: false
    },
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: DashboardOverview2,
        meta: {
          title: 'Dashboard',
          auth: false,
          isAuth: false
        }
      },
      {
        path: 'profile',
        name: 'profile.informations',
        component: ProfileInformations,
        meta: {
          title: 'Profile',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'profile/change-password',
        name: 'profile.security',
        component: ProfileSecurity,
        meta: {
          title: 'Change Password',
          auth: true,
          isAuth: false
        }
      }
    ]
  },
  {
    path: '/admin',
    component: TopMenu,
    meta: {
      title: 'Administration',
      auth: false,
      isAuth: false
    },
    children: [
      {
        path: 'roles',
        name: 'admin.roles',
        component: Roles,
        meta: {
          title: 'Wiki Roles',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'roles/:id/view',
        name: 'admin.role.view',
        component: Role,
        meta: {
          title: 'Wiki Role',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'permissions',
        name: 'admin.permissions',
        component: Permissions,
        meta: {
          title: 'Wiki Permissions',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'bans',
        name: 'admin.bans',
        component: Bans,
        meta: {
          title: 'Wiki Bans',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'bans/:id/view',
        name: 'admin.ban',
        component: Ban,
        meta: {
          title: 'Wiki Ban',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'accounts',
        name: 'admin.accounts',
        component: Accounts,
        meta: {
          title: 'Wiki Accounts',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'accounts/:id/informations',
        name: 'admin.accounts.informations',
        component: AccountInformations,
        meta: {
          title: 'Wiki Account',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'accounts/:id/settings',
        name: 'admin.accounts.settings',
        component: AccountSettings,
        meta: {
          title: 'Wiki Account',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'accounts/:id/security',
        name: 'admin.accounts.security',
        component: AccountSecurity,
        meta: {
          title: 'Wiki Account',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'accounts/:id/postings',
        name: 'admin.accounts.postings',
        component: AccountPostings,
        meta: {
          title: 'Wiki Account',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'accounts/:id/bans',
        name: 'admin.accounts.bans',
        component: AccountBans,
        meta: {
          title: 'Wiki Account',
          auth: true,
          isAuth: false
        }
      },
      {
        path: 'settings/general',
        name: 'admin.settings.general',
        component: SettingsGeneral,
        meta: {
          title: 'Wiki Settings',
          auth: true,
          isAuth: false
        }
      }
    ]
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      title: 'Login',
      auth: false,
      isAuth: true
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      title: 'Register',
      auth: false,
      isAuth: true
    }
  },
  {
    path: '/error-page',
    name: 'error-page',
    component: ErrorPage,
    meta: {
      title: 'Error',
      auth: false,
      isAuth: false
    }
  },
  {
    path: '/:pathMatch(.*)*',
    component: ErrorPage,
    meta: {
      title: 'Error',
      auth: false,
      isAuth: false
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { left: 0, top: 0 }
  }
})

router.beforeEach(async (to, from, next) => {
  const toWithMeta = to.matched.slice().reverse().find(r => r.meta)
  let isLoggedIn = false

  console.log(localStorage.getItem('token'))

  axios.defaults.headers.common['Content-Type'] = 'application/json'
  axios.defaults.headers.common.Authorization = 'Bearer ' + localStorage.getItem('token')

  try {
    const response = await axios.get('http://127.0.0.1:8000/api/auth/user')
    isLoggedIn = response.data.success
  } catch (error) { }

  if (toWithMeta.meta?.auth && !isLoggedIn) {
    next({
      path: '/login',
      query: {
        redirect: toWithMeta.fullPath
      }
    })
  }

  if (toWithMeta.meta?.isAuth && isLoggedIn) {
    next({
      path: '/',
      query: {
        redirect: toWithMeta.fullPath
      }
    })
  }

  document.title = toWithMeta.meta.title || process.env.BASE_URL

  next()
})

export default router
