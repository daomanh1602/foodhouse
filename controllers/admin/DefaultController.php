<?php
namespace app\controllers\admin;

use Yii;

class DefaultController extends MyController
{
    public function actionSelectLang($lang = 'vi')
    {
        if (in_array($lang, Yii::$app->params['active_languages'])) {
            if (Yii::$app->user->isGuest) {
                Yii::$app->session->set('active_language', $lang);
            } else {
                // Yii::$app->session->set('active_language', $lang);
                Yii::$app->db->createCommand()->update('nobi_user', ['language'=>$lang], ['id'=>MY_ID])->execute();                
            }
           Yii::$app->session->set('active_language', $lang);           
        }
        $return = Yii::$app->request->getReferrer();
        if (!isset($return)) {
            $return = Yii::$app->request->getBaseUrl();
        }
        return $this->redirect($return);
    }
}