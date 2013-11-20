<?php
/* @var $this PcaReportController */
/* @var $model PcaReport */

$this->breadcrumbs=array(
	'PCA Reports'=>array('index'),
	$model->pca_report_id,
);

$this->menu=array(
	//array('label'=>'List PCA Reports', 'url'=>array('index')),
	array('label'=>'Create PCA Report', 'url'=>array('create')),
	//array('label'=>'Update PCA Report', 'url'=>array('update', 'id'=>$model->pca_report_id)),
	array('label'=>'Delete PCA Report', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pca_report_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PCA Reports', 'url'=>array('admin')),
);
?>

<h4><?php echo CHtml::link($model->pca->title, array('/pca/view', 'id'=>$model->pca->pca_id)); ?> Report <?php echo $model->title; ?> </h4>


<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered condensed',
	'data'=>$model,
	'attributes'=>array(
		//'pca_report_id',
		//'pca_id',
		'start_period',
		'end_period',
		'received_date',
	),
)); 
?>
<h4>PCA Report Details:</h4>
<table class='detail-view table table-striped table-bordered table-condensed'>
<tr>
<td>Indicator</td><td>Total Beneficiaries</td><td>Type</td>
</tr>
<?php 

$strings = array();
$current_string = 0;

for ($i=0; $i < count($model->TargetProgressPcaReportRel); $i++) { 


	if ($model->TargetProgressPcaReportRel[$i]['target_id'] != $current_string){

		$current_string = $model->TargetProgressPcaReportRel[$i]['target_id'];
		$strings[$model->TargetProgressPcaReportRel[$i]['target_id']] = 1;
		

	} else {

		$current_string = $model->TargetProgressPcaReportRel[$i]['target_id'];
		$strings[$model->TargetProgressPcaReportRel[$i]['target_id']]++;		 
	}
    
}

$current_target = 0;
foreach ($model->TargetProgressPcaReportRel as $key => $value) {

	if ($value['target_id'] != $current_target){

		if (array_key_exists($value['target_id'], $strings) == 1){

		echo "<tr>";
    	echo "<td rowspan=".$strings[$value['target_id']]." width='50%'>".CHtml::link($value->target->tpTarget->name, array('/target/view', 'id'=>$value['target_id']))."</td>";
    	echo "<td>".$value['total']."</td>";
    	echo "<td>".$value->unit->tpUnit->type."</td>";		

		} 
	}
	else
	{
		echo "<td>".$value['total']."</td>";
    	echo "<td>".$value->unit->tpUnit->type."</td>";		
	}
	echo "</tr>";
	$current_target = $value['target_id'];
}

?>
</table>