<template>
    <div>
        <app-tool-bar>
          <slot slot="tab">
            <app-nav/>
          </slot>
          <slot slot="responsiveTab">
            <app-mobile-nav/>
          </slot>
        </app-tool-bar>
        <app-header>
        Mon compte en banque
        </app-header>
        <app-main class="main">
          <h2>Mon solde</h2>
          <p>{{ balance }}</p>
          <app-trade-form/>
          <app-trade-table/>
        </app-main>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from '@/components/layout/AppHeader'
import AppToolBar from '@/components/layout/AppToolBar'
import AppNav from '@/components/ui/AppNav'
import AppMobileNav from '@/components/ui/AppMobileNav'
import AppMain from '@/components/layout/AppMain'
import AppFooter from '@/components/layout/AppFooter'
import BankApi from '@/services/api/Bank'
import AppTradeForm from '@/components/ui/AppTradeForm'
import AppTradeTable from '@/components/ui/AppTradeTable'

export default {
  name: 'BankPage',
  components: {
    AppHeader,
    AppToolBar,
    AppNav,
    AppMobileNav,
    AppMain,
    AppFooter,
    AppTradeForm,
    AppTradeTable
  },
  data () {
    return {
      balance: null,
      trades: null
    }
  },
  beforeCreate () {
    if (this.$localStorage.get('authenticated') === 'false') {
      this.$router.push('/login')
    } else {
      BankApi.getUserBalance().then(data => {
        if (data.length > 0) {
          this.balance = data[0].balance
        }
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
.main{
  width: 80%;
  margin: auto;
}
</style>
