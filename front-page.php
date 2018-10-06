<?php
use Danzerpress\Controllers\Controller;

$context = [
    'posts' => Timber::get_posts([
        'post_type' => 'post'
    ]),
    'posts_per_page' => 10,
    'post_page' => 2
];

$_front = new Controller('front.twig', $context);
$_front->render();