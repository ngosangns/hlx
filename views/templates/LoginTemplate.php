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

        .md-app-content {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</body>

</html>
<?php
    });
    return $view;
};
