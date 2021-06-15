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
        icon: 'SlidersIcon',
        pageName: 'dashboard',
        title: 'Administration',
        subMenu: [
          {
            icon: 'ShieldIcon',
            pageName: 'dashboard',
            title: 'Roles'
          },
          {
            icon: 'KeyIcon',
            pageName: 'dashboard',
            title: 'Permissions'
          },
          {
            icon: 'UsersIcon',
            pageName: 'dashboard',
            title: 'Accounts'
          },
          {
            icon: 'SlashIcon',
            pageName: 'dashboard',
            title: 'Bans'
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
