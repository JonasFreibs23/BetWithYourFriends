<template>
    <div>
        <app-nav/>
        <app-header/>
        <app-main>
            <h1>Create a bet</h1>
        </app-main>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from '@/components/layout/AppHeader'
import AppNav from '@/components/layout/AppNav'
import AppMain from '@/components/layout/AppMain'
import AppFooter from '@/components/layout/AppFooter'

export default {
  name: 'CreateBetPage',
  components: {
    AppHeader,
    AppNav,
    AppMain,
    AppFooter
  }
}
</script>

<style scoped>
</style>
