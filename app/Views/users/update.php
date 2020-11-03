<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?> 

  <div class="main-content-inner">
    <div class="row">
        
        <div class="col-lg-12 col-ml-12">
            <div class="row">
            <?= view('App\Views\_notifications') ?>
                <!-- basic form start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body ">
                            <h4 class="header-title">Update your personal details</h4>
                            <form  method=POST action="<?= base_url('update-user-general-detials'); ?>">
                                 <div class="form-group ">
                                    <input type="text" class="form-control mb-4 input-rounded" id="name" aria-describedby="name" name="name" value="<?= $user['name'];?>" placeholder="Enter new user name">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control mb-4 input-rounded" id="exampleInputEmail1"  name="email" aria-describedby="emailHelp" placeholder="Enter email"  disabled type="text" value="<?= $user['email'];?>">
                                    <small id="emailHelp" class="form-text text-muted">After updating your email you will be logged out untill mail verification.</small>
                                </div>
                                 <div class="form-group ">
                                    <input type="number" class="form-control mb-4 input-rounded" id="phone"  name="phone" aria-describedby="name"value="<?= $user['phone_number'];?>" placeholder="Update your phone number">
                                    
                                </div>
                                 <div class="form-group ">
                                    <input type="text" class="form-control mb-4 input-rounded" id="name" aria-describedby="name" name="address" value="<?= $user['address'];?>"placeholder="Enter new address">
                                    
                                </div>
                                <input type="hidden" name="id" value="<?php echo $user['id'];?>" >

                               
                                
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                     <div class="card">
                        <div class="card-body ">
                            <h4 class="header-title">Change Password</h4>
                            <form  method=POST action="<?= base_url('change-user-password'); ?>">
                                

                                <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="password" id="exampleInputPassword1" placeholder="Current password" value="">
                                </div>

                                <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="new_password" id="exampleInputPassword1" placeholder="New password" value="">
                                </div>
                                 <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="new_password_confirm" id="exampleInputPassword1" placeholder="Confirm new password" value="">
                                </div>
                                <input type="hidden" name="id" value="<?php echo $user['id'];?>" >

                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                     <div class="card">
                        <div class="card-body ">
                            <h4 class="header-title">Change your e-mail</h4>
                            <form  method=POST action="<?= base_url('update-user-email'); ?>">
                                
                                <div class="form-group">
                                    <input type="email" class="form-control mb-4 input-rounded" id="exampleInputEmail1"  name="new_email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= old('new_email') ?>">
                                    <small id="emailHelp" class="form-text text-muted">After updating your email you will be logged out untill mail verification.</small>
                                </div>

                                <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="password" id="exampleInputPassword1" placeholder="Current password">
                                </div>
                                 
                                 <input type="hidden" name="id" value="<?php echo $user['id'];?>" >
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Update</button>
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