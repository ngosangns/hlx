<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {
        ?>
<vueper-slides :visible-slides="5" :touchable="false" class="no-shadow">
    <vueper-slide v-for="(slide, i) in slides" :key="i" :title="slide.title" :content="slide.content" link="/"
        :image="slide.image" />
</vueper-slides>
<div id="home-content" class="md-layout md-gutter" style="margin-top: 2rem">
    <div class="md-layout-item md-medium-size-75">
        <md-card>
            <md-card-content>
                <md-tabs>
                    <md-tab id="tab-home" md-label="Home" exact>
                        Home Tab
                    </md-tab>
                    <md-tab id="tab-pages" md-label="Pages">
                        Pages tab
                        <p>Unde provident nemo reiciendis officia, possimus repellendus. Facere dignissimos dicta quis
                            rem. Aliquam aspernatur dolor atque nisi id deserunt laudantium quam repellat.</p>
                    </md-tab>
                    <md-tab id="tab-posts" md-label="Posts">
                        Posts tab
                        <p>Qui, voluptas repellat impedit ducimus earum at ad architecto consectetur perferendis
                            aspernatur iste amet ex tempora animi, illum tenetur quae assumenda iusto.</p>
                    </md-tab>
                    <md-tab id="tab-favorites" md-label="Favorites">
                        Favorites tab
                        <p>Maiores, dolorum. Beatae, optio tempore fuga odit aperiam velit, consequuntur magni inventore
                            sapiente alias sequi odio qui harum dolorem sunt quasi corporis.</p>
                    </md-tab>
                </md-tabs>
            </md-card-content>
        </md-card>
    </div>
    <div class="md-layout-item md-medium-size-25 md-xsmall-size-100">
        <md-card>
            <md-card-header>
                <div class="md-title">Bình luận mới nhất</div>
            </md-card-header>
            <md-card-content>
            </md-card-content>
        </md-card>
    </div>
</div>
<?php
    });
    $view->setFoot(function ($view) {
        ?>
<script src="https://unpkg.com/vueperslides"></script>
<link href="https://unpkg.com/vueperslides/dist/vueperslides.css" rel="stylesheet">
<script>
    Vue.component("vueper-slides", vueperslides.VueperSlides);
    Vue.component("vueper-slide", vueperslides.VueperSlide)
    data['slides'] = [{
        title: 'Slide #1',
        content: 'Slide content 1.',
        image: '/assets/images/1.jpg',
    }, {

        title: 'Slide #2',
        content: 'Slide content 2.',
        image: '/assets/images/2.jpg',
    }, {

        title: 'Slide #3',
        content: 'Slide content 3.',
        image: '/assets/images/3.jpg',
    }, {

        title: 'Slide #4',
        content: 'Slide content 4.',
        image: '/assets/images/4.jpg',
    }, {

        title: 'Slide #5',
        content: 'Slide content 5.',
        image: '/assets/images/5.jpg',
    }, ]
</script>
<style>
    .vueperslides__track a {
        color: white !important;
        text-decoration-line: none !important;
        font-size: 1rem;
    }

    .vueperslide__content-wrapper {
        justify-content: flex-end !important;
    }

    #home-content .md-card {
        margin: 0;
    }
</style>
<?php
    });
    return $view;
};
