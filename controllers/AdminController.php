<?php

namespace app\controllers;

use Yii;
use app\models\Contacts;
use app\models\Gallery;
use app\models\Services;
use app\models\Social;
use app\models\History;
use app\models\Partners;
use app\models\RegisterForm;
use app\models\Settings;
use app\models\User;
use app\models\UploadForm;
use app\models\Work;
use app\models\WorkDescr;
use yii\helpers\FileHelper;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\UploadedFile;


class AdminController extends Controller
{
    public $layout = "admin_layout";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }


// *********************************************    Settings Section        ************************************************

    public function actionSettings()
    {
        $model = Settings::find()->orderBy(['id' => SORT_DESC])->one();

        if (!$model)
            $model = new Settings();

        return $this->render('editSettings', compact('model'));
    }

    public function actionSettingsUpdate()
    {
        $model = Settings::find()->orderBy(['id' => SORT_DESC])->one();

        if (!$model)
            $model = new Settings();

        if ($model->load(Yii::$app->request->post())) {
            $photo = UploadedFile::getInstance($model, 'image');

            if ($photo != null) {
                $rand = rand(0, 9999);
                $newName = $rand . date("Y_m_d") . '.' . $photo->name;

                $model->url_image = '/images/' . $newName;

                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web';
                $path = Yii::$app->params['uploadPath'] . $model->url_image;
                $photo->saveAs($path);
                $model->name_image = $newName;
            }

            $model->save(false);
        }
        return $this->render('editSettings', compact('model'));
    }

// *********************************************    Gallery Section        ************************************************

    public function actionGallery()
    {
        if(empty($_GET["id"]))
            $_GET["id"] = '2';

        $query = Gallery::find()->orderBy(['id' => SORT_DESC])->where('id_category = '.$_GET["id"]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 12]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('editGallery', compact('models', 'pages'));
    }

    public function actionGalleryUpload($id)
    {

        $model = new Gallery();
        
        if ($model->load(Yii::$app->request->post())) {
            $photo = UploadedFile::getInstance($model, 'image');

            if ( $photo != null ) {
                $rand = rand(0, 9999);
                $newName = $rand . date("Y_m_d") . '.' . $photo->extension;
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web';
                $path = 'images/gallery/'. $id . '/' . $newName;
                $photo->saveAs($path);

                $model->url_image = $path;
                $model->name = $newName;
                $model->id_category = $id;
            }

            $model->save(false);
        }
        
        return $this->render('upload', compact('model'));
    }

    public function actionGalleryDelete()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $pic = Yii::$app->request->post()['photoUrl'];
        $image = Gallery::find()->where(['url_image' => $pic])->one();

        if ($image->delete() & unlink($pic)) {
            return ['status'=> 'ok'];
        } else {
            return ['status'=> 'no'];
        }
    }

// *********************************************    Social Section        ************************************************

    public function actionSocial()
    {
        $model = Social::find()->orderBy(['id' => SORT_DESC])->one();

        if (!$model)
            $model = new Social();

        return $this->render('editSocial', compact('model'));
    }

    public function actionSocialUpdate()
    {
        $model = Social::find()->orderBy(['id' => SORT_DESC])->one();

        if (!$model)
            $model = new Social();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->save();
        }

        return $this->render('editSocial', compact('model'));
    }

// *********************************************    Cotacts Section        ************************************************

    public function actionContacts()
    {
        $model = Contacts::find()->orderBy(['id' => SORT_DESC])->one();

        if (!$model)
            $model = new Contacts();

        return $this->render('editContacts', compact('model'));
    }

    public function actionContactsUpdate()
    {
        $model = Contacts::find()->orderBy(['id' => SORT_DESC])->one();

        if (!$model)
            $model = new Contacts();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->save();
        }

        return $this->render('editContacts', compact('model'));
    }

// *********************************************    Services Section        ************************************************

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => Services::find(), 'pagination' => ['pageSize' => 10]]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionUpdate($id)
    {
        $model = new Services();

        if (Yii::$app->request->isGet) {
            $model = Services::findOne(['id' => $id]);//Yii::$app->request->get('id')
            return $this->render('editService', ['model' => $model]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model_ = Services::findOne(Yii::$app->request->post('Services')['id']);
            $image  = UploadedFile::getInstance($model, 'image');

            if ($image == null) {
                $model_->img_banner = $model->img_banner;
                $model_->title      = $model->title;
                $model_->content    = $model->content;

                if ($model_->save()) {
                    $dataProvider = new ActiveDataProvider(['query' => Services::find(), 'pagination' => ['pageSize' => 10]]);
                    return $this->redirect(['index', 'dataProvider' => $dataProvider]);
                }

            } else {
                $model_->img_banner = '/images/' . $image->name;
                $model_->title      = $model->title;
                $model_->content    = $model->content;

                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web';
                $path = Yii::$app->params['uploadPath'] . $model_->img_banner;

                if ($model_->save()) {
                    $image->saveAs($path);
                    $dataProvider = new ActiveDataProvider(['query' => Services::find(), 'pagination' => ['pageSize' => 10]]);
                    return $this->redirect(['index', 'dataProvider' => $dataProvider]);

                } else {
                    // store the source file name
                    $model_->img_banner = '/images/' . $image->name;
                    $model_->title = $model->title;
                    $model_->content = $model->content;


                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                    Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web';
                    $path = Yii::$app->params['uploadPath'] . $model_->img_banner;

                    if ($model_->save()) {
                        $image->saveAs($path);
                        $dataProvider = new ActiveDataProvider(['query' => Services::find(), 'pagination' => ['pageSize' => 10]]);
                        return $this->redirect(['index', 'dataProvider' => $dataProvider]);
                    } else {
                        // error in saving model
                    }
                }
            }


            return $this->render('editService', ['model' => $model]);
        }
    }

    // *********************************************     Partners Section        ************************************************

    public function actionPartners()
    {
        $dataProvider = new ActiveDataProvider(['query' => Partners::find(), 'pagination' => ['pageSize' => 10]]);
        return $this->render('partners', ['dataProvider' => $dataProvider]);
    }

    public function actionPartnersUpdate()
    {
        $model = new Partners();

        if (Yii::$app->request->isGet) {
            if (Yii::$app->request->get('id') != null) {
                $header = 'Редактирование данных партнёра';
                $model = Partners::findOne(['id' => Yii::$app->request->get('id')]);
                return $this->render('editPartners', compact('model', 'header'));
            } else {
                $header = 'Новый партнёр';
                return $this->render('editPartners', compact('model', 'header'));
            }
        }

        if ($model->load(Yii::$app->request->post())) {

            if (Yii::$app->request->post('Partners')['id'] != '') {
                $model_ = Partners::findOne(Yii::$app->request->post('Partners')['id']);
                $image_ = UploadedFile::getInstance($model, 'image_');

                if ($image_ == null) {
                    $model_->image = $model->image;
                    $model_->link = $model->link;
                    $model_->name = $model->name;

                    if ($model_->save()) {
                        $dataProvider = new ActiveDataProvider(['query' => Partners::find(), 'pagination' => ['pageSize' => 10]]);
                        return $this->redirect(['partners', 'dataProvider' => $dataProvider]);
                    }
                } else {
                    $model_->image = '/images/' . $image_->name;
                    $model_->link = $model->link;
                    $model_->name = $model->name;

                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                    Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web';
                    $path = Yii::$app->params['uploadPath'] . $model_->image;

                    if ($model_->save()) {
                        $image_->saveAs($path);
                        $dataProvider = new ActiveDataProvider(['query' => Partners::find(), 'pagination' => ['pageSize' => 10]]);
                        return $this->redirect(['partners', 'dataProvider' => $dataProvider]);
                    } else {
                        // error in saving model
                    }
                }
            } else {
                $image_ = UploadedFile::getInstance($model, 'image_');
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/images/';

                $path = Yii::$app->params['uploadPath'] . $image_->name;
                $model->image = '/images/' . $image_->name;

                if ($model->save()) {
                    if ($image_)
                        $image_->saveAs($path);
                    $dataProvider = new ActiveDataProvider(['query' => Partners::find(), 'pagination' => ['pageSize' => 10]]);
                    return $this->redirect(['partners', 'dataProvider' => $dataProvider]);
                } else {
                    // error in saving model
                }
            }
        }
    }

    public function actionPartnersDelete($id)
    {
        $model = Partners::findOne($id);
        $path = Yii::getAlias('@web') . $model->image;

        if (file_exists($path))
            FileHelper::unlink($path);

        $model->delete();
        $dataProvider = new ActiveDataProvider(['query' => Partners::find(), 'pagination' => ['pageSize' => 10]]);

        return $this->render('partners', ['dataProvider' => $dataProvider]);
    }

    // *********************************************     Work Section        ************************************************

    public function actionWork() {
        $dataProvider = new ActiveDataProvider(['query' => Work::find(), 'pagination' => ['pageSize' => 10]]);
        return $this->render('work', ['dataProvider' => $dataProvider]);
    }

    public function actionWorkUpdate($id) {
        if (Yii::$app->request->isGet) {
            $workModel = Work::findOne($id);

            if(!$workModel)
                return $this->goBack();

            $descriptionsProvider = new ActiveDataProvider(['query' => WorkDescr::find()->where(['work_id' => $id]), 'pagination' => ['pageSize' => 10]]);
            $wdModel = new WorkDescr();

            return $this->render('editWork', compact('workModel', 'wdModel', 'descriptionsProvider'));
        }
    }

    public function actionSaveWorkInDb($id) {
        $model = Work::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->header = Yii::$app->request->post('Work')['header'];
            $model->save();
            return $this->redirect(['/admin/work-update', 'id'=> $model->id]);
        }
    }

    public function actionAddDescription(int $id) {
        $model = Work::findOne($id);

        if(!$model)
            return $this->goBack();

        $wd = new WorkDescr();
        if($wd->load(Yii::$app->request->post()) && $wd->validate()) {
            $wd->work_id = $id;

            $wd->save();
        }
        return $this->redirect(['/admin/work-update', 'id'=> $id]);
    }

    public function actionWorkDelete($id) {
        $model = Work::findOne($id);
        $model->delete();
        $dataProvider = new ActiveDataProvider(['query' => Work::find(), 'pagination' => ['pageSize' => 10]]);
        return $this->render('work', ['dataProvider' => $dataProvider]);
    }

    public function actionWorkDescriptionUpdate($id) {
//        $this->view->title = 'Блог';
        $model = WorkDescr::findOne($id);
        return $this->render('editWorkDescription', compact('model', 'id'));
    }

    public function actionWorkDescriptionSaveInDb($id) {
        if (Yii::$app->request->isPost) {
            $model = WorkDescr::findOne($id);
            $model->description = Yii::$app->request->post('WorkDescr')['description'];

            $model->save();
            $workModel = Work::findOne($model->work_id);
            $descriptionsProvider = new ActiveDataProvider(['query' => WorkDescr::find()->where(['work_id' => $id]), 'pagination' => ['pageSize' => 10]]);
            $wdModel = new WorkDescr();
            return $this->render('editWork', compact('workModel', 'wdModel', 'descriptionsProvider'));
        }
    }

    public function actionWorkDescriptionDelete($id) {
        $modelWork = WorkDescr::findOne($id);

        if($modelWork)
            $modelWork->delete();

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    // *********************************************     User Section        ************************************************

    public function actionUser()
    {
        $dataProvider = new ActiveDataProvider(['query' => User::find(), 'pagination' => ['pageSize' => 10]]);
        return $this->render('user', ['dataProvider' => $dataProvider]);
    }

    public function actionUserCreate()
    {
        $model = new RegisterForm();
        $user = new User();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $user->username = $model->username;
            $user->password = md5($model->password);

            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Пользователь успешно создан!');
                return $this->redirect('/admin/user');
            }
        }

        return $this->render('createUser', compact('model'));
    }

    public function actionUserDelete($id)
    {
        $model = User::findOne($id);
        $model->delete();
        $dataProvider = new ActiveDataProvider(['query' => User::find(), 'pagination' => ['pageSize' => 10]]);
        return $this->render('user', ['dataProvider' => $dataProvider]);
    }

    public function actionUserUpdate($id)
    {
        $model = new RegisterForm();
        $user = User::findOne($id);

        if ($model->load(\Yii::$app->request->post()) ) {
            $user->password = md5($model->password);
            if ($user->save()) {

                Yii::$app->session->setFlash('success', 'Пароль успешно изменён!');
                return $this->redirect('/admin/user');
            }
        }

        $model->username = $user->username;
        return $this->render('editUser', compact('model', 'id'));
    }

    // *********************************************     History Section     ************************************************

    public function actionHistory() {
        $id = 1;
        $model = History::findOne($id);


        if (!$model) {
            $model = new History();
            return $this->render('history', compact('model', 'id'));
        }
        else {
            return $this->render('history', compact('model', 'id'));
        }
    }

    public function actionHistoryUpdate($id) {
        $model = History::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('success', 'Ваша история успешно обновлена!');

            return $this->redirect('/admin/history');
        }
    }

}
