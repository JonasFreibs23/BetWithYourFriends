<template>
  <md-tabs class="md-layout-item md-size-100" md-sync-route md-alignment="fixed" v-responsive="['hidden-all', 'md', 'lg', 'xl']">
      <md-tab md-label="Accueil" to="/home"></md-tab>
      <md-tab md-label="Mes paris" to="/my-bets"></md-tab>
      <md-tab md-label="Créer un pari" to="/create-bet"></md-tab>
      <md-tab md-label="Ma banque" to="/bank"></md-tab>
      <md-tab md-label="A propos" to="/about"></md-tab>
      <md-tab md-label="Login" to="/login"></md-tab>
      <md-tab md-label="Logout" v-on:click="disconnect"></md-tab>
      <md-snackbar :md-active.sync="logoutSucces">Utilisateur déconnecté !</md-snackbar>
      <md-snackbar :md-active.sync="logoutFailed">Echec lors de la déconnection !</md-snackbar>
  </md-tabs>
</template>

<script>
import LoginApi from '@/services/api/Login'
export default {
  name: 'AppNav',
  data: () => ({
    logoutSucces: null,
    logoutFailed: null
  }),
  methods: {
    disconnect () {
      LoginApi.logout().then(result => {
        if (result.data === 1) {
          this.logoutSucces = true
          this.$localStorage.set('authenticated', 'false')
          this.$router.push('/login')
        } else {
          this.logoutFailed = true
        }
      })
    }
  }
}
</script>
