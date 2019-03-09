<template>
  <div>
    <form novalidate class="md-layout md-alignment-center" @submit.prevent="validateUser">
      <md-card class="md-layout-item md-size-50 md-small-size-100">
        <md-card-header>
          <div class="md-title">Utilisateur</div>
        </md-card-header>
        <md-card-content>
          <div class="md-layout md-gutter">
            <div class="md-layout-item md-small-size-100">
              <md-field :class="getValidationClass('userName')">
                <label for="userName">Nom d'utilisateur</label>
                <md-input name="userName" id="userName" v-model="form.userName"/>
                <span class="md-error" v-if="!$v.form.userName.required">Le nom d'utilisateur est requis</span>
                <span class="md-error" v-else-if="!$v.form.userName.minlength">Le nom d'utilisateur est incorrect</span>
              </md-field>
            </div>
            <div class="md-layout-item md-small-size-100">
              <md-field :class="getValidationClass('password')">
                <label for="password">Mot de passe</label>
                <md-input type="password" name="password" id="password" v-model="form.password"/>
                <span class="md-error" v-if="!$v.form.password.required">Le mot de passe est requis</span>
                <span class="md-error" v-else-if="!$v.form.password.minlength">Le mot de passe est incorrect</span>
              </md-field>
            </div>
          </div>
        </md-card-content>
        <md-card-actions>
          <md-button type="submit" class="md-primary">Se connecter</md-button>
        </md-card-actions>
      </md-card>
      <md-snackbar :md-active.sync="loginSucces">La connection est réussi !</md-snackbar>
      <md-snackbar :md-active.sync="loginFailed">La connection a échoué !</md-snackbar>
    </form>
  </div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, minLength, alphaNum } from 'vuelidate/lib/validators'
import LoginApi from '@/services/api/Login'

export default {
  name: 'AppLoginForm',
  mixins: [validationMixin],
  data: () => ({
    form: {
      userName: null,
      password: null
    },
    loginSucces: null,
    loginFailed: null
  }),
  validations: {
    form: {
      userName: {
        required,
        minLength: minLength(2),
        alphaNum
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
    logUserIn () {
      LoginApi.login(this.form.userName, this.form.password).then(result => {
        if (result.data === 1) {
          this.loginSucces = true
          this.$localStorage.set('authenticated', true)
          setTimeout(function () {
            this.$router.push('/home')
          }.bind(this), 2000)
          // TODO SHOW disconnect button
        } else {
          this.loginFailed = true
        }
      })
    },
    validateUser () {
      this.$v.$touch()

      if (!this.$v.$invalid) {
        this.logUserIn()
      }
    }
  }
}
</script>

<style lang="scss" scoped>
  .md-progress-bar {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
  }
</style>
