import axios from 'axios'

// TODO : change for prod version
axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'

export default {
  name: 'LoginApi',
  login (username, password) {
    return axios.post('/login', {
      username: username,
      password: password
    })
  },
  createAccount (email, username, password) {
    return axios.post('/createAccount', {
      email: email,
      username: username,
      password: password
    })
  }
}
