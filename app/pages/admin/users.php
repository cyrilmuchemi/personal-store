<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Users - Accounts Zone</title>
  <link href="<?=ROOT?>/assets/css/style.css" rel="stylesheet">
</head>
<body class="mt-5">
<h4>Users</h4>

<table class="table">
  <tr>
    <th>#</th><th>Username</th><th>Email</th><th>Role</th><th>Date</th>
  </tr>

  <?php
    $query = "select * from users order by id desc";
    $rows = query($query);
  ?>

  <?php if(!empty($rows)) :?>
    <?php foreach($rows as $row) :?>
    <tr>
      <td><?=$row['id']?></td>
      <td><?=$row['username']?></td>
      <td><?=$row['email']?></td>
      <td><?=$row['role']?></td>
      <td><?=$row['date']?></td>
    </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
</body>
</html>