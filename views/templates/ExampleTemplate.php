<?php
(function($vm, $child) {
    require_once "views/setup/ViewSetup.php";
    $view = new ViewSetup($vm);
    $view->child = $child;
    
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
                    <?= ($view->child->content)($view->child) ?>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
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

                    new Vue({
                        el: '#app'
                    })
                </script>
                <style>
                    .elevation-demo {
                        padding: 16px;
                        display: flex;
                        flex-wrap: wrap;
                    }

                    .md-content {
                        width: 100px;
                        height: 100px;
                        margin: 24px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                </style>
                <?= ($view->child->foot)($view->child) ?>
            </body>

        </html>
        <?php
    };
    ($view->content)($view);
})($vm, $child);
?>
