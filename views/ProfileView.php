<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<div class="md-layout md-gutter">
    <div class="md-layout-item md-medium-size-25 md-small-size-100">
        <div style="padding: .5rem; 
                    display: flex; 
                    flex-direction: column;
                    align-items: center; 
                    justify-content: center;">
            <div style="
                background-image: url(/assets/images/1.jpg);
                background-position: center center;
                background-size: cover;
                width: 80%;
                padding-top: 80%;
                border-radius: 50%;
            "></div><br>
            <span class="md-display-1">Admin</span>
        </div>
    </div>
    <div class="md-layout-item">
        <md-tabs>
            <md-tab id="tab-home" md-label="Thông tin chung" exact></md-tab>
            <md-tab id="tab-manga" md-label="Upload truyện">
                <md-list>
                    <md-list-item>Go to Subpage 1</md-list-item>
                    <md-list-item>Go to Subpage 2</md-list-item>
                </md-list>
            </md-tab>
            <md-tab id="tab-info" md-label="Cập nhật thông tin"></md-tab>
            <md-tab id="tab-favorites" md-label="Bộ sưu tập"></md-tab>
        </md-tabs>
    </div>
</div><?php
    });
    $view->setFoot(function () {?>
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
    });
    return $view;
};
