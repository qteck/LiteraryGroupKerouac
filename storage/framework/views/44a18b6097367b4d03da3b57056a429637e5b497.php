 

<?php $__env->startSection('content_admin'); ?>
<h1>List of Books</h1>
<?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<?php echo e($error); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
<div class="table-responsive">
<table class="table table-striped">
 	<thead>
 		<tr>
 			<th>Created</th>
 			<th>Title</th>
 			<th>Description</th>
 			<th>Author</th>
 			<th>Price</th>
 			<th>#</th>
 			<th>#</th>
 		</tr>
 	</thead>
 	    <tbody>
	<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		<tr>
		<td><?php echo e($book->created_at->format('d.m.Y')); ?></td>
		<td>
			<a href="<?php echo e(url('/admin/dealer/update-gallery/'.$book->id)); ?>">
				<?php echo e($book->title); ?>

			</a>
		</td>
		<td><?php echo e($book->description); ?></td>
		<td><?php echo e($book->author); ?></td>
		<td><?php echo e($book->price); ?></td>
		<td><a href="<?php echo e(url('/admin/dealer/books/edit/'.$book->id)); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
		<td><a href="<?php echo e(url('/admin/dealer/books/delete/'.$book->id)); ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	    </tbody>
</table>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('/admin/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>