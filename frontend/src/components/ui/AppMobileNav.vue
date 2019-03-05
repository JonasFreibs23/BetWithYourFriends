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
        <span class="md-list-item-text">Logout</span>
      </md-list-item>
    </md-list>
  </div>
</template>

<script>
export default {
  name: 'AppMobileNav',
  methods: {
    navigate (link) {
      this.$router.push(link)
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
