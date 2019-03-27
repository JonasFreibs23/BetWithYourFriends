import axios from 'axios'

// TODO : change for prod version
axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'
axios.defaults.withCredentials = true

export default {
  name: 'BankApi',
  getUserBalance () {
    return axios.get('/getUserBalance').then(response => {
      return response.data
    })
  }
}
