<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {
        ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $view->vm->title ?>
    </title>
    <meta name="keywords" content="'<?= $view->vm->keywords ?>">
    <meta name="description" content="<?= $view->vm->description ?>">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
    <style>
        #loading {
            width: 100vw;
            height: 100vh;
            z-index: 100;
            background: white;
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader {
            border: 1vw solid #f3f3f3;
            border-radius: 50%;
            border-top: 1vw solid #3498db;
            width: 10vw;
            height: 10vw;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <?php $view->getChild()->getHead() ?>
    <div id="app">
        <div id="loading" v-if="loadingState">
            <div class="loader"></div>
        </div>
        <div class="md-layout">
            <div class="md-layout-item">
                <md-app md-mode="fixed" id="wrapper">
                    <md-app-toolbar class="md-primary">
                        <div class="md-toolbar-row">
                            <span class="md-title">
                                <a href="/">
                                    <md-avatar style="margin-right: .5rem">
                                        <img src="/favicon.ico" alt="Avatar">
                                    </md-avatar>
                                </a>
                            </span>
                        </div>
                    </md-app-toolbar>
                    <md-app-content>
                        <?php $view->getChild()->getContent() ?>
                    </md-app-content>
                </md-app>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/vue-material"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuelidate@0.7.6/dist/vuelidate.min.js"
        integrity="sha256-4wHDIs7DYJ0xz+FlWjIu4kPe2jFk+KAg+JH4vgi9WRs=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuelidate@0.7.6/dist/validators.min.js"
        integrity="sha256-Bm9w6Cif2Vx+HnSoGdKn3/mgtowQA5eACGYIh5QaUvQ=" crossorigin="anonymous"></script>
    <script>
        Vue.use(window.vuelidate.default)
        var validationMixin = window.vuelidate.validationMixin
        const {
            required,
            email,
            minLength,
            maxLength
        } = window.validators

        Vue.use(VueMaterial.default)

        // change single option
        Vue.material.locale.dateFormat = 'dd/MM/yyyy'

        // change multiple options
        Vue.material = {
            ...Vue.material,
            locale: {
                ...Vue.material.locale,
                dateFormat: 'dd/MM/yyyy',
                firstDayOfAWeek: 1
            }
        }
        let data = {
            loadingState: true,
        }
    </script>
    <?php $view->getChild()->getFoot() ?>
    <script>
        new Vue({
            el: '#app',
            mixins: [validationMixin],
            data: () => ({
                loadingState: true,
                form: {
                    firstName: null,
                    lastName: null,
                    gender: null,
                    age: null,
                    email: null,
                },
                userSaved: false,
                sending: false,
                lastUser: null
            }),
            validations: {
                form: {
                    firstName: {
                        required,
                        minLength: minLength(3)
                    },
                    lastName: {
                        required,
                        minLength: minLength(3)
                    },
                    age: {
                        required,
                        maxLength: maxLength(3)
                    },
                    gender: {
                        required
                    },
                    email: {
                        required,
                        email
                    }
                }
            },
            mounted: function() {
                this.offLoading() //method1 will execute at pageload
            },
            methods: {
                offLoading: function() {
                    this.loadingState = false;
                },
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
                    this.form.firstName = null
                    this.form.lastName = null
                    this.form.age = null
                    this.form.gender = null
                    this.form.email = null
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
            },
        })
    </script>
    <style>
        #wrapper {
            position: fixed;
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .md-app-content {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*Search box*/
        #search-box {
            padding-left: 1rem;
        }

        #search-box .md-field {
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        #search-box .md-field input,
        #search-box .md-field input::placeholder {
            color: white;
            -webkit-text-fill-color: white;
        }

        #search-box .md-field:before {
            background-color: white;
        }

        #search-box .md-field:after {
            display: none;
        }
    </style>
</body>

</html>
<?php
    });
    return $view;
};
