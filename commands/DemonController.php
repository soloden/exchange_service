<?php

namespace app\commands;

use yii\console\Controller;

class DemonController extends Controller
{
    private $url = 'https://www.cbr-xml-daily.ru/daily_json.js';

    public function getUrl()
    {
        return $this->url;
    }

    public function actionIndex()
    {
        $response = json_decode(file_get_contents($this->getUrl()), true);
        $valuteList = $response['Valute'];
        foreach ($valuteList as $key => $valute) {
            \Yii::$app->redis->set($key, json_encode($valute));
        }
    }

}
