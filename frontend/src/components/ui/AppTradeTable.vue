<template>
  <div>
    <h2>Your Trades</h2>
    <p>{{ trades }}</p>
    <div class="md-layout">
      <swiper :options="swiperOptions">
        <swiper-slide v-for="trade in trades.slice().reverse()" :key="trade.userIdAsk">
          <app-card :tradeId="trade.userIdAsk" class="md-layout-item">
              <template slot="idAsk">{{trade.userIdAsk}}</template>
              <template slot="idAccept">{{trade.userIdAccept}}</template>
              <template slot="isPaid">{{trade.isPaid}}</template>
              <template slot="isAccepted">{{trade.isAccepted}}</template>
              <template slot="value">{{trade.value}}</template>
          </app-card>
        </swiper-slide>
        <div class="swiper-button-prev" slot="button-prev"></div>
        <div class="swiper-button-next" slot="button-next"></div>
      </swiper>
    </div>
  </div>
</template>

<script>
import TradeApi from '@/services/api/Trade'

export default {
  name: 'AppTradeTable',
  data () {
    return {
      trades: [],
      swiperOptions: {
        slidesPerView: 4,
        spaceBetween: 0,
        freeMode: true,
        loop: true,
        watchOverflow: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        }
      }
    }
  },
  methods: {
    created () {
      TradeApi.getUsersTrade().then(trades => {
        this.trades = trades
      })
    }
  }
}
</script>

<style>
.md-table-head{
  text-align: center !important;
}
.md-table-cell{
  text-align: center !important;
}
</style>
