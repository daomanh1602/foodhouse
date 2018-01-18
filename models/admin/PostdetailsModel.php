<?php
namespace app\models\admin;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class PostdetailsModel extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%post_detail}}';
	}
	public function getPost() {
		return $this->hasOne(PostModel::className(), ['id' => 'post_id']);
	}
	
	
}