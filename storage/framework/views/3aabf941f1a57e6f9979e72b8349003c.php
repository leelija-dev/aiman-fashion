
<?php $__env->startSection('source', 'Size'); ?>
<?php $__env->startSection('page-title', 'Sizes'); ?>

<?php $__env->startSection('title'); ?>
<?php echo e(config('app.name')); ?> - Sizes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex flex-wrap flex-lg-nowrap justify-content-between align-items-center">
                <!-- Search Form -->
                <form method="GET" action="<?php echo e(route('admin.sizes')); ?>" class="mb-2 mb-md-0 d-flex w-100 w-lg-50">
                    <div class="d-flex gap-2 col-12 flex-sm-nowrap flex-wrap justify-content-sm-start justify-content-end">
                        <input type="text" name="search" class="form-control me-2" style="height:40px;width:100%;" placeholder="Search by name or code" value="<?php echo e(request('search')); ?>">
                        <button type="submit" class="btn btn-primary me-2 mb-sm-3 mb-1" style="height:40px;">Search</button>
                        <a href="<?php echo e(route('admin.sizes')); ?>" class="btn btn-danger mb-sm-3 mb-1" style="height:40px;">Reset</a>
                    </div>
                </form>

                <!-- Action Button -->
                <div class="d-flex gap-2 flex-sm-nowrap flex-wrap justify-content-end w-100 w-xl-50">
                    <a href="<?php echo e(route('admin.sizes.create')); ?>" class="btn btn-primary w-100 w-sm-auto mb-sm-3 mb-1">
                        <i class="fas fa-plus"></i> Add New Size
                    </a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Size Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sort Order</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm"><?php echo e($size->name); ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <span class="badge bg-info text-white"><?php echo e($size->code); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <span class="text-sm"><?php echo e($size->sort_order); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="#" class="text-secondary font-weight-bold text-xs me-4"
                                       data-bs-toggle="modal" data-bs-target="#editModal<?php echo e($size->id); ?>"
                                       title="Edit size">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form id="delete-form-<?php echo e($size->id); ?>"
                                          action="<?php echo e(route('admin.sizes.delete', $size->id)); ?>"
                                          method="POST" style="display:none;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                    <a href="javascript:void(0);"
                                       onclick="confirmDelete(<?php echo e($size->id); ?>)">
                                        <i class="fa-solid fa-trash text-danger font-weight-bold text-xs"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal<?php echo e($size->id); ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo e($size->id); ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?php echo e($size->id); ?>">Edit Size</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form id="editForm<?php echo e($size->id); ?>"
                                              action="<?php echo e(route('admin.sizes.update', $size->id)); ?>"
                                              method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="modal-body text-start">
                                                <div class="mb-3">
                                                    <label for="edit_name_<?php echo e($size->id); ?>" class="form-label">Size Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="edit_name_<?php echo e($size->id); ?>" name="name" 
                                                           value="<?php echo e($size->name); ?>" maxlength="20" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_code_<?php echo e($size->id); ?>" class="form-label">Size Code <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="edit_code_<?php echo e($size->id); ?>" name="code" 
                                                           value="<?php echo e($size->code); ?>" maxlength="10" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_sort_order_<?php echo e($size->id); ?>" class="form-label">Sort Order</label>
                                                    <input type="number" class="form-control" id="edit_sort_order_<?php echo e($size->id); ?>" name="sort_order" 
                                                           value="<?php echo e($size->sort_order); ?>" min="0">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <p class="text-muted">No sizes found.</p>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Showing <?php echo e($data->firstItem()); ?> to <?php echo e($data->lastItem()); ?> of <?php echo e($data->total()); ?> entries
                    </div>
                    <div>
                        <?php echo e($data->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function confirmDelete(sizeId) {
    if (confirm('Are you sure you want to delete this size?')) {
        document.getElementById('delete-form-' + sizeId).submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Form validation for edit modals
    document.querySelectorAll('form[id^="editForm"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            const sizeId = this.id.replace('editForm', '');
            const name = document.getElementById('edit_name_' + sizeId);
            const code = document.getElementById('edit_code_' + sizeId);

            let isValid = true;

            // Reset validation states
            this.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            // Validate required fields
            if (!name.value.trim()) {
                name.classList.add('is-invalid');
                isValid = false;
            }

            if (!code.value.trim()) {
                code.classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields correctly.');
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\aiman\resources\views/Admin/size/index.blade.php ENDPATH**/ ?>