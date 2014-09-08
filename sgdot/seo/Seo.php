<?php 

namespace sgdot\seo;

use yii\base\Widget;
use yii\helpers\Url;
use yii\helpers\Html;
use Yii;

class Seo extends Widget {
    public $modelClass;
    
    public function run() {
        parent::run();
        /* @var $view \yii\web\View */
        $view = \Yii::$app->getView();
        $seo = $this->getSeo();
        if (is_null($seo)) {
            echo Html::tag('title', $view->title) . PHP_EOL;
        } else {
            echo Html::tag('title', $seo->title) . PHP_EOL;
            $view->registerMetaTag([
                'name' => 'keywords',
                'content' => $seo->keywords,
            ]);
            $view->registerMetaTag([
                'name' => 'description',
                'content' => $seo->description,
            ]);
        }
    }
    public function getSeo() {
        /* @var $request yii\web\Request */
        $request = Yii::$app->request;
        $host = $request->hostInfo;
        $currentUrl = strtr(Url::canonical(), [$host => '']);
        $class = $this->modelClass;
        return $class::findOne(['url' => $currentUrl]);
    }
}
