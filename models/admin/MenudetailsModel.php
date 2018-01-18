<?php
namespace app\models\admin;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class MenudetailsModel extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%menu_detail}}';
	}
	public function getCategory() {
		return $this->hasOne(Menu::className(), ['id' => 'cate_id']);
	}
	
	
}