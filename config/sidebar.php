<?php

return [
  'Product' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Product',
    'class' => '',
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/product/create',
        'title' => 'Add Product',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/products',
        'title' => 'List Products',
      ],
    ],
  ],
  'Category' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Category',
    'class' => '',
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/category/create',
        'title' => 'Add Category',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/categories',
        'title' => 'List Categories',
      ],
    ],
  ],
  'Order' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Order',
    'class' => '',
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/order/create',
        'title' => 'Add Order',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/orders',
        'title' => 'List Orders',
      ],
    ],
  ],
];
