<template>
    <div>
        <md-card md-with-hover>
            <md-ripple>
                <md-card-header>
                    <div class="md-title">
                        <slot name="userIdAsk"></slot>
                    </div>
                    <div class="md-subhead">
                        <slot name="value"></slot>
                    </div>
                </md-card-header>

                <md-card-content>
                    <slot name="description"></slot>
                </md-card-content>

                <md-divider></md-divider>

                <md-card-actions>
                    <md-button class="md-primary" @click.native="applyTrade(0)">
                        <slot name="optAccept"></slot>
                    </md-button>
                    <md-button class="md-primary" @click.native="applyTrade(1)">
                        <slot name="optRefuse"></slot>
                    </md-button>
                </md-card-actions>
            </md-ripple>
        </md-card>
        <md-snackbar :md-active.sync="tradeSaved">Le trade a été enregistré !</md-snackbar>
        <md-snackbar :md-active.sync="tradeNotSaved">Le trade n'a pas pu être enregistré !</md-snackbar>
    </div>
</template>

<script>
import TradeApi from '@/services/api/Trade'

export default {
  name: 'AppCardTrade',
  props: [
    'tradeId'
  ],
  data: () => ({
    tradeSaved: false,
    tradeNotSaved: false
  }),
  methods: {
    applyTrade: function (tradeOpt) {
      // TODO : remove hard coded user id
      if (this.$localStorage.get('authenticated') === 'true') {
        TradeApi.applyToTrade(this.tradeId, tradeOpt).then(response => {
          if (response.data === 1) {
            this.tradeSaved = true
          } else {
            this.tradeNotSaved = true
          }
        }).catch(error => {
          this.tradeNotSaved = true
          console.log(error)
        })
        this.tradeSaved = false
        this.tradeNotSaved = false
      } else {
        this.$router.push('/login')
      }
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
