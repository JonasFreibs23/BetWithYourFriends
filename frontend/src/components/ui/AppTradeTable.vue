<template>
  <div>
    <h2>Vos trocs en cours : choisissez de les accepter ou pas </h2>
    <div class="md-layout">
      <swiper :options="swiperOptions">
        <swiper-slide v-for="trade in tradesToBeAccepted.slice()" :key="trade.tradeId">
          <app-card-trade :tradeId="trade.tradeId" :finished="false" class="md-layout-item">
              <template slot="userIdAsk">{{trade.userIdAsk}}</template>
              <template slot="value">{{trade.value}}</template>
              <template slot="description">{{trade.userIdAccept}}</template>
              <template slot="optAccept">{{accept}}</template>
              <template slot="optRefuse">{{refuse}}</template>
          </app-card-trade>
        </swiper-slide>
        <div v-if="countOptionOne > 1" class="swiper-button-prev" slot="button-prev"></div>
        <div v-if="countOptionOne > 1" class="swiper-button-next" slot="button-next"></div>
      </swiper>
    </div>
    <h2>Vos trocs en payement : notez payé quand le troc a été payé </h2>
    <div class="md-layout">
      <swiper :options="swiperOptions">
        <swiper-slide v-for="trade in tradesToBePaid.slice().reverse()" :key="trade.tradeId">
          <app-card-trade :tradeId="trade.tradeId" :finished="false" class="md-layout-item">
              <template slot="userIdAsk">{{trade.userIdAsk}}</template>
              <template slot="value">{{trade.value}}</template>
              <template slot="description">{{trade.userIdAccept}}</template>
              <template slot="optAccept">{{paid}}</template>
              <template slot="optRefuse">{{notPaid}}</template>
          </app-card-trade>
        </swiper-slide>
        <div v-if="countOptionTwo > 1" class="swiper-button-prev" slot="button-prev"></div>
        <div v-if="countOptionTwo > 1" class="swiper-button-next" slot="button-next"></div>
      </swiper>
    </div>
    <h2>Historique de vos trocs </h2>
    <div class="md-layout">
      <swiper :options="swiperOptions">
        <swiper-slide v-for="trade in tradesFinished.slice().reverse()" :key="trade.tradeId">
          <app-card-trade :tradeId="trade.tradeId" :finished="true" class="md-layout-item">
              <template slot="userIdAsk">{{trade.userIdAsk}}</template>
              <template slot="value">{{trade.value}}</template>
              <template slot="description">{{trade.userIdAccept}}</template>
          </app-card-trade>
        </swiper-slide>
        <div v-if="countOptionThree > 1" class="swiper-button-prev" slot="button-prev"></div>
        <div v-if="countOptionThree > 1" class="swiper-button-next" slot="button-next"></div>
      </swiper>
    </div>
  </div>
</template>

<script>
import TradeApi from '@/services/api/Trade'
import AppCardTrade from '@/components/ui/AppCardTrade'
import { swiper, swiperSlide } from 'vue-awesome-swiper'
import 'swiper/dist/css/swiper.css'

export default {
  name: 'AppTradeTable',
  components: {
    AppCardTrade,
    swiper,
    swiperSlide
  },
  data: () => ({
    tradesToBeAccepted: [],
    tradesToBePaid: [],
    tradesFinished: [],
    trade: null,
    accept: 'accepter',
    refuse: 'refuser',
    paid: 'payé',
    notPaid: 'non payé',
    countOptionOne: 0,
    countOptionTwo: 0,
    countOptionThree: 0,
    swiperOptions: {
      slidesPerView: 1,
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
  }),
  mounted () {
    window.bus.$on('refresh', () => {
      this.getUserTradesToBeAccepted()
      this.getUserTradesToBePaid()
      this.getUserTradesFinished()
    })
    this.getUserTradesToBeAccepted()
    this.getUserTradesToBePaid()
    this.getUserTradesFinished()
  },
  methods: {
    navigate (link) {
      this.$router.push(link)
    },
    getUserTradesToBeAccepted () {
      TradeApi.getUserTradesToBeAccepted().then(trades => {
        this.tradesToBeAccepted = trades
        this.countOptionOne = trades.length
      })
    },
    getUserTradesToBePaid () {
      TradeApi.getUserTradesToBePaid().then(trades => {
        this.tradesToBePaid = trades
        this.countOptionTwo = trades.length
      })
    },
    getUserTradesFinished () {
      TradeApi.getUserTradesFinished().then(trades => {
        this.tradesFinished = trades
        this.countOptionThree = trades.length
      })
    }
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
