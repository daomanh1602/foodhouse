<?php

namespace common\models;

use Yii;
use yii\base\Model;


class TestForm extends Model{
	public $fname, $lname, $bday,
	$phone_num , $address, $gender,$email
	;
	
	public function attributeLabels()
	{
		return [
				'fname' => 'First name',
				'lname' => 'Last name',
				'bday'  => 'Birthday',
				'phone_num' => 'Phone number',
				'address' => 'Address',
				'gender' => 'Gender',
				'email' => 'Email',
				
 		];
	}
	
	public function rules()
	{
		return [
				[[
						'fname', 'lname', 'bday',
						'phone_num', 'address', 'gender','email',
				], 'trim'],
				[[
						'fname', 'lname', 'bday',
						'phone_num', 'address', 'gender','email'
				],'required'],

		];
	}
}
