<div class="text-center mb-4">
      <h4>Sellers</h4>
    </div>
    <div class="table-responsive">
    <table class="table">
      <tr>
        <th>#</th>
        <th>Email</th>
        <th>Role</th>
        <th>Phone</th>
        <th>Account Name</th>
        <th>Best Price</th>
        <th>Date</th>
        <th>Action</th>
      </tr>

      <?php
        $limit = 10; 
        $offset = ($PAGE['page_number'] - 1) * $limit;

        $query = "select * from sellers order by id desc limit $limit offset $offset";
        $rows = query($query);
      ?>

      <?php if(!empty($rows)) :?>
        <?php foreach($rows as $row) :?>
        <tr>
          <td><?=$row['id']?></td>
          <td><?=$row['email']?></td>
          <td><?=$row['role']?></td>
          <td><?=$row['phone']?></td>
          <td><?=$row['account_name']?></td>
          <td><?=$row['account_price']?></td>
          <td><?=date("jS M, Y", strtotime($row['date']))?></td>
          <td>
          <a class="text-white decoration-none" href="<?=ROOT?>/admin/sellers/delete/<?=$row['id']?>">
            <button class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
          </a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <div class="col-md-12">
      <a href="<?=$PAGE['first_link']?>">
        <button class="btn btn-success" type="button">First Page</button>
      </a>
      <a href="<?=$PAGE['prev_link']?>">
        <button class="btn btn-success mx-3" type="button">Prev Page</button>
      </a>
      <a href="<?=$PAGE['next_link']?>">
        <button class="btn btn-success float-end" type="button">Next Page</button>
      </a>
    </div>
    </div>