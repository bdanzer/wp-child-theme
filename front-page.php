<?php
use Danzerpress\Controller\Controller;

$context = [
    'posts' => Timber::get_posts([
        'post_type' => 'post'
    ]),
    'posts_per_page' => 10,
    'post_page' => 1
];

$_front = new Controller('front.twig', $context);
$_front->render();