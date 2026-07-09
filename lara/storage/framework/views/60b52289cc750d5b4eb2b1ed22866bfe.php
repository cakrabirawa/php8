<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', isset($breadcrumbs['title']) ? ($breadcrumbs['title'] . ' | ' . config('app.name')) : config('app.name')); ?></title>

    <link rel="icon" href="<?php echo e(config('settings.site_favicon') ?? asset('favicon.ico')); ?>" type="image/x-icon">

    <?php echo $__env->make('backend.layouts.partials.theme-colors', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->yieldContent('before_vite_build'); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js', 'resources/css/app.css'], 'build'); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo $__env->yieldContent('before_head'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty(config('settings.global_custom_css'))): ?>
    <style>
        <?php echo config('settings.global_custom_css'); ?>

    </style>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo $__env->make('backend.layouts.partials.integration-scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('head-scripts'); ?>

    <?php echo Hook::applyFilters(AdminFilterHook::ADMIN_HEAD, ''); ?>

</head>

<body x-data="{
    page: 'ecommerce',
    darkMode: false,
    stickyMenu: false,
    sidebarToggle: $persist(false),
    scrollTop: false
}"
x-init="
    darkMode = JSON.parse(localStorage.getItem('darkMode')) ?? false;
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)));
    $watch('sidebarToggle', value => localStorage.setItem('sidebarToggle', JSON.stringify(value)));
    
    // Add loaded class for smooth fade-in
    $nextTick(() => {
        document.querySelector('.app-container').classList.add('loaded');
    });
"
:class="{ 'dark bg-gray-900': darkMode === true }">

    <!-- Page Wrapper with smooth fade-in -->
    <div class="app-container flex h-screen overflow-hidden">
        <?php echo $__env->make('backend.layouts.partials.sidebar.logo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Content Area -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto bg-body dark:bg-gray-900">
            <!-- Small Device Overlay -->
            <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
            <!-- End Small Device Overlay -->

            <?php echo $__env->make('backend.layouts.partials.header.index', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Email Verification Banner -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.email-verification-banner', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1198342662-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Main Content -->
            <main class="flex-1">
                <?php if (! empty(trim($__env->yieldContent('admin-content')))): ?>
                    <?php echo $__env->yieldContent('admin-content'); ?>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($slot)): ?> <?php echo e($slot); ?> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </main>
            <!-- End Main Content -->

            <!-- Footer -->
            <?php echo $__env->make('backend.layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal704196272d5e2debce23ffdbf1a3fb23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal704196272d5e2debce23ffdbf1a3fb23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast-notifications','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast-notifications'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal704196272d5e2debce23ffdbf1a3fb23)): ?>
<?php $attributes = $__attributesOriginal704196272d5e2debce23ffdbf1a3fb23; ?>
<?php unset($__attributesOriginal704196272d5e2debce23ffdbf1a3fb23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal704196272d5e2debce23ffdbf1a3fb23)): ?>
<?php $component = $__componentOriginal704196272d5e2debce23ffdbf1a3fb23; ?>
<?php unset($__componentOriginal704196272d5e2debce23ffdbf1a3fb23); ?>
<?php endif; ?>

    <?php echo Hook::applyFilters(AdminFilterHook::ADMIN_FOOTER_BEFORE, ''); ?>


    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty(config('settings.global_custom_js'))): ?>
    <script>
        <?php echo config('settings.global_custom_js'); ?>

    </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>


    <?php echo Hook::applyFilters(AdminFilterHook::ADMIN_FOOTER_AFTER, ''); ?>

</body>
</html>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/app.blade.php ENDPATH**/ ?>