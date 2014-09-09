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
        
        $seo = $this->getSeo();
        if (is_null($seo)) {
            echo Html::tag('title', $view->title) . PHP_EOL;
        } else {
            echo Html::tag('title', $seo->title) . PHP_EOL;
            $this->registerMetaTag('keywords', $seo->keywords);
            $this->registerMetaTag('description', $seo->description);
            $view->registerLinkTag('image_src', $seo->image_src);
        }
    }
    
    public function registerMegaTag($name, $content) {
        if(!empty($content)) {
            /* @var $view \yii\web\View */
            $view = \Yii::$app->getView();
            $view->registerMetaTag([
                'name' => $name,
                'content' => $content,
            ]);
        }
    }
    
    public function registerLinkTag($rel, $href) {
        if(!empty($href)) {
            /* @var $view \yii\web\View */
            $view = \Yii::$app->getView();
            $view->registerLinkTag([
                'rel'=>$rel,
                'href'=>$href,
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
