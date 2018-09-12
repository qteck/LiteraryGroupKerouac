 

<?php $__env->startSection('content_admin'); ?>
  <h1>Orders</h1>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Forename</th>
        <th>Surname</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Item</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Currency</th>
        <th>Address</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
     <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
      <tr>
        <td><?php echo e($order->forename); ?></td>
        <td><?php echo e($order->surname); ?></td>
        <td><?php echo e($order->phone); ?></td>
        <td><?php echo e($order->email); ?></td>
        <td><?php echo e($order->orderedItem_id); ?></td>
        <td><?php echo e($order->price); ?></td>
        <td><?php echo e($order->quantity); ?></td>
        <td><?php echo e($order->currency); ?></td>
        <td><?php echo e($order->address); ?></td>
        <td><?php echo e($order->status); ?></td>
        <td><?php echo e($order->created_at); ?></td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    </tbody>
  </table>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('/admin/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>