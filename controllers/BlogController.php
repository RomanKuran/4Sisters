<?php

namespace app\controllers;

use app\models\Blog;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\Controller;

class BlogController extends Controller
{

    public $layout = "admin_layout";

    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Blog::find()->orderBy(['date' => SORT_DESC]),
            'pagination' => ['pageSize' => 10]
        ]);

        $this->view->title = 'Блог';

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreateBlog() {
        $model = new Blog();
        $_SESSION['BLOG_MODE'] = 'CREATE';
        $_SESSION['TMP_FOLDER'] = null;

        $this->view->title = 'Блог';

        return $this->render('createBlog', compact('model'));
    }

    public function actionSaveBlogInDb() {
        $model = new Blog();

//        якщо дані для блогу отримані
        if ($model->load(Yii::$app->request->post())) {
            $model->id_user = Yii::$app->user->id;

//            Валідація пройдена
            if ($model->validate()) {

//                перевірка на унікальність url
                $foundUrl = Blog::find()->where(['url' => $model->url])->one();

                if ($foundUrl) {
                    Yii::$app->session->setFlash('warning', 'Измените, пожалуйста, url!');
                    return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

                } else {
                    if (!empty($_FILES['Blog']['name']['image']))
                        $model->poster_url = Yii::getAlias('@web') . '/blogs/' . $_SESSION['TMP_FOLDER'] . '/' . $_FILES['Blog']['name']['image'];

                    $model->save();

                    Yii::$app->session->setFlash('success', 'Блог \'' . $model->title . '\' успешно создан!');
                    return $this->redirect('index');
                }
            }
        }
    }

    public function actionEditBlog($id) {
        $model = Blog::findOne($id);
        $_SESSION['BLOG_MODE'] = 'EDIT';
        $_SESSION['BLOG_ID'] = $model->id;

        $this->view->title = 'Блог';

        return $this->render('editBlog', compact('model', 'id'));
    }

    public function actionUpdateBlog($id) {
        $model = Blog::findOne($id);

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                $model->save();

                Yii::$app->session->setFlash('success', 'Блог \'' . $model->title . '\' успешно редактирован!');
                return $this->redirect('index');
            }
        }
    }

    public function actionDeleteBlog($id) {
        $model = Blog::findOne($id);
        $path = Yii::getAlias('@web') . 'blogs/' . $model->id;

        $this->removeDirectory($path);
        try {
            $model->delete();
        } catch (StaleObjectException $e) {
        } catch (\Throwable $e) {
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    public function actions() {
        if (!Yii::$app->request->isAjax)
            return;

        if (Yii::$app->session->isActive) {

            $url = 'http://4sisters/blogs/';
            $path = Yii::getAlias('@web') . 'blogs/';

            if ($_SESSION['BLOG_MODE'] == 'CREATE') { //   BLOG_MODE == CREATE
                $url    .= $_SESSION['TMP_FOLDER'] . '/';
                $path   .= $_SESSION['TMP_FOLDER'];

                if ($_SESSION['TMP_FOLDER'] == null) {
                    $_SESSION['TMP_FOLDER'] = 'tmp_' . rand(10000, 1000000);

                    try {
                        FileHelper::createDirectory($path, 0777, true);
                    } catch (Exception $e) { }
                }
            } else { //   BLOG_MODE == EDIT
                if ($_SESSION['BLOG_MODE'] == 'EDIT') {

                    $folders        = FileHelper::findFiles($path);
                    $folder_find    = false;

                    foreach ($folders as $folder) {
                        if ($folder == $_SESSION['BLOG_ID']) {
                            $folder_find = true;
                            break;
                        }
                    }

                    $url    .= $_SESSION['BLOG_ID'] . '/';
                    $path   .= $_SESSION['BLOG_ID'];

                    if ($folder_find == false) {
                        try {
                            FileHelper::createDirectory($path, 0777, true);
                        } catch (Exception $e) { }
                    }
                }
            }

            return [
                'images-get'    => [
                    'class'         => 'vova07\imperavi\actions\GetImagesAction',
                    'url'           => $url,
                    'path'          => $path,
                    'options'       => [
                        'only' => ['*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico']
                    ],
                ],
                'image-upload'  => [
                    'class'         => 'vova07\imperavi\actions\UploadFileAction',
                    'url'           => $url,
                    'path'          => $path,
                    'replace'       => true,
                    'translit'      => true
                ],
                'file-delete'   => [
                    'class'         => 'vova07\imperavi\actions\DeleteFileAction',
                    'url'           => $url,
                    'path'          => $path
                ]
            ];
        }
    }

    private function removeDirectory($path) {
        $files = glob($path . '/*');

        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }

        if (file_exists($path)) rmdir($path);
        return;
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class'     => VerbFilter::className(),
                'actions'   => [
                    'index'                     => ['GET', 'POST'],
                    'create-blog'               => ['GET', 'POST'],
                    'save-blog-in-db'           => ['POST'],
                    'update-blog'               => ['POST'],
                    'images-get'                => ['GET'],
                    'image-upload'              => ['POST'],
                    'file-delete'               => ['POST'],
                    'delete-title-image'        => ['POST']
                ]
            ]
        ];
    }

}

