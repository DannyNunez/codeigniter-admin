<h3>Manage User Roles</h3>
<hr>
<?php if (isset($message)): ?>
    <div class="alert">
        <?php echo $message; ?>
    </div>
<?php endif; ?>
<table  class="table table-bordered tablesorter table-striped table-hover" >
    <thead>
    <th>Account Type</th>
    <th>#Users</th>
    <th>Description</th>
    <th>Edit</th>
</thead>
<?php foreach ($roles as $role): ?>
    <tr>
        <td><?php echo $role->role_name;?></td>
        <td>1</td>
        <td><?php echo $role->description;?></td>
        <td><a href="<?php echo base_url('setting/roles/edit') . "/$role->id"; ?>" class="btn btn-primary"><i class="icon-edit icon-3x"></i></a></td>
    </tr>
<?php endforeach; ?>
</table>