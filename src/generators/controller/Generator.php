<?php

namespace rguerral\gii\generators\controller;

use yii\db\BaseActiveRecord;
use yii\filters\AccessRule;

/**
 * This generator will generate a controller and one or a few action view files.
 *
 * @property array $actionIDs An array of action IDs entered by the user. This property is read-only.
 * @property string $controllerFile The controller class file path. This property is read-only.
 * @property string $controllerID The controller ID. This property is read-only.
 * @property string $controllerNamespace The namespace of the controller class. This property is read-only.
 * @property string $controllerSubPath The controller sub path. This property is read-only.
 */
class Generator extends \yii\gii\generators\controller\Generator
{
    /**
     * @var string the base class of the controller
     */
    public $baseClass = 'yii\rest\Controller';
    /**
     * @var string list of action IDs separated by commas or spaces
     */
    public $actions = 'index';

    /**
     * @var string
     */
    public $modelClass;
    /**
     * @var string
     */
    public $ruleConfigClass;

    public $behaviors = true;

    public $index = true;
    public $create = true;
    public $view = true;
    public $update = true;
    public $delete = true;
    public $select = false;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'API REST Controller Generator';
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'Un generador de controladores de tipo API REST.';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['modelClass', 'ruleConfigClass'], 'filter', 'filter' => 'trim'],
            [['modelClass'], 'required'],
            [['modelClass', 'ruleConfigClass'], 'match', 'pattern' => '/^[\w\\\\]*$/', 'message' => 'Only word characters and backslashes are allowed.'],
            ['modelClass', 'validateClass', 'params' => ['extends' => BaseActiveRecord::class]],
            ['ruleConfigClass', 'validateClass', 'params' => ['extends' => AccessRule::class]],
            ['modelClass', 'validateModelClass'],
            [['index', 'create', 'view', 'update', 'delete', 'select', 'behaviors'], 'boolean'],
            /*[['controllerClass', 'actions', 'baseClass'], 'filter', 'filter' => 'trim'],
            [['controllerClass', 'baseClass'], 'required'],
            ['controllerClass', 'match', 'pattern' => '/^[\w\\\\]*Controller$/', 'message' => 'Only word characters and backslashes are allowed, and the class name must end with "Controller".'],
            ['controllerClass', 'validateNewClass'],
            ['baseClass', 'match', 'pattern' => '/^[\w\\\\]*$/', 'message' => 'Only word characters and backslashes are allowed.'],
            ['actions', 'match', 'pattern' => '/^[a-z][a-z0-9\\-,\\s]*$/', 'message' => 'Only a-z, 0-9, dashes (-), spaces and commas are allowed.'],
            ['viewPath', 'safe'],*/
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'modelClass' => 'Model Class',
            'ruleConfigClass' => 'ruleConfig Class del AccessControl',
            'index' => 'Listar',
            'create' => 'Crear',
            'view' => 'Ver',
            'update' => 'Actualizar',
            'delete' => 'Eliminar',
            'select' => 'Select',
            /*'controllerClass' => 'Controller Class',
            'viewPath' => 'View Path',
            'baseControllerClass' => 'Base Controller Class',
            'indexWidgetType' => 'Widget Used in Index Page',
            'searchModelClass' => 'Search Model Class',
            'enablePjax' => 'Enable Pjax',*/
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function requiredTemplates()
    {
        return [
            'controller.php'
        ];
    }

    /**
     * {@inheritdoc}
     */
    /*public function stickyAttributes()
    {
        return ['baseClass'];
    }*/

    /**
     * {@inheritdoc}
     */
    public function hints()
    {
        return [
            'modelClass' => 'This is the <code>BaseActiveRecord</code> class associated with the table that CRUD will be built upon.
                You should provide a fully qualified class name, e.g., <code>app\models\Post</code>.',
            'controllerClass' => 'This is the name of the controller class to be generated. You should
                provide a fully qualified namespaced class (e.g. <code>app\controllers\PostController</code>),
                and class name should be in CamelCase ending with the word <code>Controller</code>. Make sure the class
                is using the same namespace as specified by your application\'s controllerNamespace property.',
            'actions' => 'Provide one or multiple action IDs to generate empty action method(s) in the controller. Separate multiple action IDs with commas or spaces.
                Action IDs should be in lower case. For example:
                <ul>
                    <li><code>index</code> generates <code>actionIndex()</code></li>
                    <li><code>create-order</code> generates <code>actionCreateOrder()</code></li>
                </ul>',
            'viewPath' => 'Specify the directory for storing the view scripts for the controller. You may use path alias here, e.g.,
                <code>/var/www/basic/controllers/views/order</code>, <code>@app/views/order</code>. If not set, it will default
                to <code>@app/views/ControllerID</code>',
            'baseClass' => 'This is the class that the new controller class will extend from. Please make sure the class exists and can be autoloaded.',
        ];
    }
    /**
     * Checks if model class is valid
     */
    public function validateModelClass()
    {
        $class = $this->modelClass;
        if (!method_exists($class, 'primaryKey') || !$class::primaryKey()) {
            $this->addError('modelClass', "The table associated with $class must have primary key(s).");
        }
    }
}
