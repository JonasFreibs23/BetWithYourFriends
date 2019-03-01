<template>
<div class="app-form">
    <form novalidate class="md-layout" @submit.prevent="validateBet">
        <md-card class="md-layout-item md-size-100 md-small-size-100">
            <md-card-content>
                <md-field :class="getValidationClass('title')">
                    <label for="title">Nom de l'événement</label>
                    <md-input name="title" id="title" v-model="form.title" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.title.required">Le nom de l'événement est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.title.minlength">Nom d'événement invalide</span>
                </md-field>

                <md-field :class="getValidationClass('description')">
                    <label for="description">Description de l'événement</label>
                    <md-textarea name="description" id="description" v-model="form.description" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.description.required">La description de l'événement est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.description.minlength">Le description de l'événement est invalide</span>
                </md-field>

                <md-field :class="getValidationClass('option1')">
                    <label for="option1">1er option de pari</label>
                    <md-input name="option1" id="option1" v-model="form.option1" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.option1.required">La première option de pari est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.option1.minlength">La première option de pari est invalide</span>
                </md-field>

                <md-field :class="getValidationClass('option2')">
                    <label for="option2">2ème option de pari</label>
                    <md-input name="option2" id="option2" v-model="form.option2" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.option2.required">La deuxième option de pari est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.option2.minlength">La deuxième option de pari est invalide</span>
                </md-field>

                <md-datepicker :class="getValidationClass('eventDate')" name="eventDate" id="eventDate" v-model="form.eventDate" :disabled="sending">
                    <label>Select date</label>
                    <span class="md-error" v-if="!$v.form.eventDate.required">La date de l'événement est obligatoire</span>
                </md-datepicker>

                <md-field :class="getValidationClass('participationPrice')">
                    <label for="participationPrice">Prix de participation</label>
                    <md-input type="number" id="participationPrice" name="participationPrice" v-model="form.participationPrice" :disabled="sending" />
                </md-field>
            </md-card-content>

            <md-card-actions>
                <md-button type="submit" class="md-primary" :disabled="sending">Créer un nouveau pari</md-button>
            </md-card-actions>
        </md-card>
        <md-snackbar :md-active.sync="betSaved">Le pari {{ lastBet }} a été enregistré !</md-snackbar>
    </form>
</div>
</template>

<script>
// TODO : Improve validation
import { validationMixin } from 'vuelidate'
import { required, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'AppForm',
  mixins: [validationMixin],
  data: () => ({
    form: {
      title: null,
      description: null,
      option1: null,
      option2: null,
      participationPrice: null,
      eventdate: null
    },
    betSaved: false,
    sending: false,
    lastBet: null
  }),
  validations: {
    form: {
      title: {
        required,
        minLength: minLength(3)
      },
      description: {
        required,
        minLength: minLength(3)
      },
      option1: {
        required,
        maxLength: minLength(3)
      },
      option2: {
        required,
        maxLength: minLength(3)
      },
      participationPrice: {
        required
      },
      eventDate: {
        required
      }
    }
  },
  methods: {
    getValidationClass (fieldName) {
      const field = this.$v.form[fieldName]

      if (field) {
        return {
          'md-invalid': field.$invalid && field.$dirty
        }
      }
    },
    clearForm () {
      this.$v.$reset()
      this.form.title = null
      this.form.description = null
      this.form.option1 = null
      this.form.option2 = null
      this.form.participationPrice = null
      this.form.eventDate = null
    },
    saveBet () {
      this.sending = true

      // Instead of this timeout, here you can call your API
      window.setTimeout(() => {
        this.lastBet = `${this.form.title}}`
        this.betSaved = true
        this.sending = false
        this.clearForm()
      }, 1500)
    },
    validateBet () {
      this.$v.$touch()

      if (!this.$v.$invalid) {
        this.saveBet()
      }
    }
  }
}
</script>

<style lang="scss" scoped>
.app-form{
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}
</style>
