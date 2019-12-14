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
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Ulangan Harian</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">UTS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">UAS</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_test )) ? $header_button_test : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_test)) ? $contents_test : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_mid )) ? $header_button_mid : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_mid)) ? $contents_mid : '';  ?>
                        
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <div class="float-right">
                                        <?php echo (isset( $header_button_final )) ? $header_button_final : '';  ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo (isset($contents_final)) ? $contents_final : '';  ?>
                        
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