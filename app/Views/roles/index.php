<?= $this->extend('App\Views\layouts\main') ?>

<?= $this->section('content') ?>
       <div class="main-content-inner">
                <div class="row">
                <?= view('App\Views\_notifications') ?>
                    <!-- data table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                            <form method="get" action="<?php printf(base_url('roles/create'));?>">
                            <button type="submit" class="btn btn-outline-primary mb-3 float-right">Create Role</button>
                            </form>
                                <div class="data-tables">
                                    <table id="example"class="table table-striped  table-hover">
                                        <thead class="bg-light text-capitalize">
                                            <tr>
                                                <th>Name</th>
                                               
                                                 <th>#</th>


                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($roles)){?>
                                            <?php foreach($roles as $role){?>

                                            <tr>
                                                <td><?php echo $role['name'];?></td>
                                               
                                                <td>
                                                    <div class="btn-group br-6">
                                                      <a type="button" class="btn btn-rounded btn-xs btn-danger mr-1 "  href="<?=base_url()?>/roles/delete/<?=$role['id']?>"><i class="ti-trash"></i></a>
                                                      <a type="button" class="btn btn-rounded btn-xs btn-primary"  href="<?=base_url()?>/roles/update/<?=$role['id'] ?>"><i class="fa fa-edit"></i></a>
                                                     
                                                    </div>
                                                </td>
                                            </tr>
                                          <?php }}?>
                                        </tbody>
                                    </table>
                                    <?= $pager->links() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data table end -->
                    <!-- Primary table start -->
                    
                   
                    <!-- Dark table end -->
                </div>
            </div>
<?= $this->endSection() ?>

<script >
    
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>