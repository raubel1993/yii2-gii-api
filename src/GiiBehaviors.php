<?php

namespace rguerral\gii;


class GiiBehaviors extends \yii\base\Behavior
{
    public $generators = [
        'model' => [
            'class' => \yii\gii\generators\model\Generator::class,
            'templates' => [ //setting for out templates
                'default' => '@rguerral/gii/generators/model/api-rest', // template name => path to template
            ]
        ],
        'crud' => [
            'class' => 'yii\gii\generators\crud\Generator',
        ],
        'controller' => [
            'class' => \rguerral\gii\generators\controller\Generator::class,
            'baseClass' => 'yii\rest\Controller',
            'actions' => '',
            'templates' => [ //setting for out templates
                'default' => '@rguerral/gii/generators/controller/api-rest', // template name => path to template
            ]
        ],
        'form' => [
            'class' => 'yii\gii\generators\form\Generator'
        ],
        'module' => [
            'class' => 'yii\gii\generators\module\Generator'
        ],
        'extension' => [
            'class' => 'yii\gii\generators\extension\Generator'
        ],
    ];
    public function events()
    {
        return [
            \yii\gii\Module::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }
    public function beforeAction($event)
    {
        $this->owner->generators = $this->generators;
    }
}
