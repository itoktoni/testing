<?php

namespace app\controllers;

use Yii;
use app\models\Customer;
use app\models\CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cache = Yii::$app->cache;


        // $searchModel = new CustomerSearch();
        // // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // // $searchModel = false;
        // // $dataProvider = false;
        // $cache = Yii::$app->cache;

        // // $key = !empty($_GET['page'])?$_GET['page']:1; // Ini untuk key dari cache kita
     
        // // $searchModel = $cacing->get('customer-searchModel-'.$key); // buat mbedain aja
        // // if ($searchModel === false) {
        // //     $cacing->set('customer-searchModel-'.$key, new CustomerSearch(), 300); // di cache 300 detik
        // //     $searchModel = Yii::$app->cache->get($key.'model');
        // // }      
         
        // // $dataProvider = $cacing->get('customer-dataProvider-'.$key);
        // // if ($dataProvider === false) {
        // //     $cacing->set($key, $searchModel->search(Yii::$app->request->queryParams), 300);
        // //     $dataProvider = $cacing->get('customer-dataProvider-'.$key);
        // // } 

        // $key = !empty($_GET['page'])?$_GET['page']:1;
        
        // $key_search = 'search-'.$key; 
        // $search = $cache->get($key_search);
        // if ($search === false) {
            
        //     $cache->set($key_search, new CustomerSearch(), 300); // di cache 300 detik
        //     $searchModel = Yii::$app->cache->get($key_search);
        // }

        // $key_provider = 'provider-'.$key;
        // $provider = $cache->get($key_provider);
        // if ($provider === false) {
            
        //     $cache->set($key_provider, $searchModel->search(Yii::$app->request->queryParams), 300);
        //     $provider = $cache->get($key_provider);
        // }

        // // $data = $cache->get($key);
        // // // d($data);
        // // if ($data === false) {

        // //     $query = Customer::find();
        // //     $provider.$key = new ActiveDataProvider([
        // //         'query' => $query,
        // //         'pagination' => [
        // //             'pageSize' => 10,
        // //         ],
        // //     ]); 
        // //     $cache->set($key, $provider.$key);
        // // }
        // // else{


        // // }
        
        // // // $get = $cache->get($key);
        // // // d($get->getModels());

       

        // // d($provider->getModels());

        $query = Customer::find();
        if($cache->get('data') === false){
            $provider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $cache->get($key),
                '$key' => $key,
            ]);
    }

    /**
     * Displays a single Customer model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_customer]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_customer]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
