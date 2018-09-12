<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-4">

		<blockquote class="blockquote ">
			<p class="m-b-0">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit.
			</p>
		</blockquote>		

	</div>
	<div class="col-md-8"><h2>Literární tour</h2></div>
</div>

<div class="table-responsive row-margin">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Datum</th>
				<th>Místo</th>
				<th>Status</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
		<?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<tr>
				<td>1</td>
				<td><?php echo e($tour->date_of_event); ?></td>
				<td><?php echo e($tour->place); ?></td>
				<td><?php echo e($tour->status); ?></td>
				<th><a href="<?php echo e(url('/')); ?>/literarni-tour/<?php echo e($tour->id); ?>">Zobrazit mapu</a></th>
			</tr>
	   	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</tbody>
	</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>