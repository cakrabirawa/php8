<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(isset($post) ? 'Edit' : 'Create'); ?> <?php echo e($postTypeModel->label_singular); ?> - <?php echo e(config('app.name', 'Laravel')); ?></title>

    
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@2.3.0/dist/iconify-icon.min.js"></script>

    <?php echo $__env->make('backend.layouts.partials.theme-colors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/lara-builder/post-entry.jsx']); ?>

    
    <?php echo app(\App\Services\Builder\BuilderService::class)->injectToFrontend('page'); ?>

</head>
<body class="font-sans antialiased">
    <div
        id="lara-builder-root"
        data-context="page"
        data-initial-data="<?php echo e(json_encode($initialData ?? null)); ?>"
        data-post-data="<?php echo e(json_encode($postData)); ?>"
        data-save-url="<?php echo e($saveUrl); ?>"
        data-list-url="<?php echo e(route('admin.posts.index', $postType)); ?>"
        data-upload-url="<?php echo e(route('admin.posts.upload-image', $postType)); ?>"
        data-video-upload-url="<?php echo e(route('admin.posts.upload-video', $postType)); ?>"
        data-taxonomies="<?php echo e(json_encode($taxonomies ?? [])); ?>"
        data-selected-terms="<?php echo e(json_encode($selectedTerms ?? [])); ?>"
        data-parent-posts="<?php echo e(json_encode($parentPosts ?? [])); ?>"
        data-post-type="<?php echo e($postType); ?>"
        data-post-type-model="<?php echo e(json_encode([
            'label' => $postTypeModel->label,
            'label_singular' => $postTypeModel->label_singular,
            'hierarchical' => $postTypeModel->hierarchical,
            'supports_editor' => $postTypeModel->supports_editor,
            'supports_excerpt' => $postTypeModel->supports_excerpt,
            'supports_thumbnail' => $postTypeModel->supports_thumbnail,
            'icon' => $postTypeModel->icon ?? 'lucide:file-text',
        ])); ?>"
        data-statuses="<?php echo e(json_encode(\App\Models\Post::getPostStatuses())); ?>"
        data-translations='<?php echo json_encode(__("*"), 15, 512) ?>'
    ></div>

    
    <?php if (isset($component)) { $__componentOriginal84a9c9effc1da52974759c439d148b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84a9c9effc1da52974759c439d148b62 = $attributes; } ?>
<?php $component = App\View\Components\MediaModal::resolve(['id' => 'laraBuilderMediaModal','title' => __('Select Media'),'multiple' => false,'allowedTypes' => 'all','buttonClass' => 'hidden'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('media-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\MediaModal::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84a9c9effc1da52974759c439d148b62)): ?>
<?php $attributes = $__attributesOriginal84a9c9effc1da52974759c439d148b62; ?>
<?php unset($__attributesOriginal84a9c9effc1da52974759c439d148b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84a9c9effc1da52974759c439d148b62)): ?>
<?php $component = $__componentOriginal84a9c9effc1da52974759c439d148b62; ?>
<?php unset($__componentOriginal84a9c9effc1da52974759c439d148b62); ?>
<?php endif; ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/pages/posts/builder.blade.php ENDPATH**/ ?>