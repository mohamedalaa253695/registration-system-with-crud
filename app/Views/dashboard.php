<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
     <div class="main-content-inner">
                <!-- sales report area start -->
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="ti-user"></i> New Users</div>
                                            <h2><?php echo $numberOfRoles;?></h2>
                                        </div>
                                        <canvas id="seolinechart1" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg2">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="ti-unlock"></i> Roles</div>
                                            <h2><?php echo $numberOfRoles;?></h2>
                                        </div>
                                        <canvas id="seolinechart2" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                       >
                        </div>
                    </div>>
                    </div>
                </div>
                <!-- sales report area end -->
                <!-- overview area start -->
                
               
                <!-- row area start-->
            </div>
<?= $this->endSection() ?>