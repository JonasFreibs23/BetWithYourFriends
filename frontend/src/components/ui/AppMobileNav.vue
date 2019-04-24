<template>
  <div>
    <md-list>
      <md-list-item>
        <span class="md-list-item-text" v-on:click="navigate('/home')">Accueil</span>
      </md-list-item>
      <md-list-item>
        <span class="md-list-item-text" v-on:click="navigate('/my-bets')">Mes paris</span>
      </md-list-item>
      <md-list-item>
        <span class="md-list-item-text" v-on:click="navigate('/create-bet')">Créer un pari</span>
      </md-list-item>
      <md-list-item>
        <span class="md-list-item-text" v-on:click="navigate('/bank')">Ma banque</span>
      </md-list-item>
      <md-list-item>
        <span class="md-list-item-text" v-on:click="navigate('/about')">A propos</span>
      </md-list-item>
      <md-list-item>
        <span class="md-list-item-text" v-on:click="navigate('/login')">Login</span>
      </md-list-item>
      <md-list-item>
        <span class="md-list-item-text" v-on:click="logout">Logout</span>
      </md-list-item>
    </md-list>
    <md-snackbar :md-active.sync="logoutSucces">Utilisateur déconnecté !</md-snackbar>
    <md-snackbar :md-active.sync="logoutFailed">Echec lors de la déconnection !</md-snackbar>
  </div>
</template>

<script>
import LoginApi from '@/services/api/Login'

export default {
  name: 'AppMobileNav',
  data: () => ({
    logoutSucces: null,
    logoutFailed: null
  }),
  methods: {
    navigate (link) {
      this.$router.push(link)
    },
    logout () {
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

<style scoped>
.md-list-item-text{
  color: grey;
  cursor: pointer;
}
</stlye>
