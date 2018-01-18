<?php
namespace app\models\admin;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class Uploadfile extends Model
{
    public $avatar;

    public function rules()
	{
		return [
			[['avatar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
		];
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->avatar->saveAs('upload/' . $this->avatar->baseName . '.' . $this->avatar->extension);
            return true;
        } else {
            return false;
        }
    }
}