<?php
use yii\widgets\Pjax;
?>
<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function() {     
      $.pjax.reload({container:'#map'});
    }, 60000); 
});
JS;
$this->registerJs($script);
?>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCcv_FsDJCo3UlJ1JMBPUMvgRUuo8JW_t8');
$this->registerJsFile(Yii::$app->request->BaseUrl . '/js/maps.js');
?>
<input type="hidden" value="<?php echo  Yii::$app->request->BaseUrl.'/images/red-bulb.png'?>" id="red-bulb">
<input type="hidden" value="<?php echo  Yii::$app->request->BaseUrl.'/images/green-bulb.png'?>" id="green-bulb">
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <button class="pull-left btn btn-google" style="margin-bottom: 10px;" id="refresh-map" onclick="js: initialize();
                    ">Refresh</button>
            <div class="clearfix"></div>
            <?php Pjax::begin(); ?>
            <div id="map" style="width: auto; height: 450px;">
                <div style="margin: 15% 5% 40% 40%; font-size: 100px;">
                    <i class=" fa-spin fa fa-spinner"></i>
                </div>
            </div>
            <?php Pjax::end(); ?>
        </div>
    </div>
    <!-- /.row -->
</div>