<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<form id="login-form" novalidate class="md-layout" @submit.prevent="validateUser">
    <md-card class="md-layout-item md-size-50 md-small-size-100">
        <md-card-header>
            <div class="md-title">Đăng nhập</div>
        </md-card-header>

        <md-card-content>
            <md-field :class="getValidationClass('email')">
                <label for="email">Email</label>
                <md-input type="email" name="email" id="email" autocomplete="email" v-model="form.email"
                    :disabled="sending"></md-input>
                <span class="md-error" v-if="!$v.form.email.required">Email là bắt
                    buộc</span>
                <span class="md-error" v-else-if="!$v.form.email.email">Email không đúng định
                    dạng</span>
            </md-field>
            <md-field :class="getValidationClass('password')">
                <label for="password">Mật khẩu</label>
                <md-input type="password" name="password" id="password" autocomplete="password" v-model="form.password"
                    :disabled="sending"></md-input>
                <span class="md-error" v-if="!$v.form.password.required">Mật khẩu là bắt
                    buộc</span>
            </md-field>
        </md-card-content>
        <md-card-actions style="justify-content: center; padding: 1rem">
            <span class="md-body-1" style="width: 100%">
                Chưa có tài khoản?
                <a href="/register">Đăng ký</a>
            </span>
            <md-button type="submit" class="md-primary" :disabled="sending">Đăng nhập</md-button>
        </md-card-actions>
        <md-progress-bar md-mode="indeterminate" v-if="sending" />
    </md-card>

    <md-snackbar :md-active.sync="login">Đăng nhập thành công</md-snackbar>
</form><?php
    });
    $view->setFoot(function ($view) { ?>
<script src="/assets/js/vuelidate.min.js"></script>
<script src="/assets/js/validators.min.js"></script>
<script>
    Vue.use(window.vuelidate.default)
    var validationMixin = window.vuelidate.validationMixin
    const {
        required,
        email,
        minLength,
        maxLength
    } = window.validators

    mixins.push({
        name: 'FormValidation',
        mixins: [validationMixin],
        data: () => ({
            form: {
                email: null,
                password: null,
            },
            login: false,
            sending: false,
            lastUser: null
        }),
        validations: {
            form: {
                email: {
                    required,
                    email
                },
                password: {
                    required
                }
            }
        },
        methods: {
            getValidationClass(fieldName) {
                const field = this.$v.form[fieldName]
                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            clearForm() {
                this.$v.$reset()
                this.form.email = null
                this.form.password = null
            },
            saveUser() {
                this.sending = true
                // Instead of this timeout, here you can call your API
                window.setTimeout(() => {
                    this.lastUser = `${this.form.firstName} ${this.form.lastName}`
                    this.userSaved = true
                    this.sending = false
                    this.clearForm()
                }, 1500)
            },
            validateUser() {
                this.$v.$touch()
                if (!this.$v.$invalid) {
                    this.saveUser()
                }
            }
        }
    })
</script>
<style>
    #login-form {
        width: 100%;
        max-width: 50rem;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-error-message {
        color: var(--md-theme-default-fieldvariant, #ff1744);
    }
</style><?php
    });
    return $view;
};
