import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/components/pages/HomePage'
import MyBetsPage from '@/components/pages/MyBetsPage'

Vue.use(Router)

export default new Router({
  routes: [{
    path: '/',
    name: 'HomePage',
    component: HomePage
  },
  {
    path: '/home',
    name: 'HomePage',
    component: HomePage
  },
  {
    path: '/my-bets',
    name: 'MyBetsPage',
    component: MyBetsPage
  }
  ]
})
