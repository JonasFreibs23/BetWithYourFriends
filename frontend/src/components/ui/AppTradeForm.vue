<template>
<div class="app-form">
    <form  class="md-layout md-alignment-center">
      <md-card-actions>
          <md-button type="submit" class="md-primary" :disabled="sending">Valider</md-button>
      </md-card-actions>
    </form>
</div>
</template>

<script>
import TradeApi from '@/services/api/Trade'

export default {
  name: 'AppForm',
  data: () => ({
    form: {
      userIdAsk: null,
      userIdAccept: null,
      value: null
    },
    error: null,
    tradeSaved: null,
    tradeNotSaved: null,
    sending: false
  }),
  methods: {
    clearForm () {
      this.$v.$reset()
      this.form.userIdAsk = null
      this.form.userIdccept = null
      this.form.value = null
    },
    validate () {
      TradeApi.createTrade(this.form).then(response => {
        if (response.data === 1) {
          this.tradeSaved = true
          this.sending = false
          this.clearForm()
        } else {
          this.tradeNotSaved = true
        }
      }).catch(error => {
        this.error = error
        this.tradeSaved = false
        this.tradeNotSaved = true
        this.sending = false
      })
    }
  }
}
</script>
