<?php $__env->startSection('content'); ?>
<div class="row">
	<div class="col-md-4">

		<blockquote class="blockquote ">
			<p class="m-b-0">
				Everything depends upon execution; having just a vision is no solution.
				<footer class="blockquote-footer"><cite title="Source Title">Stephen Sondheim</cite></footer>
			</p>
		</blockquote>		

	</div>
	<div class="col-md-8"><h2><?php echo e($tour->title); ?></h2></div>
</div>

<div class="container-fluid">
<div class="row row-margin">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Datum</th>
				<th>Místo</th>
				<th>Cena</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>#</td>
				<td><?php echo e($tour->date_of_event); ?></td>
				<td><?php echo e($tour->place); ?></td>
				<th><?php echo e($tour->price); ?> kč</th>
				<td><?php echo e($tour->status); ?></td>
			</tr>
		</tbody>
	</table>
	<iframe src="<?php echo e($tour->map_url); ?>" style="width: 100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>