<?php

return [
  'Product' =>
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Product',
    'class' => '',
    'visibility' => true,
    'permission' => [true],
    'sub_link' =>
    [
      'create' =>
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/products/create',
        'title' => 'Add Product',
        'visibility' => true,
        'permission' => '',
      ],
      'index' =>
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/products',
        'title' => 'List Products',
        'visibility' => true,
        'permission' => '',
      ],
    ],
  ],
  'Category' =>
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Category',
    'class' => '',
    'visibility' => true,
    'permission' => '',
    'sub_link' =>
    [
      'create' =>
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/categories/create',
        'title' => 'Add Category',
        'visibility' => true,
        'permission' => '',
      ],
      'index' =>
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/categories',
        'title' => 'List Categories',
        'visibility' => true,
        'permission' => '',
      ],
    ],
  ],
  'Order' =>
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Order',
    'class' => '',
    'visibility' => true,
    'permission' => '',
    'sub_link' =>
    [
      'create' =>
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/orders/create',
        'title' => 'Add Order',
        'visibility' => true,
        'permission' => '',
      ],
      'index' =>
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/orders',
        'title' => 'List Orders',
        'visibility' => true,
        'permission' => '',
      ],
    ],
  ],
];
