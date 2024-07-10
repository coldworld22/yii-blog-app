<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom CSS for additional styling -->
    <style>
        #logo img {
            display: block;
            margin: 0 auto;
            border-radius: 50%; /* Make the image circular */
            width: 150px; /* Adjust the size as needed */
            height: 150px; /* Adjust the size as needed */
        }
        #header h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container" id="page">

    <div id="header" class="my-4 text-center">
       
        <h1><?php echo CHtml::encode("Task Assignment App"); ?></h1>
    </div><!-- header -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php $this->widget('zii.widgets.CMenu',array(
                'htmlOptions' => array('class' => 'navbar-nav'),
                'itemCssClass' => 'nav-item',
                'linkLabelWrapper' => 'span',
                'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
                'encodeLabel' => false,
                'items'=>array(
                    array('label'=>'Home', 'url'=>array('/site/index'), 'itemOptions' => array('class' => 'nav-item'), 'linkOptions' => array('class' => 'nav-link')),
                    array('label'=>'Contact', 'url'=>array('/site/contact'), 'itemOptions' => array('class' => 'nav-item'), 'linkOptions' => array('class' => 'nav-link')),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'nav-item'), 'linkOptions' => array('class' => 'nav-link')),
                    array('label'=>'Register', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'nav-item'), 'linkOptions' => array('class' => 'nav-link')),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'itemOptions' => array('class' => 'nav-item'), 'linkOptions' => array('class' => 'nav-link'))
                ),
            )); ?>
        </div>
    </nav><!-- mainmenu -->

    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'htmlOptions' => array('class' => 'breadcrumb'),
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer" class="mt-4 text-center">
        <p>&copy; <?php echo date('Y'); ?> Ayman.<br/>
        All Rights Reserved.<br/>
       </p>
    </div><!-- footer -->

</div><!-- page -->

</body>
</html>
