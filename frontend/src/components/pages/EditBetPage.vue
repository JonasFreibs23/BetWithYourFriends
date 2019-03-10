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
    Editer mon pari
    </app-header>
    <app-main>
      <app-bet-opt-card>
        <template slot="title">{{ name }}</template>
        <template slot="opt1">{{ option1 }}</template>
        <template slot="opt2">{{ option2 }}</template>
      </app-bet-opt-card>
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
import AppBetOptCard from '@/components/ui/AppBetOptCard'

export default {
  name: 'EditBetPage',
  props: {
    id: String,
    name: String,
    option1: String,
    option2: String
  },
  components: {
    AppHeader,
    AppToolBar,
    AppNav,
    AppMobileNav,
    AppMain,
    AppFooter,
    AppBetOptCard
  },
  beforeCreate () {
    if (this.$localStorage.get('authenticated') === 'false') {
      this.$router.push('/login')
    }
  }
}
</script>

<style scoped>
</style>
