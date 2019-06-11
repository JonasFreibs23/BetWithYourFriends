import axios from 'axios'

// TODO : change for prod version
axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'
// axios.defaults.baseURL = 'http://157.26.77.153/php'
axios.defaults.withCredentials = true

export default {
  name: 'UsersApi',
  fetchNameId () {
    return axios.get('/fetchNameId').then(response => {
      return response.data
    })
  }
}
