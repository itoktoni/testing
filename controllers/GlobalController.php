<?php

namespace app\controllers;

use Yii;
use app\models\EntryForm;
use yii\web\Controller;
use yii\helpers\VarDumper;
use yii\db\Query;
use app\models\Users;
use yii\base\DynamicModel;
use AlgoliaSearch\Client;

class GlobalController extends Controller {

    public $db;
    public $template;
    public $algolia;

    public function init() {
        $this->db = \Yii::$app->db;
        $this->template = Yii::$app->params['frontend'];

        parent::init();
    }

    public function beforeAction($action) {

//        session_destroy();
        $controller = get_class($this);
        $controller = Yii::$app->controller->id;
        $function = Yii::$app->controller->action->id;
        $connection = \Yii::$app->db;

        if (isset($_SESSION['login'])) {
            $group = $_SESSION['login']['groups'];
            $sql = $connection->createCommand("SELECT * FROM roles WHERE groups='$group' AND controllers='$controller' AND functions='$function'");
        } else {
            $sql = $connection->createCommand("SELECT * FROM roles WHERE groups is null AND controllers='$controller' AND functions='$function'");
        }

        // d($sql->getRawSql());
        $get = $sql->queryOne();

        if (!empty($get['role_id'])) {
            if ($get['filters'] == 'login') {
                $_SESSION['alert'] = ['type' => 'error','data' => 'Please Login to Access That Page !'];
                $this->response()->redirect(['global/login']);
            } elseif ($get['filters'] == 'access') {

                $_SESSION['alert'] = ['type' => 'error','data' => 'You Must Authorized to access That Page !'];
                $this->redirect(['global/error']);
            }
        }

        return parent::beforeAction($action);
    }

    protected function app() {
        return Yii::$app;
    }

    protected function algolia(){

        $client = new \AlgoliaSearch\Client('TP8H76V4RK', 'ae0afaa0a2f3f3ccb559691522805852');
        $this->algolia = $client->initIndex('product_NAME');
        return $this->algolia;
    }

    protected function request() {
        return $this->app()->request;
    }

    protected function session() {

        return $this->app()->session;
    }

    protected function response() {

        return $this->app()->response;
    }

    public static function dd($data) {
        VarDumper::dump($data, $depth = 10, $highlight = true);
    }

    public function seo($string){
        
        $separator = '-';
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }

    public function actionRegister() {

        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $data = $this->request()->post('Users');
            $model->first_name = $data['first_name'];
            $model->last_name = $data['last_name'];
            $model->name = $data['first_name'].' '.$data['last_name'];
            $model->email = $data['email'];
            $model->groups = 'user';
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->password = md5($data['password']);
            $model->save();

            $_SESSION['alert'] = ['type' => 'success', 'data' => 'Your Register Success !'];
            return $this->response()->redirect(['global/login']);
        }

        return $this->renderPartial('register', [
                    'model' => $model,
        ]);
    }

    public function actionError() {

        return $this->renderPartial('error');
    }

    public function actionLogin() {

        if (isset($_SESSION['login'])) {
            $_SESSION['alert'] = ['type' => 'success', 'data' => 'You Have Already Login \n with Email ' . $_SESSION['login']['email']];
            
            return $this->response()->redirect(['/']);
        }

        $model = new Users();
        $connection = \Yii::$app->db;

        if ($model->load(Yii::$app->request->post())) {

            $data = $this->request()->post('Users');
            $email = $data['email'];
            $password = $data['password'];

            $model = new DynamicModel(['email' => $email, 'password' => $password]);

            $model->addRule(['password', 'email'], 'required')
                    ->addRule('email', 'email')
                    ->validate();
            $hash = md5($password);
            $sql = $connection->createCommand("SELECT * FROM users WHERE email='$email' AND password='$hash'");
            $get = $sql->queryOne();
//            d($get);

            if (empty($get['id'])) {
                $_SESSION['alert'] = ['type' => 'error', 'data' => 'Data Invalid !'];
                return $this->response()->redirect(['global/login']);
            }

            $_SESSION['login'] = $get;
           $_SESSION['alert'] = ['type' => 'success', 'data' => 'Hai... ' . ucwords($_SESSION['login']['name'])];

            return $this->response()->redirect(['/']);
        }

        return $this->renderPartial('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        session_destroy();
        return $this->response()->redirect(['/']);
    }

    public function autonumber($table, $field, $prefix, $codelength) {

        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT max($field) as maxcode from $table where orders.order_id like '$prefix%'");
        $get = $sql->queryOne();
        $data = $get['maxcode'];

        if (!empty($data)) {
            $code = substr($data, strlen($prefix));
            $countcode = ($code) + 1;
        } else {
            $countcode = 1;
        }

        $newcode = $prefix . str_pad($countcode, $codelength - strlen($prefix), "0", STR_PAD_LEFT);
        return $newcode;
    }

}
