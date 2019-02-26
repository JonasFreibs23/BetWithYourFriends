<template>
    <div>
        <app-nav/>
        <app-header/>
        <app-main>
            <h1>Home page</h1>
            <h2>Test</h2>
            <app-card/>
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

export default {
  name: 'HomePage',
  components: {
    AppHeader,
    AppNav,
    AppMain,
    AppFooter,
    AppCard
  }
}
</script>

<style scoped>
p {
  font-size: 2em;
  text-align: center;
}
</style>
