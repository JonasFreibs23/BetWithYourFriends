import axios from 'axios'

// TODO : change for prod version
axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'
// axios.defaults.baseURL = 'http://157.26.77.153/php'
axios.defaults.withCredentials = true

export default {
  name: 'LoginApi',
  login (username, password) {
    return axios.post('/login', {
      username: username,
      password: password
    })
  },
  logout () {
    return axios.post('/logout')
  },
  createAccount (email, username, password) {
    return axios.post('/createAccount', {
      email: email,
      username: username,
      password: password
    })
  }
}
