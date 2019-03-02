<template>
    <div>
        <app-nav/>
        <app-header>
        Les paris
        </app-header>
        <app-main>
            <h2>plus récents</h2>
            <div class="md-layout">
                <app-card v-for="bet in bets" :key="bet.id" :betId="bet.id" class="md-layout-item">
                    <template slot="title">{{bet.title}}</template>
                    <template slot="date">{{bet.eventDate}}</template>
                    <template slot="description">{{bet.description}}</template>
                    <template slot="opt1">{{bet.winOpt1}}</template>
                    <template slot="opt2">{{bet.winOpt2}}</template>
                </app-card>
            </div>
        </app-main>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from '@/components/layout/AppHeader'
import AppNav from '@/components/layout/AppNav'
import AppMain from '@/components/layout/AppMain'
import AppFooter from '@/components/layout/AppFooter'
import AppCard from '@/components/ui/AppCard'
import BetsApi from '@/services/api/Bets'

export default {
  name: 'HomePage',
  components: {
    AppHeader,
    AppNav,
    AppMain,
    AppFooter,
    AppCard
  },
  data () {
    return {
      bets: []
    }
  },
  created () {
    BetsApi.getBets()
      .then(bets => {
        this.bets = bets
      })
  }
}
</script>

<style scoped>
h2{
    text-align: left;
    margin-left: 20px;
}
</style>
