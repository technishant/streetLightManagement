<?php

use yii\helpers\Html;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluid">

    <div class="panel panel-primary">
        <div class="panel-body pd-0">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <th>Device ID</th>
                    <th>Device Data</th>
                    <th>Timestamp</th>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($model)) {
                            echo "<tr><td rowspan='3'>No Data Logged for this device<td></tr>";
                        } else {
                            foreach ($model as $row) {
                                echo "<tr>";
                                echo "<td>" . $row->device_id . "</td>";
                                echo "<td>" . $row->device_data . "</td>";
                                echo "<td>" . $row->created . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>