<?php
namespace common\models;
class Product extends MyActiveRecord
{
    public static $types = [
        'tour'=>['id'=>1, 'name'=>'Private tour', 'alias'=>'tour'],
        'vpctour'=>['id'=>2, 'name'=>'VPC tour', 'alias'=>'vpctour'],
        'tcgtour'=>['id'=>3, 'name'=>'TCG tour', 'alias'=>'tcgtour'],
    ];
    
    public static function tableName() {
        return '{{%ct}}';
    }
    public function rules() {
        return [
            [['title', 'about', 'intro', 'conditions', 'others', 'summary', 'image', 'prices', 'price', 'price_unit', 'price_for', 'price_from', 'price_until', 'tags', 'client_ref'], 'trim'],
            [['offer_type', 'language', 'title', 'about', 'pax', 'day_from', 'price_unit', 'price_for', 'price_from', 'price_until'], 'required', 'message'=>'Required'],
            [['pax'], 'integer', 'min'=>0],
            [['price'], 'number', 'min'=>0],
            [['price'], 'default', 'value'=>0],
            [['day_from', 'price_from', 'price_until'], 'date', 'format'=>'Y-m-d', 'message'=>'Date must be of "yyyy-mm-dd" format'],
            [['op_code'], 'unique'],
            [['op_code', 'op_name'], 'required'],
        ];
    }
    public function scenarios() {
        return [
            'product/c/prod'=>['title', 'about', 'language', 'pax', 'intro', 'conditions', 'others', 'summary', 'image', 'prices', 'price', 'price_unit', 'price_for', 'price_until', 'promo', 'tags'],
            'product/u/prod'=>['title', 'about', 'language', 'pax', 'intro', 'conditions', 'others', 'summary', 'image', 'prices', 'price', 'price_unit', 'price_for', 'price_until', 'promo', 'tags'],
            'products_c'=>['title', 'about', 'offer_type', 'language', 'pax', 'day_from', 'intro', 'conditions', 'others', 'summary', 'image', 'prices', 'price', 'price_unit', 'price_for', 'price_from', 'price_until', 'promo', 'tags'],
            'products_u'=>['title', 'about', 'offer_type', 'language', 'pax', 'day_from', 'intro', 'conditions', 'others', 'summary', 'image', 'prices', 'price', 'price_unit', 'price_for', 'price_from', 'price_until', 'promo', 'tags'],
            'product/pt'=>['prices', 'price', 'price_unit', 'price_for', 'price_from', 'price_until'],
            'product/copy'=>['title', 'summary'],
            'products_u-op'=>['op_code', 'op_name'],
            'product/ref'=>['client_ref'],
        ];
    }
    public function getCreatedBy()
    {
        return $this->hasOne(User2::className(), ['id'=>'created_by']);
    }
    public function getUpdatedBy()
    {
        return $this->hasOne(User2::className(), ['id'=>'updated_by']);
    }
    public function getIncidents()
    {
        return $this->hasMany(Incident::className(), ['tour_id'=>'id']);
    }
    public function getComplaints()
    {
        return $this->hasMany(Complaint::className(), ['tour_id'=>'id']);
    }
    public function getServicesPlus()
    {
        return $this->hasMany(ServicePlus::className(), ['tour_id'=>'id']);
    }
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['product_id'=>'id']);
    }
    public function getDays()
    {
        return $this->hasMany(Day::className(), ['rid'=>'id']);
    }
    public function getPax()
    {
        return $this->hasMany(Pax::className(), ['tour_id'=>'id']);
    }
    public function getNodes()
    {
        return $this->hasMany(Node::className(), ['rid'=>'id'])->andWhere(['rtype'=>'product']);
    }
    public function getTournotes()
    {
        return $this->hasMany(Tournote::className(), ['product_id'=>'id']);
    }
    public function getTourStats() {
        return $this->hasOne(TourStats::className(), ['tour_id' => 'id']);
    }
    public function getTour()
    {
        return $this->hasOne(Tour::className(), ['ct_id'=>'id']);
    }
    public function getGuides()
    {
        return $this->hasMany(TourGuide2::className(), ['tour_id'=>'id']);
    }
    public function getMetas()
    {
        return $this->hasMany(Meta::className(), ['rid'=>'id'])->andWhere(['rtype'=>'product']);
    }
}
