<template>
  <div>
    <md-toolbar class="md-small app-toolbar--bgc">
      <div class="md-toolbar-row">
        <div v-responsive.sm.xs class="md-toolbar-section-start">
        <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
          <md-icon>menu</md-icon>
        </md-button>
        </div>
        <slot name="tab"></slot>
      </div>
    </md-toolbar>
    <div class="snack-menu md-elevation-9" v-if="menuVisible">
      <slot name="responsiveTab"></slot>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.md-toolbar + .md-toolbar {
  margin-top: 16px;
}
.app-toolbar--bgc{
  background-color: #fff;
}
</style>

<style>
.md-toolbar .md-tabs{
  padding-left: 0px;
}
.md-toolbar{
  padding: 0px 0px 0px 0px;
}
.md-toolbar, .md-toolbar-row{
  min-height: 0px;
}
.snack-menu{
  width: 100%;
}
</style>

<script>
// TODO : implement logout and hide when not logged in

export default {
  name: 'AppToolBar',
  data: () => ({
    menuVisible: false
  })
}
</script>
