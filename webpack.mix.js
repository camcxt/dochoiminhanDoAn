const mix = require('laravel-mix');

// Publish tất cả các tệp trong thư mục "resources/css" và các thư mục con
mix.copyDirectory('resources/css', 'public/css');

// Publish tất cả các tệp trong thư mục "resources/js" và các thư mục con
mix.copyDirectory('resources/js', 'public/js');