<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;

class MakeRoute extends Controller
{
    use FileFolderManage, GetStubContents;

    protected $model_data,$stub_path,$dir_name;
    public function __construct($model_data)
    {
        $this->model_data= $model_data;
        $this->stub_path =__DIR__.'/../../stubs/route.stub';
        $this->dir_name='routes';
        $this->make();
    }

    public function make(): void
    {
        $this->makeDirectory($this->dir_name);
        $model_data = json_decode($this->model_data);

        foreach ($model_data as $key => $model) {
            $routes = $model->routes;
            if (count($routes)>0){
                $current = file_get_contents($this->dir_name.'/web.php');
                $current .= 'Route::resource("'.$model->table_name.'",'.$model->model_name.'Controller::class);'."\n";
                file_put_contents($this->dir_name.'/web.php', $current);
            }


        }
    }

}
