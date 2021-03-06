<div class="form">
    <?php echo CHtml::image($this->createUrl("/static/images/loading.gif"), 'loading', array('class' => 'loading', 'style' => 'position:absolute;')); ?>

    <?php
    $editable_raw = User::itemAlias('realisasi_edit', Yii::app()->user->role);
    $editable = $model->attributes;

    $output = Output::getDropDownList();
    $output_pertama = explode(" - ", reset($output));
    $output_pertama = $output_pertama[0];

    $suboutput = Suboutput::getDropDownList($output_pertama);
    $suboutput_pertama = explode(" - ", reset($suboutput));
    $suboutput_pertama = $suboutput_pertama[0];

    $mak = Mak::getDropDownList($output_pertama, $suboutput_pertama);

    foreach ($editable as $k => $e) {
        if (in_array($k, $editable_raw)) {
            $editable[$k] = true;
        } else {
            $editable[$k] = false;
        }
    }

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'tagihan-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'style' => 'visibility:hidden;'
        )
    ));
    ?>

    <script type="text/javascript" src="<?php echo $this->staticUrl . "/js/jquery.maskMoney.js"; ?>"></script>
    <?php
    $this->widget('ext.moneymask.MMask', array(
        'element' => '#Tagihan_jumlah_tagihan,#Tagihan_ppn, #Tagihan_pph21, #Tagihan_pph22, #Tagihan_pph23, #Tagihan_pph25',
        'currency' => 'IDR',
        'config' => array(
            'showSymbol' => false,
            'thousands' => '.',
            'decimal' => ',',
            'precision' => 0
        )
    ));
    ?>

    <br/>

    <?php echo $form->errorSummary($model); ?>

    <?php if (!$model->isNewRecord): ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                Pembuat Tagihan
            </span> 
            : <b><?php echo $model->pembuat_tagihan->nama; ?> (<?php echo $model->pembuat_tagihan->nip; ?>)</b>
        </div>
        <hr style='margin:0px 0px 15px 0px;'/>
    <?php endif; ?>

    <?php if ($editable['kode_output']): ?>
        <?php echo $form->dropDownListRow($model, 'kode_output', $output, array('class' => 'span5', 'maxlength' => 25)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('kode_output'); ?>
            </span> 
            : <b><?php echo $model->kode_output_text; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['kode_suboutput']): ?>
        <?php echo $form->dropDownListRow($model, 'kode_suboutput', $suboutput, array('class' => 'span5', 'maxlength' => 25)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('kode_suboutput'); ?>
            </span> 
            : <b><?php echo $model->kode_suboutput_text; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['kode_mak']): ?>
        <?php echo $form->dropDownListRow($model, 'kode_mak', $mak, array('class' => 'span5', 'maxlength' => 25, 'options' => Mak::getDropDownListOptions($output_pertama, $suboutput_pertama))); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('kode_mak'); ?>
            </span> 
            : <b><?php echo $model->kode_mak_text; ?></b>
        </div>
    <?php endif; ?>

    <?php echo $form->hiddenField($model, 'id_p_ar', array('class' => 'span5', 'maxlength' => 20)); ?>

    <?php if ($editable['tanggal_ar']): ?>
        <?php echo $form->labelEx($model, 'tanggal_ar'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_ar',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_ar'); ?>
            </span> 
            : <b><?php echo $model->tanggal_ar; ?></b>
        </div>
    <?php endif; ?>

    <?php echo $form->hiddenField($model, 'id_p_sptb', array('class' => 'span5', 'maxlength' => 20)); ?>


    <?php if ($editable['tanggal_sptb']): ?>
        <?php echo $form->labelEx($model, 'tanggal_sptb'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_sptb',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_sptb'); ?>
            </span> 
            : <b><?php echo $model->tanggal_sptb; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['nomor_sptb']): ?>
        <?php echo $form->textFieldRow($model, 'nomor_sptb', array('class' => 'span5', 'maxlength' => 20)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('nomor_sptb'); ?>
            </span> 
            : <b><?php echo $model->nomor_sptb; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['id_p_ppk']): ?>
        <?php echo $form->dropDownListRow($model, 'id_p_ppk', User::getListByRole("ppk"), array('class' => 'span5', 'maxlength' => 20)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('id_p_ppk'); ?>
            </span> 
            : <b><?php echo (isset($model->ppk) ? $model->ppk->nama : ""); ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['nomor_spp']): ?>
        <?php echo $form->textFieldRow($model, 'nomor_spp', array('class' => 'span5', 'maxlength' => 20)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('nomor_spp'); ?>
            </span> 
            : <b><?php echo $model->nomor_spp; ?></b>
        </div>
    <?php endif; ?>


    <?php if ($editable['tanggal_spp']): ?>
        <?php echo $form->labelEx($model, 'tanggal_spp'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_spp',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_spp'); ?>
            </span> 
            : <b><?php echo $model->tanggal_spp; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['nomor_spm']): ?>
        <?php echo $form->textFieldRow($model, 'nomor_spm', array('class' => 'span5', 'maxlength' => 20)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('nomor_spm'); ?>
            </span> 
            : <b><?php echo $model->nomor_spp; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['tanggal_spm']): ?>
        <?php echo $form->labelEx($model, 'tanggal_spm'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_spm',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_spm'); ?>
            </span> 
            : <b><?php echo $model->tanggal_spm; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['tanggal_verifikasi']): ?>
        <?php echo $form->labelEx($model, 'tanggal_verifikasi'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_verifikasi',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_verifikasi'); ?>
            </span> 
            : <b><?php echo $model->tanggal_verifikasi; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['tanggal_ke_tu']): ?>
        <?php echo $form->labelEx($model, 'tanggal_ke_tu'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_ke_tu',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_ke_tu'); ?>
            </span> 
            : <b><?php echo $model->tanggal_ke_tu; ?></b>
        </div>
    <?php endif; ?>



    <?php echo $form->hiddenField($model, 'id_p_spm', array('class' => 'span5', 'maxlength' => 20)); ?>

    <?php echo $form->hiddenField($model, 'id_p_sp2d', array('class' => 'span5', 'maxlength' => 20)); ?>

    <?php if ($editable['nomor_sp2d']): ?>
        <?php echo $form->textFieldRow($model, 'nomor_sp2d', array('class' => 'span5', 'maxlength' => 20)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('nomor_sp2d'); ?>
            </span> 
            : <b><?php echo $model->nomor_sp2d; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['tanggal_sp2d']): ?>
        <?php echo $form->labelEx($model, 'tanggal_sp2d'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_sp2d',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_sp2d'); ?>
            </span> 
            : <b><?php echo $model->tanggal_sp2d; ?></b>
        </div>
    <?php endif; ?>


    <?php if ($editable['jenis_tagihan']): ?>
        <?php echo $form->dropDownListRow($model, 'jenis_tagihan', Tagihan::itemAlias("JenisTagihan"), array('class' => 'span5', 'maxlength' => 10)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('jenis_tagihan'); ?>
            </span> 
            : <b><?php echo $model->jenis_tagihan; ?></b>
        </div>
    <?php endif; ?>


    <?php if ($editable['tanggal_tagihan']): ?>
        <?php echo $form->labelEx($model, 'tanggal_tagihan'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_tagihan',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_tagihan'); ?>
            </span> 
            : <b><?php echo $model->tanggal_tagihan; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['tanggal_trm_tagihan']): ?>
        <?php echo $form->labelEx($model, 'tanggal_trm_tagihan'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_trm_tagihan',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_trm_tagihan'); ?>
            </span> 
            : <b><?php echo $model->tanggal_trm_tagihan; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['tanggal_deadline']): ?>
        <?php echo $form->labelEx($model, 'tanggal_deadline'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model' => $model,
            'attribute' => 'tanggal_deadline',
            'htmlOptions' => array(
                'readonly' => 'readonly'
            )
        ));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('tanggal_deadline'); ?>
            </span> 
            : <b><?php echo $model->tanggal_deadline; ?></b>
        </div>
    <?php endif; ?>


    <?php if ($editable['uraian_tagihan']): ?>
        <?php echo $form->textFieldRow($model, 'uraian_tagihan', array('class' => 'span5', 'maxlength' => 255)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('uraian_tagihan'); ?>
            </span> 
            : <b><?php echo $model->uraian_tagihan; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['pihak_penerima']): ?>
        <?php echo $form->textFieldRow($model, 'pihak_penerima', array('class' => 'span5', 'maxlength' => 255)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('pihak_penerima'); ?>
            </span> 
            : <b><?php echo $model->pihak_penerima; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['jenis_penerima']): ?>
        <?php
        echo $form->dropDownListRow($model, 'jenis_penerima', array(
            '' => '---',
            'BP' => 'BP',
            'PIHAK KETIGA' => 'PIHAK KETIGA',
            'PEGAWAI' => 'PEGAWAI',
                ), array('class' => 'span2', 'maxlength' => 255));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('jenis_penerima'); ?>
            </span> 
            : <b><?php echo $model->jenis_penerima; ?></b>
        </div>
    <?php endif; ?>


    <?php if ($editable['dasar_tagihan']): ?>
        <?php
        echo $form->dropDownListRow($model, 'dasar_tagihan', array(
            '' => '---',
            'ST' => 'ST',
            'SK' => 'SK',
            'SPK' => 'SPK',
            'KONTRAK' => 'KONTRAK',
                ), array('class' => 'span2', 'maxlength' => 25));
        ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('dasar_tagihan'); ?>
            </span> 
            : <b><?php echo $model->dasar_tagihan; ?></b>
        </div>
    <?php endif; ?>


    <?php if ($editable['sumber_dana']): ?>
        <?php echo $form->textFieldRow($model, 'sumber_dana', array('class' => 'span1', 'maxlength' => 25, 'readonly' => 'readonly')); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('sumber_dana'); ?>
            </span> 
            : <b><?php echo $model->sumber_dana; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($model->sumber_dana != "RM"): ?>
        <div id="kode_lpk_row">
            <?php if ($editable['kode_lpk']): ?>
                <?php echo $form->dropDownListRow($model, 'kode_lpk', Tagihan::itemAlias("KodeLPK"), array('class' => 'span5', 'maxlength' => 20)); ?>
                <div class="clearfix"></div>
            <?php else: ?>
                <div class='row-tagihan'>
                    <span class='label-tagihan'>
                        <?php echo $model->getAttributeLabel('kode_lpk'); ?>
                    </span> 
                    : <b><?php echo $model->kode_lpk; ?></b>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($editable['mata_uang']): ?>
        <?php echo $form->dropDownListRow($model, 'mata_uang', Tagihan::itemAlias("MataUang"), array('class' => 'span5', 'maxlength' => 25)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('mata_uang'); ?>
            </span> 
            : <b><?php echo $model->mata_uang; ?></b>
        </div>
    <?php endif; ?>

    <?php if ($editable['jumlah_tagihan']): ?>
        <?php echo $form->textFieldRow($model, 'jumlah_tagihan', array('class' => 'span5', 'maxlength' => 20)); ?>
        <div class="clearfix"></div>
    <?php else: ?>
        <div class='row-tagihan'>
            <span class='label-tagihan'>
                <?php echo $model->getAttributeLabel('jumlah_tagihan'); ?>
            </span> 
            : <b><?php echo Format::currency($model->jumlah_tagihan); ?></b>
        </div>
    <?php endif; ?>

    <div id="kurs_container">
        <?php if ($editable['kurs']): ?>
            <?php echo $form->textFieldRow($model, 'kurs', array('class' => 'span5', 'maxlength' => 20)); ?>
            <div class="clearfix"></div>
        <?php else: ?>
            <div class='row-tagihan'>
                <span class='label-tagihan'>
                    <?php echo $model->getAttributeLabel('kurs'); ?>
                </span> 
                : <b><?php echo $model->kurs; ?></b>
            </div>
        <?php endif; ?>

        <?php if ($model->mata_uang != "IDR"): ?>
            <div class='row-tagihan'>
                <span class='label-tagihan'>
                    <?php echo $model->getAttributeLabel('jumlah_tagihan_rupiah'); ?>
                </span> 
                : <b><?php echo Format::currency($model->jumlah_tagihan_rupiah); ?></b>
            </div>
        <?php endif; ?>

        <?php if ($editable['jenis_kurs']): ?>
            <?php echo $form->dropDownListRow($model, 'jenis_kurs', Tagihan::itemAlias("JenisKurs"), array('class' => 'span5', 'maxlength' => 25)); ?>
            <div class="clearfix"></div>
        <?php else: ?>
            <div class='row-tagihan'>
                <span class='label-tagihan'>
                    <?php echo $model->getAttributeLabel('jenis_kurs'); ?>
                </span> 
                : <b><?php echo $model->jenis_kurs; ?></b>
            </div>
        <?php endif; ?>
    </div>

    <div id="pajak_container">
        <?php if ($editable['ppn']): ?>
            <label>Pajak</label>
        <?php endif; ?>
        <select id="pajak_dropdown" style="width:110px;<?php if (!$editable['ppn']): ?>display:none;<?php endif; ?>">
            <option value="pajak">Pajak</option>
            <option value="non_pajak">Non-Pajak</option>
        </select>
        <div class="clearfix"></div>
        <?php if (!$editable['ppn']): ?>
            <div class='row-tagihan'>
                <span class='label-tagihan'>
                    Pajak:
                </span> 
                : <b id="berpajak"><?php echo ($model->berpajak ? "Pajak" : "Non-Pajak"); ?>

                </b>
            </div>
        <?php endif; ?>

        <div id="pajak_subcontainer" class="well span7" style='margin-left:0px;'>
            <?php if ($editable['ppn']): ?>
                <?php echo $form->textFieldRow($model, 'ppn', array('class' => 'span4', 'maxlength' => 20)); ?>
                <div class="clearfix"></div>
            <?php else: ?>
                <div class='row-tagihan'>
                    <span class='label-tagihan'>
                        <?php echo $model->getAttributeLabel('ppn'); ?>
                    </span> 
                    : <b><?php echo Format::currency($model->ppn); ?></b>
                </div>
            <?php endif; ?>
            <?php if ($editable['ppn']): ?>
                <div id="pph_row">
                    <label>PPh</label>
                    <select id="pph_dropdown" style="width:90px;margin-right:10px;">
                        <option value="pph_21">PPh 21</option>
                        <option value="pph_22">PPh 22</option>
                        <option value="pph_23">PPh 23</option>
                        <option value="pph_25">PPh 25</option>
                    </select>
                    <?php echo $form->textField($model, 'pph_21', array('class' => 'pph span3', 'maxlength' => 20)); ?>
                    <?php echo $form->textField($model, 'pph_22', array('class' => 'pph span3', 'maxlength' => 20, 'style' => 'display:none;')); ?>
                    <?php echo $form->textField($model, 'pph_23', array('class' => 'pph span3', 'maxlength' => 20, 'style' => 'display:none;')); ?>
                    <?php echo $form->textField($model, 'pph_25', array('class' => 'pph span3', 'maxlength' => 20, 'style' => 'display:none;')); ?>
                    <div class="clearfix"></div>
                <?php else: ?>
                    <div class='row-tagihan'>
                        <span class='label-tagihan'>
                            <?php
                            if ($model->pph_21 != 0) {
                                echo $model->getAttributeLabel('pph_21');
                            } else if ($model->pph_22 != 0) {
                                echo $model->getAttributeLabel('pph_22');
                            } else if ($model->pph_23 != 0) {
                                echo $model->getAttributeLabel('pph_23');
                            } else if ($model->pph_25 != 0) {
                                echo $model->getAttributeLabel('pph_25');
                            }
                            ?> 
                        </span> 
                        : <b><?php
                            if ($model->pph_21 != 0) {
                                echo Format::currency($model->pph_21);
                            } else if ($model->pph_22 != 0) {
                                echo Format::currency($model->pph_22);
                            } else if ($model->pph_23 != 0) {
                                echo Format::currency($model->pph_23);
                            } else if ($model->pph_25 != 0) {
                                echo Format::currency($model->pph_25);
                            }
                            ?></b>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <?php if (!isset($_GET['mode'])): ?>
        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => $model->isNewRecord ? 'Create' : 'Save',
            ));
            ?>
        </div>
    <?php endif; ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function() {
        $("#Tagihan_sumber_dana").change(function() {
            if ($(this).val() == "RM") {
                $("#kode_lpk_row").hide();
            } else {
                $("#kode_lpk_row").show();
            }
        }).change();

        if ($(".pph:eq(0)").val() > 0 || $(".pph:eq(1)").val() > 0 || $(".pph:eq(2)").val() > 0
                || $(".pph:eq(3)").val() > 0 || $("#Tagihan_ppn").val() > 0) {
            $("#pajak_dropdown").val("pajak");
        } else {
            $("#pajak_dropdown").val("non_pajak");
        }

        $("#pajak_dropdown").change(function() {
            if ($(this).val() == "pajak") {
                $("#pajak_subcontainer").show();
            } else {
                $("#pajak_subcontainer").hide();
                $(".pph,#Tagihan_ppn").val('0');
            }
        }).change();

        if ($("#berpajak").text().trim() == "Pajak") {
            $("#pajak_subcontainer").show();
        }

        $(".pph").each(function() {
            if ($(this).val() != 0) {
                $("#pph_dropdown").val($(this).attr('id').replace("Tagihan_", ''));
                $(".pph").hide();
                $(this).show();
            }
        });

        $("#pph_dropdown").change(function() {
            $(".pph").hide().val('0');
            $("#Tagihan_" + $(this).val()).show();
        });

        $("#Tagihan_kode_output").change(function() {
            $kode = $(this).val().split('-')[1];
            $("#Tagihan_kode_suboutput,#Tagihan_kode_mak").attr("disabled", "disabled");
            $.get('<?php echo $this->createUrl('/tagihan/suboutput_dropdown/'); ?>' + "/" + $kode, function(data) {
                $("#Tagihan_kode_suboutput").replaceWith(data);
                $("#Tagihan_kode_suboutput").change();
            });
        });

        $(document).on("change", "#Tagihan_kode_suboutput", function() {
            $("#Tagihan_kode_mak").attr("disabled", "disabled");
            $o = $("#Tagihan_kode_output").val().split("-")[1];
            $s = $(this).val().split('-')[1];
            $.get('<?php echo $this->createUrl('/tagihan/mak_dropdown?'); ?>' + "o=" + $o + "&s=" + $s, function(data) {
                $("#Tagihan_kode_mak").replaceWith(data);

                $("#Tagihan_kode_mak").change(function() {
                    $("#Tagihan_sumber_dana").val($(this).find(":selected").attr("sumber_dana"));
                });

                $("#Tagihan_kode_mak").change();
            });
        });

        $("#Tagihan_kode_mak").change(function() {
            $("#Tagihan_sumber_dana").val($(this).find(":selected").attr("sumber_dana"));
        });

<?php if ($model->sumber_dana == ""): ?>
            $("#Tagihan_kode_mak").change();
<?php endif; ?>

        $("#Tagihan_mata_uang").change(function() {
            if ($(this).val() == "IDR") {
                $("#kurs_container").hide();
                $("#pajak_container").show();
            } else {
                $("#kurs_container").show();
                $("#pajak_container").hide();
            }
        }).change();

        $(".loading").remove();
        $("#tagihan-form").css('visibility', 'visible');
    });
</script>