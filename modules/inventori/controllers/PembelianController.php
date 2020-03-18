<?php

namespace backend\modules\inventori\controllers;

use Yii;
use backend\modules\inventori\models\Pembelian;
use backend\modules\inventori\models\PembelianSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\inventori\models\DetailPembelian;
use backend\modules\inventori\models\Barang;
use backend\modules\inventori\models\Vendor;
use backend\modules\inventori\models\Model;
use yii\widgets\ActiveForm;

/**
 * PembelianController implements the CRUD actions for Pembelian model.
 */
class PembelianController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pembelian models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PembelianSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pembelian model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function getdetailPembelians($id)
    {
        $model = DetailPembelians::find()->where(['id' => $id])->all();
        return $model;
    }
    
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $detailPembelians = $model->detailPembelians;

        // $detailPembelians = DetailPembelian::find()->where(['detail_pembelian_id' => $id])->all();
        // if (!$detailPembelians) {
        //     throw new NotFoundHttpException('Kosong');
        // }

        return $this->render('view', [
            'model' => $model,
            'detailPembelians' => $detailPembelians,
        ]);
    }

    /**
     * Creates a new Pembelian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
    $modelPembelian = new Pembelian;
    $modelsDetailPembelian = [new DetailPembelian];

    if ($modelPembelian->load(Yii::$app->request->post())) {

        $modelsDetailPembelian = Model::createMultiple(DetailPembelian::classname());
        Model::loadMultiple($modelsDetailPembelian, Yii::$app->request->post());

        // validate all models
        $valid = $modelPembelian->validate();
        $valid = Model::validateMultiple($modelsDetailPembelian) && $valid;
  
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
        
            try {
                if ($flag = $modelPembelian->save(false)) {
                    foreach ($modelsDetailPembelian as $modelDetail) {
                        $modelDetail->pembelian_id = $modelPembelian->id;
                        if (! ($flag = $modelDetail->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $modelPembelian->id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
    }

    return $this->render('create', [
        'modelPembelian' => $modelPembelian,
        'modelsDetailPembelian' => (empty($modelsDetailPembelian)) ? [new DetailPembelian] : $modelsDetailPembelian
        ]);
    }

    /**
     * Updates an existing Pembelian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $modelPembelian = $this->findModel($id);
        $modelsDetailPembelian = $modelPembelian->detailPembelians;

        if ($modelPembelian->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsDetailPembelian, 'id', 'id');
            $modelsDetailPembelian = Model::createMultiple(DetailPembelian::classname(), $modelsDetailPembelian);
            Model::loadMultiple($modelsDetailPembelian, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsDetailPembelian, 'id', 'id')));

            // validate all models
            $valid = $modelPembelian->validate();
            $valid = Model::validateMultiple($modelsDetailPembelian) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPembelian->save(false)) {
                        if (!empty($deletedIDs)) {
                            DetailPembelian::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsDetailPembelian as $modelDetailPembelian) {
                            $modelDetailPembelian->pembelian_id = $modelPembelian->id;
                            if (! ($flag = $modelDetailPembelian->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPembelian->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelPembelian' => $modelPembelian,
            'modelsDetailPemebelian' => (empty($modelsDetailPembelian)) ? [new DetailPembelian] : $modelsDetailPembelian
        ]);
    }

    /**
     * Deletes an existing Pembelian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pembelian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pembelian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pembelian::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
