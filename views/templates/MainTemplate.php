<?php
(function($vm, $child, $template) {
    $view = new ViewSetup($vm, $child, $template);
    $view->content = function ($view) {
        ?>
        <!DOCTYPE html>
        <html>

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <title><?= $view->vm->title ?></title>
                <meta name="keywords" content="'<?= $view->vm->keywords ?>">
                <meta name="description" content="<?= $view->vm->description ?>">

                <link rel="stylesheet"
                      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic|Material+Icons">
                <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
                <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
            </head>

            <body>
                <?= ($view->child->head)($view->child) ?>
                <div id="app">
                    <div style="width: 100vw; height: 100vh; z-index: 100; 
                         background: white; position: fixed; display: flex;
                         align-items: center; justify-content: center" v-if="loadingState">
                        <md-progress-spinner md-mode="indeterminate">Loading...</md-progress-spinner>
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
                                            <md-button><md-icon>account_circle</md-icon></md-button>
                                        </div>
                                    </div>
                                    <div class="md-toolbar-row" style="min-height: auto!important">
                                        <md-tabs class="md-primary">
                                            <md-tab id="tab-home" md-label="Home"></md-tab>
                                            <md-tab id="tab-pages" md-label="Pages"></md-tab>
                                            <md-tab id="tab-posts" md-label="Posts"></md-tab>
                                            <md-tab id="tab-favorites" md-label="Favorites"></md-tab>
                                        </md-tabs>
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
                                    <?= ($view->child->content)($view->child) ?>
                                </md-app-content>
                            </md-app>

                        </div>
                    </div>

                </div>
                <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
                <script src="https://unpkg.com/vue-material"></script>
                <script>
                    let data = {}
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
                </script>
                <?= ($view->child->foot)($view->child) ?>
                <script>
                    new Vue({
                        el: '#app',
                        data: () => ({
                                ...data,
                                menuVisible: false,
                                loadingState: true,
                            }),
                        mounted: function () {
                            this.offLoading() //method1 will execute at pageload
                        },
                        methods: {
                            offLoading: function () {
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
                    #search-box .md-field input, #search-box .md-field input::placeholder {
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
    };
    $view->render();
})($vm, $child, null);
?>
