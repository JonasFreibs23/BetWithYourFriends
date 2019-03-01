<template>
    <div>
        <app-nav/>
        <app-header/>
        <app-main>
            <h1>Login</h1>
            <app-stepper/>
        </app-main>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from '@/components/layout/AppHeader'
import AppNav from '@/components/layout/AppNav'
import AppMain from '@/components/layout/AppMain'
import AppFooter from '@/components/layout/AppFooter'
import AppStepper from '@/components/ui/AppStepper'

export default {
  name: 'LoginPage',
  components: {
    AppHeader,
    AppNav,
    AppMain,
    AppFooter,
    AppStepper
  }
}
</script>

<style scoped>
</style>
