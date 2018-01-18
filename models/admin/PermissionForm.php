<?php
namespace app\models\admin;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

class PermissionForm extends Model
{	
	public $name;
	public $category;
	public $post;
	public $permission;
	public $slide;
	
	public function attributeLabels()
	{
		return [
			'name'=> Yii::t('app', 'Name'),
			'category'=> Yii::t('app', 'Category'),
			'post'=> Yii::t('app', 'Post'),
			'permission'=> Yii::t('app', 'Permission'),
			'slide'=> Yii::t('app', 'Slide'),
		];
	}
	public function rules()
	{
		return [
				[['name','category','post','slide','permission'], 'trim'],
		];
	}
	
}