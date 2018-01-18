<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\LoginForm;
use yii\web\Controller;

class LoginController extends MyController {
    
    public function behaviors() {
        return [
            'AccessControl' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions'=>['index'],
                        'allow'=>true,
                        //'roles'=>['?'],
                    ], [
                        'actions'=>['logout'],
                        'allow'=>true,
                        'roles'=>['@/admin/login'],
                    ],
                ]
            ]
        ];
    }
    
    public function actionIndex() {
        $this->layout = 'login';

        $model = new LoginForm();
        $model->scenario = 'login';
// 		Yii::$app->session->set('uid', $uid);
        
        if ($model->load ( Yii::$app->request->post () ) && $model->login ()) {
            $uid = Yii::$app->security->generateRandomString();
            
            Yii::$app->db
            ->createCommand()
            ->insert('nobi_ss_login', [
                    'created_at' => NOW,
                    'user_id' => Yii::$app->user->identity->id,
                    'ip_address'=>isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : Yii::$app->request->getUserIP(),
                    'ua_string'=>Yii::$app->request->getUserAgent(),
            ])
            ->execute();
            
            return $this->redirect('@web/admin/user');
        }
        
        return $this->render ( 'index', [ 
                'model' => $model 
        ] );
    }
    
    public function actionLogout()
    {
        // Delete session from at_logins
        $uid = Yii::$app->session->get('uid');
        Yii::$app->session->remove('uid');
        Yii::$app->getResponse()->getCookies()->remove('imswtf');
        Yii::$app->user->logout(false);
        
        $this->layout = 'login';
        return $this->render('logout');
    }
}