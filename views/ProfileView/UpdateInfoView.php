<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<span class="md-headline">Cập nhật thông tin</span><br>
<form novalidate class="md-layout" style="max-width: 1920px" @submit.prevent="validateUser">
    <div class="md-layout-item md-large-size-50 md-xsmall-size-100">
        <md-field :class="getValidationClass('name')">
            <label for="name">Họ tên</label>
            <md-input name="name" id="name" autocomplete="name" v-model="form.name" :disabled="sending"></md-input>
            <span class="md-error" v-if="!$v.form.name.required">
                Họ tên là bắt buộc</span>
        </md-field>
        <md-field :class="getValidationClass('email')">
            <label for="email">Email</label>
            <md-input type="email" name="email" id="email" autocomplete="email" v-model="form.email"
                :disabled="sending"></md-input>
            <span class="md-error" v-if="!$v.form.email.required">Email là bắt buộc</span>
            <span class="md-error" v-else-if="!$v.form.email.email">Email không đúng định dạng</span>
        </md-field>
        <md-button type="submit" class="md-primary" :disabled="sending">Cập nhật</md-button>
        <md-snackbar :md-active.sync="userSaved">The user {{ lastUser }} was saved with success!</md-snackbar>
        <md-progress-bar md-mode="indeterminate" v-if="sending" />
    </div>
</form><br>
<span class="md-headline">Cập nhật mật khẩu</span><br>
<form novalidate class="md-layout" style="max-width: 1920px" @submit.prevent="validateUser2">
    <div class="md-layout-item md-large-size-50 md-xsmall-size-100">
        <md-field :class="getValidationClass2('cpassword')">
            <label for="name">Mật khẩu hiện tại</label>
            <md-input type="password" name="cpassword" autocomplete="cpassword" v-model="form2.cpassword"
                :disabled="sending2"></md-input>
            <span class="md-error" v-if="!$v.form2.cpassword.required">
                Mật khẩu hiện tại là bắt buộc</span>
        </md-field>
        <md-field :class="getValidationClass2('npassword')">
            <label for="name">Mật khẩu mới</label>
            <md-input type="password" name="npassword" autocomplete="npassword" v-model="form2.npassword"
                :disabled="sending2"></md-input>
            <span class="md-error" v-if="!$v.form2.npassword.required">
                Mật khẩu mới là bắt buộc</span>
        </md-field>
        <md-field :class="getValidationClass2('repassword')">
            <label for="name">Xác nhận mật khẩu</label>
            <md-input type="password" name="repassword" autocomplete="repassword" v-model="form2.repassword"
                :disabled="sending2"></md-input>
            <span class="md-error" v-if="!$v.form2.repassword.required">
                Xác nhận mật khẩu là bắt buộc</span>
            <span class="md-error" v-else-if="!$v.form2.repassword.sameAsPassword">
                Mật khẩu xác nhận không trùng khớp</span>
        </md-field>
        <md-button type="submit" class="md-primary" :disabled="sending2">Cập nhật</md-button>
        <md-snackbar :md-active.sync="userSaved2">The user {{ lastUser }} was saved with success!</md-snackbar>
        <md-progress-bar md-mode="indeterminate" v-if="sending2" />
    </div>
</form><br><br><?php
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
        maxLength,
        sameAs
    } = window.validators

    mixins.push({
        name: 'FormValidation',
        mixins: [validationMixin],
        data: () => ({
            form: {
                name: "Nguyễn Văn A",
                email: "admin@localhost.com",
            },
            form2: {
                cpassword: null,
                npassword: null,
                repassword: null,
            },
            userSaved: false,
            sending: false,
            lastUser: null,
            userSaved2: false,
            sending2: false,
            lastUser2: null
        }),
        validations: {
            form: {
                name: {
                    required,
                },
                email: {
                    required,
                    email,
                }
            },
            form2: {
                cpassword: {
                    required,
                },
                npassword: {
                    required,
                },
                repassword: {
                    required,
                    sameAsPassword: sameAs(function() {
                        return this.form2.npassword
                    })
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
                this.$v.form.$reset()
                this.form.name = null
                this.form.gender = null
                this.form.email = null
            },
            saveUser() {
                this.sending = true

                // Instead of this timeout, here you can call your API
                window.setTimeout(() => {
                    this.lastUser = `${this.form.name}`
                    this.userSaved = true
                    this.sending = false
                    this.clearForm()
                }, 1500)
            },
            validateUser() {
                this.$v.form.$touch()

                if (!this.$v.form.$invalid) {
                    this.saveUser()
                }
            },
            getValidationClass2(fieldName) {
                const field = this.$v.form2[fieldName]

                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            clearForm2() {
                this.$v.form2.$reset()
                this.form2.cpassword = null
                this.form2.npassword = null
                this.form2.repassword = null
            },
            saveUser2() {
                this.sending2 = true

                // Instead of this timeout, here you can call your API
                window.setTimeout(() => {
                    this.lastUser2 = `${this.form.name}`
                    this.userSaved2 = true
                    this.sending2 = false
                    this.clearForm2()
                }, 1500)
            },
            validateUser2() {
                this.$v.form2.$touch()

                if (!this.$v.form2.$invalid) {
                    this.saveUser2()
                }
            }
        }
    })
</script><?php
    });
    return $view;
};
