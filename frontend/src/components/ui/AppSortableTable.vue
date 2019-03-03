<template>
  <div>
    <md-table v-model="bets" md-sort="name" md-sort-order="asc" md-card>
      <md-table-toolbar>
        <h1 class="md-title">Mes inscriptions aux paris</h1>
      </md-table-toolbar>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Event" md-numeric  md-sort-by="title">{{ item.title }}</md-table-cell>
        <md-table-cell md-label="Date" md-numeric md-sort-by="eventDate">{{ item.eventDate }}</md-table-cell>
        <md-table-cell md-label="Price" md-numeric md-sort-by="participationPrice">{{ item.participationPrice }}</md-table-cell>
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
      BetsApi.getBetByIds(usersBets).then(results => {
        this.bets = Object.values(results)
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
