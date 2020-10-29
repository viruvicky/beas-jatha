<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Jatha;

/**
 * JathaSearch represents the model behind the search form of `common\models\Jatha`.
 */
class JathaSearch extends Jatha
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'reg_no', 'male', 'female', 'total', 'created_by'], 'integer'],
            [['centre', 'destination', 'from_date', 'to_date', 'created_on','status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Jatha::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'reg_no' => $this->reg_no,
            'male' => $this->male,
            'female' => $this->female,
            'total' => $this->total,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'created_on' => $this->created_on,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'centre', $this->centre])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'destination', $this->destination]);

        return $dataProvider;
    }
}
