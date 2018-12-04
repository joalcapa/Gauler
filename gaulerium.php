#!/usr/bin/php
<?php

$command = $argv[1];
$attribute = $argv[2];


$typesCommand = explode("-", $command);
switch($typesCommand[0]) {
    case 'create':

        switch($typesCommand[1]) {
            case 'model':

                $attributesModel = '';
                if(!empty($argv[3])) {
                    if($argv[3] == "attributes") {
                        if(!empty($argv[4])) {
                            $tokenAttributes = explode(",", $argv[4]);
                            foreach ($tokenAttributes as $ta) {
                                $attributesModel .= "\t\t'".$ta."',\n";
                            }
                        }
                    }
                }

                $data = "<?php
                
namespace Gauler\\Api\\Models;

use Joalcapa\\Fundamentary\\App\\Models\\BaseModel as Model;
                
class ". ucwords($attribute) ."sModel extends Model {
                
    public static \$model = '". ucwords($attribute) ."s';
                
    protected \$tuples = [
".$attributesModel."    ]; 
                
    protected \$hidden_tuples = [
    ];
                
}";



                $DescriptorFichero = fopen("api\\models\\".ucwords($attribute)."sModel.php","w");
                fputs($DescriptorFichero,$data);
                fclose($DescriptorFichero);

                echo 'successfully created model whit the name: ' . ucwords($attribute) .'sModel.php' . PHP_EOL;
                echo 'ubicacion: api\\models\\' . ucwords($attribute) .'sModel.php';


                break;
            default:
                return;
        }

        break;
    default:
        return;
}

?>
