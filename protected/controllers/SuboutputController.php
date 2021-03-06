<?php

class SuboutputController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update','admin','delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function generateJSON($model, $isnew) {
        $satuan_target = $model->output->satuan_target;

        $array = $model->attributes;
        $array['isnew'] = $isnew;
        $array['uraian'] = CHtml::link($model->detail->uraian, array('#'), array(
                    'data-toggle' => 'modal',
                    'data-target' => '#SuboutputDialog',
                    'onclick' => "window.data_id = {$model->id}; window.data_table = 'Suboutput';",
                    'class' => 'link'
        ));
        $array['satuan_target'] = $satuan_target;
        $array['jumlah'] = Format::currency($model->pagu);

        echo CJSON::encode($array);
        Yii::app()->end();
    }
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Suboutput;

        $model->dipa_uid = @$_GET['dpid'];
        $model->dipa_version = @$_GET['dpv'];
        $model->output_uid = @$_GET['oid'];

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Suboutput'])) {
            $model->attributes = $_POST['Suboutput'];
            $model->kode = Format::kode($_POST['Suboutput']['kode']);
            $model->kode_uid = Format::kode_uid($_POST['Suboutput']['kode']);

            if ($model->save()) {
                $this->generateJSON($model, 1);
            }
        }

        $satuan_target = Output::model()->find(array(
                    'condition' => 'uid = ' . $model->output_uid . ' and dipa_uid = ' . $model->dipa_uid . ' and dipa_version  =' . $model->dipa_version
                ))->satuan_target;

        $this->renderPartial('create', array(
            'model' => $model,
            'satuan_target' => $satuan_target
                ), false, true);
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Suboutput'])) {
            $model->attributes = $_POST['Suboutput'];
            $model->kode = Format::kode($_POST['Suboutput']['kode']);
            $model->kode_uid = Format::kode_uid($_POST['Suboutput']['kode']);

            if ($model->save()) {
                $this->generateJSON($model, 0);
            }
        }

        $this->renderPartial('update', array(
            'model' => $model,
            'satuan_target' => $model->output->satuan_target
                ), false, true);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            Yii::app()->end();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Suboutput');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Suboutput('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Suboutput']))
            $model->attributes = $_GET['Suboutput'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Suboutput::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'suboutput-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
