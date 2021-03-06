<?php
/* @var $this VillageController */
/* @var $model Village */

$this->breadcrumbs=array(
	'Villages'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Village', 'url'=>array('index')),
	array('label'=>'Create Village', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#location-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Villages</h1>

<p>
Search, View and Update Villages.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'location-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'location_id',
		array(
		   'name'=>'governorate',
		   'value'=>'$data->locality->region->governorate->name',),	
		array(
		   'name'=>'region',
		   'value'=>'$data->locality->region->name',),	
		array(
		   'name'=>'locality',
		   'value'=>'$data->locality->name',),	
		'name',
		'p_code',
		'latitude',
		'longitude',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
