<?php

namespace app\models\admin;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $f_name
 * @property string $l_name
 * @property string $birthday
 * @property integer $gender
 * @property string $address
 * @property string $avatar
 * @property integer $status_acc
 */
class UserModel extends ActiveRecord  implements IdentityInterface
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user}}';
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'f_name'=> Yii::t('appuser', 'f_name'),
				'l_name'=> Yii::t('appuser', 'l_name'),
				'gender'=> Yii::t('appuser', 'g_name'),
				'emails'=>'Email',		
				'address'=> Yii::t('appuser', 'a_name'),
				'password' => Yii::t('appuser', 'p_name'),
				'username' => Yii::t('appuser', 'u_name'),
				'id_permission' => Yii::t('appuser', 'permission'),
				'status_acc' => Yii::t('appuser', 'status'),
		];
	}
	
	public function rules()
	{
		return [
				[['username','password','permission_id','address'], 'required'],
				[['emails'], 'email'],
				[['username','emails'], 'unique'],
				[['username','password','first_name','last_name'], 'string', 'max' => 250],			
				[['avatar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],					
		];
	}
	
	public function scenarios()
	{
		return [
				'create' => ['f_name', 'l_name','username','password','emails','address','gender','id_permission','status_acc'],
				'update' => ['f_name', 'l_name','emails','address','gender','status_acc'],
				'change_password' => ['password'],
				'login' => ['username','password'],
		];
	}
	
	
	public static function findIdentity($id) {
// 		$user = self::find()
// 		->where([
// 				"id" => $id
// 		])
// 		->one();
// 		if (!count($user)) {
// 			return null;
// 		}
// 		return new static($user);
		
		return static::find()->where(['id'=>$id])->one();
	}
	
	public static function findIdentityByAccessToken($token, $userType = null) {
		
		$user = self::find()
		->where(["accessToken" => $token])
		->one();
		if (!count($user)) {
			return null;
		}
		return new static($user);
	}
	
	public static function findByUsername($username) {
// 		$user = self::find()
// 		->where([
// 				"username" => $username,
// 				"status_acc"=>'1'
// 		])
// 		->one();
// 		if (!count($user)) {
// 			return null;
// 		}
// 		return new static($user);
		
		return static::find()->where(['status_acc'=>'1', 'username' => $username])->one();
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getAuthKey() {
		return $this->authKey;
	}
	
	public function validateAuthKey($authKey) {
		return $this->authKey === $authKey;
	}
	
	public function validatePassword($password) {
		return $this->password ===  md5($password);
	}

	public function upload()
	{
		if ($this->validate()) {			
			$this->avatar->saveAs('upload/user/' . $this->avatar->baseName . '.' . $this->avatar->extension);
			return true;
		} else {
			return false;
		}
	}
  
}
