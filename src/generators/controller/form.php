<?php
/* @var $this yii\web\View */
/* @var $form \yii\widgets\ActiveForm */
/* @var $generator generators\controller\Generator */


?>
<?= $form->field($generator, 'controllerClass') ?>
<?= $form->field($generator, 'modelClass') ?>
<?= ''// $form->field($generator, 'actions') ?>
<?= ''//$form->field($generator, 'viewPath') ?>
<?= $form->field($generator, 'baseClass') ?>
<?= $form->field($generator, 'behaviors')->checkbox() ?>
<?= $form->field($generator, 'ruleConfigClass') ?>
<div class="container">
    <div class="row"> <h3 > Acciones </h3> </div>
    <div class="row">
        <?= $form->field($generator, 'index', ['options' => ['class' => 'col-md-2']] )->checkbox([]) ?>
        <?= $form->field($generator, 'create', ['options' => ['class' => 'col-md-2']] )->checkbox([]) ?>
        <?= $form->field($generator, 'view', ['options' => ['class' => 'col-md-2']] )->checkbox([]) ?>
        <?= $form->field($generator, 'update', ['options' => ['class' => 'col-md-2']] )->checkbox([]) ?>
        <?= $form->field($generator, 'delete', ['options' => ['class' => 'col-md-2']] )->checkbox([]) ?>
        <?= $form->field($generator, 'select', ['options' => ['class' => 'col-md-2']] )->checkbox([]) ?>
    </div>
</div>
<br>