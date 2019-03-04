<template>
    <div>
        <app-tool-bar class="md-layout">
          <md-tabs class="md-layout-item md-size-100" md-sync-route md-alignment="fixed" v-responsive="['hidden-all', 'md', 'lg', 'xl']">
              <md-tab md-label="Accueil" to="/home"></md-tab>
              <md-tab md-label="Mes paris" to="/my-bets"></md-tab>
              <md-tab md-label="Créer un pari" to="/create-bet"></md-tab>
              <md-tab md-label="Ma banque" to="/bank"></md-tab>
              <md-tab md-label="A propos" to="/about"></md-tab>
              <md-tab md-label="Login" to="/login"></md-tab>
          </md-tabs>
        </app-tool-bar>
    </div>
</template>

<script>
import AppToolBar from '@/components/ui/AppToolBar'

export default {
  name: 'AppNav',
  components: {
    AppToolBar
  }
}
</script>
