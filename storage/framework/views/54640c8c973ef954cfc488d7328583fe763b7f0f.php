 

<?php $__env->startSection('content_admin'); ?>
  <h1>List of events</h1>

<div class="table-responsive row-margin">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Datum</th>
				<th>Místo</th>
				<th>Status</th>
				<th>Status</th>
				<th>#</th>
				<th>#</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
		<?php $__currentLoopData = $listOfEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			<tr>
				<td><?php echo e($listOfEvents->count--); ?></td>
				<td><?php echo e($tour->date_of_event); ?></td>
				<td><?php echo e($tour->place); ?></td>
				<td><?php echo e($tour->status); ?></td>
				<td><a href="<?php echo e(url('/literarni-tour/'.$tour->id)); ?>">Zobrazit mapu</a></td>
				<td><a href="<?php echo e(url('/literarni-tour/'.$tour->id)); ?>"><span class="glyphicon glyphicon-link"></span></a></td>
				<td><a href="<?php echo e(url('/literarni-tour/edit/'.$tour->id)); ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
				<td><a href="<?php echo e(url('/literarni-tour/delete/'.$tour->id)); ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
			</tr>
	   	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</tbody>
	</table>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('/admin/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>