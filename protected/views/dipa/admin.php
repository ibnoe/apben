<?php
$this->breadcrumbs=array(
	'DIPA'=>array('admin'),
	'Manage',
);


?>

<h1>Manage DIPA</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'dipa-grid',
    'type' => 'bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'version',
		'tahun_anggaran',
		'tanggal_dipa',
		'nomor_dipa',
		'satker',
		'kegiatan',
		/*
		'version',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}'
		),
	),
)); ?>