<template>
  <div class="md-layout md-alignment-center">
    <md-table class="md-layout-item md-size-100 md-small-size-100 md-xsmall-size-100" v-model="searched" md-sort="name" md-sort-order="asc" md-card md-fixed-header>
      <md-table-toolbar>
        <div class="md-toolbar-section-start">
          <h1 class="md-title">Mes inscriptions aux paris</h1>
        </div>
        <md-field style="max-width: 300px;" md-clearable class="md-toolbar-section-end">
          <md-input placeholder="Recherch par événement" v-model="search" @input="searchOnTable" />
        </md-field>
      </md-table-toolbar>

      <md-table-empty-state
        md-label="Pas d'événement trouvé"
        :md-description="`Pas d'événement trouvé pour la recherche '${search}' query.`">
      </md-table-empty-state>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Event" md-sort-by="title">{{ item.title }}</md-table-cell>
        <md-table-cell md-label="Date" md-numeric md-sort-by="eventDate">{{ item.eventDate }}</md-table-cell>
        <md-table-cell v-if="item.betOpt === '0'" md-label="Bet" md-sort-by="winOpt1">{{ item.winOpt1 }}</md-table-cell>
        <md-table-cell v-else-if="item.betOpt === '1'" md-label="Bet" md-sort-by="winOpt2">{{ item.winOpt2 }}</md-table-cell>
        <md-table-cell md-label="Price" md-numeric md-sort-by="participationPrice">{{ item.participationPrice }}</md-table-cell>
        <md-table-cell md-label="winningOption" md-sort-by="winningOption">{{ item.winningOption ? item.winningOption : "Pas encore défini" }}</md-table-cell>
        <md-table-cell md-label="Edit bet">
          <md-button class="md-primary" v-on:click="navigate(`${item.id}`,` ${item.title}`,`${item.winOpt1}`,`${item.winOpt2}`)">Edit</md-button>
        </md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
import BetsApi from '@/services/api/Bets'

const toLower = text => {
  return text.toString().toLowerCase()
}

const searchByName = (items, term) => {
  if (term) {
    return items.filter(item => toLower(item.title).includes(toLower(term)))
  }

  return items
}

export default {
  name: 'AppSortableTable',
  data () {
    return {
      search: null,
      searched: [],
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
        this.searched = this.bets
      })
    })
  },
  methods: {
    navigate (betId, betName, option1, option2) {
      this.$router.push({name: 'EditBet', params: {id: betId, name: betName, option1: option1, option2: option2}})
    },
    searchOnTable () {
      this.searched = searchByName(this.bets, this.search)
    }
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
