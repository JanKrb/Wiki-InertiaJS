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
        pageName: 'top-menu-widgets',
        title: 'Subjects',
        subMenu: [
          {
            icon: 'DivideIcon',
            pageName: 'top-menu-chart',
            title: 'Math'
          },
          {
            icon: 'FileTextIcon',
            pageName: 'top-menu-chart',
            title: 'German'
          },
          {
            icon: 'ServerIcon',
            pageName: 'top-menu-chart',
            title: 'OS & Networking'
          },
          {
            icon: 'TrendingDownIcon',
            pageName: 'top-menu-chart',
            title: 'Math'
          },
          {
            icon: 'HardDriveIcon',
            pageName: 'top-menu-slider',
            title: 'Computer technic'
          },
          {
            icon: 'DatabaseIcon',
            pageName: 'top-menu-image-zoom',
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
