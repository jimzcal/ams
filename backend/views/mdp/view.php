<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Mdp;

/* @var $this yii\web\View */
/* @var $model backend\models\Mdp */

$this->title = 'MDP';
// $this->params['breadcrumbs'][] = ['label' => 'Mdps', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdp-view">

    <div class="right-top-button">
        <?=
            Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', ['delete', 'id' => 1], [
                    'class' => 'right-button-text',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
        ?>
    </div>

    <div style="background-color: #FFFFFF; min-width: 98%; width: 150%; margin-right: auto; margin-left: auto; padding: 10px; margin-top: 35px;">
        <table style="width: 99%; margin-right: auto; margin-left: auto; margin-top: 10px;">
            <tr>
                <td colspan="22" style="text-align: center; font-weight: bold; font-size: 16px;">
                    MONTHLY DISBURSEMENT PROGRAM
                </td>
            </tr>
            <tr style="height: 10PX;">
                <td colspan="22" style="text-align: center;">
                    For Fiscal Year <?= $fiscal_year ?>
                </td>
            </tr>
            <tr style="font-size: 11px;">
                <td style="width: 140px;">Department</td>
                <td style="width: 20px;">:</td>
                <td><u style="font-weight: bold;">DEPARTMENT OF AGRICULTURE</u></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 11px;">
                <td>Agency</td>
                <td>:</td>
                <td><u style="font-weight: bold;">OFFICE OF THE SECRETARY (OSEC)</u></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 11px;">
                <td>Operating Unit</td>
                <td>:</td>
                <td><u style="font-weight: bold;">ALL</u></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="font-size: 11px;">
                <td>Organizational Code</td>
                <td>:</td>
                <td><u style="font-weight: bold;">05 0001 00000</u></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered table-condensed" style="width: 100%">
            <tr style="font-size: 11px; font-weight: bold; text-align: center;">
                <td rowspan="3" style="width: 250px; vertical-align: middle;">Particulars</td>
                <td rowspan="3" style="width: 140px; vertical-align: middle;">UACS Code</td>
                <td rowspan="3" style="vertical-align: middle;">Total Program</td>
                <td rowspan="3" style="vertical-align: middle;">Tax Rem. Advice</td>
                <td rowspan="3" style="vertical-align: middle;">Net Program</td>
                <td colspan="17">Full Year Requirement</td>
            </tr>
            <tr style="font-size: 11px; font-weight: bold; text-align: center;">
                <td colspan="4">Quarter 1</td>
                <td colspan="4">Quarter 2</td>
                <td colspan="4">Quarter 3</td>
                <td colspan="4">Quarter 4</td>
                <td rowspan="2">Full Year Total</td>
            </tr>
            <tr style="font-size: 10px; font-weight: bold; text-align: center;">
                <td>Jan</td>
                <td>Feb</td>
                <td>Mar</td>
                <td>Total</td>
                <td>Apr</td>
                <td>May</td>
                <td>Jun</td>
                <td>Total</td>
                <td>July</td>
                <td>Aug</td>
                <td>Sep</td>
                <td>Total</td>
                <td>Oct</td>
                <td>Nov</td>
                <td>Dec</td>
                <td>Total</td>
            </tr>
            <tr style="font-size: 9px; text-align: center;">
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5=3-4</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                <td>22</td>
            </tr>
            <?php foreach ($model as $key => $value) : ?>
                <tr style="font-size: 10px;">
                    <td><?= $value->particulars ?></td>
                    <td><?= $value->uacs_code ?></td>
                    <td><?= $value->total_program ?></td>
                    <td><?= $value->tra ?></td>
                    <td><?= $value->net_program ?></td>
                    <td><?= $value->january ?></td>
                    <td><?= $value->february ?></td>
                    <td><?= $value->march ?></td>
                    <td style="text-align: right; font-weight: bold;"><?= $value->first_total ?></td>
                    <td><?= $value->april ?></td>
                    <td><?= $value->may ?></td>
                    <td><?= $value->june ?></td>
                    <td style="text-align: right; font-weight: bold;"><?= $value->second_total ?></td>
                    <td><?= $value->july ?></td>
                    <td><?= $value->august ?></td>
                    <td><?= $value->september ?></td>
                    <td style="text-align: right; font-weight: bold;"><?= $value->third_total ?></td>
                    <td><?= $value->october ?></td>
                    <td><?= $value->november ?></td>
                    <td><?= $value->december ?></td>
                    <td style="text-align: right; font-weight: bold;"><?= $value->forth_total ?></td>
                    <td style="text-align: right; font-weight: bold;"><?= $value->full_year_total ?></td>
                </tr>
                    <?php $child_val = Mdp::find()->where(['parent_uacs' => $value->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                        foreach ($child_val as $key => $child_value) :
                     ?>
                     <tr style="font-size: 10px;">
                        <td style="text-indent: 5px;"><?= $child_value->particulars ?></td>
                        <td><?= $child_value->uacs_code ?></td>
                        <td><?= $child_value->total_program ?></td>
                        <td><?= $child_value->tra ?></td>
                        <td><?= $child_value->net_program ?></td>
                        <td><?= $child_value->january ?></td>
                        <td><?= $child_value->february ?></td>
                        <td><?= $child_value->march ?></td>
                        <td style="text-align: right; font-weight: bold;"><?= $child_value->first_total ?></td>
                        <td><?= $child_value->april ?></td>
                        <td><?= $child_value->may ?></td>
                        <td><?= $child_value->june ?></td>
                        <td style="text-align: right; font-weight: bold;"><?= $child_value->second_total ?></td>
                        <td><?= $child_value->july ?></td>
                        <td><?= $child_value->august ?></td>
                        <td><?= $child_value->september ?></td>
                        <td style="text-align: right; font-weight: bold;"><?= $child_value->third_total ?></td>
                        <td><?= $child_value->october ?></td>
                        <td><?= $child_value->november ?></td>
                        <td><?= $child_value->december ?></td>
                        <td style="text-align: right; font-weight: bold;"><?= $child_value->forth_total ?></td>
                        <td style="text-align: right; font-weight: bold;"><?= $child_value->full_year_total ?></td>
                    </tr>
                        <?php $child_val2 = Mdp::find()->where(['parent_uacs' => $child_value->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                                foreach ($child_val2 as $key => $child_value2) :
                             ?>
                             <tr style="font-size: 10px;">
                                <td style="text-indent: 10px;"><?= $child_value2->particulars ?></td>
                                <td><?= $child_value2->uacs_code ?></td>
                                <td><?= $child_value2->total_program ?></td>
                                <td><?= $child_value2->tra ?></td>
                                <td><?= $child_value2->net_program ?></td>
                                <td><?= $child_value2->january ?></td>
                                <td><?= $child_value2->february ?></td>
                                <td><?= $child_value2->march ?></td>
                                <td style="text-align: right; font-weight: bold;"><?= $child_value2->first_total ?></td>
                                <td><?= $child_value2->april ?></td>
                                <td><?= $child_value2->may ?></td>
                                <td><?= $child_value2->june ?></td>
                                <td style="text-align: right; font-weight: bold;"><?= $child_value2->second_total ?></td>
                                <td><?= $child_value2->july ?></td>
                                <td><?= $child_value2->august ?></td>
                                <td><?= $child_value2->september ?></td>
                                <td style="text-align: right; font-weight: bold;"><?= $child_value2->third_total ?></td>
                                <td><?= $child_value2->october ?></td>
                                <td><?= $child_value2->november ?></td>
                                <td><?= $child_value2->december ?></td>
                                <td style="text-align: right; font-weight: bold;"><?= $child_value2->forth_total ?></td>
                                <td style="text-align: right; font-weight: bold;"><?= $child_value2->full_year_total ?></td>
                            </tr>
                                <?php $child_val3 = Mdp::find()->where(['parent_uacs' => $child_value2->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                                        foreach ($child_val3 as $key => $child_value3) :
                                     ?>
                                     <tr style="font-size: 10px;">
                                        <td style="text-indent: 20px;"><?= $child_value3->particulars ?></td>
                                        <td><?= $child_value3->uacs_code ?></td>
                                        <td><?= $child_value3->total_program ?></td>
                                        <td><?= $child_value3->tra ?></td>
                                        <td><?= $child_value3->net_program ?></td>
                                        <td><?= $child_value3->january ?></td>
                                        <td><?= $child_value3->february ?></td>
                                        <td><?= $child_value3->march ?></td>
                                        <td style="text-align: right; font-weight: bold;"><?= $child_value3->first_total ?></td>
                                        <td><?= $child_value3->april ?></td>
                                        <td><?= $child_value3->may ?></td>
                                        <td><?= $child_value3->june ?></td>
                                        <td style="text-align: right; font-weight: bold;"><?= $child_value3->second_total ?></td>
                                        <td><?= $child_value3->july ?></td>
                                        <td><?= $child_value3->august ?></td>
                                        <td><?= $child_value3->september ?></td>
                                        <td style="text-align: right; font-weight: bold;"><?= $child_value3->third_total ?></td>
                                        <td><?= $child_value3->october ?></td>
                                        <td><?= $child_value3->november ?></td>
                                        <td><?= $child_value3->december ?></td>
                                        <td style="text-align: right; font-weight: bold;"><?= $child_value3->forth_total ?></td>
                                        <td style="text-align: right; font-weight: bold;"><?= $child_value3->full_year_total ?></td>
                                    </tr>
                                        <?php $child_val4 = Mdp::find()->where(['parent_uacs' => $child_value3->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                                            foreach ($child_val4 as $key => $child_value4) :
                                         ?>
                                         <tr style="font-size: 10px;">
                                            <td style="text-indent: 25px;"><?= $child_value4->particulars ?></td>
                                            <td><?= $child_value4->uacs_code ?></td>
                                            <td><?= $child_value4->total_program ?></td>
                                            <td><?= $child_value4->tra ?></td>
                                            <td><?= $child_value4->net_program ?></td>
                                            <td><?= $child_value4->january ?></td>
                                            <td><?= $child_value4->february ?></td>
                                            <td><?= $child_value4->march ?></td>
                                            <td style="text-align: right; font-weight: bold;"><?= $child_value4->first_total ?></td>
                                            <td><?= $child_value4->april ?></td>
                                            <td><?= $child_value4->may ?></td>
                                            <td><?= $child_value4->june ?></td>
                                            <td style="text-align: right; font-weight: bold;"><?= $child_value4->second_total ?></td>
                                            <td><?= $child_value4->july ?></td>
                                            <td><?= $child_value4->august ?></td>
                                            <td><?= $child_value4->september ?></td>
                                            <td style="text-align: right; font-weight: bold;"><?= $child_value4->third_total ?></td>
                                            <td><?= $child_value4->october ?></td>
                                            <td><?= $child_value4->november ?></td>
                                            <td><?= $child_value4->december ?></td>
                                            <td style="text-align: right; font-weight: bold;"><?= $child_value4->forth_total ?></td>
                                            <td style="text-align: right; font-weight: bold;"><?= $child_value4->full_year_total ?></td>
                                        </tr>
                                            <?php $child_val5 = Mdp::find()->where(['parent_uacs' => $child_value4->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                                                foreach ($child_val5 as $key => $child_value5) :
                                             ?>
                                             <tr style="font-size: 10px;">
                                                <td style="text-indent: 30px;"><?= $child_value5->particulars ?></td>
                                                <td><?= $child_value5->uacs_code ?></td>
                                                <td><?= $child_value5->total_program ?></td>
                                                <td><?= $child_value5->tra ?></td>
                                                <td><?= $child_value5->net_program ?></td>
                                                <td><?= $child_value5->january ?></td>
                                                <td><?= $child_value5->february ?></td>
                                                <td><?= $child_value5->march ?></td>
                                                <td style="text-align: right; font-weight: bold;"><?= $child_value5->first_total ?></td>
                                                <td><?= $child_value5->april ?></td>
                                                <td><?= $child_value5->may ?></td>
                                                <td><?= $child_value5->june ?></td>
                                                <td style="text-align: right; font-weight: bold;"><?= $child_value5->second_total ?></td>
                                                <td><?= $child_value5->july ?></td>
                                                <td><?= $child_value5->august ?></td>
                                                <td><?= $child_value5->september ?></td>
                                                <td style="text-align: right; font-weight: bold;"><?= $child_value5->third_total ?></td>
                                                <td><?= $child_value5->october ?></td>
                                                <td><?= $child_value5->november ?></td>
                                                <td><?= $child_value5->december ?></td>
                                                <td style="text-align: right; font-weight: bold;"><?= $child_value5->forth_total ?></td>
                                                <td style="text-align: right; font-weight: bold;"><?= $child_value5->full_year_total ?></td>
                                            </tr>
                                                <?php $child_val6 = Mdp::find()->where(['parent_uacs' => $child_value5->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                                                    foreach ($child_val6 as $key => $child_value6) :
                                                 ?>
                                                 <tr style="font-size: 10px;">
                                                    <td style="text-indent: 35px;"><?= $child_value6->particulars ?></td>
                                                    <td><?= $child_value6->uacs_code ?></td>
                                                    <td><?= $child_value6->total_program ?></td>
                                                    <td><?= $child_value6->tra ?></td>
                                                    <td><?= $child_value6->net_program ?></td>
                                                    <td><?= $child_value6->january ?></td>
                                                    <td><?= $child_value6->february ?></td>
                                                    <td><?= $child_value6->march ?></td>
                                                    <td style="text-align: right; font-weight: bold;"><?= $child_value6->first_total ?></td>
                                                    <td><?= $child_value6->april ?></td>
                                                    <td><?= $child_value6->may ?></td>
                                                    <td><?= $child_value6->june ?></td>
                                                    <td style="text-align: right; font-weight: bold;"><?= $child_value6->second_total ?></td>
                                                    <td><?= $child_value6->july ?></td>
                                                    <td><?= $child_value6->august ?></td>
                                                    <td><?= $child_value6->september ?></td>
                                                    <td style="text-align: right; font-weight: bold;"><?= $child_value6->third_total ?></td>
                                                    <td><?= $child_value6->october ?></td>
                                                    <td><?= $child_value6->november ?></td>
                                                    <td><?= $child_value6->december ?></td>
                                                    <td style="text-align: right; font-weight: bold;"><?= $child_value6->forth_total ?></td>
                                                    <td style="text-align: right; font-weight: bold;"><?= $child_value6->full_year_total ?></td>
                                                </tr>
                                                    <?php $child_val7 = Mdp::find()->where(['parent_uacs' => $child_value6->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                                                        foreach ($child_val7 as $key => $child_value7) :
                                                     ?>
                                                     <tr style="font-size: 10px;">
                                                        <td style="text-indent: 40px;"><?= $child_value7->particulars ?></td>
                                                        <td><?= $child_value7->uacs_code ?></td>
                                                        <td><?= $child_value7->total_program ?></td>
                                                        <td><?= $child_value7->tra ?></td>
                                                        <td><?= $child_value7->net_program ?></td>
                                                        <td><?= $child_value7->january ?></td>
                                                        <td><?= $child_value7->february ?></td>
                                                        <td><?= $child_value7->march ?></td>
                                                        <td style="text-align: right; font-weight: bold;"><?= $child_value7->first_total ?></td>
                                                        <td><?= $child_value7->april ?></td>
                                                        <td><?= $child_value7->may ?></td>
                                                        <td><?= $child_value7->june ?></td>
                                                        <td style="text-align: right; font-weight: bold;"><?= $child_value7->second_total ?></td>
                                                        <td><?= $child_value7->july ?></td>
                                                        <td><?= $child_value7->august ?></td>
                                                        <td><?= $child_value7->september ?></td>
                                                        <td style="text-align: right; font-weight: bold;"><?= $child_value7->third_total ?></td>
                                                        <td><?= $child_value7->october ?></td>
                                                        <td><?= $child_value7->november ?></td>
                                                        <td><?= $child_value7->december ?></td>
                                                        <td style="text-align: right; font-weight: bold;"><?= $child_value7->forth_total ?></td>
                                                        <td style="text-align: right; font-weight: bold;"><?= $child_value7->full_year_total ?></td>
                                                    </tr>
                                                        <?php $child_val8 = Mdp::find()->where(['parent_uacs' => $child_value7->uacs_code, 'fiscal_year' => $value->fiscal_year, 'version' => $value->version])->all();

                                                            foreach ($child_val8 as $key => $child_value8) :
                                                         ?>
                                                         <tr style="font-size: 10px;">
                                                            <td style="text-indent: 45px;"><?= $child_value8->particulars ?></td>
                                                            <td><?= $child_value8->uacs_code ?></td>
                                                            <td><?= $child_value8->total_program ?></td>
                                                            <td><?= $child_value8->tra ?></td>
                                                            <td><?= $child_value8->net_program ?></td>
                                                            <td><?= $child_value8->january ?></td>
                                                            <td><?= $child_value8->february ?></td>
                                                            <td><?= $child_value8->march ?></td>
                                                            <td style="text-align: right; font-weight: bold;"><?= $child_value8->first_total ?></td>
                                                            <td><?= $child_value8->april ?></td>
                                                            <td><?= $child_value8->may ?></td>
                                                            <td><?= $child_value8->june ?></td>
                                                            <td style="text-align: right; font-weight: bold;"><?= $child_value8->second_total ?></td>
                                                            <td><?= $child_value8->july ?></td>
                                                            <td><?= $child_value8->august ?></td>
                                                            <td><?= $child_value8->september ?></td>
                                                            <td style="text-align: right; font-weight: bold;"><?= $child_value8->third_total ?></td>
                                                            <td><?= $child_value8->october ?></td>
                                                            <td><?= $child_value8->november ?></td>
                                                            <td><?= $child_value8->december ?></td>
                                                            <td style="text-align: right; font-weight: bold;"><?= $child_value8->forth_total ?></td>
                                                            <td style="text-align: right; font-weight: bold;"><?= $child_value8->full_year_total ?></td>
                                                        </tr>
                                                         <?php endforeach ?>
                                                     <?php endforeach ?>
                                                 <?php endforeach ?>
                                             <?php endforeach ?>
                                         <?php endforeach ?>
                                     <?php endforeach ?>
                             <?php endforeach ?>
                     <?php endforeach ?>
            <?php endforeach ?>
        </table>
    </div>
</div>
