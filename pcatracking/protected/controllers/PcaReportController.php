<?php

class PcaReportController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','returnBeneficiaries'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>$this->getAccessLevels('pcaReport_create'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>$this->getAccessLevels('pcaReport_update'),
			),
			array('allow', // allow admin user to perform 'admin' actions
				'actions'=>array('admin'),
				'users'=>$this->getAccessLevels('pcaReport_admin'),
			),
			array('allow', // allow admin user to perform 'delete' actions
				'actions'=>array('delete'),
				'users'=>$this->getAccessLevels('pcaReport_delete'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new PcaReport;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcaReport']))
		{
			$model->attributes=$_POST['PcaReport'];
			
				
							//post pca target beneficiaries	
							//$relations = $this->manageRelations($_POST['Pca']['PcaTargetProgressRel'], 1);
				$this->transpose( $_POST['PcaReport']['TargetProgressPcaReportRel'], $out); // unset null totals
				$model->TargetProgressPcaReportRel = $out;
			//	print_r($model->TargetProgressPcaReportRel );
				$relatedTables[] = 'TargetProgressPcaReportRel';
					

				if($model->saveWithRelated($relatedTables))
				{
					$this->transpose($_POST['PcaReport']['TargetProgressPcaReportRel'], $out);

					$this->updatePcaTargetProgress(PcaTargetProgress, $out, $model->pca_id);		
					$this->redirect(array('view','id'=>$model->pca_report_id));

				}
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PcaReport']))
		{
			$model->attributes=$_POST['PcaReport'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pca_report_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $update_pca_progress = array();
        foreach((array)$model->TargetProgressPcaReportRel as $key => $value)
        {
            $update_pca_progress[$key]['total'] = - $value['total'] ;
            $update_pca_progress[$key]['target_id'] = $value['target_id'] ;
            $update_pca_progress[$key]['unit_id'] = $value['unit_id'] ;
           //$update_pca_progress[$key] = $value;

        }

        if (!empty($update_pca_progress))
            $this->updatePcaTargetProgress(PcaTargetProgress, $update_pca_progress, $model->pca_id);

		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PcaReport');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PcaReport('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PcaReport']))
			$model->attributes=$_GET['PcaReport'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PcaReport the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PcaReport::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionReturnBeneficiaries()
	{
		
		$pca_id = $_POST['pca_id'];
		//$targets = array();
	//	echo $pca_id;
		$pca_report_progress = PcaTargetProgress::model()->findAll(array('order'=>'target_id', 'condition'=>'pca_id='.$pca_id));
	//	print_r($pca_report_progress);
		foreach ($pca_report_progress as $key => $value) {
			//$value['target_name'] = Target::model()->find(array( 'select'=>'name', 'condition'=>'target_id='.$value['target_id']));
			//echo $value['target_name'];
		//	$value['unit_name'] = 
			
			$targets[$key]['target_id'] = $value['target_id'];
			$targets[$key]['unit_id'] = $value['unit_id'];
			$targets[$key]['total'] = $value['total'];
			$targets[$key]['shortfall'] = $value['shortfall'];
			$targets[$key]['current'] = $value['current'];
			$targets[$key]['target_name'] = $value->tpTarget->tpTarget->name;
			$targets[$key]['unit_name'] = $value->tpTarget->tpUnit->type;

		}
		echo CJSON::encode($targets);
		# code...
	}

	/**
	 * Performs the AJAX validation.
	 * @param PcaReport $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pca-report-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


}
