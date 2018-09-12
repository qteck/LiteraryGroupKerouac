<?php $__env->startSection('content_admin'); ?>
<h1>List of articles</h1>

                    <?php if(session('errorNote')): ?>
                    <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Danger!</strong>
                      <?php echo e(session('errorNote')); ?>

                    </div>
                    <?php endif; ?>  
<?php if($errors): ?>
	<ul>
	<?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		<li><?php echo e($error); ?></li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	</ul>
<?php endif; ?>

<?php if(count($listOfArticles) > 0): ?>
<div class="table-responsive">
<table class="table table-striped">
 	<thead>
 		<tr>
 			<th>Created</th>
 			<th>Title</th>
 			<th>Status</th>
 			<th>#</th>
 			<th>#</th>
 			<th>#</th>
 		</tr>
 	</thead>
 	    <tbody>
	<?php $__currentLoopData = $listOfArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		<tr>
		<td><?php echo e($article->scheduled->format('d.m.Y')); ?></td>
		<td>
			<a href="<?php echo e(url('/admin/dealer/update-article/'.$article->id)); ?>">
				<?php echo e($article->title); ?>

			</a>
		</td>
		<td><?php echo e($article->status); ?></td>
		<td><a href="<?php echo e(url('/clanek/'.$article->id)); ?>"><span class="glyphicon glyphicon-link"></span></a></td>
		<td><a href="<?php echo e(url('/admin/dealer/edit-article/'.$article->id)); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="<?php echo e(url('/admin/dealer/delete-article/'.$article->id)); ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	    </tbody>
</table>
</div>
<?php else: ?> 
<p>You haven't added any article.</p>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('/admin/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>