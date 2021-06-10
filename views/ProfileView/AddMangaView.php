<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<form id="login-form" novalidate class="md-layout" @submit.prevent="validateUser">
    <div class="md-headline" style="display: block; width: 100%; text-align: left;">Thêm truyện</div>
    <md-field :class="getValidationClass('name')">
        <label for="name">Tên truyện</label>
        <md-input type="text" name="name" autocomplete="name" v-model="form.name" :disabled="sending">
        </md-input>
        <span class="md-error" v-if="!$v.form.name.required">Tên truyện là bắt buộc</span>
    </md-field>
    <md-field :class="getValidationClass('author')">
        <label for="author">Tên tác giả</label>
        <md-input type="text" name="author" autocomplete="author" v-model="form.author" :disabled="sending">
        </md-input>
    </md-field>
    <md-field :class="getValidationClass('description')">
        <label for="description">Mô tả truyện</label>
        <md-input type="text" name="description" autocomplete="description" v-model="form.description"
            :disabled="sending">
        </md-input>
    </md-field>
    <md-field :class="getValidationClass('status')">
        <label for="status">Trạng thái</label>
        <md-input type="text" name="status" autocomplete="status" v-model="form.status" :disabled="sending">
        </md-input>
    </md-field>
    <div style="width: 100%; display: flex; justify-content: flex-end;">
        <md-button type="submit" class="md-primary" :disabled="sending">Thêm</md-button>
    </div>
    <md-snackbar :md-active.sync="trigger">Thêm truyện thành công</md-snackbar>
</form>
<div class="progress-bar">
    <md-progress-bar md-mode="indeterminate" v-if="sending" />
</div><?php
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
                name: null,
                author: null,
                description: null,
                status: null,
            },
            trigger: false,
            sending: false,
        }),
        validations: {
            form: {
                name: {
                    required,
                },
                author: {},
                description: {},
                status: {}
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
                this.form.name = null
                this.form.author = null
                this.form.description = null
                this.form.status = null
            },
            saveUser() {
                this.sending = true
                // Instead of this timeout, here you can call your API
                window.setTimeout(() => {
                    this.sending = false
                    this.clearForm()
                    this.trigger = !this.trigger
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
        max-width: 40rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .progress-bar {
        width: 100%;
        max-width: 40rem;
    }

    .form-error-message {
        color: var(--md-theme-default-fieldvariant, #ff1744);
    }
</style><?php
            });
    return $view;
};
