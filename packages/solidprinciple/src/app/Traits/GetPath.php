<?php
namespace Devil\Solidprinciple\app\Traits;
trait GetPath
{
    /**
     * Get path from base path
     * @param string $path_to Path to.
     * @return
     * 'controller'=>app/Http/Controllers,
     * 'model'=>app/Models,
     * 'request'=>app/Http/Requests,
     *  'view'=>resources/views,
     * 'admin_view'=>resources/views/admin,
     *  'view_backend'=>resources/views/backend/admin/backend,
     * 'view_admin_common'=>resources/views/backend/admin/backend/common,
     * .
     */
   public function path(string $path_to): string
   {
       switch ($path_to) {
           case 'controller':
               $path = 'app/Http/Controllers';
               break;
           case 'model':
               $path = 'app/Models';
               break;
           case 'request':
               $path = 'app/Http/Requests';
               break;
           case 'view':
               $path = 'resources/views';
               break;
           case 'view_admin':
               $path = 'resources/views/backend/admin';
               break;
           case 'view_backend':
               $path = 'resources/views/backend/admin/backend';
               break;
           case 'view_admin_common':
               $path = 'resources/views/backend/admin/backend/common';
               break;
           default:
               $path = '';
               break;
       }
       return $path;
   }
   public function stub(){
       return __DIR__.'/../stubs/';
   }
    public function admin_stub(){
        return __DIR__.'/../stubs/admin_view';
    }
}
