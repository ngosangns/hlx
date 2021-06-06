<?php
(function($vm, $child) {
    $view = new ViewSetup($vm, $child);
    
    $view->content = function ($view) {
        ?>
        
        <?php
    };
    $view->end = function ($view) {
        ?>
        <?php
    };
    
    $child = $view;
    require "views/templates/MainTemplate.php";
})($vm, null);
?>
