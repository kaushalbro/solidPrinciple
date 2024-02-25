<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;

class MakeModel extends Controller
{
    use FileFolderManage,GetStubContents;
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
        $json_model_details= '[{
         "model_name": "product",
         "table_name": "products",
         "fillable": ["name", "description", "price", "stock_quantity", "category_id"],
         "hidden": [],
         "casts": [],
         "with": [],
         "db_column_name": [
           "name|string|nullable|no-default",
           "description|string|notnull|no-default",
           "price|float|nullable|no-default",
           "status|enum|notnullable|active|active:inactive:activeInactive",
           "stock_quantity|float|nullable|no-default",
           "category_id|unsignedInteger|nullable|no-default"],
         "request_rules":[
              "name-required|string",
              "description-nullable|string",
              "price-required|numeric|min:|max:10",
               "stock_quantity-required|numeric|min:|max:10",
               "category_id-required|numeric"]
         },
         {
          "model_name": "Category",
          "table_name": "Categories",
          "fillable":["name", "Description"],
          "hidden": [],
          "casts": [],
          "with": [],
          "db_column_name": ["name|string|nullable|no-default","description|string|notnull|no-default"],
          "request_rules":["name-required|string","description-nullable|string"]
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
      new MakeModelRepo($json_model_details);
      new MakeController($json_model_details);
      new MakeRequest($json_model_details);
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
