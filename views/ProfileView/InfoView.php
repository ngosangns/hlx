<?php
return function ($vm, $child) {
    $view = new ViewSetup($vm, $child);
    $view->setContent(function ($view) {?>
<span class="md-headline">Truyện đã đăng</span><br>
<span class="md-headline">Truyện đã thích</span><?php
    });
    return $view;
};
