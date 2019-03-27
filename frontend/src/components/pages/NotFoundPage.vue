<template>
    <div>
        <app-tool-bar class="md-layout">
          <slot slot="tab">
            <app-nav/>
          </slot>
          <slot slot="responsiveTab">
            <app-mobile-nav/>
          </slot>
        </app-tool-bar>
        <app-header>
        Error 404
        </app-header>
        <app-main>
          <p>
          Oops, the requested page was not found... <br/>
          You can use the navigation bar to get back to the home page.
          </p>
          <md-button class="md-raised" v-on:click="navigate('/')">Home</md-button>
          <md-button class="md-raised" v-on:click="navigate('/create-bet')">Create a bet</md-button>
          <md-button class="md-raised" v-on:click="navigate('/login')">Create a new account</md-button>
          <md-button class="md-raised" v-on:click="navigate('/my-bets')">See my bets</md-button>
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

export default {
  name: 'NotFoundPage',
  components: {
    AppHeader,
    AppToolBar,
    AppNav,
    AppMobileNav,
    AppMain,
    AppFooter
  },
  methods: {
    navigate (link) {
      this.$router.push(link)
    }
  }
}
</script>
