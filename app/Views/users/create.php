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
                            <h4 class="header-title">Create new ueser</h4>
                            <form  method=POST action="<?= base_url('users/create'); ?>">
                                 <div class="form-group ">
                                    <input type="text" class="form-control mb-4 input-rounded" id="name" aria-describedby="name" name="name" placeholder="Enter new user name">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control mb-4 input-rounded" id="exampleInputEmail1"  name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">After updating your email you will be logged out untill mail verification.</small>
                                </div>
                                 <div class="form-group ">
                                    <input type="number" class="form-control mb-4 input-rounded" id="phone"  name="phone" aria-describedby="name" placeholder=" phone number">
                                    
                                </div>
                                 <div class="form-group ">
                                    <input type="text" class="form-control mb-4 input-rounded" id="name" aria-describedby="name" name="address" placeholder="Enter new address">
                                    
                                </div>
                               

                                <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="password" id="exampleInputPassword1" placeholder=" password">
                                </div>
                                 <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="password_confirm" id="exampleInputPassword2" placeholder="Confirm password">
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