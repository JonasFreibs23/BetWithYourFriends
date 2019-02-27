<template>
    <div>
        <md-tabs md-sync-route md-alignment="fixed">
            <md-tab md-label="Home" to="/home"></md-tab>
            <md-tab md-label="My bets" to="/my-bets"></md-tab>
            <md-tab md-label="Create bet" to="/create-bet"></md-tab>
            <md-tab md-label="My bank" to="/bank"></md-tab>
            <md-tab md-label="About" to="/about"></md-tab>
            <md-tab md-label="Login" to="/login"></md-tab>
        </md-tabs>
    </div>
</template>

<script>
export default {
  name: 'AppNav'
}
</script>
