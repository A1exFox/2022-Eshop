<?php

declare(strict_types=1);

use wfm\Router;

Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']);
Router::add('^(?<lang>[a-z]+)?/?product/(?<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
Router::add('^(?<lang>[a-z]+)?/?category/(?<slug>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
Router::add('^(?<lang>[a-z]+)?/?search/?$', ['controller' => 'Search', 'action' => 'index']);
Router::add('^(?P<lang>[a-z]+)?/?$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
Router::add('^(?P<lang>[a-z]+)/(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
