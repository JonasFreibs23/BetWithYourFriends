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
        A propos
        </app-header>
        <app-main/>
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
  name: 'AboutPage',
  components: {
    AppHeader,
    AppToolBar,
    AppNav,
    AppMobileNav,
    AppMain,
    AppFooter
  }
}
</script>
