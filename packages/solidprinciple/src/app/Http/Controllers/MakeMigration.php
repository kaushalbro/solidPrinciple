<?php


namespace Devil\Solidprinciple\app\Http\Controllers;

use Devil\Solidprinciple\app\Traits\FileFolderManage;
use Devil\Solidprinciple\app\Traits\GetStubContents;
use Illuminate\Routing\Controller;

class MakeMigration extends Controller
{
    use FileFolderManage, GetStubContents;
    protected $model_data,$stub_path,$dir_name;
    public function __construct($model_data)
    {
        $this->model_data = $model_data;
        $this->stub_path =__DIR__.'/../../stubs/migration.stub';
        $this->dir_name=base_path('database/migrations');
        $this->make();
    }

    public function make(): void
    {
//        $this->makeDirectory($this->dir_name);
        $model_data  = json_decode($this->model_data);
        foreach ($model_data as $key => $model){
            $table_name = $model->table_name;
            $table_column = $model->db_column_name;
            $column= "";
            foreach ($table_column as $key_1 => $value){
                $name_datatype= explode('|',$value);
                $column_name=strtolower($name_datatype[0]);
                $datatype=lcfirst($name_datatype[1]);
                $null =  $name_datatype[2]=='nullable'?'->nullable()':'';
                $default= $name_datatype[3]!='no-default'? "->default('".$name_datatype[3]."')":'';
                if ($datatype=='enum'){
                    if (!isset($name_datatype[4])) {
                        error_log(sprintf("\033[31m%s\033[0m",'Enum values is required'));
                    }else{
                        $enum_value ="[";
                        foreach (explode(':',  $name_datatype[4]) as $key_2 =>$enumval ){
                            $enum_value.="'".$enumval."',";
                        }
                        $col = '$table->'.$datatype.'("'.$column_name.'",'.$enum_value.'])'.$null.$default;
                    }
                }else{
                    $col = '$table->'.$datatype.'("'.$column_name.'")'.$null.$default;
                }
                $column .= $col .';'."\n\t\t\t";
            }
            $contents =$this->getStubContents($this->stub_path,[
                'classname'=> ucwords($table_name),
                'tablename'=> strtolower($table_name),
                'db_column_name'=>$column
            ]);
            $dateString = date("Y_m_d_His").'_';
            $migration_name = 'create_'.strtolower($table_name).'_table.php';
            if (!$this->migrationCreated($migration_name)){
                $this->makeFile($this->dir_name.'/'.$dateString.$migration_name, $contents);
            }else{
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
