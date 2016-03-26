<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyCcv_FsDJCo3UlJ1JMBPUMvgRUuo8JW_t8');
$this->registerJsFile(Yii::$app->request->BaseUrl.'/js/maps.js');
?>

<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div class="col-lg-12 col-md-6">
            <button class="pull-left" style="margin-bottom: 10px;" id="refresh-map">Refresh</button>
            <div class="clearfix"></div>
            <div id="map" style="width: auto; height: 550px;">
                <div style="margin: 15% 5% 40% 40%; font-size: 100px;">
                    <i class=" fa-spin fa fa-spinner"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>