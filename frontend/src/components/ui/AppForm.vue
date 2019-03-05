<template>
<div class="app-form">
    <form novalidate class="md-layout md-alignment-center" @submit.prevent="validateBet">
        <md-card class="md-layout-item md-size-80 md-small-size-100 md-xsmall-size-100">
            <md-card-content>
                <md-field :class="getValidationClass('title')">
                    <label for="title">Nom de l'événement</label>
                    <md-input name="title" id="title" v-model="form.title" :disabled="sending" autofocus/>
                    <span class="md-error" v-if="!$v.form.title.required">Le nom de l'événement est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.title.minlength">Nom de l'événement invalide</span>
                    <span class="md-error" v-else-if="!$v.form.title.alphaNum">Le nom de l'événement doit être composé de caractère alpha numeric</span>
                </md-field>

                <md-field :class="getValidationClass('description')">
                    <label for="description">Description de l'événement</label>
                    <md-textarea name="description" id="description" v-model="form.description" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.description.required">La description de l'événement est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.description.minlength">Le description de l'événement est invalide</span>
                    <span class="md-error" v-else-if="!$v.form.description.alphaNum">La description doit être composé de caractères alpha numeric</span>
                </md-field>

                <md-field :class="getValidationClass('option1')">
                    <label for="option1">1er option de pari</label>
                    <md-input name="option1" id="option1" v-model="form.option1" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.option1.required">La première option de pari est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.option1.minlength">La première option de pari est invalide</span>
                    <span class="md-error" v-else-if="!$v.form.option1.alphaNum">La première option doit être composé de caractères alpha numeric</span>
                </md-field>

                <md-field :class="getValidationClass('option2')">
                    <label for="option2">2ème option de pari</label>
                    <md-input name="option2" id="option2" v-model="form.option2" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.option2.required">La deuxième option de pari est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.option2.minlength">La deuxième option de pari est invalide</span>
                    <span class="md-error" v-else-if="!$v.form.option2.alphaNum">La deuxième option doit être composé de caractères alpha numeric</span>
                </md-field>

                <md-datepicker :class="getValidationClass('eventDate')" name="eventDate" id="eventDate" v-model="form.eventDate" :disabled="sending" md-immediately>
                    <label>Select date</label>
                    <span class="md-error" v-if="!$v.form.eventDate.required">La date de l'événement est obligatoire</span>
                    <span class="md-error" v-else-if="!$v.form.eventDate.minValue">La date de l'événement doit être de aujourd'hui ou à venir</span>
                </md-datepicker>

                <md-field :class="getValidationClass('participationPrice')">
                    <label for="participationPrice">Prix de participation</label>
                    <md-input type="number" id="participationPrice" name="participationPrice" v-model="form.participationPrice" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.participationPrice.required">Un prix de participation est requis</span>
                    <span class="md-error" v-else-if="!$v.form.participationPrice.minValue">La valeur minimal est de 0</span>
                    <span class="md-error" v-else-if="!$v.form.participationPrice.numeric">La valeur doit être numeric</span>
                </md-field>
            </md-card-content>

            <md-card-actions>
                <md-button type="submit" class="md-primary" :disabled="sending">Créer un nouveau pari</md-button>
            </md-card-actions>
        </md-card>
        <md-snackbar :md-active.sync="betSaved">Le pari {{ lastBet }} a été enregistré !</md-snackbar>
        <md-snackbar :md-active.sync="betNotSaved">Le pari {{ lastBet }} n'a pas pu être enregistré !, erreur : {{ error }}</md-snackbar>
    </form>
</div>
</template>

<script>
// TODO : Improve validation
import { validationMixin } from 'vuelidate'
import { required, minLength, minValue, numeric, alphaNum } from 'vuelidate/lib/validators'
import BetsApi from '@/services/api/Bets'

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
      eventDate: null
    },
    betSaved: false,
    betNotSaved: false,
    sending: false,
    lastBet: null,
    error: null
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
        maxLength: minLength(1),
        alphaNum
      },
      option2: {
        required,
        maxLength: minLength(1),
        alphaNum
      },
      participationPrice: {
        required,
        numeric,
        minValue: minValue(0)
      },
      eventDate: {
        required,
        minValue: minValue(new Date())
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
      this.form.eventDate = this.form.eventDate.toISOString().split('T')[0]
      this.sending = true
      BetsApi.createBet(this.form).then(response => {
        this.lastBet = `${this.form.title}`
        this.betSaved = true
        this.betNotSaved = false
        this.sending = false
        this.clearForm()
      }).catch(error => {
        this.error = error
        this.betSaved = false
        this.betNotSaved = true
        this.sending = false
      })
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
