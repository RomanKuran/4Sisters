<?php

namespace app\models;

use DateTime;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "blog"
 *
 * @property int $id
 * @property int $id_category
 * @property int $id_user
 * @property string $title
 * @property string $preView
 * @property string $content
 * @property string $url
 * @property DateTime $date
 * @property string $poster_url
 *
 **/
class Blog extends ActiveRecord {

    public $image;
    public $ignoreAfterSave = false;

    public static function tableName()
    {
        return 'blog';
    }

    public function rules()
    {
        return [
            [['title', 'id_category', 'preView', 'content', 'url'], 'required'],
            [['title'], 'string', 'max' => 150],
            [['preView'], 'string', 'max' => 200],
            [['content'], 'string'],
            [['url'], 'string', 'max' => 150],
            [['id_category'], 'integer'],
            [['id_user'], 'integer'],
            [['poster_url'], 'string', 'max' => 200],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_category' => 'Категория',
            'id_user' => 'Пользователь',
            'title' => 'Заглавие',
            'preView' => 'Краткое описание',
            'content' => 'Текст',
            'date' => 'Дата',
            'url' => 'Url',
            'poster_url' => 'Титульная картинка',
            'image' => 'Титульная картинка'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category'])->one();
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user'])->one();
    }

    public function beforeSave($insert)
    {
        if ($this->ignoreAfterSave == true) {
            parent::beforeSave($insert);
            return true;
        }
        $path = Yii::getAlias('@web') . 'blogs/';

//        Пробігаюсь по контенту і шукаю фотки
        preg_match_all('/img src=\"(\w.+?)\"/', $this->content, $find_content_images);
        $title_image = UploadedFile::getInstance($this, 'image');
        $images_in_content = $find_content_images[1];

        if ($title_image || $images_in_content) {

            $folders = FileHelper::findFiles($path);
            $folder_find = false;

            foreach ($folders as $folder) {
                if ($_SESSION['BLOG_MODE'] == 'EDIT' && $folder == $this->id) {
                    $folder_find = true;
                    break;
                } else {
                    if ($_SESSION['BLOG_MODE'] == 'CREATE' && $folder == $_SESSION['TMP_FOLDER']) {
                        $folder_find = true;
                        break;
                    }
                }
            }

            if ($title_image != null && $folder_find == false ||
                $images_in_content != null && $folder_find == false ||
                $title_image != null && $images_in_content != null && $folder_find == false) {

                if ($_SESSION['TMP_FOLDER'] == null)
                    $_SESSION['TMP_FOLDER'] = 'tmp_' . rand(10000, 1000000);

                if ($_SESSION['BLOG_MODE'] == 'EDIT')
                    $path .= $this->id;
                else {
                    if ($_SESSION['BLOG_MODE'] == 'CREATE')
                        $path .= $_SESSION['TMP_FOLDER'];
                }

                try {
                    FileHelper::createDirectory($path, 0777, true);
                } catch (Exception $e) { }
            } else {
                if ($_SESSION['BLOG_MODE'] == 'EDIT')
                    $path .= $this->id;
                else {
                    if ($_SESSION['BLOG_MODE'] == 'CREATE')
                        $path .= $_SESSION['TMP_FOLDER'];
                }
            }

            $files = FileHelper::findFiles($path);

//            видаляю з контенту фотки, які є в папці, але немає в контенті
            if ($images_in_content) {
                $find = true;

                for ($i = 0; $i < count($files); $i++) {
                    for ($j = 0; $j < count($images_in_content); $j++) {
                        if (pathinfo($files[$i], PATHINFO_BASENAME) ==
                            pathinfo($images_in_content[$j], PATHINFO_BASENAME)) {
                            $find = true;
                            break;
                        } else
                            $find = false;
                    }

                    if ($find == false)
                        FileHelper::unlink($files[$i]);
                }
            }

            if ($title_image) { // || $this->poster_url
//                Перевіряю існуючу титулку, якщо вона є і користувач змінив її, то стару видаляю
                if ($this->poster_url != null) {
                    foreach ($files as $file) {
                        if (pathinfo($file, PATHINFO_BASENAME) ==
                            pathinfo($this->poster_url, PATHINFO_BASENAME)) {
                            $path_delete_file = Yii::getAlias('@web') . pathinfo($file, PATHINFO_DIRNAME) . '/' .
                                pathinfo($file, PATHINFO_BASENAME);

                            FileHelper::unlink($path_delete_file);
                            break;
                        }
                    }
                }

                switch ($_SESSION['BLOG_MODE']) {
                    case "EDIT":
                        $this->poster_url = '/blogs/' . $this->id . '/' . $title_image->name;
                        break;
                    case "CREATE":
                        $this->poster_url = '/blogs/' . $_SESSION['TMP_FOLDER'] . '/' . $title_image->name;
                        break;
                }

                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web';
                $path = Yii::$app->params['uploadPath'] . $this->poster_url;

                $title_image->saveAs($path);
            }
        } else {

            if (empty($images_in_content) && (empty($title_image) && empty($this->poster_url)))
                $this->removeDirectory($path . '/'.$this->id);
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->ignoreAfterSave == true) {
            parent::afterSave($insert, $changedAttributes);
            return;
        }

        $path = Yii::getAlias('@web') . 'blogs/' . $this->id;

//        Пробігаюсь по контенту і шукаю фотки
        preg_match_all('/img src=\"(\w.+?)\"/', $this->content, $find_content_images);
        $images_in_content = $find_content_images[1];
        $tmp_folder = $_SESSION['TMP_FOLDER'];
        $old_path = Yii::getAlias('@web') . 'blogs/' . $tmp_folder;

        if ($_SESSION['TMP_FOLDER'] != null)
            $this->content = preg_replace('/' . $_SESSION['TMP_FOLDER'] . '/', $this->id, $this->content);

        $new_poster_url = str_replace($_SESSION['TMP_FOLDER'], $this->id, $this->poster_url);
        $this->poster_url = $new_poster_url;
        $this->ignoreAfterSave = true;

        $this->save();
        Yii::$app->db->createCommand()
            ->update('blog', ['poster_url' => $new_poster_url], 'id = ' . $this->id)
            ->execute();

        if (empty($images_in_content) && empty($this->poster_url))
            $this->removeDirectory($path);

        try {
            rename($old_path, $path);
        } catch (\Exception $e) { }

//        Знімаю тег тимчасової папки
        if (isset($_SESSION['TMP_FOLDER']))
            unset($_SESSION['TMP_FOLDER']);

        if (isset($_SESSION['BLOG_MODE']))
            unset($_SESSION['BLOG_MODE']);

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    private function removeDirectory($path)
    {
        $files = glob($path . '/*');

        foreach ($files as $file) {
            is_dir($file) ? $this->removeDirectory($file) : unlink($file);
        }

        if (file_exists($path)) rmdir($path);
        return;
    }

}
