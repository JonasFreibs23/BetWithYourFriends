<template>
    <div>
        <app-nav/>
        <app-header>
        Mes paris
        </app-header>
        <app-main>
          <app-sortable-table/>
        </app-main>
        <app-footer/>
    </div>
</template>

<script>
import AppHeader from '@/components/layout/AppHeader'
import AppNav from '@/components/layout/AppNav'
import AppMain from '@/components/layout/AppMain'
import AppFooter from '@/components/layout/AppFooter'
import AppSortableTable from '@/components/ui/AppSortableTable'

export default {
  name: 'UsersBetsPage',
  components: {
    AppHeader,
    AppNav,
    AppMain,
    AppFooter,
    AppSortableTable
  }
}
</script>
