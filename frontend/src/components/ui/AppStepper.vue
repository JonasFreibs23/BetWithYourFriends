<template>
  <div class="app-form">
    <form class="md-layout md-alignment-center" novalidate @submit.prevent="validateUser">
      <md-card class="md-layout-item md-size-80 md-small-size-100 md-xsmall-size-100">
        <md-card-content>
          <md-field :class="getValidationClass('username')">
            <label>Entrer votre nom d'utilisateur</label>
            <md-input v-model="form.username" autofocus></md-input>
            <span class="md-error" v-if="!$v.form.username.required">Le nom de l'utilisateur est requis</span>
            <span class="md-error" v-else-if="!$v.form.username.minlength">Le nom de l'utilisateur doit comporter au moins 2 caractères</span>
            <span class="md-error" v-else-if="!$v.form.username.alphanum">Le nom de l'utilisateur doit comporter uniquement des cararctères alphanumérique</span>
          </md-field>
          <md-field :class="getValidationClass('email')">
            <label>Entrer votre adresse email</label>
            <md-input v-model="form.email"></md-input>
            <span class="md-error" v-if="!$v.form.email.required">L'adresse email est requise</span>
            <span class="md-error" v-else-if="!$v.form.email.email">L'adresse email est invalide</span>
          </md-field>
          <md-field :class="getValidationClass('password')">
            <label>Entrer un mot de passe</label>
            <md-input type="password" v-model="form.password"></md-input>
            <span class="md-error" v-if="!$v.form.password.required">Le mot de passe est requis</span>
            <span class="md-error" v-else-if="!$v.form.password.minlength">Le mot de passe doit comporter au moins 3 caractères</span>
            <span class="md-error" v-else-if="!$v.form.password.alphaNum">Le mot de passe doit comporter uniquement des caractères alphanumérique</span>
          </md-field>
          <md-button type="submit" class="md-primary">Créer un compte</md-button>
          <span class="form-error" v-if="!isFormCorrect">Au moins un champ est invalide</span>
        </md-card-content>
      </md-card>
    </form>
    <md-snackbar :md-active.sync="creationSucced">Le nouvel utilisateur {{ form.username }} a été créé !</md-snackbar>
    <md-snackbar :md-active.sync="creationFailed">La création du nouvel utilisateur a échoué ! {{ errorMsg }}</md-snackbar>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, minLength, alphaNum, email } from 'vuelidate/lib/validators'
import LoginApi from '@/services/api/Login'

export default {
  name: 'AppStepper',
  mixins: [validationMixin],
  data: () => ({
    active: 'first',
    first: false,
    second: false,
    third: false,
    secondStepError: null,
    isFormCorrect: true,
    creationSucced: null,
    creationFailed: null,
    errorMsg: null,
    form: {
      username: null,
      email: null,
      password: null,
      errorMessage: ''
    }
  }),
  validations: {
    form: {
      username: {
        required,
        minLength: minLength(2),
        alphaNum
      },
      email: {
        required,
        email
      },
      password: {
        required,
        minLength: minLength(3),
        alphaNum
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
    validateUser () {
      this.$v.$touch()

      if (!this.$v.$invalid) {
        this.saveUser()
      }
    },
    saveUser () {
      LoginApi.createAccount(this.form.email, this.form.username, this.form.password)
        .then(result => {
          if (result.data === 1) {
            this.creationSucced = true
            setTimeout(function () {
              this.$router.push('/login')
            }.bind(this), 2000)
          } else {
            this.errorMsg = result.data
            this.creationFailed = true
          }
        })
    }
  }
}
</script>

<style scoped>
.form-error{
  color: red;
  font-size: 20px;
}
</style>
