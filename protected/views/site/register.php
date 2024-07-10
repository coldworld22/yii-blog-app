<h1 class="my-4 text-center">Register</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'register-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'username', array('class' => 'text-danger')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'email', array('class' => 'text-danger')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
        <?php echo $form->error($model,'password', array('class' => 'text-danger')); ?>
    </div>

    <div class="form-group text-center">
        <?php echo CHtml::submitButton('Register', array('class' => 'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->
