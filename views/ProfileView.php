<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<div class="md-layout" style="max-width: 1920px">
    <div class="md-layout-item md-large-size-25 md-small-size-100" style="max-width: calc(1920px / 4)">
        <div style="padding: .5rem; 
                    display: flex; 
                    flex-direction: column;
                    align-items: center; 
                    justify-content: center;">
            <div style="
                background-image: url(/assets/images/1.jpg);
                background-position: center center;
                background-size: cover;
                width: 85%;
                padding-top: 85%;
                border-radius: 50%;
            "></div><br>
            <a href="/profile"><span class="md-headline">Admin</span></a>
            <a href="/profile/update-info" style="display: block; width: 100%; text-align: center">
                <md-button style="width: 85%"
                    class="md-raised <?= $view->vm->tab === "update-info" ? "md-primary" : "" ?>">
                    Cập nhật thông tin
                </md-button>
            </a>
            <br>
            <div style="width: 85%">
                <span style="">
                    <md-icon>badge</md-icon>
                    <span style="display: inline-block; height: 100%; vertical-align: middle;">
                        Nguyễn Văn A</span>
                </span><br>
                <span>
                    <md-icon>email</md-icon>
                    <span style="display: inline-block; height: 100%; vertical-align: middle;">
                        admin@localhost</span>
                </span><br><br>
                <md-divider></md-divider>
            </div>
        </div>
    </div>
    <div class="md-layout-item">
        <md-tabs md-active-tab="<?= $view->vm->tab ?>">
            <md-tab id="info" md-label="Tường" md-icon="call_to_action" href="/profile"></md-tab>
            <md-tab id="upload-manga" md-label="Upload truyện" md-icon="book" href="/profile/upload-manga"></md-tab>
        </md-tabs>
        <md-divider></md-divider><br>
        <div id="profile-content">
            <?php $view->getChild()->getContent(); ?>
        </div>
    </div>
</div><?php
    });
    $view->setFoot(function ($view) {?>
<script>
    mixins.push({
        name: 'PersistentMini',
        data: () => ({
            menuProfileVisible: false
        }),
        methods: {
            toggleMenu() {
                this.menuProfileVisible = !this.menuProfileVisible
            }
        }
    })
</script><?php
        $view->getChild()->getFoot();
    });
    return $view;
};
