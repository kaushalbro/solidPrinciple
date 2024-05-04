<?php

return [
////////////////////////////////////////////////////////////////////////////
//                                                                        //
//                   WARNING :  DEVIL/SOLID - PACKAGE                     //
//            DO NO ALTER DEFAULT CONFIGURATION UNLESS REQUIRED           //
//                   ALTERING HERE MAY CAUSE MALFUNCTION                  //
//                                                                        //
////////////////////////////////////////////////////////////////////////////
        'api_key' => "DEVIL SOLID API KEY HERE(NULL DEFAULT)",

        'raw_json_data_path' => base_path("data.json"),  // root path/base_path

        'model_path' => "app/Models",

        'controller_path' => "app/Http/Controllers",

        'request_path'=>"app/Http/Requests",

        'view_path' =>"resources/views",

        'migration_path'=>"database/migrations",

        'backend_view_path'=>"resources/views/backend",

        'backend_admin_view_path' => "resources/views/backend/admin",

        'frontend_view_path' => "resources/views/frontend",

        // Configuration for Repo pattern
        'interface_path' => "app/Interfaces",

        'repo_path' => "app/Repositories",

        // Other Configuration

         'show_file_already_exists_warning' => true,
         'show_folder_already_exists_warning' => true,
      ];
