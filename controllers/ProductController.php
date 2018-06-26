<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Category;
use app\models\SubCategory;
use yii\helpers\ArrayHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends GlobalController
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

         if ($model->load(Yii::$app->request->post())) {
                try{
                       $picture = UploadedFile::getInstance($model, 'product_image');
                       $product = $_POST['Product'];
                       $seo = $this->seo($product['product_name']);
                       $model->product_image = $seo.'.'.$picture->getExtension();
                       $model->product_id_sub_category = $product['product_id_sub_category'];
                       $model->product_id_category = $product['product_id_category'];
                       $model->product_url = $seo;
                       $model->product_active = 1;
                       $picture->saveAs('files/product/' . $seo.'.'.$picture->getExtension());
                       
                       if($model->save()){


                       $category = Category::find($product['product_id_category'])->one();
                       $subcategory = SubCategory::find($product['product_id_sub_category'])->one();

                         $this->algolia()->addObject([
                            'product_id' => $model->product_id,
                            'product_name' => $model->product_name,
                            'product_image' => $model->product_image,
                            'product_image_url' => Yii::$app->params['base_url'] . 'files/product/'.$model->product_image,
                            'product_description' => $model->product_description,
                            'product_price' => $model->product_price,
                            'product_qty' => $model->product_qty,
                            'product_id_category' => $model->product_id_category,
                            'product_category' => empty($category->category_name) ? null : $category->category_name,
                            'product_id_sub_category' => empty($subcategory->sub_category_name) ? null : $subcategory->sub_category_name,
                            'product_url' => Yii::$app->params['base_url'].'view/'.$model->product_url,
                            'product_active' => $model->product_active,
                            'product_weight' => 1,
                        ]); 

                            Yii::$app->getSession()->setFlash('success','Data saved!');
                           return $this->redirect(['view','id'=>$model->product_id]);
                       }
                       else{

                            Yii::$app->getSession()->setFlash('error','Data Canot be save !');
                            return $this->redirect(['create']);
                       } 



                        // $this->algolia()->addObjects([
                        //     'product_id' => $model->product_id,
                        //     'product_name' => $model->product_name,
                        //     'product_image' => $model->product_image,
                        //     'product_image_url' => Yii::$app->params['base_url'] . 'files/product/'.$model->product_image,
                        //     'product_description' => $model->product_description,
                        //     'product_price' => $model->product_price,
                        //     'product_qty' => $model->product_qty,
                        //     'product_id_category' => $model->product_id_category,
                        //     'product_category' => empty($category->category_name) ? null : $category->category_name,
                        //     'product_id_sub_category' => empty($subcategory->sub_category_name) ? null : $subcategory->sub_category_name,
                        //     'product_url' => $model->product_url,
                        //     'created_at' => $model->created_at,
                        //     'created_by' => $model->created_by,
                        //     'product_active' => $model->product_active,
                        //     'product_weight' => $model->product_weight,
                        //     'product_view' => $model->product_view,
                        //     'product_like' => $model->product_like,
                        // ]);


                   }
                   catch(Exception $e){
                          Yii::$app->getSession()->setFlash('error', $e->getMessage());
                    }
              }
            else {

                $category = new Category();
                $sub_category = new SubCategory();
                $cat = $category->find()->asArray()->all();
                $sub_cat = $sub_category->find()->asArray()->all();
                $map_cat = ArrayHelper::map($cat,'category_id', 'category_name');
                $map_sub_cat = ArrayHelper::map($sub_cat,'sub_category_id', 'sub_category_name');

                return $this->render('create', [
                    'model' => $model,
                    'category' => $map_cat,
                    'sub_category' => $map_sub_cat,
                ]);
            }
        }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $product = $_POST['Product'];
            $seo = $this->seo($product['product_name']);
            
            $picture = UploadedFile::getInstance($model, 'product_image');

            $model->product_id_sub_category = $product['product_id_sub_category'];
            $model->product_id_category = $product['product_id_category'];
            $model->product_image = $seo.'.'.$picture->getExtension();
            $model->product_url = $seo;

            // $model->save();
            $picture->saveAs('files/product/' . $seo.'.'.$picture->getExtension());
               if($model->save()){
                    Yii::$app->getSession()->setFlash('success','Data saved!');
                   return $this->redirect(['view','id'=>$model->product_id]);
               }
               else{

                    Yii::$app->getSession()->setFlash('error','Data Canot be save !');
                    return $this->redirect(['create']);
               } 
        }

        $category = new Category();
                $sub_category = new SubCategory();
                $cat = $category->find()->asArray()->all();
                $sub_cat = $sub_category->find()->asArray()->all();
                $map_cat = ArrayHelper::map($cat,'category_id', 'category_name');
                $map_sub_cat = ArrayHelper::map($sub_cat,'sub_category_id', 'sub_category_name');
        return $this->render('update', [
            'model' => $model,
            'category' => $map_cat,
                    'sub_category' => $map_sub_cat,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        unlink(Yii::$app->basePath.'/web/files/product/'.$model->product_image);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
