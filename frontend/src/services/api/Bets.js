import axios from 'axios'

// TODO : change for prod version
axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'
axios.defaults.withCredentials = false

export default {
  name: 'BetsApi',
  getBets () {
    return axios.get('/getBets').then(response => {
      return response.data
    })
  },
  createBet (bet) {
    return axios.post('/createBet', {
      title: bet.title,
      description: bet.description,
      option1: bet.option1,
      option2: bet.option2,
      eventDate: bet.eventDate,
      participationPrice: bet.participationPrice
    })
  }
}
