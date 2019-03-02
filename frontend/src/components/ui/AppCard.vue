<template>
    <div>
        <md-card md-with-hover>
            <md-ripple>
                <md-card-header>
                    <div class="md-title">
                        <slot name="title"></slot>
                    </div>
                    <div class="md-subhead">
                        <slot name="date"></slot>
                    </div>
                </md-card-header>

                <md-card-content>
                    <slot name="description"></slot>
                </md-card-content>

                <md-divider></md-divider>

                <md-card-actions>
                    <md-button class="md-primary" @click.native="applyBet(0)">
                        <slot name="opt1"></slot>
                    </md-button>
                    <md-button class="md-primary" @click.native="applyBet(1)">
                        <slot name="opt2"></slot>
                    </md-button>
                </md-card-actions>
            </md-ripple>
        </md-card>
        <md-snackbar :md-active.sync="betSaved">Le pari a été enregistré !</md-snackbar>
        <md-snackbar :md-active.sync="betNotSaved">Le pari n'a pas pu être enregistré !</md-snackbar>
    </div>
</template>

<script>
import BetsApi from '@/services/api/Bets'

export default {
  name: 'AppCard',
  props: [
    'betId'
  ],
  data: () => ({
    betSaved: false,
    betNotSaved: false
  }),
  methods: {
    applyBet: function (betOpt) {
      // TODO : remove hard coded user id
      // TODO : give feedback to user
      BetsApi.applyToBet(this.betId, betOpt, 1).then(response => {
        this.betSaved = true
        console.log(response)
      }).catch(error => {
        this.betNotSaved = true
        console.log(error)
      })
      this.betSaved = false
      this.betNotSaved = false
    }
  }
}
</script>

<style lang="scss" scoped>
  .md-card {
    width: 320px;
    margin: 4px;
    display: inline-block;
    vertical-align: top;
  }
</style>
