const state = () => {
  return {
    menu: [
      {
        icon: 'HomeIcon',
        pageName: 'top-menu-dashboard-overview-2',
        title: 'Dashboard'
      },
      {
        icon: 'LayersIcon',
        pageName: 'top-menu-dashboard-overview-2',
        title: 'Subjects',
        subMenu: [
          {
            icon: 'DivideIcon',
            pageName: 'top-menu-dashboard-overview-2',
            title: 'Math'
          },
          {
            icon: 'FileTextIcon',
            pageName: 'top-menu-dashboard-overview-2',
            title: 'German'
          },
          {
            icon: 'ServerIcon',
            pageName: 'top-menu-dashboard-overview-2',
            title: 'OS & Networking'
          },
          {
            icon: 'TrendingDownIcon',
            pageName: 'top-menu-dashboard-overview-2',
            title: 'Math'
          },
          {
            icon: 'HardDriveIcon',
            pageName: 'top-menu-dashboard-overview-2',
            title: 'Computer technic'
          },
          {
            icon: 'DatabaseIcon',
            pageName: 'top-menu-dashboard-overview-2',
            title: 'Databases'
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
