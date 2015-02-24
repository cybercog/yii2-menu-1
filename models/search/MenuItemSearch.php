<?php

namespace fonclub\menu\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use fonclub\menu\models\MenuItem;

/**
 * Class MenuItemSearch
 * @package fonclub\menu\models\search
 */
class MenuItemSearch extends MenuItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'menu_type_id', 'parent_id'], 'integer'],
            [['url', 'status'], 'safe'],
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
        $query = MenuItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // multilang
        $titleField = 'title_'.Yii::$app->language;
        $dataProvider->sort->attributes[$titleField] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
        ];

        $query->joinWith(['items']);
        $query->andFilterWhere(['like', 'title', $this->{$titleField}]);
        $query->andFilterWhere(['like', 'locale', Yii::$app->language]);
        // multilang

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'menu_type_id' => $this->menu_type_id,
            'parent_id' => $this->parent_id,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
