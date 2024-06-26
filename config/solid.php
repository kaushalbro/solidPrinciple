<?php

return [
////////////////////////////////////////////////////////////////////////////
//                                                                        //
//                   WARNING :  DEVIL/SOLID - PACKAGE                     //
//            DO NO ALTER DEFAULT CONFIGURATION UNLESS REQUIRED           //
//                   ALTERING HERE MAY CAUSE MALFUNCTION                  //
//                                                                        //
////////////////////////////////////////////////////////////////////////////
                                //NOTE:NOTE
////////////////////////////////////////////////////////////////////////////
//                                                                        //
//         All Directory Name pattern should match the pattern bellow     //
//                                                                        //
////////////////////////////////////////////////////////////////////////////

        'is_repository_design_pattern'=>false,

        'api_key' => "DEVIL SOLID API KEY HERE(NULL DEFAULT)",

        'frontend_design'=>"BLADE",  // OR "REACT" OR "BLADE"

        'raw_json_data_path' => base_path("data.json"),  // root path/base_path

        'model_path' => "app/Models",

        'controller_path' => "app/Http/Controllers",

        'request_path'=>"app/Http/Requests",

        'view_path' =>"resources/views",

        'migration_path'=>"database/migrations",

        'backend_admin_view_path' => "resources/views/backend/admin",

        'frontend_view_path' => "resources/views/frontend",

        // Configuration for Repository pattern
        'interface_path' => "app/Interfaces",

        'repo_path' => "app/Repositories",

        'base_interface_name' => "SolidInterface",
        'base_repository_name' => "SolidBaseRepository",


        // Other Configuration
         'show_file_already_exists_warning' => true,
         'show_folder_already_exists_warning' => true,
        // Override created file : this my delete content of previous file
         'override_previous_file_data' => false,
      ];
