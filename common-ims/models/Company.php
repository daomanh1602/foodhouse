<?php
namespace common\models;

class Company extends MyActiveRecord
{
	public $groups;
	
	public static function tableName() {
		return '{{%companies}}';
	}

	public function rules()
	{
		return [
			[['name', 'name_full', 'search', 'info', 'stt_hoadon' ], 'required'],
			[['name'], 'unique'],
			[['accounting_code', 'name', 'name_full', 'search', 'info', 'tax_info', 'bank_info', 'image'], 'trim'],
			[['accounting_code'], 'filter', 'filter'=>'strtoupper'],
			[['image'], 'url'],
		];
	}

	public function attributeLabels()
	{
		return [
			'name'=>'Short name',
			'name_full'=>'Full name',
			'search'=>'Search keywords',
			'tax_info'=>'Tax information',
			'bank_info'=>'Bank information',
			'stt_hoadon'=>'Invoice status',
			'info_pricing'=>'Thong tin thanh toan',
			'info'=>\Yii::t('mn', 'Information'),
		];
	}

	public function scenarios()
	{
		return [
			'company/c'=>['name', 'name_full', 'tax_info', 'info_pricing', 'stt_hoadon', 'info', 'short_name'],
			'company/u'=>['name', 'name_full', 'search', 'tax_info', 'accounting_code', 'image', 'info_pricing', 'stt_hoadon', 'short_name'],
		];
	}


	public function getVenues()
	{
		return $this->hasMany(Venue::className(), ['company_id' => 'id']);
	}

	public function getCreatedBy()
	{
		return $this->hasOne(User::className(), ['id' => 'created_by']);
	}

	public function getUpdatedBy()
	{
		return $this->hasOne(User::className(), ['id' => 'updated_by']);
	}

	public function getMetas()
	{
		return $this->hasMany(Meta2::className(), ['rid' => 'id'])->where(['rtype'=>'company']);
	}

	public function getCases()
	{
		return $this->hasMany(Kase::className(), ['company_id' => 'id']);
	}

	public function getProfileTA()
	{
		return $this->hasMany(TAProfile::className(), ['company_id' => 'id']);
	}


	public function getNcc()
	{
		return $this->hasOne(Ncc::className(), ['ncc_id'=>'id']);
	}

	public function getSearch()
	{
		return $this->hasOne(Search::className(), ['rid'=>'id']);
	}
}
