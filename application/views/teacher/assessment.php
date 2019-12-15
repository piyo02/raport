<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="col-12">
                <?php
                echo $alert;
                ?>
              </div>
              <div class="row">
                <div class="col-lg-9">
                  <ul class="nav nav-pills ml-auto p-2">
                      <li class="nav-item"><a class="nav-link active" href="#assignment" data-toggle="tab">Tugas</a></li>
                      <li class="nav-item"><a class="nav-link" href="#daily_test" data-toggle="tab">Ulangan Harian</a></li>
                      <li class="nav-item"><a class="nav-link" href="#mid" data-toggle="tab">UTS</a></li>
                      <li class="nav-item"><a class="nav-link" href="#final" data-toggle="tab">UAS</a></li>
                      <li class="nav-item"><a class="nav-link" href="#attitude" data-toggle="tab">Sikap</a></li>
                      <?php if(isset( $guardianship )): ?>
                        <li class="nav-item"><a class="nav-link" href="#absence" data-toggle="tab">Ketidakhadiran</a></li>
                        <li class="nav-item"><a class="nav-link" href="#exctracurricular" data-toggle="tab">Ekstrakurikuler</a></li>
                        <li class="nav-item"><a class="nav-link" href="#achievement" data-toggle="tab">Prestasi</a></li>
                      <?php endif; ?>
                  </ul>
                </div>
                <div class="col-lg-3">
                  <form action="">
                    <div class="row">
                      <div class="col-lg-8">
                        <input type="hidden" name="id" id="id" value="<?= $this->input->get('id');?>">
                        <?php
                          $form = array(
                            'name' => $attr['form_name'],
                            'id' => $attr['form_name'],
                            'type' => $attr['type'],
                            'class' => 'form-control',  
                            
                          );
                          $form['options'] = ( isset( $attr['options'] )  ) ? $attr['options'] : '';
                          $form['selected'] = ( $this->input->get('course_id') != NULL  ) ? $this->input->get('course_id') : 1;
                          echo form_dropdown( $form );
                        ?>
                      </div>
                      <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary">Lihat</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane active" id="assignment">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_assignment )) ? $header_button_assignment : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_assignment)) ? $contents_assignment : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="daily_test">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_test )) ? $header_button_test : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_test)) ? $contents_test : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="mid">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_mid )) ? $header_button_mid : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_mid)) ? $contents_mid : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="final">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_final )) ? $header_button_final : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_final)) ? $contents_final : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="attitude">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_student_attitude )) ? $header_button_student_attitude : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_attitude)) ? $contents_attitude : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="absence">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_absence )) ? $header_button_absence : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_absence)) ? $contents_absence : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="exctracurricular">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_extracurricular )) ? $header_button_extracurricular : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_extracurricular)) ? $contents_extracurricular : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="achievement">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-6">
                                  <?= $teacher ?>
                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_achievement )) ? $header_button_achievement : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_achievement)) ? $contents_achievement : '';  ?>
                        
                    </div>
                </div>
              <?php echo (isset($pagination_links)) ? $pagination_links : '';  ?>
              <!--  -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>