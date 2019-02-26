<template>
    <div>
        <md-card md-with-hover>
            <md-ripple>
                <md-card-header>
                    <div class="md-title">Match de foot</div>
                    <div class="md-subhead">Neuchâtel Xamax - FC Sion</div>
                </md-card-header>

                <md-card-content>
                Samedi soir à 22h. Pronostique sur le match
                </md-card-content>

                <md-card-actions>
                    <md-button>Parier sur Xamax</md-button>
                    <md-button>Parier sur FC Sion</md-button>
                </md-card-actions>
            </md-ripple>
        </md-card>
    </div>
</template>

<script>
export default {
  name: 'AppCard'
}
</script>

<style lang="scss" scoped>
  .md-card {
    width: 320px;
    margin: 4px;
    display: inline-block;
    vertical-align: top;
  }
</style>
