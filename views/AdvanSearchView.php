<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<form id="search-form" novalidate class="md-layout" @submit.prevent="validateUser">
    <md-card class="md-layout-item md-size-50 md-small-size-100">
        <md-card-header>
            <div class="md-title">Tìm kiếm nâng cao</div>
        </md-card-header>

        <md-card-content>
            <md-field :class="getValidationClass('name')">
                <label for="name">Tên truyện</label>
                <md-input type="text" name="name" autocomplete="name" v-model="form.name" :disabled="sending">
                </md-input>
            </md-field>
            <md-field :class="getValidationClass('author')">
                <label for="author">Tác giả</label>
                <md-input type="text" name="author" autocomplete="author" v-model="form.author" :disabled="sending">
                </md-input>
            </md-field>
        </md-card-content>
        <md-card-actions style="justify-content: center; padding: 1rem">
            <md-button type="submit" class="md-primary" :disabled="sending">Tìm</md-button>
        </md-card-actions>

        <md-progress-bar md-mode="indeterminate" v-if="sending" />
    </md-card>


    <md-snackbar :md-active.sync="searched">Tìm thấy ... kết quả</md-snackbar>
</form><?php
    });
    $view->setFoot(function ($view) {?>
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
                name: null,
                author: null,
            },
            searched: false,
            sending: false,
            lastUser: null
        }),
        validations: {
            form: {
                name: {},
                author: {},
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
            saveUser() {
                this.sending = true
                // Instead of this timeout, here you can call your API
                window.setTimeout(() => {
                    this.lastUser = `${this.form.firstName} ${this.form.lastName}`
                    this.userSaved = true
                    this.sending = false
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
    #search-form {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #search-form>.md-card {
        margin: 0;
    }

    .form-error-message {
        color: var(--md-theme-default-fieldvariant, #ff1744);
    }
</style><?php
            });
    return $view;
};
