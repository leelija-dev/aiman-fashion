<?php $__env->startSection('source', 'Brands'); ?>
<?php $__env->startSection('page-title', 'Brands'); ?>

<?php $__env->startSection('title'); ?>
<?php echo e(config('app.name')); ?> - Brands

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-3 flex-sm-nowrap flex-wrap">
                    <h4 class="card-title">Brands</h4>
                    <div class="d-flex gap-2 flex-wrap w-sm-auto w-100">
                        <a href="<?php echo e(route('admin.brands.trashed')); ?>" class="btn btn-outline-secondary w-sm-auto w-100 mb-0">
                            <i class="fas fa-trash"></i> View Trashed Brands
                        </a>

                        <a href="<?php echo e(route('admin.brands.create')); ?>" class="btn btn-primary w-sm-auto w-100 mb-0">
                            <i class="fas fa-plus"></i> Add New Brand
                        </a>
                    </div>
                </div>
                <div class=" px-3 pt-0 pb-2">
                    <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">#</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Slug</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Created At</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($brand->name); ?></td>
                                    <td><?php echo e($brand->slug); ?></td>
                                    <td>
                                        <?php if($brand->is_active): ?>
                                        <span class="badge bg-success rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Active
                                        </span>
                                        <?php else: ?>
                                        <span class="badge bg-danger rounded-pill">
                                            <i class="fas fa-times-circle me-1"></i> Inactive
                                        </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($brand->created_at->format('d M, Y')); ?></td>
                                    <td>
                                        <div class=" d-flex gap-2">
                                            <a href="<?php echo e(route('admin.brands.show', $brand->id)); ?>"
                                                class="btn btn-info px-3 py-2  d-flex justify-content-center align-items-center"
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.brands.edit', $brand->id)); ?>"
                                                class="btn btn-primary px-3 py-2  d-flex justify-content-center align-items-center"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="d-none" id="delete-form-<?php echo e($brand->id); ?>" action="<?php echo e(route('admin.brands.destroy', $brand->id)); ?>"
                                                method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                

                                                
                                                
                                            </form>
                                            <button class="btn btn-danger px-3 py-2  d-flex justify-content-center align-items-center" href="javascript:void(0);"
                                                onclick="confirmDelete(<?php echo e($brand->id); ?>)">
                                                <i
                                                    class="fa-solid fa-trash "></i>
                                            </button>
                                            
                                            



                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Brands not available!</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <?php echo e($brands->links('pagination::bootstrap-5')); ?>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be delete this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\aiman\resources\views/Admin/brands/index.blade.php ENDPATH**/ ?>