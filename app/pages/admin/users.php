<?php if($action == "add") :?>
  <!-- Add new user -->
  <div class="col-md-6 mx-auto">
        <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">Add a new user</h1>
        <div class="form-floating mb-3">
        <input value="<?=old_value('username')?>" name="username" type="text" class="form-control" id="floatingInput" placeholder="Username">
        <label for="floatingInput">Username</label>
        </div>
        <?php if(!empty($errors['username'])) :?>
        <div class="text-danger"><?=$errors['username']?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
        <input value="<?=old_value('email')?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        </div>
        <?php if(!empty($errors['email'])) :?>
        <div class="text-danger"><?=$errors['email']?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
        <input value="<?=old_value('phone')?>" name="phone" type="text" class="form-control" id="floatingInput">
        <label for="floatingInput">Phone Number</label>
        </div>
        <?php if(!empty($errors['phone'])) :?>
        <div class="text-danger"><?=$errors['phone']?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
        <select name="role" class="form-select">
            <option value="user">Customer</option>
            <option value="admin">Admin</option>
            <option value="editor">Editor</option>
            <option value="seller">Seller</option>
        </select>
        </div>
        <?php if(!empty($errors['role'])) :?>
        <div class="text-danger"><?=$errors['role']?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
        <input  value="<?=old_value('password')?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
        </div>
        <?php if(!empty($errors['password'])) :?>
        <div class="text-danger"><?=$errors['password']?></div>
        <?php endif; ?>

        <div class="form-floating mb-3">
        <input  value="<?=old_value('confirmpassword')?>" name="confirmpassword" type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password">
        <label for="floatingPassword">Confirm Password</label>
        </div>
        <button class="mt-4 btn btn-primary w-100 py-2" type="submit">Add New</button>
        </form>
    </div>
 <!--End Add new user -->
<?php elseif($action == "edit") :?>
   <!-- Edit user -->
   <div class="col-md-6 mx-auto">
        <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal">Edit user</h1>
        <?php if(!empty($row)) :?>
          <div class="form-floating mb-3">
          <input value="<?=old_value('username', $row['username'])?>" name="username" type="text" class="form-control" id="floatingInput" placeholder="Username">
          <label for="floatingInput">Username</label>
          </div>
          <?php if(!empty($errors['username'])) :?>
          <div class="text-danger"><?=$errors['username']?></div>
          <?php endif; ?>

          <div class="form-floating mb-3">
          <input value="<?=old_value('email', $row['email'])?>" name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
          </div>
          <?php if(!empty($errors['email'])) :?>
          <div class="text-danger"><?=$errors['email']?></div>
          <?php endif; ?>

          <div class="form-floating mb-3">
          <input value="<?=old_value('phone', $row['phone'])?>" name="phone" type="text" class="form-control" id="floatingInput">
          <label for="floatingInput">Phone Number</label>
          </div>
          <?php if(!empty($errors['phone'])) :?>
          <div class="text-danger"><?=$errors['phone']?></div>
          <?php endif; ?>

          <div class="form-floating mb-3">
          <select name="role" class="form-select">
              <option value="user">Customer</option>
              <option value="admin">Admin</option>
              <option value="editor">Editor</option>
              <option value="seller">Seller</option>
          </select>
          </div>
          <?php if(!empty($errors['role'])) :?>
          <div class="text-danger"><?=$errors['role']?></div>
          <?php endif; ?>

          <div class="form-floating mb-3">
          <input  value="<?=old_value('password')?>" name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
          </div>
          <?php if(!empty($errors['password'])) :?>
          <div class="text-danger"><?=$errors['password']?></div>
          <?php endif;?>

          <div class="form-floating mb-3">
          <input  value="<?=old_value('confirmpassword')?>" name="confirmpassword" type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password">
          <label for="floatingPassword">Confirm Password</label>
          </div>
          <button class="mt-4 btn btn-primary w-100 py-2" type="submit">Save</button>
        <?php endif;?>
        </form>
    </div>
 <!--End edit user -->
<?php elseif($action == "delete") :?>
  
<?php else:?>

    <div class="text-center mb-4">
      <h4>Users  
      <a class="text-white decoration-none" href="<?=ROOT?>/admin/users/add">
        <button class="btn btn-primary"> Add New </button>
      </a>
      </h4>
    </div>
    <div class="table-responsive">
    <table class="table">
      <tr>
        <th>#</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Date</th>
        <th>Action</th>
      </tr>

      <?php
        $query = "select * from users order by id desc";
        $rows = query($query);
      ?>

      <?php if(!empty($rows)) :?>
        <?php foreach($rows as $row) :?>
        <tr>
          <td><?=$row['id']?></td>
          <td><?=esc($row['username'])?></td>
          <td><?=$row['email']?></td>
          <td><?=$row['role']?></td>
          <td><?=date("jS M, Y", strtotime($row['date']))?></td>
          <td>
          <a class="text-white decoration-none" href="<?=ROOT?>/admin/users/edit/<?=$row['id']?>">
            <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button>
          </a>
          <a class="text-white decoration-none" href="<?=ROOT?>/admin/users/delete/<?=$row['id']?>">
            <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
          </a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </table>
    </div>
<?php endif;?>