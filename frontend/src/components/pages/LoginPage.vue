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
    Login
    </app-header>
    <app-main>
      <md-button v-if="newAccount" class="md-raised md-primary" @click="newAccount = !newAccount">
      Se connecter
      </md-button>
      <md-button v-if="!newAccount" class="md-raised md-primary" @click="newAccount = !newAccount">
      Créer un compte
      </md-button>
      <div class="form-container">
        <app-stepper v-if="newAccount"/>
        <app-login-form v-if="!newAccount"/>
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
import AppStepper from '@/components/ui/AppStepper'
import AppLoginForm from '@/components/ui/AppLoginForm'

export default {
  name: 'LoginPage',
  data () {
    return {
      newAccount: true
    }
  },
  components: {
    AppHeader,
    AppToolBar,
    AppNav,
    AppMobileNav,
    AppMain,
    AppFooter,
    AppStepper,
    AppLoginForm
  }
}
</script>

<style scoped>
.form-container{
  margin-top: 20px;
}
</style>
