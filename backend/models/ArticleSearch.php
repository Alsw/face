<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'categoryId', 'publishedTime', 'hits', 'promoted', 'postNum', 'upsNum', 'userId', 'createdTime', 'updatedTime'], 'integer'],
            [['title', 'tagIds', 'source', 'sourceUrl', 'body', 'thumb', 'originalThumb','status'], 'safe'],
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
        $query = Article::find();

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
            'categoryId' => $this->categoryId,
            'publishedTime' => $this->publishedTime,
            'hits' => $this->hits,
            'promoted' => $this->promoted,
            'postNum' => $this->postNum,
            'upsNum' => $this->upsNum,
            'userId' => $this->userId,
            'createdTime' => $this->createdTime,
            'updatedTime' => $this->updatedTime,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'tagIds', $this->tagIds])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'sourceUrl', $this->sourceUrl])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'originalThumb', $this->originalThumb])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
