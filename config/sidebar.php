<?php
$current_route="request()->getRequestUri()";

return [
  'Product' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Product',
    'class' => '',
    'visibility' => true,
    'permission' => true,
    'active' => false,
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/products/create',
        'title' => 'Add Product',
        'visibility' => true,
        'permission' => true,
        'active' => '$current_route == "/admin/products/create"',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/products',
        'title' => 'List Products',
        'visibility' => true,
        'permission' => true,
        'active' => false,
      ],
    ],
  ],
  'Download' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Download',
    'class' => '',
    'visibility' => true,
    'permission' => true,
    'active' => false,
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/downloads/create',
        'title' => 'Add Download',
        'visibility' => true,
        'permission' => true,
        'active' => '$current_route == "/admin/downloads/create"',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/downloads',
        'title' => 'List Downloads',
        'visibility' => true,
        'permission' => true,
        'active' => false,
      ],
    ],
  ],
  '[solid_auto_generated_sidebar]' => NULL,
];
