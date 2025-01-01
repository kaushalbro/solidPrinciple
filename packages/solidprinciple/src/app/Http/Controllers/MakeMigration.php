<?php
namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Support\Str;

class MakeMigration extends BaseController
{
    use FileFolderManage, GetStubContents;
    protected $model_data,$stub_path,$dir_name;
    public function __construct($model_data)
    {
            parent::__construct();
            $data =is_array($model_data)?$model_data[1]:file_get_contents($model_data);
            $this->model_data =$data;
            $this->stub_path =__DIR__.'/../../stubs/migration.stub';
            $this->dir_name=base_path('database/migrations');
            $this->make();
    }

    public function make(): void
    {
        $model_data  = json_decode($this->model_data);
        foreach ($model_data as $key => $model){
            $table_name = $model->table_name??strtolower(Str::plural($model->model_name));
            $table_column = $model->table_column_name;
            $foreign_column= $model->table_foreign_key??[];
            $column= "";
            foreach ($table_column as $key_1 => $value){
                $name_datatype= explode('|',$value);
                $column_name=strtolower($name_datatype[0]);
                $datatype=lcfirst($name_datatype[1]);
                $null =  $name_datatype[2]=='nullable'?'->nullable()':'';
                $default= $name_datatype[3]!='no-default'? "->default('".$name_datatype[3]."')":'';
                if ($datatype=='enum'){
                        $enum_value ="[";
                        foreach (explode(':',  end($name_datatype)) as $key_2 =>$enumval ){
                            $enum_value.="'".$enumval."',";
                        }
                        $col = '$table->'.$datatype.'("'.$column_name.'",'.$enum_value.'])'.$null.$default;
                } elseif ($datatype=='file'){
                    $col = '$table->string("'.$column_name.'")'.$null.$default;
                }
                else{
                    $col = '$table->'.$datatype.'("'.$column_name.'")'.$null.$default;
                }
                $column .= $col .';'."\n\t\t\t";
            }
            foreach ($foreign_column as $key_2 => $value){
                $first_hierarchy=explode('|',$value);
                $foreing_col= $first_hierarchy[0];
                $table_column_name=explode(':',$foreing_col)[0];
                $data_type=explode(':',$foreing_col)[1];
                $references=$first_hierarchy[1];
                $references_table=explode(':',$references)[0];
                $references_table_column=explode(':',$references)[1];
                $null_1=$first_hierarchy[2]=='nullable'?'->nullable()':'';
                $for_col= '$table->unsignedBigInteger("'.$table_column_name.'")'.$null_1;
                $column.=$for_col.';'."\n\t\t\t";
                $reference_key='$table->foreign("'.$table_column_name.'")->references("'.$references_table_column.'")->on("'.$references_table.'")';
                $column.=$reference_key.';'."\n\t\t\t";
            }

            $contents =$this->getStubContents($this->stub_path,[
                'classname'=> ucwords($table_name),
                'tablename'=> strtolower($table_name),
                'table_column_name'=>$column
            ]);
            $dateString = date("Y_m_d_His").'_';
            $migration_name = 'create_'.strtolower($table_name).'_table.php';
            if (!$this->migrationCreated($migration_name)){
                $this->makeFile($this->dir_name.'/'.$dateString.$migration_name, $contents);
            }else if (config('solid.show_folder_already_exists_warning')){
                error_log(sprintf("\033[33m%s\033[0m", $migration_name.' migration already created.'));
            }
        }
    }

    public function migrationCreated($migration_name): bool
    {
        $dir_path = $this->dir_name;
        $files = scandir($dir_path);
        foreach ($files as $file) {
            $file_name = substr($file,  18);
             if ($migration_name == $file_name){
                return true;
             }
        }
        return false;
    }
}
