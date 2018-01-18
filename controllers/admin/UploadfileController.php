<?php
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use app\models\admin\Uploadfile;
use yii\web\UploadedFile;

class UploadfileController extends MyController
{
    public function actionUpload()
    {
        $model = new UploadFile();

        if (Yii::$app->request->isPost) {
            $model->avatar = UploadedFile::getInstance($model, 'avatar');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }
}
?>