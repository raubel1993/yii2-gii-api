<?php

namespace rguerral\gii;

class Module extends \yii\gii\Module
{
    protected function coreGenerators()
    {
        return [
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [ //setting for out templates
                    'default' => '@rguerral/api/model/api-rest', // template name => path to template
                ]
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
            ],
            'controller' => [
                'class' => 'rguerral\api\controller\Generator',
                'baseClass' => 'yii\rest\Controller',
                'actions' => '',
                'templates' => [ //setting for out templates
                    'default' => '@rguerral/api/controller/api-rest', // template name => path to template
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
    }
}
