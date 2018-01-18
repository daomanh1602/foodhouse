<?php
namespace app\models\admin;
use yii\base\Model;
use yii\web\IdentityInterface;

class MenuForm extends Model
{	
	public $name;
	public $slug;
	public $url;
	
	
	public function attributeLabels()
	{
		return [
// 			'parent_id' => Yii::t('app','parent id'),	
// 			'name'=> Yii::t('app', 'name'),
// 			'description'=> Yii::t('app', 'description'),
// 			'content'=> Yii::t('app', 'content'),
// 			'slug'=> Yii::t('app', 'slug'),		'
			'name'=> 'Name',			
			'slug'=> 'Slug',
			'url' => 'Link'
		];
	}
	public function rules()
	{
		return [
				[['name', 'slug', 'url'], 'trim'],
				[['name', 'url'], 'required', 'message'=>'Còn thiếu'],				
		];
	}
	public function scenarios()
	{
		return [
				'create' => ['name', 'url' ],
		];
	}
	
}