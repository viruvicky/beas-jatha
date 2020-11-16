<?php
use common\components\Lhelper;
/* @var $this yii\web\View */

$this->title = 'Report';
date_default_timezone_set('Asia/Kolkata');
$hour =  date('H');
$today = date('Y-m-d');
if($hour > 12){
    $today = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $today) ) ));
}
echo $today;
?>
<?php if ($model){
    $male = $female= $isoMale = $isoFemale = $deraHosMale = $deraHosFemale = $beasHosMale = $beasHosFemale = 0;
    foreach ($model as $data){
        $male += $data->male;
        $female += $data->female;
        $pateints = \common\models\Patient::findAll(['jatha'=>$data->id]);
        if($pateints){
            foreach ($pateints as $pateint){
                if($pateint->status==4){
                    if($pateint->gender==1){$isoMale+=1;}
                    if($pateint->gender==2){$isoFemale+=1;}
                }
                if($pateint->status==5){
                    if($pateint->gender==1){$deraHosMale+=1;}
                    if($pateint->gender==2){$deraHosFemale+=1;}
                }if($pateint->status==6){
                    if($pateint->gender==1){$beasHosMale+=1;}
                    if($pateint->gender==2){$beasHosFemale+=1;}
                }
            }
        }
    }
    $male = $male-$deraHosMale-$beasHosMale;
    $female = $female-$deraHosFemale-$beasHosFemale;
    $total = $male+$female;


    $oldIsoMale=$oldIsoFemale = $deraHosMale = $deraHosFemale = $beasHosMale = $beasHosFemale = 0;
    $pateints = \common\models\Patient::find()->where('status !=7')->all();
    if($pateints){
        foreach ($pateints as $pateint){
            if($pateint->status==4){
                if($pateint->gender==1){$oldIsoMale+=1;}
                if($pateint->gender==2){$oldIsoFemale+=1;}
            }
            if($pateint->status==5){
                if($pateint->gender==1){$deraHosMale+=1;}
                if($pateint->gender==2){$deraHosFemale+=1;}
            }if($pateint->status==6){
                if($pateint->gender==1){$beasHosMale+=1;}
                if($pateint->gender==2){$beasHosFemale+=1;}
            }
        }
    }


    $totalDeraHos=$deraHosMale+$deraHosFemale;
    $totalBeasHos=$beasHosMale+$beasHosFemale;


}?>
<div class="col-md-4 table-responsive">
<table class="table table-bordered  table-striped">
    <tr><th colspan="4">GRAND TOTAL OF SEWADARS</th></tr>
    <tr>
        <th>&nbsp;</th>
        <th>M</th>
        <th>F</th>
        <th>Total</th>
    </tr>
    <tr>
        <th>&nbsp;</th>
        <td><?=$male; ?></td>
        <td><?=$female;?></td>
        <td><?=$total; ?></td>
    </tr>
    <tr>
        <th>DERA HOSPITAL</th>
        <td><?=$deraHosMale; ?></td>
        <td><?=$deraHosFemale;?></td>
        <td><?=$totalDeraHos; ?></td>
    </tr>
   <tr>
        <th>BEAS HOSPITAL</th>
        <td><?=$beasHosMale; ?></td>
        <td><?=$beasHosFemale;?></td>
        <td><?=$totalBeasHos; ?></td>
    </tr>
    <tr>
        <th>GRAND TOTAL</th>
        <th><?=$male+$deraHosMale+$beasHosMale; ?></th>
        <th><?=$female+$deraHosFemale+$beasHosFemale;?></th>
        <th><?=$total+$totalDeraHos+$totalBeasHos; ?></th>
    </tr>
    <tr><th colspan="4">SEWADARS IN QUARANTINE SHED NO. 8</th></tr>
    <tr>
        <?php $date= date('Y-m-d',(strtotime ( '-3 day' , strtotime ( $today) ) ));?>
        <th>FINAL </th>
        <?=Lhelper::getTotalByDate($date);?>
    </tr>
    <tr>
        <?php $date= date('Y-m-d',(strtotime ( '-2 day' , strtotime ( $today) ) ));?>
        <th><?=date('d-m-Y',strtotime($date))?> </th>
        <?=Lhelper::getTotalByDate($date);?>
    </tr>
    <tr>
        <?php $date= date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $today) ) ));?>
        <th><?=date('d-m-Y',strtotime($date))?>  </th>
        <?=Lhelper::getTotalByDate($date);?>
    </tr>
    <tr>
        <?php //$date= date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $today) ) ));?>
        <th><?=date('d-m-Y',strtotime($today))?>  </th>
        <?=Lhelper::getTotalByDate($date);?>
    </tr>


    <tr><th colspan="4">SHED ISOLATION BY DERA HOSPITAL IN SHED NO. 7</th></tr>
    <tr>
        <th>ISOLATION </th>
        <td><?=$isoMale; ?></td>
        <td><?=$isoFemale;?></td>
        <td><?=$isoMale+$isoFemale; ?></td>

    </tr> <tr>
        <th>OLD (JATHA) CASE </th>
        <td><?=$toim = ($oldIsoMale>0)?$oldIsoMale-$isoMale:0; ?></td>
        <td><?=$toif= ($oldIsoFemale>0)?$oldIsoFemale-$isoFemale:0; ?></td>
        <td><?=$toim+$toif;?></td>

    </tr> <tr>
        <?php
        $detainedMale=$detainedFemale = 0;
        $detained = \common\models\Jatha::find()->where('status = 2')->all();
        if($detained) {
            foreach ($detained as $detaine) {
                $detainedMale += $detaine->male;
                $detainedFemale += $detaine->female;
            }
        }
        ?>
        <th>JATHA DETAINED </th>
        <td><?=$detainedMale; ?></td>
        <td><?=$detainedFemale;?></td>
        <td><?=$detainedMale+$detainedFemale; ?></td>
    </tr>
</table>
</div>
