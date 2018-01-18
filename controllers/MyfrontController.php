<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\HttpException;

class MyfrontController extends Controller
{
	public function __construct($id, $module, $config = [])
	{
		$this->layout = 'frontEndLayout';

		
		if (!defined('MY_ID')) {
			if (Yii::$app->user->isGuest) {
				define('MY_ID', 0);
// 						exit();						
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
	
	// public function actionSavelog($action, $result){
	// 	Yii::$app->db->createCommand()
	// 	->insert('nobi_log', [
	// 			'u_id'=> USER_ID,
	// 			'action' => $action,
	// 			'created_at' => NOW,
	// 			'result' => $result,
	// 	])
	// 	->execute();
	// }
	
	// public function behaviors()
	// {
	// 	return [
	// 		'AccessControl' => [
	// 			'class' => \yii\filters\AccessControl::className(),
	// 			'rules' => [
	// 				[
	// 					'allow'=>true,
	// 					'roles'=>array('@/home'),
	// 				], [
	// 					'allow'=>false,
	// 				],
	// 			]
	// 		]
	// 	];
	// }
	
	
}