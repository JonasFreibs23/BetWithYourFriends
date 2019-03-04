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
  getUsersBets () {
    return axios.get('/getUsersBets').then(response => {
      return response.data
    })
  },
  getBetByIds (ids) {
    let bets = {}
    let promises = []
    for (let id of ids) {
      promises.push(axios.get('/getBetById?betId=' + id))
    }
    return axios.all(promises).then(results => {
      results.forEach(result => {
        bets[result.data[0].id] = result.data[0]
      })
      return bets
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
