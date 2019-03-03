<template>
    <div>
        <app-nav/>
        <app-header>
        Mon compte en banque
        </app-header>
        <app-main>
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
  name: 'BankPage',
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
