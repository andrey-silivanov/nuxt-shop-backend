<template>
    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-40" id="login-page">
        <md-card>
            <md-card-header data-background-color="green">
                <h4 class="title">Login</h4>
            </md-card-header>
            <md-card-content>
                <form novalidate class="md-layout" @submit.prevent="validateUser">
                <md-field :class="getValidationClass('email')">
                    <label for="email">Email</label>
                    <md-input type="email" name="emaildsd" id="email" v-model="form.email" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.email.required">The email is required</span>
                    <span class="md-error" v-else-if="!$v.form.email.email">Invalid email</span>
                </md-field>
                <md-field :class="getValidationClass('password')">
                    <label for="password">Password</label>
                    <md-input type="password" autocomplete="off" name="email" id="password" v-model="form.password" :disabled="sending" />
                    <span class="md-error" v-if="!$v.form.password.required">The password is required</span>
                </md-field>
                <md-card-actions>
                    <md-button type="submit" class="md-success" :disabled="sending">Login</md-button>
                </md-card-actions>
                </form>
            </md-card-content>
        </md-card>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {
        required,
        email,
        minLength,
        maxLength
    } from 'vuelidate/lib/validators'

    export default {
        name: 'FormValidation',
        mixins: [validationMixin],
        data: () => ({
            form: {
                email: null,
                password: null
            },
            userSaved: false,
            sending: false,
            lastUser: null
        }),
        validations: {
            form: {
                password: {
                    required
                },
                email: {
                    required,
                    email
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
                this.form.firstName = null
                this.form.lastName = null
                this.form.age = null
                this.form.gender = null
                this.form.email = null
            },
            saveUser () {
                this.sending = true

                // Instead of this timeout, here you can call your API
                window.setTimeout(() => {
                    this.lastUser = `${this.form.firstName} ${this.form.lastName}`
                    this.userSaved = true
                    this.sending = false
                    this.clearForm()
                }, 1500)
            },
            validateUser () {
                this.$v.$touch()

                if (!this.$v.$invalid) {
                    this.saveUser()
                }
            }
        }
    }
</script>