<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<div style="display: flex; align-items: center; justify-content: flex-start">
    <span class="md-headline">Chọn truyện</span>
    <a href="/profile/upload-manga/add-manga">
        <md-button class="md-primary md-raised" :md-ripple="false">
            <div style="display: flex; align-items: center; justify-content: center">
                <md-icon>add</md-icon>Thêm truyện mới
            </div>
        </md-button>
    </a>
</div><br>
<div id="uploaded-manga">
    <div class="manga" v-for="manga in uploadedManga">
        <div class="background" :style="'background-image: url('+manga.image+')'">
            <span class="md-title">{{manga.title}}</span>
        </div>
    </div>
</div><br><?php
    });
    $view->setFoot(function ($view) {?>
<script>
    mixins.push({
        name: "InfoView",
        data: () => ({
            uploadedManga: [{
                    image: "/assets/images/2.jpg",
                    title: "Manga 1",
                },
                {
                    image: "/assets/images/2.jpg",
                    title: "Manga 1",
                },
                {
                    image: "/assets/images/2.jpg",
                    title: "Manga 1",
                },
                {
                    image: "/assets/images/2.jpg",
                    title: "Manga 1",
                },
            ],
            collections: [{
                    image: "/assets/images/3.jpg",
                    title: "Manga 1",
                },
                {
                    image: "/assets/images/3.jpg",
                    title: "Manga 1",
                },
                {
                    image: "/assets/images/3.jpg",
                    title: "Manga 1",
                },
                {
                    image: "/assets/images/3.jpg",
                    title: "Manga 1",
                },
            ],
        }),

    })
</script>
<style>
    #uploaded-manga {
        display: grid;
        gap: 1rem;
        grid-template-columns: repeat(1, minmax(15rem, 1fr));
    }

    #uploaded-manga .manga .md-title {
        color: white;
        display: block;
        text-align: center;
        font-weight: normal;
    }

    #uploaded-manga .manga .background {
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        width: 100%;
        padding-top: 150%;
    }

    @media only screen and (min-width: 960px) and (max-width: 1919px) {
        #uploaded-manga {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media only screen and (min-width: 560px) and (max-width: 959px) {
        #uploaded-manga {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media only screen and (max-width: 599px) {
        #uploaded-manga {
            grid-template-columns: repeat(1, 1fr);
        }
    }
</style><?php
            });
    return $view;
};
