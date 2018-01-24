<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "document_data".
 *
 * @property integer $id
 * @property string $code_number
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $sender
 * @property string $receiver
 * @property string $reception_room
 * @property string $issuing_room
 * @property integer $type_doc
 * @property integer $style_doc
 * @property string $send_at
 * @property string $recep_at
 * @property string $start_at
 * @property string $end_at
 * @property string $sign_at
 * @property string $review_at
 * @property integer $review_by
 * @property string $file_upload
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class DocumentData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_doc', 'style_doc', 'created_by', 'updated_by'], 'integer'],
            [['content'], 'string'],
            [['send_at', 'recep_at', 'start_at', 'end_at', 'sign_at', 'review_at', 'created_at', 'updated_at'], 'safe'],
            [['code_number', 'title', 'review_by', 'description', 'sender', 'receiver', 'reception_room', 'issuing_room', 'file_upload'], 'string', 'max' => 255],
            [['code_number', 'title', 'description', 'sender', 'receiver', 'reception_room', 'issuing_room', 'file_upload'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code_number' => Yii::t('app', 'Code number'),
            'title' => Yii::t('app', 'Name document'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'sender' => Yii::t('app', 'Send from'),
            'receiver' => Yii::t('app', 'Send to'),
            'reception_room' => Yii::t('app', 'Room reception'),
            'issuing_room' => Yii::t('app', 'Room issuing'),
            'type_doc' => Yii::t('app', 'Type of document'),
            'style_doc' => Yii::t('app', 'Style of document'),
            'send_at' => Yii::t('app', 'Send at'),
            'recep_at' => Yii::t('app', 'Day of receipt'),
            'start_at' => Yii::t('app', 'Effective date'),
            'end_at' => Yii::t('app', 'Expiry date'),          
            'review_at' => Yii::t('app', 'Day of approval'),
            'review_by' => Yii::t('app', 'aAproved by'),
            'file_upload' => Yii::t('app', 'File Upload'),
            'created_at' => Yii::t('app', 'Created at'),
            'created_by' => Yii::t('app', 'Created by'),
            'updated_at' => Yii::t('app', 'Updated at'),
            'updated_by' => Yii::t('app', 'Updated by'),
        ];
    }
    
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id'=>'updated_by']);
    }
    
}
