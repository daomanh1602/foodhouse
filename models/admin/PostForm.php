<?php
namespace app\models\admin;

use yii\base\Model;
use yii\web\UploadedFile;

class PostForm extends Model{
	public $name;
	public $description;
	public $content;
	public $tag;	
	public $cate_id;	
	public $avatar;
	public $slug;
	public $seo_title;
	public $seo_description;
	
	public function attributeLabels()
	{
		return [
				'name' => "Title",
				'description' => "Description",
				'content' => "Content",
				'tag' => "Tag",
				'cate_id' => "Category"	,
				'avatar' => "avatar",
				'seo_title' => "Seo title",
				'seo_description' => "Seo description",
		];
	}
	
	public function rules()
	{
		return [
				[['name','content'], 'trim'],
				[['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
		];
	}
	
	public function scenarios()
	{
		return [
			'create' => ['name', 'description','content','cate_id','seo_title','seo_description'],
		];
	}
	
	public function upload()
	{
		if ($this->validate()) {		
			$this->avatar->saveAs('upload/post/' . $this->avatar->baseName . '.' . $this->avatar->extension);
			return true;
		} else {
			return false;
		}
	}
}