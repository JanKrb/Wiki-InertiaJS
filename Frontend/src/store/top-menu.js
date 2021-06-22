const state = () => {
  return {
    menu: [
      {
        icon: 'HomeIcon',
        pageName: 'dashboard',
        title: 'Dashboard'
      },
      {
        icon: 'LayersIcon',
        pageName: 'dashboard',
        title: 'Subjects',
        subMenu: [
          {
            icon: 'DivideIcon',
            pageName: 'dashboard',
            title: 'Math'
          },
          {
            icon: 'FileTextIcon',
            pageName: 'dashboard',
            title: 'German'
          },
          {
            icon: 'ServerIcon',
            pageName: 'dashboard',
            title: 'OS & Networking'
          },
          {
            icon: 'TrendingDownIcon',
            pageName: 'dashboard',
            title: 'Math'
          },
          {
            icon: 'HardDriveIcon',
            pageName: 'dashboard',
            title: 'Computer technic'
          },
          {
            icon: 'DatabaseIcon',
            pageName: 'dashboard',
            title: 'Databases'
          }
        ]
      },
      {
        icon: 'ToolIcon',
        pageName: 'mod.tags',
        title: 'Moderation',
        subMenu: [
          {
            icon: 'TagIcon',
            pageName: 'moderation.tags',
            title: 'Tags'
          },
          {
            icon: 'FilterIcon',
            pageName: 'moderation.tags',
            title: 'Authorization'
          },
          {
            icon: 'BellIcon',
            pageName: 'moderation.announcements',
            title: 'Announcements'
          },
          {
            icon: 'AlertOctagonIcon',
            pageName: 'moderation.reports',
            title: 'Reports'
          },
          {
            icon: 'InboxIcon',
            pageName: 'moderation.notifications',
            title: 'User Notifications'
          }
        ]
      },
      {
        icon: 'SlidersIcon',
        pageName: 'admin.roles',
        title: 'Administration',
        subMenu: [
          {
            icon: 'ShieldIcon',
            pageName: 'admin.roles',
            title: 'Roles'
          },
          {
            icon: 'KeyIcon',
            pageName: 'admin.permissions',
            title: 'Permissions'
          },
          {
            icon: 'CreditCardIcon',
            pageName: 'admin.badges',
            title: 'Badges'
          },
          {
            icon: 'UsersIcon',
            pageName: 'admin.accounts',
            title: 'Accounts'
          },
          {
            icon: 'SlashIcon',
            pageName: 'admin.bans',
            title: 'Bans'
          },
          {
            icon: 'ServerIcon',
            pageName: 'admin.settings.general',
            title: 'Settings'
          }
        ]
      }
    ]
  }
}

// getters
const getters = {
  menu: state => state.menu
}

// actions
const actions = {}

// mutations
const mutations = {}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}
