 

<?php $__env->startSection('content_admin'); ?>
  <h1>Add an event</h1>

<?php if(count($errors) > 0): ?>
<div class="alert alert-danger">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </ul>
</div>
<?php endif; ?>

                <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <strong>Success!</strong>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <?php echo e(session('success')); ?>

                </div>
                <?php endif; ?>


<form class="form-horizontal panel panel-default" action="<?php echo e(url('/')); ?>/admin/dealer/add-event-action" style="width:50%;padding: 20px;" method="POST">
    <?php echo e(csrf_field()); ?>

    <div class="form-group row">
        <label for="title" class="col-md-3">Title:</label>
        <div class="col-md-9">
            <input type="text" id="title" class="form-control" value="<?php echo e(old('title')); ?>" name="title">
        </div>
    </div>
    <div class="form-group">
        <label for="place" class="col-md-3">Place:</label>
        <div class="col-md-9">
            <input type="text" id="place" class="form-control" value="<?php echo e(old('place')); ?>" name="place">
        </div>
    </div>
      <div class="form-group">
        <label for="price" class="col-md-3">Price:</label>
        <div class="col-md-9">
            <input type="text" id="price" class="form-control" value="<?php echo e(old('price')); ?>" name="price">
        </div>
    </div>
    <div class="form-group">
        <label for="map_url" class="col-md-3">Map URL (maps.google.cz):</label>
        <div class="col-md-9">
            <textarea id="map_url" class="form-control" name="map_url"><?php echo e(old('map_url')); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="date_of_event" class="col-md-3">Datum konání:</label>
        <div class="col-md-9">
            <input type="text" id="date_of_event" class="form-control" value="<?php echo e(old('date_of_event')); ?>" name="date_of_event">
        </div>
    </div>
    <div class="form-group">
        <label for="status" class="col-md-3">Status:</label>
        <div class="col-md-9">
            <input type="text" id="status" class="form-control" value='<?php echo e(old('status')); ?>' name="status">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-md-9">
            <input type="submit" class="btn btn-primary" name="addEventSubmit" value="Add event">
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('/admin/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>