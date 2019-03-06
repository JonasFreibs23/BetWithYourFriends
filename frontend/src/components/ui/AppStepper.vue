<template>
  <div>
    <form novalidate>
      <md-steppers :md-active-step.sync="active" md-vertical md-linear>
        <md-step id="first" md-label="Création d'un compte sur le site de pari" md-description="Nom d'utilisateur" :md-editable="true" :md-done.sync="first">
          <md-subheader>
          Entrer un nom d'utilisateur
          </md-subheader>
          <div class="md-layout md-gutter">
            <md-field :class="getValidationClass('username')">
              <md-input v-model="form.username" name="username" class="md-layout-item" autofocus tabindex=1 />
              <span class="md-error" v-if="!$v.form.username.required">Le nom de l'utilisateur est requis</span>
              <span class="md-error" v-else-if="!$v.form.username.minlength">Le nom de l'utilisateur doit comporter au moins 2 caractères</span>
              <span class="md-error" v-else-if="!$v.form.username.alphanum">Le nom de l'utilisateur doit comporter uniquement des cararctères alphanumérique</span>
            </md-field>
          </div>
          <md-button class="md-raised md-primary" @click="setDone('first', 'second')" tabindex=2 >Valider le nom d'utilisateur</md-button>
        </md-step>

        <md-step id="second" md-label="Votre adresse email" :md-error="secondStepError" :md-editable="true" :md-done.sync="second">
          <md-subheader>
          Entrer une adresse email
          </md-subheader>
          <p>
          Votre adresse email est utilisé uniquement dans le but d'exploiter pleinement les fonctionalités de ce site
          </p>
          <div class="md-layout md-gutter">
            <md-field :class="getValidationClass('email')">
              <md-input v-model="form.email" name="email" class="md-layout-item" tabindex=3 />
              <span class="md-error" v-if="!$v.form.email.required">L'adresse email est requise</span>
              <span class="md-error" v-else-if="!$v.form.email.email">L'adresse email est invalide</span>
            </md-field>
          </div>
          <md-button class="md-raised md-primary" @click="setDone('second', 'third')" tabindex=4 >Valider l'adresse email</md-button>
        </md-step>

        <md-step id="third" md-label="Choisir un mot de passe" :md-editable="true" :md-done.sync="third">
          <md-subheader>
          Entrer un mot de passe
          </md-subheader>
          <p>Dernière étape avant de pouvoir participer à des paris</p>
          <div class="md-layout md-gutter">
            <md-field :class="getValidationClass('password')">
              <md-input type="password" v-model="form.password" name="password" class="md-layout-item" tabindex=5 />
              <span class="md-error" v-if="!$v.form.password.required">Le mot de passe est requis</span>
              <span class="md-error" v-else-if="!$v.form.password.minlength">Le mot de passe doit comporter au moins 3 caractères</span>
              <span class="md-error" v-else-if="!$v.form.password.alphaNum">Le mot de passe doit comporter uniquement des caractères alphanumérique</span>
            </md-field>
          </div>
          <md-button class="md-raised md-primary" @click="setDone('third')" tabindex=6 >Valider la création du compte</md-button>
        </md-step>
        <span class="form-error" v-if="!isFormCorrect">Au moins un champ est invalide</span>
      </md-steppers>
    </form>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, minLength, alphaNum, email } from 'vuelidate/lib/validators'
import LoginApi from '@/services/api/Login'

// TODO add validation

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
    form: {
      username: null,
      email: null,
      password: null
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
    setDone (id, index) {
      this[id] = true

      this.secondStepError = null
      if (index) {
        this.active = index
      } else {
        this.$v.$touch()

        if (!this.$v.$invalid) {
          this.isFormCorrect = true
          this.saveUser()
        } else {
          this.isFormCorrect = false
        }
      }
    },
    saveUser () {
      // TODO : Snack bar or redirect
      LoginApi.createAccount(this.form.email, this.form.username, this.form.password)
        .then(result => {
          if (result.status === 200) {
          // TODO ok snackbar and redirect
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
