<?php
namespace common\models;

use Yii;

class Client extends MyActiveRecord
{
	public $newpassword;
	
	public static function tableName() {
		return 'clients';
	}
	
	public function rules() {
		return [
				[[
						'name',
						'price_strategy',
						'owner_id',
						'body', 'note',
						'payment_conditions',
						'bank_account',
						'login', 'password', 'newpassword',
				], 'trim'],
				[[
						'name', 'owner_id',
				], 'required', 'message'=>Yii::t('app', 'Required')],
		];
	}
	
	public function getCreatedBy()
	{
		return $this->hasOne(User2::className(), ['id' => 'created_by']);
	}
	
	public function getUpdatedBy()
	{
		return $this->hasOne(User2::className(), ['id' => 'updated_by']);
	}
	
	public function getMetas()
	{
		return $this->hasMany(Meta2::className(), ['rid' => 'id'])->where(['rtype'=>'client']);
	}
	
	public function getCases()
	{
		return $this->hasMany(Kase::className(), ['company_id' => 'id']);
	}
}