<p>
<h3 style="display:inline-block">Permissions</h3>
        <a class="btn btn-primary pull-right" href="<?php echo base_url('settings/permissions/add'); ?>"><i class="icon-plus"></i> Add Permission</a>
</p>
<hr>
<?php if (isset($message)): ?>
    <div class="alert">
        <?php echo $message; ?>
    </div>
<?php endif; ?>
<table  class="table table-bordered tablesorter table-striped table-hover" >
    <thead>
    <th>ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Status</th>
</thead>
<?php foreach ($permissions as $value): ?>
    <tr>
        <td><?php echo $value->id;?></td>
        <td><?php echo $value->name;?></td>
        <td><?php echo $value->description;?></td>
        <td><a href="<?php echo base_url('settings/permissions/edit') . "/$value->id"; ?>" class="btn btn-primary"><i class="icon-edit icon-2x"></i></a></td>
    </tr>
<?php endforeach; ?>
</table>