<?php
namespace common\models;

use Yii;

class Vendor extends MyActiveRecord
{
	public $newpassword;
	
	public static function tableName() {
		return 'vendors';
	}
	
	public function rules() {
		return [
				[[
						'name',
						'name_full',						
						'tax_info',
						'bank_info',
						'info_pricing', 'accounting_code',
						'description',
						'info',						
				], 'trim'],
				[[
					'name', 
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