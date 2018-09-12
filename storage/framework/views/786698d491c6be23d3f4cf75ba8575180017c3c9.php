<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<div class="row row-margin">

    <div class="col-sm-12 grid8 margin-as-fuck">
        <h2 style="text-align: center;">
            <a href="<?php echo e(url('/')); ?>/clanek/<?php echo e($article->id); ?>">
                <?php echo e($article->title); ?>

            </a>
        </h2>
        <hr class="divider">
               <div class="row">
            <div class="container-fluid">
                <strong><?php echo e($article->created_at->format('d.m.Y')); ?>, <?php echo e($article->place); ?></strong>
            </div>
        </div>

        <?php echo $article->content; ?>

    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>