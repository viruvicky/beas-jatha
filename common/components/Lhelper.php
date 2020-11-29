<?php
/**
 * User: varinder Kumar
 * Date: 02/08/2016
 * langauge Helper for whole site
 */

namespace common\components;
use \common\components\Yii;
use common\models\FormFieldType;
use common\models\Menu;
use common\models\FormFieldValues;
use common\models\FormFieldMultyValue;
use common\models\FeeStructures;
use common\models\ModuleFieldsAttributes;
use common\models\Settings;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use yii\db\Expression;
date_default_timezone_set('Asia/Kolkata');

class Lhelper
{

    public static function getDepartment()
    {
        $data = ArrayHelper::map(\common\models\Department::find()->where('is_active = 1')->orderBy('name ASC')->asArray()->all(), 'id', 'name');
        return $data;
    }
    public static function getStatus($id)
    {
        $data = ArrayHelper::map(\common\models\Status::find()->where('is_active = 1 AND position ='.$id)->asArray()->all(), 'id', 'name');
        return $data;
    }
    public static function getActiveJatha()
    {
       // $data = ArrayHelper::map(\common\models\Jatha::find()->where('status != 3')->asArray()->all(), 'id', 'Name');$data  = [];
        $users = \common\models\Jatha::find()->where('status != 3')->all();

        $data = ArrayHelper::map($users, 'id', function ($user) {
            return '('.$user->reg_no.') '.$user->centre ;
        });
        return $data;

    }
    public static function getTotalByDate($date){
        $jathas =   \common\models\Jatha::find()->where('status != 3 AND from_date="'.$date.'"')->all();
        $html = "<td>--</td>
                        <td>--</td>
                        <td>--</td>";
        if($jathas) {
              $male = 0; $female=0;
              foreach ($jathas as $jatha) {
                  $male += $jatha->male;
                  $female += $jatha->female;
              }
              $total = $male+$female;
              $html = "<td>".$male."</td>
                        <td>".$female."</td>
                        <td>".$total."</td>";
          }

      return $html;

    }

}