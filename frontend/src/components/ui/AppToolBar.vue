<template>
  <div>
    <md-toolbar class="md-small app-toolbar--bgc">
      <div class="md-toolbar-row">
        <div v-responsive.sm.xs class="md-toolbar-section-start">
        <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        </div>
        <slot></slot>
      </div>
    </md-toolbar>
    <div class="snack-menu md-elevation-9" v-if="menuVisible">
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
      </md-list>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.md-toolbar + .md-toolbar {
  margin-top: 16px;
}
.app-toolbar--bgc{
  background-color: #fff;
}
span:hover{
  color: grey;
  cursor: pointer;
}
</style>

<style>
.md-toolbar .md-tabs{
  padding-left: 0px;
}
.snack-menu{
  width: 100%;
}
</style>

<script>
// TODO : check : vue responsve lib
export default {
  name: 'AppToolBar',
  data: () => ({
    menuVisible: false
  }),
  methods: {
    navigate (link) {
      this.$router.push(link)
    }
  }
}
</script>
