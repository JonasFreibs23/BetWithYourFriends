<template>
  <div>
    <md-steppers :md-active-step.sync="active" md-vertical md-linear>
      <md-step id="first" md-label="Ajouter un titre au pari" md-description="Titre" :md-editable="true" :md-done.sync="first">
        <md-subheader>
        Entrer un titre pour l'événement
        </md-subheader>
        <div class="md-layout md-gutter">
            <md-input name="title" class="md-layout-item"/>
        </div>
        <md-button class="md-raised md-primary" @click="setDone('first', 'second')">Continue</md-button>
      </md-step>

      <md-step id="second" md-label="Second Step" :md-error="secondStepError" :md-editable="true" :md-done.sync="second">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
        <md-button class="md-raised md-primary" @click="setDone('second', 'third')">Continue</md-button>
        <md-button class="md-raised md-primary">Set error!</md-button>
      </md-step>

      <md-step id="third" md-label="Third Step" :md-editable="true" :md-done.sync="third">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias doloribus eveniet quaerat modi cumque quos sed, temporibus nemo eius amet aliquid, illo minus blanditiis tempore, dolores voluptas dolore placeat nulla.</p>
        <md-button class="md-raised md-primary" @click="setDone('third')">Done</md-button>
      </md-step>
    </md-steppers>
  </div>
</template>

<script>
export default {
  name: 'AppStepper',
  data: () => ({
    active: 'first',
    first: false,
    second: false,
    third: false,
    secondStepError: null
  }),
  methods: {
    setDone (id, index) {
      this[id] = true

      this.secondStepError = null

      if (index) {
        this.active = index
      }
    }
  }
}
</script>
