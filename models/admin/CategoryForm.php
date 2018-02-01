<?php
namespace app\models\admin;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

class CategoryForm extends Model
{	
	public $name;
	public $description;
	public $content;
	public $slug;
	public $seo_title;
	public $seo_description;
	public $avatar;
	public $status;

	//silde
	public $use;
	public $type;

	public function attributeLabels()
	{
		return [
			'name'=> Yii::t('app', 'Name'),
			'description'=> Yii::t('app', 'description'),
			'content'=> Yii::t('app', 'Content'),	
			'slug'=> Yii::t('app', 'Slug'),
			'seo_title'=> Yii::t('app', 'Seo title'),
			'seo_description' => Yii::t('app', 'Seo Description'),	
			'avatar' => Yii::t('app','avatar'),
			'status' => Yii::t('app', 'status'),
			'use' => Yii::t('app', 'Used'),
			'type' => Yii::t('app', 'r_type'),
		];
	}
	public function rules()
	{
		return [
				[['name', 'description'], 'trim'],
				[['avatar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],				
		];
	}
	public function scenarios()
	{
		return [
				'create' => ['name', 'description','content','seo_title','seo_description'],
				'create_slide' => ['name', 'description','status','use','type'],
		];
	}

	public function upload()
	{
		if ($this->validate()) {			
			$this->avatar->saveAs('upload/slide/' . $this->avatar->baseName . '.' . $this->avatar->extension);
			return true;
		} else {
			return false;
		}
	}
	
}