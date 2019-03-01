<template>
    <div>
        <md-card md-with-hover>
            <md-ripple>
                <md-card-header>
                    <div class="md-title">
                        <slot name="title"></slot>
                    </div>
                    <div class="md-subhead">
                        <slot name="date"></slot>
                    </div>
                </md-card-header>

                <md-card-content>
                    <slot name="description"></slot>
                </md-card-content>

                <md-divider></md-divider>

                <md-card-actions>
                    <md-button>
                        <slot name="opt1"></slot>
                    </md-button>
                    <md-button>
                        <slot name="opt2"></slot>
                    </md-button>
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
