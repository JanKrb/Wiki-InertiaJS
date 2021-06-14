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
            icon: '',
            pageName: 'top-menu-chart',
            title: 'Math'
          },
          {
            icon: '',
            pageName: 'top-menu-slider',
            title: 'Software'
          },
          {
            icon: '',
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
