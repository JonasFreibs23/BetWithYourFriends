<template>
    <div>
        <app-nav/>
        <app-header>
        Les paris
        </app-header>
        <app-main>
            <h2>plus récents</h2>
            <div class="md-layout">
              <swiper :options="swiperOptions">
                <swiper-slide v-for="bet in bets.slice().reverse()" :key="bet.id">
                  <app-card :betId="bet.id" class="md-layout-item">
                      <template slot="title">{{bet.title}}</template>
                      <template slot="date">{{bet.eventDate}}</template>
                      <template slot="description">{{bet.description}}</template>
                      <template slot="opt1">{{bet.winOpt1}}</template>
                      <template slot="opt2">{{bet.winOpt2}}</template>
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
import AppNav from '@/components/layout/AppNav'
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
    AppNav,
    AppMain,
    AppFooter,
    AppCard,
    swiper,
    swiperSlide
  },
  data () {
    return {
      bets: [],
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
