<?php

namespace app\controllers;

use app\models\History;
use Yii;
use app\models\Services;
use app\models\Blog;
use app\models\Contacts;
use app\models\Social;
use app\models\Team;
use app\models\Partners;
use app\models\Work;
use app\models\WorkDescr;
use yii\web\Controller;
use app\models\Gallery;
use app\models\Settings;

class DevController extends Controller
{
    public $layout = "custom";

    public function actionIndex()
    {
        $model                  = Services::find()->all();
        $modelTeam              = Team::find()->all();
        $partners               = Partners::find()->all();
        $modelContacts          = Contacts::find()->orderBy(['id' => SORT_DESC])->one();
        $modelSocial            = Social::find()->orderBy(['id' => SORT_DESC])->one();
        $modelWork              = Work::find()->all();
        $modelWorkDescr         = WorkDescr::find()->all();
        $modelGalleryDesign     = Gallery::find()->where(['id_category'=>2])->all();
        $modelGalleryArt        = Gallery::find()->where(['id_category'=>3])->all();
        $modelGalleryFurniture  = Gallery::find()->where(['id_category'=>4])->all();
        $modelBlog              = Blog::find()->where(['id_category' => 1])->limit(3)->orderBy('date')->all();
        $modelHistory           = History::findOne(1);

        Yii::$app->view->params['modelSettings'] = Settings::find()->orderBy(['id' => SORT_DESC])->one();

        $params = compact('model', 'modelTeam', 'modelContacts', 'modelSocial',
            'partners', 'modelWork', 'modelWorkDescr', 'modelGalleryDesign',
            'modelGalleryArt', 'modelGalleryFurniture','modelBlog', 'modelHistory');

        return $this->render('index', $params);
    }

    public function actionDevelopers()
    {
        return $this->render('developers_team');
    }

    public function actionBlogCategory()
    {
        $id = Yii::$app->request->get('id');
        $model = Blog::find()->where(['id_category' => $id])->orderBy('date')->all();//->limit(3)

        $html = $this->renderPartial('blog_partial', ['model' => $model]);
        $btnMoreBlogs = $this->renderPartial('blog_btn_more', ['model' => $model]);

        return $this->asJson(['blogRow' => $html, 'moreBlogs' => $btnMoreBlogs]);
    }

    public function actionBlogOpen()
    {
        $id = Yii::$app->request->get('id');
        $model = Blog::findOne(['id' => $id]);

        return $this->renderPartial('openBlog', compact('model'));
    }

    public function actionMoreBlogs()
    {
        $id = Yii::$app->request->get('id');
        $offset = Yii::$app->request->get('offset');
        $model = Blog::find()->where(['id_category' => $id])->offset($offset)->orderBy('date')->all();

        return $this->renderPartial('moreBlogs', compact('model'));
    }

}
