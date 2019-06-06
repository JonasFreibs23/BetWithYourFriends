import axios from 'axios'

// TODO : change for prod version
// axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'
axios.defaults.baseURL = 'http://157.26.77.153/php'
axios.defaults.withCredentials = true

export default {
  name: 'BetsApi',
  getBets () {
    return axios.get('/getBets').then(response => {
      return response.data
    })
  },
  getTrendingBets () {
    return axios.get('/getTrendingBets').then(response => {
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
      promises.push(axios.get('/getBetById', {
        params: {
          betId: id
        }
      }))
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
  applyToBet (betId, betOpt) {
    return axios.post('/applyToBet', {
      betId: betId,
      betOpt: betOpt
    })
  },
  editBet (betId, betWinningOpt) {
    return axios.get('/editBet', {
      params: {
        betId: betId,
        betWinningOpt: betWinningOpt
      }
    })
  }
}
