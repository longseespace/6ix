<?php
// $this->breadcrumbs=array(
// 	'Colors'=>array('index'),
// 	'Manage',
// );

// $this->menu=array(
// 	array('label'=>'List Color','url'=>array('index')),
// 	array('label'=>'Create Color','url'=>array('create')),
// );
$cs = Yii::app()->clientScript;
$cs->registerCssFile($this->assetsUrl . '/css/modules/color.css');
?>

<div class="box">
	<div class="box-header">
		<h1>Colors and Patterns</h1>
	</div>

	<div class="box-content">
		<div class="column-left">
			<h1>Colors</h1>
			<ul id="colors">
			<?php foreach ($models->data as $value) { ?>
				<li id="<?php echo $value->id; ?>" style="background-color: <?php echo $value->hex; ?>; border: 1px solid <?php echo $value->hex; ?>; -webkit-transform: rotate(0deg);">
					<!-- <span class="glyph delete" style="display: none;"></span> -->
          <a href="<?php echo $this->createUrl('color/view/id/' . $value->id); ?>" title="<?php echo $value->name; ?>"></a>
				</li>
			<?php }; ?>
			</ul>
		</div>
		<div class="column-right">
			<?php if (!empty($patterns)) { ?>
				<h1>Patterns</h1>
				<ul id="patterns">
					<?php foreach ($patterns->data as $value) { ?>
						<li id="<?php echo $value->id; ?>" style="-webkit-transform: rotate(0deg);">
							<!-- <span class="glyph delete" style="display: none;"></span> -->
		          <a href="<?php echo $this->createUrl('pattern/view/id/' . $value->id); ?>" title="<?php echo $value->id; ?>">
		          	<img id="pattern-img" src="<?php echo $value->image; ?>"
		          </a>
						</li>
					<?php }; ?>
				</ul>
			<?php }; ?>
		</div>
		<div class="clear"></div>
		<div class="action_bar">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'primary',
				'label'=>$model->isNewRecord ? 'Create' : 'Save',
			)); ?>
		</div>
	</div>
