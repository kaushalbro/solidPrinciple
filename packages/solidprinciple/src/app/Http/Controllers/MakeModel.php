<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Illuminate\Routing\Controller;

class MakeModel extends Controller
{
    use FileFolderManage;
    protected $model_data,$stub_path,$dir_name;
    public function __construct($model_data)
    {
        $this->model_data = $model_data;
        $this->stub_path =__DIR__.'/../../stubs/model.stub';
        $this->dir_name='Models';
        $this->make();
    }

    public function make(): void
    {
        $this->makeDirectory('app/'.$this->dir_name);
        $json_model_details= '[{
         "model_name": "product",
         "table_name": "products",
        "fillable": ["name", "description", "price", "stockQuantity", "categoryID"],
         "hidden": [],
         "casts": [],
         "with": [],
         "db_column_name": [
         "name:string:nullable",
          "description:string:notnull",
          "price:float:nullable",
          "stock_quantity:float:nullable",
           "category_id:unsignedInteger:nullable"]
         },
         {
          "model_name": "Category",
          "table_name": "Categories",
          "fillable":["name", "Description"],
          "hidden": [],
          "casts": [],
          "with": [],
         "db_column_name": [
          "name:string:nullable",
          "description:string:notnull"]
         }
          ]';
      $model_data  = json_decode($json_model_details);
      foreach ($model_data as $key => $model){
          $fillable = $this->removeDoubleQuote($model->fillable);
          $hidden = $this->removeDoubleQuote($model->hidden);
          $casts = $this->removeDoubleQuote($model->casts);
          $with = $this->removeDoubleQuote($model->with);
          $contents =$this->getStubContents($this->stub_path,[
            'namespace' => 'App\\'.$this->dir_name,
            'classname'=> $model->model_name,
            'fillable'=>$fillable,
            'hidden'=>$hidden,
            'casts'=>$casts,
            'with'=>$with
        ]);
        $this->makeFile('app/'.$this->dir_name.'/'.$model->model_name.'.php', $contents);
      }
      new MakeMigration($json_model_details);
    }

    public function getStubContents($stub_path,$stubVariables = [])
    {
        $contents = file_get_contents($stub_path);
        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('{{ '.$search.' }}' , $replace, $contents);
        }
        return $contents;
    }
    public function removeDoubleQuote($array){
        $fillableCount = count($array);
        $newFillable = '[';
        if ($fillableCount == 0){
            $newFillable.="]";
        }else{
            foreach ($array as $key_1=> $fillable){
                $fillable=strtolower($fillable);
                if ($key_1 == $fillableCount-1) {
                    $newFillable.="'".$fillable."']";
                }else{
                    $newFillable.="'".$fillable."',";
                }
            }
        }
        return $newFillable;
    }
}
