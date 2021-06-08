<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) { ?>
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
                            <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
                                <md-icon>menu</md-icon>
                            </md-button>
                            <span class="md-title">
                                <md-avatar style="margin-right: .5rem">
                                    <img src="/favicon.ico" alt="Avatar">
                                </md-avatar>
                            </span>
                            <div id="search-box" class="md-toolbar-section-end">
                                <md-field>
                                    <md-input placeholder="Tìm truyện..."></md-input>
                                </md-field>
                                <md-button class="md-raised">Tìm kiếm</md-button>
                            </div>
                            <div class="md-toolbar-section-end">
                                <a href="/login">
                                    <md-button>
                                        <md-icon>account_circle</md-icon>
                                    </md-button>
                                </a>
                            </div>
                        </div>
                        <div class="md-toolbar-row" style="min-height: auto!important">
                            <md-menu>
                                <md-button>Trang chủ</md-button>
                            </md-menu>
                            <md-menu>
                                <md-button>Liên hệ</md-button>
                            </md-menu>
                            <md-menu>
                                <md-button>Tìm kiếm nâng cao</md-button>
                            </md-menu>
                        </div>
                    </md-app-toolbar>
                    <md-app-drawer :md-active.sync="menuVisible">
                        <md-toolbar class="md-transparent" md-elevation="0">Navigation</md-toolbar>

                        <md-list>
                            <md-list-item>
                                <md-icon>move_to_inbox</md-icon>
                                <span class="md-list-item-text">Inbox</span>
                            </md-list-item>

                            <md-list-item>
                                <md-icon>send</md-icon>
                                <span class="md-list-item-text">Sent Mail</span>
                            </md-list-item>

                            <md-list-item>
                                <md-icon>delete</md-icon>
                                <span class="md-list-item-text">Trash</span>
                            </md-list-item>

                            <md-list-item>
                                <md-icon>error</md-icon>
                                <span class="md-list-item-text">Spam</span>
                            </md-list-item>
                        </md-list>
                    </md-app-drawer>

                    <md-app-content>
                        <?php $view->getChild()->getContent() ?>
                    </md-app-content>
                </md-app>

            </div>
        </div>

    </div>
    <script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/vue-material"></script>
    <script>
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

        const mixins = []
    </script>
    <?php $view->getChild()->getFoot() ?>
    <script>
        new Vue({
            el: '#app',
            mixins,
            data: () => ({
                menuVisible: false,
                loadingState: true,
            }),
            mounted: function() {
                this.offLoading() //method1 will execute at pageload
            },
            methods: {
                offLoading: function() {
                    this.loadingState = false;
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

</html><?php
    });
    return $view;
};
