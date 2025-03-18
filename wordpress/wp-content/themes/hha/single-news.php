<?php 
    $field = get_field('in_the_news_link'); 

    if (!empty($field) && !empty($field['url'])) {
        header('location: '.$field['url']);
    } else {
        header('location: /');
    }