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
