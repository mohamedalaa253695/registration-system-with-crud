<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?> 

  <div class="main-content-inner">
    <div class="row">
        
        <div class="col-lg-12 col-ml-12">
            <div class="row">
                <!-- basic form start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body ">
                            <h4 class="header-title">Update user</h4>
                            <form  method=POST action="<?= base_url('users/update'); ?>">
                                 <div class="form-group ">
                                    <input type="text" class="form-control mb-4 input-rounded" id="name" aria-describedby="name" name="user" value="<?= $user['name']?>"placeholder="Update User">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control mb-4 input-rounded" id="exampleInputEmail1"  name="email" aria-describedby="emailHelp"  value="<?= $user['email']?>" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">After updating your email you will be logged out untill mail verification.</small>
                                </div>
                                 <div class="form-group ">
                                    <input type="number" class="form-control mb-4 input-rounded" id="phone"  name="phone" aria-describedby="name" value="<?= $user['phone_number']?>" placeholder="Update your phone number">
                                    
                                </div>
                                <div class="form-group ">
                                    <input type="text" class="form-control mb-4 input-rounded" id="name" aria-describedby="name" name="user" value="<?= $user['address']?>"placeholder="Update address">
                                    
                                </div>
                                
                                <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="current_password" id="exampleInputPassword1"value="<?= $user['password_hash']?>" placeholder="new password">
                                </div>

                                <div class="form-group">
                                    <input class="form-control mb-4 input-rounded" type="password" name="new_password" id="exampleInputPassword2"value="<?= $user['password_hash']?>" placeholder="Confirm password">
                                </div>
                                

                                <input type="hidden" name="id" value="<?php echo $user['id'];?>" >
                                
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