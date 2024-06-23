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
  'Category' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Category',
    'class' => '',
    'visibility' => true,
    'permission' => true,
    'active' => false,
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/categories/create',
        'title' => 'Add Category',
        'visibility' => true,
        'permission' => true,
        'active' => '$current_route == "/admin/categories/create"',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/categories',
        'title' => 'List Categories',
        'visibility' => true,
        'permission' => true,
        'active' => false,
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
    'permission' => true,
    'active' => false,
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/orders/create',
        'title' => 'Add Order',
        'visibility' => true,
        'permission' => true,
        'active' => '$current_route == "/admin/orders/create"',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/orders',
        'title' => 'List Orders',
        'visibility' => true,
        'permission' => true,
        'active' => false,
      ],
    ],
  ],
  'Payment' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Payment',
    'class' => '',
    'visibility' => true,
    'permission' => true,
    'active' => false,
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/orders/create',
        'title' => 'Add Payment',
        'visibility' => true,
        'permission' => true,
        'active' => '$current_route == "/admin/orders/create"',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/orders',
        'title' => 'List Orders',
        'visibility' => true,
        'permission' => true,
        'active' => false,
      ],
    ],
  ],
  'Kaushalgg' => 
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Kaushalgg',
    'class' => '',
    'visibility' => true,
    'permission' => true,
    'active' => false,
    'sub_link' => 
    [
      'create' => 
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '/admin/orders/create',
        'title' => 'Add Kaushalgg',
        'visibility' => true,
        'permission' => true,
        'active' => '$current_route == "/admin/orders/create"',
      ],
      'index' => 
      [
        'icon' => 'fa-solid fa-list',
        'route' => '/admin/orders',
        'title' => 'List Orders',
        'visibility' => true,
        'permission' => true,
        'active' => false,
      ],
    ],
  ],
  
  'Hari' =>
  [
    'icon' => 'fa-brands fa-product-hunt',
    'route' => '',
    'title' => 'Hari',
    'class' => '',
    'visibility' => true,
    'permission' => true,
    'active' => true,
    'sub_link' =>
    [
      'create' =>
      [
        'icon' => 'fa-solid fa-plus',
        'route' => '',
        'title' => 'Add Hari',
        'visibility' => true,
        'permission' => true,
        'active' => '',
      ],
      'index' =>
      [
         'icon' => 'fa-solid fa-list',
         'route' => '',
         'title' => 'List Haris',
         'visibility' => true,
         'permission' => true,
         'active' => true,
      ],
  ],
],'[solid_auto_generated_sidebar]' => NULL,
];
