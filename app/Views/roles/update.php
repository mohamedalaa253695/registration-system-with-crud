<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?> 

  <div class="main-content-inner">
    <div class="row">
    <?= view('App\Views\_notifications') ?>
        <div class="col-lg-12 col-ml-12">
            <div class="row">
                <!-- basic form start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body ">
                            <h4 class="header-title">Update Roles</h4>
                            <form  method=POST action="<?= base_url('roles/update'); ?>">
                                 <div class="form-group ">
                                   
                                    <input type="text" class="form-control mb-4 input-rounded" id="name" aria-describedby="name" name="name" placeholder="<?php echo $role['name'];?>">
                                    <input type="hidden" name="id" value="<?php echo $role['id'];?>" >
                                   
                                </div>
                                                           
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div> 
               
              
                <!-- Custom file input end -->
            </div>
        </div>
    </div>
</div>

 <?= $this->endSection() ?>   