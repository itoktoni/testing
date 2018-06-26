<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\data\Pagination;
use app\models\Category;
use app\models\SubCategory;
use app\models\Cart;
use app\models\Voucher;
use app\models\Orders;
use app\models\Details;
use yii\db\Query;
use yii\mail;
use kartik\mpdf\Pdf;
use yii\base\DynamicModel;
use app\models\Users;
use app\models\Subscribe;
// use Pusher\Pusher;
 use yii\redis\Cache;
 use yii\helpers\Json;

class HomeController extends GlobalController {

    public $count;
    public $template;
    public $cart = [];
    public $stripe_key;
    public $admin_email;

    public function init() {

        $this->layout = $this->app()->params['frontend'];
        $this->stripe_key = $this->app()->params['stripe_key'];
        $this->admin_email = $this->app()->params['adminEmail'];
        $this->template = Yii::$app->params['frontend'];

        $count = 0;

        if ($this->session()->has('cart')) {

            $data = $this->session()->get('cart');
            $count = count($data);
        }
        $this->count = $count;
        $this->app()->view->params['count'] = $count;
    }

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

    public function actionTest(){

          $options = array(
            'cluster' => 'ap1',
            // 'encrypted' => true
          );
          $pusher = new \Pusher\Pusher(
            'b07270a223c7b4f48843',
            'b9a4a122ce6e7271473f',
            '546513',
            $options
          );

          $data['message'] = 'hello world njing';
          $pusher->trigger('my-channel', 'my-event', $data);


          return 'test';

        if($this->request()->post()){

        }
        else{
            return $this->renderPartial($this->template.'/test');
        }
    }

    public function actionChatting()
    {
        if (Yii::$app->request->post()) {

             $redis = Yii::$app->redis;
            $name = Yii::$app->request->post('name');
            $message = Yii::$app->request->post('message');
            $result = $redis->hmset('chatting', $name, $message);

        }

        return $this->render('chatting');
    }

    public function actionHomepage() {

        $redis = Yii::$app->redis;

        if ($this->request()->post()) {
            $email = $this->request()->post('email');
            $user = Subscribe::find()->where(['subscribe_email' => $email])->count();

            if($user > 0){

                $_SESSION['alert'] = ['type' => 'error', 'data' => 'Email Subscribe Already !'];
            }
            else{
                $subscribe = new Subscribe();
                $subscribe->subscribe_email = $email;
                $subscribe->subscribe_date = date('Y-m-d H:i:s');
                $subscribe->save();
                $_SESSION['alert'] = ['type' => 'success', 'data' => 'Subscribe Success !'];
            }
            
        }
        
        $query = Product::find()->where(['product_active' => 1]);
        if (isset($_GET['search'])) {
            $query->andFilterWhere(['like', 'product_name', $_GET['search']]);
        }
        
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 12,
        ]);

        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        $cache = Yii::$app->cache;

        // Yii::$app->cache->redis->hset('mykey', 'somefield', 'somevalue');

        $category = $cache->get('category'); // buat mbedain aja
        if ($category === false) {
            $cache->set('category', Category::find()->limit(6)->all(), 50000); // di cache 300 detik
        }          

        return $this->render($this->template . '/homepage', [
                    'category' => count($category) > 0 ? $category : Category::find()->limit(6)->all(),
                    'product' => $models,
                    'pages' => $pages,
        ]);
    }

    function ArraySearch($sKey, $id, $array) {
        foreach ($array as $key => $val) {
            if ($val[$sKey] == $id) {
                return $key;
            }
        }
        return false;
    }

    public function actionDetail($id) {

//        d($_SESSION['cart'][0]['product_name']);
        $session = Yii::$app->session;
//        $session->destroy();
        $data = Product::find()->where(['product_url' => $id])->one();
        $data->product_view = $data->product_view + 1;
        $data->save();

        $model = new Cart();

//        dd($this->ArraySearch('product_id', , $array));

        if ($this->request()->isAjax) {

            $product = $this->request()->post('product');
            $value = $this->request()->post('value');

             $save = Product::find()->where(['product_id' => $product])->one();
            if ($value == 0) {
                 $save->product_like = 1;
                $save->save();
                return 1;
            } else {
                $save->product_like = 0;
                $save->save();
                return 0;
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $cart = $this->request()->post('Cart');
            $_SESSION['alert'] = ['type' => 'success', 'data' => 'Data Has Been Added !'];

            if (count($_SESSION['cart']) > 0 && array_search($cart['product_id'], array_column($_SESSION['cart'], 'product_id')) !== false) {
                $data = array_search($cart['product_id'], array_column($_SESSION['cart'], 'product_id'));
                $_SESSION['cart'][$data]['qty'] = $_SESSION['cart'][$data]['qty'] + $cart['qty'];
                $this->response()->refresh();
            } else {
                $_SESSION['cart'][] = [
                    'product_id' => $cart['product_id'],
                    'product_name' => $cart['product_name'],
                    'product_url' => $cart['product_url'],
                    'product_image' => $cart['product_image'],
                    'product_price' => $cart['product_price'],
                    'product_weight' => $cart['product_weight'],
                    'qty' => $cart['qty'],
                    'session' => $cart['session'],
                ];
            }
//            d($data);
            $this->response()->refresh();
        } else {

            return $this->render($this->template . '/detail', [
                        'detail' => $data,
                        'product' => Product::find()->where(['product_id_category' => $data->product_id_category])->limit(12)->all(),
                        'category' => Category::find()->limit(12)->all(),
                        'sub_category' => SubCategory::find()->limit(12)->all(),
                        'model' => $model,
            ]);
        }
    }

    public function actionCategory($id) {

        $query = Product::find()->select(['products.*'])->leftJoin('category', 'products.product_id_category = category.category_id')->where(['category_url' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 12,
        ]);

         $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render($this->template . '/category', [
                     'product' => $models,
                    'pages' => $pages,
        ]);
    }

    public function actionProduct() {

        $query = Product::find()->where(['product_active' => 1]);
        if (isset($_GET['search'])) {
            $query->andFilterWhere(['like', 'product_name', $_GET['search']]);
        }
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 12,
        ]);

        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render($this->template . '/product', [
                    'product' => $models,
                    'pages' => $pages,
        ]);
    }

    public function actionSubcategory($id) {

        $data = Product::find()->select(['products.*'])->leftJoin('sub_category', 'products.product_id_sub_category = sub_category.sub_category_id')->where(['sub_category_url' => $id])->all();

        return $this->render('sub_category', [
                    'product' => $data,
        ]);
    }

    protected function addCart($session, $product_id, $product_name, $product_url, $product_image, $product_weight, $qty) {

        $data = array(
            'session' => $session,
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_url' => $product_url,
            'product_image' => $product_image,
            'product_weight' => $product_weight,
            'qty' => $qty,
        );

        array_push($this->cart, $data);
    }

    public function actionCart() {


        if ($this->request()->post('validate')) {
            $data = Voucher::find()->where(['voucher_code' => $this->request()->post('voucher')]);
            if ($data->count() > 0) {
                $get = $data->one();
                $total = $this->request()->post('total');
                $data_validation = $get->voucher_validation;
                if (!empty($data_validation)) {
                    $perbandingan = str_replace('@total', $total, $data_validation);
                    $validation = eval('return ' . $perbandingan . ';');

                    if ($validation) {
                        $data_voucher = $get->voucher_operan;
                        $diskon = str_replace('@total', $total, $data_voucher);
                        $voucher = eval('return ' . $diskon . ';');

                        $_SESSION['voucher'] = ['code' => $get->voucher_code, 'name' => $get->voucher_name, 'value' => $voucher];
                    }
                } else {

                    $data_voucher = $get->voucher_operan;
                    $diskon = str_replace('@total', $total, $data_voucher);
                    $voucher = eval('return ' . $diskon . ';');

                    $_SESSION['voucher'] = ['code' => $get->voucher_code, 'name' => $get->voucher_name, 'value' => $voucher];
                }

                $_SESSION['alert'] = ['type' => 'success', 'data' => 'Success Add Voucher '.$_SESSION['voucher']['name']];
            }
        } else if ($this->request()->post('delete')) {

            if ($this->request()->post('id')) {
                $data = $this->request()->post('id');
                foreach ($data as $mark) {
                    $check = array_search($mark, array_column($_SESSION['cart'], 'product_id'));
                    unset($_SESSION['cart'][$check]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                }
            }

        } else if ($this->request()->post('update')) {

            if ($this->request()->post('product_id')) {
                $data = $this->request()->post('product_id');
                $qty = $this->request()->post('qty');

                for ($i = 0; $i < count($data); $i ++) {
                    if (count($_SESSION['cart']) > 0 && array_search($data[$i], array_column($_SESSION['cart'], 'product_id')) !== false) {
                        $dapat = array_search($data[$i], array_column($_SESSION['cart'], 'product_id'));
                        $_SESSION['cart'][$dapat]['qty'] = $qty[$i];
                    }
                }
            }
        } else if ($this->request()->post('checkout')) {

            \Stripe\Stripe::setApiKey($this->stripe_key);
            $token = $_POST['stripeToken'];

            $order = new Orders();
            $service = explode('#', $this->request()->post('service'));
            $id = $this->autonumber('orders', 'order_id', 'SO' . date('Ym'), 10);
            $email = $this->request()->post('email');
            $price = $this->request()->post('price');

            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $price,
                    'currency' => 'usd',
                    'description' => $id,
                    'source' => $token,
                    'receipt_email' => $email,
                ]);

                if($charge->paid == true){

                    $transaction = $order->getDb()->beginTransaction();
                    try {
                        $order->order_id = $id;
                        $order->order_date = date('Y-m-d');
                        $order->order_name = $this->request()->post('name');
                        $order->order_email = $this->request()->post('email');
                        $order->order_province = $this->request()->post('province');
                        $order->order_city = $this->request()->post('city');
                        $order->order_sub = $this->request()->post('sub');
                        $order->order_address = $this->request()->post('address');
                        $order->order_weight = $this->request()->post('weight');
                        $order->order_courier = $this->request()->post('courier');
                        $order->order_service = $service[1];
                        $order->order_total = $this->request()->post('price');
                        $order->order_notes = $this->request()->post('notes');
                        $order->order_cost_delivery = $this->request()->post('price');

                        $order->order_payment = $charge->id;

                        $order->voucher_code = $this->request()->post('voucher_code');
                        $order->voucher_name = $this->request()->post('voucher_name');
                        $order->voucher_value = $this->request()->post('voucher_value');

                        $order->order_user = isset($_SESSION['login']) ? $_SESSION['login']['name'] : $this->request()->post('name');
                        $order->save();

                        $product_id = $this->request()->post('product_id');
                        $product_name = $this->request()->post('product_name');
                        $product_url = $this->request()->post('product_url');
                        $product_image = $this->request()->post('product_image');
                        $product_price = $this->request()->post('product_price');
                        $product_weight = $this->request()->post('product_weight');
                        $product_qty = $this->request()->post('qty');

                        for ($i = 0; $i < count($product_id); $i++) {

                            $detail = new Details();
                            $detail->detail = $id;
                            $detail->product_id = $product_id[$i];
                            $detail->product_name = $product_name[$i];
                            $detail->product_url = $product_url[$i];
                            $detail->product_image = $product_image[$i];
                            $detail->product_price = $product_price[$i];
                            $detail->product_weight = $product_weight[$i];
                            $detail->product_qty = $product_qty[$i];
                            $detail->save();

                            $model = Product::find($product_id[$i]);
                            $get = $model->one();
                            $qty = $get->product_qty;

                            $pengurangan = $qty - $product_qty[$i];
                            $product = new Product();
                            $product->product_qty = $pengurangan;
                            $product->save();  // equivalent to $model->update();
                        }

                        $transaction->commit();

                        $header = Orders::find()->where(['order_id' => $id])->one();
                        $detail = Details::find()->where(['detail' => $id])->all();

                        $content = $this->renderPartial('@app/views/pdf/so', [
                            'header' => $header,
                            'detail' => $detail,
                        ]);

                        $pdf = new Pdf([
                            'mode' => Pdf::MODE_UTF8,
                            'format' => Pdf::FORMAT_A4,
                            'orientation' => Pdf::ORIENT_PORTRAIT,
                            'destination' => Pdf::DEST_FILE,
                            'filename' => 'files/so/'.$id . '.pdf',
                            'content' => $content,
                            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                            'options' => ['title' => 'Laporan Harian']
                        ]);
                        $pdf->render();

                        Yii::$app->mailer->compose('@app/mail/html', [
                                    'data' => $this->request()->post(),
                                    'code' => $id,
                                    'service' => $service[1],
                                    'courier' => $this->request()->post('courier'),
                                    'weight' => $this->request()->post('weight'),
                                    'delivery' => $this->request()->post('price'),
                                ])
                                ->setFrom('Itok.ToniLaksono@mitrais.com')
                                ->setTo($this->request()->post('email'))
                                ->setSubject('Notification Order From System')
                                ->attach('../web/files/so/' . $id . '.pdf')
                                ->send();

                        session_destroy();
                        return $this->redirect(['/']);
                        $_SESSION['cart'] = ['type' => 'success', 'data' => 'You Are Success, Transaction Id '.$charge->id];

                    } catch (Exception $e) {
                        $transaction->rollback();
                        $_SESSION['alert'] = ['type' => 'error', 'data' => $e];
                        $this->response()->refresh();
                    }
                }
                else{

                    $_SESSION['alert'] = ['type' => 'error', 'data' => 'Payment Transaction Failed !'];
                }    

            } catch(\Stripe\Error\Card $e) {
                
                $_SESSION['alert'] = ['type' => 'error', 'data' => $e->message];
            }
        }

        $province = Yii::$app->runAction('/ongkir/province');
        return $this->render($this->template . '/cart', [
                    'sub_category' => SubCategory::find()->limit(10)->all(),
                    'product' => Product::find()->limit(10)->all(),
                    'cart' => $this->cart,
                    'province' => json_decode($province),
        ]);
    }

    public function actionAbout() {

        return $this->render($this->template . '/about');
    }

    public function actionContact() {

        $data = $this->request()->post('DynamicModel');
        $email = $data['email'];
        $message = $data['message'];
        $model = new DynamicModel(['email' => $email, 'message' => $message]);
        if ($this->request()->post()) {

            $model->addRule(['message', 'email'], 'required')
                    ->addRule('email', 'email')
                    ->validate();

                Yii::$app->mailer->compose('@app/mail/contact', [
                            'data' => $message,
                        ])
                        ->setFrom($this->admin_email)
                        ->setTo($email)
                        ->setSubject('Notification Ask From Customer')
                        ->send();
                $_SESSION['alert'] = ['type' => 'success', 'data' => 'Email Has been Sent !'];
                return $this->response()->redirect(['/']);
        }

        return $this->render($this->template . '/contact', ['model' => $model]);
    }

    public function actionCheckout() {

        $order = new Orders();
        $service = explode('#', $this->request()->post('service'));
        $id = $this->autonumber('orders', 'order_id', 'SO' . date('Ym'), 10);

        if ($this->request()->post()) {
            $transaction = $order->getDb()->beginTransaction();
            try {
                $order->order_id = $id;
                $order->order_date = date('Y-m-d');
                $order->order_name = $this->request()->post('name');
                $order->order_email = $this->request()->post('email');
                $order->order_province = $this->request()->post('province');
                $order->order_city = $this->request()->post('city');
                $order->order_sub = $this->request()->post('sub');
                $order->order_address = $this->request()->post('address');
                $order->order_weight = $this->request()->post('weight');
                $order->order_courier = $this->request()->post('courier');
                $order->order_service = $service[1];
                $order->order_notes = $this->request()->post('notes');
                $order->order_cost_delivery = $this->request()->post('price');
                $order->save();

                $product_id = $this->request()->post('product_id');
                $product_name = $this->request()->post('product_name');
                $product_url = $this->request()->post('product_url');
                $product_image = $this->request()->post('product_image');
                $product_price = $this->request()->post('product_price');
                $product_weight = $this->request()->post('product_weight');
                $product_qty = $this->request()->post('qty');

                for ($i = 0; $i < count($product_id); $i++) {

                    $detail = new Details();
                    $detail->detail = $id;
                    $detail->product_id = $product_id[$i];
                    $detail->product_name = $product_name[$i];
                    $detail->product_url = $product_url[$i];
                    $detail->product_image = $product_image[$i];
                    $detail->product_price = $product_price[$i];
                    $detail->product_weight = $product_weight[$i];
                    $detail->product_qty = $product_qty[$i];
                    $detail->save();

                    $model = Product::find($product_id[$i]);
                    $get = $model->one();
                    $qty = $get->product_qty;

                    $pengurangan = $qty - $product_qty[$i];
                    $product = new Product();
                    $product->product_qty = $pengurangan;
                    $product->save();  // equivalent to $model->update();
                }

                $transaction->commit();

                $header = Orders::find()->where(['order_id' => $id])->one();
                $detail = Details::find()->where(['detail' => $id])->all();

                $content = $this->renderPartial('@app/views/pdf/so', [
                    'header' => $header,
                    'detail' => $detail,
                ]);

                $pdf = new Pdf([
                    'mode' => Pdf::MODE_UTF8,
                    'format' => Pdf::FORMAT_A4,
                    'orientation' => Pdf::ORIENT_PORTRAIT,
                    'destination' => Pdf::DEST_FILE,
                    'filename' => $id . '.pdf',
                    'content' => $content,
                    'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                    'options' => ['title' => 'Laporan Harian']
                ]);
                $pdf->render();

                Yii::$app->mailer->compose('@app/mail/html', [
                            'data' => $this->request()->post(),
                            'code' => $id,
                            'service' => $service[1],
                            'courier' => $this->request()->post('courier'),
                            'weight' => $this->request()->post('weight'),
                            'delivery' => $this->request()->post('price'),
                        ])
                        ->setFrom('Itok.ToniLaksono@mitrais.com')
                        ->setTo($this->request()->post('email'))
                        ->setSubject('Notification Order From System')
                        ->attach('../web/' . $id . '.pdf')
                        ->send();

                session_destroy();
                return $this->redirect(['/']);
                $_SESSION['cart'] = ['type' => 'success', 'data' => 'You Are Success Checkout'];
            } catch (Exception $e) {
                $transaction->rollback();
            }
        }


        $province = Yii::$app->runAction('/ongkir/province');
        return $this->render('checkout', [
                    'sub_category' => $this->subcategory,
                    'product' => Product::find()->limit(10)->all(),
                    'cart' => $this->cart,
                    'province' => json_decode($province),
        ]);
    }

}
