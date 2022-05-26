<?php

/**
 * This is the template for generating a controller class file.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

$modelClass = StringHelper::basename($generator->modelClass);
/** @var $this yii\web\View */
/** @var $generator generators\controller\Generator */


echo "<?php\n";
?>

namespace <?= $generator->getControllerNamespace() ?>;

use Yii;
use yii\web\ServerErrorHttpException;
use <?= ltrim($generator->modelClass, '\\') ?>;

class <?= StringHelper::basename($generator->controllerClass) ?> extends <?= '\\' . trim($generator->baseClass, '\\') . "\n" ?>
{
    /** @var <?= $modelClass ?>  */
    public $modelClass = <?= $modelClass ?>::class;

<?php if ($generator->behaviors) : 
    $actionsRead = "";
    if ($generator->index) $actionsRead.= "'index',";
    if ($generator->view) $actionsRead.= "'view',";
    if ($generator->select) $actionsRead.= "'select',";
    $actionsRead.= "'options'";
    
    $actionsMuted = "";
    if ($generator->create) $actionsMuted.= "'create',";
    if ($generator->update) $actionsMuted.= "'update',";
    if ($generator->delete) $actionsMuted.= "'delete',";
    $actionsMuted.= "'options'";
    ?>
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
			'class' => \yii\filters\AccessControl::class,
            'rules' => [
                [
                    'actions' => [<?= $actionsRead ?>],
                    'allow' => true,
                    'roles' => ['@'],
                ],
                [
                    'actions' => [<?= $actionsMuted ?>],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }
    <?php endif; ?>

<?php if ($generator->index) : ?>
    public function actionIndex()
    {
        $params = Yii::$app->request->queryParams;
        $dataProvider = $this->modelClass::search($params);
        return $dataProvider;
    }
<?php endif; ?>

<?php if ($generator->view) : ?>
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $model;
    }
<?php endif; ?>

<?php if ($generator->create) : ?>
    public function actionCreate()
    {
        /** @var \yii\db\ActiveRecord */
        $model = new $this->modelClass([
            //'scenario' => $this->modelClass::SCENARIO_DEFAULT,
        ]);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }
<?php endif; ?>

<?php if ($generator->update) : ?>
    public function actionUpdate($id)
    {
        /** @var \yii\db\ActiveRecord */
        $model = $this->findModel($id);

        $model->scenario = $this->modelClass::SCENARIO_DEFAULT;
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
    }
<?php endif; ?>

<?php if ($generator->delete): ?>
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }

        Yii::$app->getResponse()->setStatusCode(204);
    }
<?php endif; ?>

<?php if ($generator->select): ?>
    public function actionSelect()
    {
        $params = Yii::$app->request->queryParams;
        $data = $this->modelClass::query($params)
            ->all();
        return $data;
    }
<?php endif; ?>

    public function findModel($id)
    {
        $model = $this->modelClass::findOne($id);        

        if (!isset($model)) 
            throw new \yii\web\NotFoundHttpException("No existe la fila: $id");

        return $model;
    }

}