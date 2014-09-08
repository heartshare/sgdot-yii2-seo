sgdot-yii2-seo
==============

yii2 seo widget

migrate 
``` php
    public function up() {
        $this->createTable('seo', [
            'id' => 'pk',
            'url' => 'string',
            'title' => 'string',
            'keywords' => 'text',
            'description' => 'text',
            'image_src' => 'string',
        ]);
    }

    public function down() {
        $this->dropTable('seo');
    }
```


use

``` php
echo Seo::widget('modelClass'=>SeoModel::classname());
```
