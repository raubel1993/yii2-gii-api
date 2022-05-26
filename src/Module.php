<?php

namespace rguerral\gii;

class Module extends \yii\gii\Module
{
    protected function coreGenerators()
    {
        return [
            'model' => ['class' => 'yii\gii\generators\model\Generator'],
            'crud' => ['class' => 'yii\gii\generators\crud\Generator'],
            'controller' => ['class' => 'yii\gii\generators\controller\Generator'],
            'form' => ['class' => 'yii\gii\generators\form\Generator'],
            'module' => ['class' => 'yii\gii\generators\module\Generator'],
            'extension' => ['class' => 'yii\gii\generators\extension\Generator'],
            'model' => [
                'class' => 'yii\gii\generators\model\Generator',
                'templates' => [ //setting for out templates
                    'default' => '@generators/model/api-rest', // template name => path to template
                ]
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                /*'templates' => [ //setting for out templates
                    'myCrud' => '@app/template/crud/default', // template name => path to template
                ]*/
            ],
            'controller' => [
                'class' => 'generators\controller\Generator',
                'baseClass' => 'yii\rest\Controller',
                'actions' => '',
                'templates' => [ //setting for out templates
                    'default' => '@generators/controller/api-rest', // template name => path to template
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
