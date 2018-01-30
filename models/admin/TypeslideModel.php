<?php
namespace app\models\admin;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

class TypeslideModel extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%type_slide}}';
	}

	public function rules()
	{
		return [
				[['name_1','name_2'], 'trim'],
		];
	}

	public static function findIdentity($id) {
		$type = self::find()
		->where([
				"id" => $id
		])
		->one();
		if (!count($type)) {
			return null;
		}
		return new static($type);
	}
	
	public function getId() {
		return $this->id;
	}
	public function getUser_created()
	{
		return $this->hasOne(UserModel::className(), ['id' => 'created_by']);
	}
}