<?php if (session()->has('success')) : ?>
    <div class="card-body">
     <div class="alert-items">
         <div class="alert alert-success" role="alert">
             <strong>Success!</strong>  <?= session('success') ?>.
        </div>  
    </div>
 </div>
        
<?php endif ?>

<?php if (session()->has('error')) : ?>
    
    <div class="card-body">
                <div class="alert-items">
                    
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> <?= session('error') ?>..
                    </div>
           
                </div>
            </div>
    
<?php endif ?>

<?php if (session()->has('errors')) : ?>

    <div class="card-body">
                <div class="alert-items">
                     <?php foreach (session('errors') as $error) : ?>
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> <?= $error ?>.
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
<?php endif ?>


