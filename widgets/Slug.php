<?php

namespace app\widgets;

use Yii;
use yii\base\Component;
use yii\base\Widget;

class Slug extends \yii\base\Widget {

    public $str;

    public function init() {
        parent::init();
        setlocale(LC_ALL, 'en_US.UTF8');
    }

    public static function create($str, $delimiter = '-') {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', trim($str));
        $slug = preg_replace('/[^A-Za-z0-9-]+/', $delimiter, strtolower($clean));
        return strtolower($slug);
    }

}