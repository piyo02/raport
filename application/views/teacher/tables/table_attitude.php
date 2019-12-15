<?= form_open()?>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover  ">
        <thead>
            <tr>
                <?php foreach ($header as $key => $value) : ?>
                    <th><?php echo $value ?></th>
                <?php endforeach; ?>
                <?php if (isset($action)) : ?>
                    <th><?php echo "Aksi" ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php foreach ($header as $key => $value) : ?>
                    <td>
                        <?php if($key == 'name') : ?>
                            <?php
                                $attr = $row->$key ;
                                echo $attr;
                            ?>
                        <?php else :?>
                            <?php 
                                $form = array(
                                    'name' => $key,
                                    'id' => $key,
                                    'type' => $attr['type'],
                                    'class' => 'form-control',    
                                );
                                $form['options'] = ( isset( $attr['options'] )  ) ? $attr['options'] : '';
                                $value = ( ( isset( $row ) && ( $row != NULL) )   ? ( isset( $row->$key ) ? $data->$key : '' ) : ''  );
                                $form['selected'] = ( isset( $attr['selected'] )  ) ? $attr['selected'] : $value;
                                echo form_dropdown( $form );
                            ?>
                        <?php endif;?>
                    </td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>
<button type="submit" class="btn btn-sm btn-primary">Simpan</button>
<?= form_close()?>