<template>
  <div class="md-layout md-alignment-center">
    <md-table class="md-layout-item md-size-100 md-small-size-100 md-xsmall-size-100" v-model="bets" md-sort="name" md-sort-order="asc" md-card>
      <md-table-toolbar>
        <h1 class="md-title">Mes inscriptions aux paris</h1>
      </md-table-toolbar>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Event" md-sort-by="title">{{ item.title }}</md-table-cell>
        <md-table-cell md-label="Date" md-numeric md-sort-by="eventDate">{{ item.eventDate }}</md-table-cell>
        <md-table-cell v-if="item.betOpt === '0'" md-label="Bet" md-sort-by="winOpt1">{{ item.winOpt1 }}</md-table-cell>
        <md-table-cell v-else-if="item.betOpt === '1'" md-label="Bet" md-sort-by="winOpt2">{{ item.winOpt2 }}</md-table-cell>
        <md-table-cell md-label="Price" md-numeric md-sort-by="participationPrice">{{ item.participationPrice }}</md-table-cell>
        <md-table-cell md-label="winningOption" md-sort-by="winningOption">{{ item.winningOption ? item.winningOption : "Pas encore défini" }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
import BetsApi from '@/services/api/Bets'

export default {
  name: 'AppSortableTable',
  data () {
    return {
      bets: {}
    }
  },
  created () {
    BetsApi.getUsersBets().then(usersBets => {
      let betIds = []
      let betOpt = []
      usersBets.forEach(bet => {
        betIds.push(bet.betId)
        betOpt.push(bet.betOpt)
      })
      BetsApi.getBetByIds(betIds).then(results => {
        this.bets = Object.values(results)
        for (let i = 0; i < this.bets.length; i++) {
          this.bets[i]['betOpt'] = betOpt[i]
        }
      })
    })
  }
}
</script>

<style>
.md-table-head{
  text-align: center !important;
}
.md-table-cell{
  text-align: center !important;
}
</style>
