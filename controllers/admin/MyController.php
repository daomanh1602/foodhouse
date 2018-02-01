<?php
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;

class MyController extends Controller
{
	public function __construct($id, $module, $config = [])
	{
		$this->layout = 'adminlayout';
		// $this->layout = 'admin_paper';
		// To https
		//\yii\base\Event::on(\yii\web\View::className(), \yii\web\View::EVENT_AFTER_RENDER,  [$this, 'handlerViewEvent']);
		
		// Active Language
		if (Yii::$app->user->isGuest) {
			$activeLanguage = Yii::$app->session->get('active_language', 'en');
		} else {
			$activeLanguage = Yii::$app->user->identity->language;
		}
		if (!in_array($activeLanguage, Yii::$app->params['active_languages'])) {
			$activeLanguage = Yii::$app->params['active_languages'][0];
		}
		Yii::$app->language = $activeLanguage;
		
		// Mobile device
		
// 		$isMobile = Yii::$app->session->get('is_mobile', 'unknown');
// 		if (isset($_GET['mobile']) && $_GET['mobile'] == 'yes')
// 			$isMobile = 'yes';
// 			if (isset($_GET['mobile']) && $_GET['mobile'] == 'no')
// 				$isMobile = 'no';
// 				if ($isMobile == 'unknown') {
// 					$isMobile = 'no';
// 					$detect = new \Mobile_Detect;
// 					if ($detect->isMobile() && !$detect->isTablet()) {
// 						$isMobile = 'yes';
// 					}
// 				}
// 				Yii::$app->session->set('is_mobile', $isMobile);
// 				if (!defined('IS_MOBILE')) {
// 					define('IS_MOBILE', $isMobile == 'yes' ? true : false);
// 				}
				
				if (!defined('MY_ID')) {
					if (Yii::$app->user->isGuest) {
						define('MY_ID', 0);			
						// exit();						
					} else {
						define('MY_ID', Yii::$app->user->identity->id);
					}
				}
				
				if (!defined('USER_ID')) {
					define('USER_ID', MY_ID);
				}
				
				if (USER_ID == 1 && !isset($_GET['x'])) {
					//$this->layout = 'main_m454';
					//$this->layout = 'main_r210';
				}
				
				// Prevent accidental upload
				// Yii::$app->session->set('ckfinder_authorized', false);
				
				parent::__construct($id, $module, $config);				
	}
	
	public function actionSavelog($action, $result){
		Yii::$app->db->createCommand()
		->insert('nobi_log', [
				'u_id'=> USER_ID,
				'action' => $action,
				'created_at' => NOW,
				'result' => $result,
		])
		->execute();
	}
	
	public function behaviors()
	{
		return [
			'AccessControl' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'allow'=>true,
						'roles'=>array('@'),
					], [
						'allow'=>false,
					],
				]
			]
		];
	}
	
	
}