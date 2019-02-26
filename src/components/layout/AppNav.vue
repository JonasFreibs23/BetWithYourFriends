<template>
    <div>
        <md-tabs md-sync-route md-alignment="fixed">
            <md-tab md-label="Home" to="/home"></md-tab>
            <md-tab md-label="My bets" to="/my-bets"></md-tab>
        </md-tabs>
    </div>
</template>

<script>
export default {
  name: 'AppNav'
}
</script>
