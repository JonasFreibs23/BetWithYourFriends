import axios from 'axios'

// TODO : change for prod version
// xios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'
axios.defaults.baseURL = 'http://157.26.77.153/php'
axios.defaults.withCredentials = true

export default {
  name: 'BankApi',
  getUserBalance () {
    return axios.get('/getUserBalance').then(response => {
      return response.data
    })
  }
}
