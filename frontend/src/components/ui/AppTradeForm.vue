<template>
<div class="app-form">
    <form  class="md-layout md-alignment-center" submit="validate">
      <md-checkbox v-model="cbx" :value="cbx1">Cafe</md-checkbox>
      <md-checkbox v-model="cbx" :value="cbx2">Patisserie</md-checkbox>
      <md-checkbox v-model="cbx" :value="cbx3">McDo</md-checkbox>
      <div class="md-layout-item">
        <md-field>
          <md-select v-model="userChoice" name="userChoice" id="userChoice" placeholder="Users">
            <md-option  v-for="user in users.slice()" :key="user.id">{{user.name}}</md-option>
          </md-select>
        </md-field>
      </div>
      <md-card-actions>
            <md-button type="submit" class="md-primary" :disabled="sending">Valider</md-button>
      </md-card-actions>
    </form>
</div>
</template>

<script>
import TradeApi from '@/services/api/Trade'
import UsersApi from '@/services/api/Users'

export default {
  name: 'AppForm',
  data: () => ({
    form: {
      userIdAsk: null,
      userIdAccept: null,
      value: 0
    },
    cbx1: {name: 'cbx1', value: '1000'},
    cbx2: {name: 'cbx2', value: '3000'},
    cbx3: {name: 'cbx3', value: '10000'},
    cbx: null,
    users: null,
    userChoice: null,
    error: null,
    tradeSaved: null,
    tradeNotSaved: null,
    sending: false
  }),
  created () {
    UsersApi.fetchNameId().then(result => {
      this.users = result
    })
  },
  methods: {
    clearForm () {
      this.$v.$reset()
      this.form.userIdAsk = null
      this.form.userIdccept = null
      this.form.value = null
    },
    validate () {
      this.form.value = this.cbx['value']
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
