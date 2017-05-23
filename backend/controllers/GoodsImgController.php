<?php

namespace backend\controllers;

use backend\models\UploadForm;
use Yii;
use backend\models\GoodsImg;
use backend\models\GoodsImgSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\base\UserException;

/**
 * GoodsImgController implements the CRUD actions for GoodsImg model.
 */
class GoodsImgController extends Controller
{
    /**
     * @inheritdoc
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

    public function actionAsyncUpload()
    {
        $uploadForm = new UploadForm();
        $GoodsImg = new GoodsImg();

        if(Yii::$app->request->isPost){
            $GoodsImg->imageFile = UploadedFile::getInstance($GoodsImg, 'url');
            if($imageUrl = $GoodsImg->upload()){
                echo Json::encode([
                    'imageUrl'    => $imageUrl,
                    'error'   => ''     //上传的error字段，如果没有错误就返回空字符串，否则返回错误信息，客户端会自动判定该字段来认定是否有错
                ]);
            }else{
                echo Json::encode([
                    'imageUrl'    => '',
                    'error'   => '文件上传失败'
                ]);
            }
        }
    }

    /**
     * Lists all GoodsImg models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsImgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GoodsImg model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GoodsImg model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GoodsImg();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $model->imageFile = UploadedFile::getInstance($model, 'url');
            if($imageUrl = $model->upload()){
                $data['GoodsImg']['url'] = $imageUrl;
                if ($model->load($data) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                throw new UserException('上传失败');
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing GoodsImg model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $model->imageFile = UploadedFile::getInstance($model, 'url');
            if ($imageUrl = $model->upload()) {
                $data['GoodsImg']['url'] = $imageUrl;
                unlink($imageUrl);
                if ($model->load($data) && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                throw new UserException('上传失败');
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GoodsImg model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $img_url = Yii::getAlias('@uploadPath').str_replace(Yii::$app->params['assetDomain'],'',$model->url);
        unlink($img_url);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GoodsImg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GoodsImg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GoodsImg::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
