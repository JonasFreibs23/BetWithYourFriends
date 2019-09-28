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
        Les paris
        </app-header>
        <app-main>
            <h2>Get started</h2>
              <md-button class="md-raised md-primary" v-on:click="navigate('/create-bet')">Create a bet</md-button>
              <md-button class="md-raised md-primary" v-on:click="navigate('/login')">Create a new account</md-button>
            <h2>Recently created bets</h2>
            <div class="md-layout">
              <swiper :options="swiperOptions">
                <swiper-slide v-for="bet in bets.slice().reverse()" :key="bet.id">
                  <app-card :betId="bet.id" :participationPrice="bet.participationPrice" class="md-layout-item">
                      <template slot="title">{{bet.title}}</template>
                      <template slot="date">{{bet.eventDate}}</template>
                      <template slot="description">{{bet.description}}</template>
                      <template slot="opt1">{{bet.winOpt1}}</template>
                      <template slot="opt2">{{bet.winOpt2}}</template>
                      <template slot="participationPrice">{{bet.participationPrice}}</template>
                  </app-card>
                </swiper-slide>
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
              </swiper>
            </div>
            <h2>Trending bets</h2>
            <div class="md-layout">
              <swiper :options="swiperOptions">
                <swiper-slide v-for="trendingBet in trendingBets.slice().reverse()" :key="trendingBet.id">
                  <app-card :betId="trendingBet.id" :participationPrice="trendingBet.participationPrice" class="md-layout-item">
                      <template slot="title">{{trendingBet.title}}</template>
                      <template slot="date">{{trendingBet.eventDate}}</template>
                      <template slot="description">{{trendingBet.description}}</template>
                      <template slot="opt1">{{trendingBet.winOpt1}}</template>
                      <template slot="opt2">{{trendingBet.winOpt2}}</template>
                  </app-card>
                </swiper-slide>
                <div class="swiper-button-prev" slot="button-prev"></div>
                <div class="swiper-button-next" slot="button-next"></div>
              </swiper>
            </div>
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
import AppCard from '@/components/ui/AppCard'
import BetsApi from '@/services/api/Bets'
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import 'swiper/dist/css/swiper.css'

export default {
  name: 'HomePage',
  components: {
    AppHeader,
    AppToolBar,
    AppNav,
    AppMobileNav,
    AppMain,
    AppFooter,
    AppCard,
    swiper,
    swiperSlide
  },
  data () {
    return {
      bets: [],
      trendingBets: [],
      swiperOptions: {
        slidesPerView: 4,
        spaceBetween: 0,
        freeMode: true,
        loop: true,
        watchOverflow: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 10
          },
          480: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          640: {
            slidesPerView: 3,
            spaceBetween: 30
          }
        }
      }
    }
  },
  methods: {
    navigate (link) {
      this.$router.push(link)
    }
  },
  created () {
    BetsApi.getBets()
      .then(bets => {
        this.bets = bets
      })
    BetsApi.getTrendingBets()
      .then(trendingBets => {
        this.trendingBets = trendingBets
      })
  }
}
</script>

<style scoped>
h2{
  text-align: left;
  margin-left: 20px;
}
.md-button{
  width: 200px;
  margin-left: 40px;
  margin-right: 40px;
  }
</style>
