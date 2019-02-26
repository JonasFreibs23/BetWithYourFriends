<template>
    <div>
        <app-nav/>
        <app-header/>
        <app-main>
            <h1>Home page</h1>
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
  name: 'HomePage',
  components: {
    AppHeader,
    AppNav,
    AppMain,
    AppFooter
  }
}
</script>

<style scoped>
p {
  font-size: 2em;
  text-align: center;
}
</style>
