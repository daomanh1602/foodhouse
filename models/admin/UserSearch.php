<?php
 
namespace app\models\admin;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\admin\User;

class UserSearch extends User
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
				[['id'], 'integer'],
				[['first_name', 'last_name', 'phone_number', 'username', 'email', 'password', 'authKey', 'password_reset_token', 'user_image', 'user_level'], 'safe'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}
	
	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = User::find();
		
		$dataProvider = new ActiveDataProvider([
				'query' => $query,
		]);
		
		$this->load($params);
		
		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}
		
		$query->andFilterWhere([
				'id' => $this->id,
		]);
		
		$query->andFilterWhere(['like', 'username', $this->username])
		->andFilterWhere(['like', 'password', $this->password])
		->andFilterWhere(['like', 'authKey', $this->authKey]);
		
		return $dataProvider;
	}
}