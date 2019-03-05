<template>
  <md-tabs class="md-layout-item md-size-100" md-sync-route md-alignment="fixed" v-responsive="['hidden-all', 'md', 'lg', 'xl']">
      <md-tab md-label="Accueil" to="/home"></md-tab>
      <md-tab md-label="Mes paris" to="/my-bets"></md-tab>
      <md-tab md-label="Créer un pari" to="/create-bet"></md-tab>
      <md-tab md-label="Ma banque" to="/bank"></md-tab>
      <md-tab md-label="A propos" to="/about"></md-tab>
      <md-tab md-label="Login" to="/login"></md-tab>
      <md-tab md-label="Logout" disabled></md-tab>
  </md-tabs>
</template>

<script>
// TODO : implement logout and hide when not logged in
export default {
  name: 'AppNav'
}
</script>
