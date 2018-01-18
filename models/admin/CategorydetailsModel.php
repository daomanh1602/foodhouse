<?php
namespace app\models\admin;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class CategorydetailsModel extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%category_detail}}';
	}
	public function getCategory() {
		return $this->hasOne(Category::className(), ['id' => 'cate_id']);
	}
	
	
}