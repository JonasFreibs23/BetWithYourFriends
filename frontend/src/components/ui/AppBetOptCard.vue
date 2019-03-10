<template>
  <div class="md-layout md-alignment-center-center ">
    <md-card class="md-layout-item md-size-80 md-small-size-100">
      <md-ripple>
        <md-card-header>
          <md-card-header-text>
            <div class="md-title">
              <slot name="title"></slot>
            </div>
            <div class="md-subhead">Définir l'issue du pari</div>
          </md-card-header-text>
        </md-card-header>

        <md-card-content>
        Les différentes options à chois sont
          <dl>
            <dt>
              Option 1
            </dt>
            <dd>
              <slot name="opt1"></slot>
            </dd>
            <dt>
              Option 2
            </dt>
            <dd>
              <slot name="opt2"></slot>
            </dd>
          </dl>
        </md-card-content>

        <md-divider></md-divider>

        <md-card-actions class="md-layout md-alignment-center-center">
          <md-button class="md-raised md-primary">Définir l'option 1 comme gagnante</md-button>
          <md-button class="md-raised md-primary">Définir l'option 2 comme gagnante</md-button>
        </md-card-actions>
      </md-ripple>
    </md-card>
  </div>
</template>

<script>
// TODO : vote call API
export default {
  name: 'AppBetOptCard'
}
</script>

<style lang="scss" scoped>
.md-button {
  margin: 20px 60px 20px 20px;
}

@media (min-width: 768px) and (max-width: 1024px) {
  .md-button {
    margin: 0px 0px 20px 0px;
  }
}

@media (min-width: 320px) and (max-width: 480px) {
  .md-button {
    margin: 0px 0px 20px 0px;
  }
}
</style>
