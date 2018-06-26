<?php

namespace app\controllers;

use Yii;
use app\Models\EntryForm;
use app\models\Test;
use yii\data\Pagination;
use app\models\Customer;
use yii\widgets\ActiveForm;
use yii\web\Response;

class TestController extends GlobalController
{
    
    public function behaviors() {
       return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['insert'],
                'rules' => [[
                    'allow' => true,
                    'roles' => ['@']
                ]]
            ],
       ];
    }
    public function actionInsert(){
        
        
        $model = new Test();
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

         if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['test/view', 'id' => $model->id]);
        }

        return $this->render('insert', [
            'model' => $model,
        ]);
    }
    
    public function actionPost(){
        
        $model = new Test();
        

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model
           
            
        } else {
            // either the page is initially displayed or there is some validation error
           dd($model->getErrors());
        }
    }
    
    public function actionView($id){
        $data = Customer::findOne($id);
        return $this->render('view', ['data' => $data]);
    }

    public function actionIndex()
    {
//        $data = Customer::find();
//         $pagination = new Pagination([
//            'defaultPageSize' => 5,
//            'totalCount' => $data->count(),
//        ]);
//
//        $customer = $data
//            ->offset($pagination->offset)
//            ->limit($pagination->limit)
//            ->all();
//            
        // $this->dd($customer);    
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Customer::find(),
            'pagination' => ['pageSize' => 10]
        ]);
        
        return $this->render('index', ['data' => $dataProvider]);
    }

    public function actionData($data = 'data'){
        
        $model = new Entryform();

        if ($this->request()->post()) {

        if ($model->validate()) {
            // Valid!
        } else {
            // Tidak Valid!
            // Panggil $model->getErrors()
            $this->dd($model->getErrors());
        }

            // $this->dd($this->request()->post('EntryForm'));
            // return $this->request()->post('name');
            // $this->dd($model);
            return $this->render('data', ['model' => $this->request()->post('EntryForm')]);

        }
        return $this->render('index', ['model' => $model]);
    }

    public function actionTest(){
        $data = [
            'name' => 'itok',
            'email' => 'itok.toni@gmail.com',

        ];
        return $this->render('data', ['model' => $data]);
    }

}
