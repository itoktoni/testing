<?php

namespace app\components;

use Yii;
use yii\base\Component;

class SlugComponent extends Component {

    public $str;

    public function init() {
        parent::init();
        setlocale(LC_ALL, 'en_US.UTF8');
    }

    public function create($str, $delimiter = '-') {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', $delimiter, $clean);
        return strtolower($slug);
//        $clean = preg_replace('/[^a-zA-Z0-9/_|+ -]/', '', $clean);
//        $clean = strtolower(trim($clean, '-'));
//        $clean = preg_replace('/[/_|+ -]+/', $delimiter, $clean);
    }

}