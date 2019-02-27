import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/components/pages/HomePage'
import MyBetsPage from '@/components/pages/MyBetsPage'
import CreateBetPage from '@/components/pages/CreateBetPage'
import BankPage from '@/components/pages/BankPage'
import AboutPage from '@/components/pages/AboutPage'
import LoginPage from '@/components/pages/LoginPage'

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
  },
  {
    path: '/create-bet',
    name: 'CreateBetPage',
    component: CreateBetPage
  },
  {
    path: '/bank',
    name: 'BankPage',
    component: BankPage
  },
  {
    path: '/about',
    name: 'AboutPage',
    component: AboutPage
  },
  {
    path: '/login',
    name: 'LoginPage',
    component: LoginPage
  }
  ]
})
