import axios from 'axios'

// TODO : change for prod version
// axios.defaults.baseURL = 'http://localhost:8000/bet/awa-g3-bet/backend'
axios.defaults.baseURL = 'http://157.26.77.153/php'
axios.defaults.withCredentials = true

export default {
  name: 'TradeApi',
  getUserTradesToBeAccepted () {
    return axios.get('/getUserTradesToBeAccepted').then(response => {
      return response.data
    })
  },
  getUserTradesToBePaid () {
    return axios.get('/getUserTradesToBePaid').then(response => {
      return response.data
    })
  },
  getUserTradesFinished () {
    return axios.get('/getUserTradesFinished').then(response => {
      return response.data
    })
  },
  createTrade (trade) {
    return axios.post('/createTrade', {
      userIdAccept: trade.userIdAccept,
      value: trade.value
    })
  },
  applyToTrade (tradeId, tradeOpt) {
    return axios.post('/applyToTrade', {
      tradeId: tradeId,
      tradeOpt: tradeOpt
    })
  }
}
