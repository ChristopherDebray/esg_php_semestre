<?php
date_default_timezone_set('Europe/Paris');

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;

echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

foreach ($data as $item) {
    echo '<url>' . PHP_EOL;
    echo '<loc>' . $_SERVER['SERVER_NAME'] . "/" . $item . '/</loc>' . PHP_EOL;
    echo '<changefreq>daily</changefreq>' . PHP_EOL;
    echo '<lastmod>'. date('Y-m-d H:i:sP') .'</lastmod>' . PHP_EOL;
    echo '<priority>0.8</priority>' . PHP_EOL;
    echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;
