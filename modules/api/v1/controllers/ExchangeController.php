<?php


namespace app\modules\api\v1\controllers;



use Yii;
use yii\filters\auth\HttpHeaderAuth;
use yii\rest\Controller;
use function foo\func;

class ExchangeController extends Controller
{

    public function behaviors()
    {
        // HttpHeaderAuth
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['class'] = HttpHeaderAuth::className();

        return $behaviors;
    }

    public function actionIndex()
    {
        $keys = Yii::$app->redis->keys('*');
        $random = rand(0, count($keys));
        $res = json_decode(Yii::$app->redis->get($keys[$random]), true);
        if ($res) {
            return [
                $keys[$random] => Yii::t('app',
                    $res['Nominal'] . ' ' . $res['Name'] . ' равен ' . $res['Value'] . '{n, plural, =0{ рублей} =1{ рублю} one{ рублю} few{ рублям} many{ рублям} other{ рублям}}',
                    ['n' =>  intval($res['Value'])]
                )
            ];
        } else {
            throw new \yii\web\NotFoundHttpException;
        }
    }

    public function actionView($id)
    {
        $res = json_decode(Yii::$app->redis->get($id), true);

        if ($res) {
            return [
                $id => Yii::t('app',
                    $res['Nominal'] . ' ' . $res['Name'] . ' равен ' . $res['Value'] . '{n, plural, =0{ рублей} =1{ рублю} one{ рублю} few{ рублям} many{ рублям} other{ рублям}}',
                    ['n' =>  intval($res['Value'])]
                )
            ];
        } else {
            throw new \yii\web\NotFoundHttpException;
        }
    }
}