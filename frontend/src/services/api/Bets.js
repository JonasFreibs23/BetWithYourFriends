import axios from 'axios'

// TODO : change for prod version
axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'

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
  },
  applyToBet (betId, betOpt, userId) {
    // TODO : dynamic userId
    return axios.post('/applyToBet', {
      betId: betId,
      betOpt: betOpt,
      userId: userId
    })
  }
}
