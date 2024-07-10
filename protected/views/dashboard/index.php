<?php
/* @var $this DashboardController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Dashboard';
$this->breadcrumbs = array(
    'Dashboard',
);
?>

<h1>Welcome to your Dashboard</h1>

<p>This is the dashboard page. You can manage your blog posts here.</p>

<p>
    <?php echo CHtml::link('Create New Blog Post', array('/blogPost/create'), array('class' => 'btn btn-success')); ?>
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'blog-post-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id',
        'title',
        array(
            'name' => 'author_id',
            'value' => '$data->author->username',
        ),
        'is_public:boolean',
        'created_at',
        'updated_at',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'label' => 'View',
                    'url' => 'Yii::app()->createUrl("blogPost/view", array("id"=>$data->id))',
                ),
                'update' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("blogPost/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("blogPost/delete", array("id"=>$data->id))',
                    'click' => 'function(){return confirm("Are you sure you want to delete this item?");}',
                ),
            ),
        ),
    ),
)); ?>
