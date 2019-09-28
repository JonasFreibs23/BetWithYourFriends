// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.css'
import 'vue-material/dist/theme/default.css'
import responsive from 'vue-responsive'
import VueLocalStorage from 'vue-localstorage'

Vue.config.productionTip = false

Vue.use(VueMaterial)
Vue.use(responsive)
Vue.use(VueLocalStorage)

window.bus = new Vue()

Vue.localStorage.set('authenticated', 'false')

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
