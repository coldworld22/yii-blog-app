<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'author_id'); ?>
        <?php echo $form->textField($model,'author_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'is_public'); ?>
        <?php echo $form->dropDownList($model,'is_public',array(''=>'','0'=>'No','1'=>'Yes')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'created_at'); ?>
        <?php echo $form->textField($model,'created_at'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'updated_at'); ?>
        <?php echo $form->textField($model,'updated_at'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
