                      php artisan solid:make
                         'solid:make {model_name? : Optional model_name parameter}
                         {--config|config : Generate Package configuration }
                         {--crud|crud : Generate Plain CRUD files }
                         {--repo-crud|repo-crud : Generate CRUD files for Repository design pattern }
                         {--m|model : Generate model}
                         {--view|view : Generate model}
                         {--c|controller : Generate Controller }
                         {--i|interface : Generate interface}
                         {--re|repo  : Generate repository}
                         {--mi|migration  : Generate migration}
                         {--r|request : Generate custom request}
                         {--ro|route : Generate routes}
                         {--layout|layout  } layout_type? : Generate Layout}
                         {--newAdminPanel|new-admin-panel : Generate fresh Admin panel}
                         {--h|help}




# Sidebar Configuration Documentation

This documentation describes how to use the `SideBar::add()` method to create a custom sidebar configuration with multiple options, including sub-links, icons, visibility, permissions, and active routes.

## Sidebar Configuration Example

### Adding a Sidebar

The following example demonstrates how to add a "Product" on sidebar with its associated sub-links:

php
```
SideBar::add('Product', Product::class) //$model is optional
    ->icon('fa-brands fa-product-hunt')
    ->route('') //optional
    ->title('Product')
    ->group('Purchase') // group under the 'Purchase' category # default is core
    ->hide(true) 
    ->permission(true)
    ->activeOnRoutes('admin/products/mainSidebar')
    ->subLinks(
        SubLink::add('Add Product')
            ->icon('fa-solid fa-plus')
            ->route('/admin/products/create')
            ->hide(true)
            ->permission(true)
            ->activeOnRoutes('/products/other_route'),
        SubLink::add('List Products')
            ->icon('fa-solid fa-list')
            ->route('/admin/products')
            ->hide(true)
            ->permission(true)
            ->activeOnRoutes(['admin/products\other_list])
    );
```

### Breakdown of the Configuration

#### Adding Sidebar:

-   `SideBar::add('Product')`: This creates a new sidebar item titled "Product".

#### Sidebar Properties:

-   `->group('Purchase')`: Sets the sidebar item’s icon using Font Awesome. Here, it uses the "fa-product-hunt" icon.
-   `->icon('fa-brands fa-product-hunt')`: Sets the sidebar item’s icon using Font Awesome. Here, it uses the "fa-product-hunt" icon.
-   `->route('')`: Defines the route for the sidebar item. In this case, the route is left blank, which can be configured based on your needs.
-   `->title('Product')`: The title that appears on the sidebar. It is set as "Product".
-   `->hide(true)`: Specifies that the sidebar item is visible. Set to `true` to make it visible.
-   `->permission(true)`: Specifies that the sidebar item is available for users with permission. Set to `true` to allow access.
-   `->activeOnRoutes('admin/products/mainSidebar')`: Defines the route(s) where this sidebar item should be marked as active. In this case, it is active when the route matches `admin/products/mainSidebar`.

### Sub Links

The sidebar item can have multiple sub-links. These sub-links are defined using the `subLinks()` method.

#### Add Product Sub-Link:

php

```
SubLink::add('Add Product')
    ->icon('fa-solid fa-plus')
    ->route('/admin/products/route_create11')
    ->hide(true)
    ->permission(true)
    ->activeOnRoutes('/kaushala/products/active_on_create1')
```

-   `SubLink::add('Add Product')`: Creates a sub-link titled "Add Product".
-   `->icon('fa-solid fa-plus')`: Sets the icon for the sub-link. In this case, it's a plus icon.
-   `->route('/admin/products/route_create11')`: Specifies the route for this sub-link.
-   `->hide(true)`: Makes the sub-link visible.
-   `->permission(true)`: Grants permission for the sub-link.
-   `->activeOnRoutes('/kaushala/products/active_on_create1')`: Marks the sub-link as active for the specified route.

#### List Products Sub-Link:

php

```
SubLink::add('List Products')
    ->icon('fa-solid fa-list')
    ->route('/admin/products/route_create')
    ->hide(true)
    ->permission(true)
    ->activeOnRoutes(['hari/admin/products+a'])
```

-   `SubLink::add('List Products')`: Creates another sub-link titled "List Products".
-   `->icon('fa-solid fa-list')`: Sets the icon for the sub-link as a list icon.
-   `->route('/admin/products/route_create')`: Specifies the route for the "List Products" sub-link.
-   `->hide(true)`: Ensures the sub-link is visible.
-   `->permission(true)`: Grants permission for the sub-link.
-   `->activeOnRoutes(['hari/admin/products+a'])`: Marks the sub-link as active for the specified route(s).

## Method Details

### `SideBar::add($name)`

-   **Description**: Adds a new sidebar item.
-   **Parameters**:
    -   `$name`: The title of the sidebar item (e.g., 'Product').

### `->icon($icon)`

-   **Description**: Sets the icon for the sidebar item.
-   **Parameters**:
    -   `$icon`: The Font Awesome class for the icon (e.g., 'fa-brands fa-product-hunt').

### `->route($route)`

-   **Description**: Defines the route for the sidebar item.
-   **Parameters**:
    -   `$route`: The route URL for the sidebar item (can be a string or a route name).

### `->title($title)`

-   **Description**: Sets the title text that will be displayed for the sidebar item.
-   **Parameters**:
    -   `$title`: The title of the sidebar item (e.g., 'Product').

### `->hide($hide)`

-   **Description**: Controls the hide of the sidebar item.
-   **Parameters**:
    -   `$hide`: `true` to make the item visible, `false` to hide it.

### `->permission($permission)`

-   **Description**: Determines whether the sidebar item is accessible based on user permissions.
-   **Parameters**:
    -   `$permission`: `true` if the item is accessible, `false` if not.

### `->activeOnRoutes($routes)`

-   **Description**: Defines the routes where the sidebar item will be marked as active.
-   **Parameters**:
    -   `$routes`: A string or an array of route names or URLs.

### `subLinks($subLinks)`

-   **Description**: Adds sub-links to the sidebar item.
-   **Parameters**:
    -   `$subLinks`: An array of `SubLink` instances, each representing a sub-link.

## SubLink Configuration

### Example SubLink Method:

php

```
SubLink::add('Link Name')
    ->icon('fa-solid fa-icon')
    ->route('/link/route')
    ->hide(true)
    ->permission(true)
    ->activeOnRoutes('/route/active_on_link');
```

### SubLink Method Details:

-   `SubLink::add($name)`: Adds a sub-link with the specified name.
-   `->icon($icon)`: Sets the icon for the sub-link.
-   `->route($route)`: Defines the route for the sub-link.
-   `->hide($hide)`: Controls the visibility of the sub-link.
-   `->permission($permission)`: Specifies whether the sub-link is available based on permissions.
-   `->activeOnRoutes($routes)`: Marks the sub-link as active for the given route(s).

### Blade Code for Frontend here:

```
@foreach(app('sidebar') as $key_1 => $group)
    @if($key_1 != 'core')
         <!-- Group Header -->
        <li class="nav-header">{{ $key_1 }}</li>
        // Handle other logic here
    @endif

    @foreach(app('sidebar')[$key_1] as $key => $main_link)
        @if( $main_link['hide'] && $main_link['permission'])
            // Handle main link logic here

            @if(count($main_link['sub_links']) > 0)
                @foreach($main_link['sub_links'] as $key_sub_link => $sub_link)
                    @if($sub_link['hide'] && $sub_link['permission'])
                        // Handle sub-link logic here
                    @endif
                @endforeach
            @endif
        @endif
    @endforeach
@endforeach
```
### JS Code for frontend
```
const sidebar = app('sidebar'); // Assuming 'sidebar' is available in your app context

Object.keys(sidebar).forEach(key_1 => {
    if (key_1 !== 'core') {
            <!-- Group Header -->
        // Handle group logic here
    }

    sidebar[key_1].forEach(main_link => {
        if (main_link.hide && main_link.permission) {
            // Handle main link logic here

            if (main_link.sub_links && main_link.sub_links.length > 0) {
                main_link.sub_links.forEach(sub_link => {
                    if (sub_link.hide && sub_link.permission) {
                        // Handle sub-link logic here
                    }
                });
            }
        }
    });
});

```


```


This version includes more detailed descriptions and is structured for better readability. 
Let me know if you need any further enhancements!

```

### Future Implementation Grouping like this. coming soon...

```
 SideBar::group('setting',function(){
             SideBar::add('User Management')
                 ->icon('fa-solid fa-users')
                 ->subLinks(
                     SubLink::add('Users', User::class)
                         ->icon('fa-solid fa-user ')
                         ->route('/admin/users'),
                     SubLink::add('Roles', Role::class)
                         ->icon('fa-solid fa-user ')
                         ->route('/admin/roles')
                 );
             SideBar::add('User Management')
                 ->icon('fa-solid fa-users')
                 ->subLinks(
                     SubLink::add('Users', User::class)
                         ->icon('fa-solid fa-user ')
                         ->route('/admin/users'),
                     SubLink::add('Roles', Role::class)
                         ->icon('fa-solid fa-user ')
                         ->route('/admin/roles')
                 );
 });
```
