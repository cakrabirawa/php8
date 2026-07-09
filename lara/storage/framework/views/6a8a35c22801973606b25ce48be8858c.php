<?php
    $menuService = app(\App\Services\MenuService\AdminMenuService::class);
    $menuGroups = $menuService->getMenu();
?>

<nav
    x-data="{
        isDark: document.documentElement.classList.contains('dark'),
        textColor: '',
        init() {
            this.updateColor();
            const observer = new MutationObserver(() => this.updateColor());
            observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        },
        updateColor() {
            this.isDark = document.documentElement.classList.contains('dark');
            const liteColor = '<?php echo e(config('settings.sidebar_text_lite')); ?>';
            const darkColor = '<?php echo e(config('settings.sidebar_text_dark')); ?>';
            this.textColor = this.isDark ? darkColor : liteColor;
        },
        openDrawer(drawerId) {
            if (typeof window.openDrawer === 'function') {
                window.openDrawer(drawerId);
            }
        }
    }"
    x-init="init()"
    class="transition-all duration-300 ease-in-out px-4"
>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $menuGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $groupItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <?php echo Hook::applyFilters(AdminFilterHook::SIDEBAR_MENU_GROUP_BEFORE->value . Str::slug($groupName), ''); ?>

        <div>
            <?php echo Hook::applyFilters(AdminFilterHook::SIDEBAR_MENU_GROUP_HEADING_BEFORE->value . Str::slug($groupName), ''); ?>

            <h3 :style="textColor ? `color: ${textColor}; opacity: 0.6` : ''" class="menu-group-heading mb-4 text-xs uppercase leading-[20px] text-gray-500 font-medium dark:text-gray-300 px-5">
                <?php echo e(__($groupName)); ?>

            </h3>
            <?php echo Hook::applyFilters(AdminFilterHook::SIDEBAR_MENU_GROUP_HEADING_AFTER->value . Str::slug($groupName), ''); ?>

            <ul class="flex flex-col mb-6 space-y-1">
                <?php echo Hook::applyFilters(AdminFilterHook::SIDEBAR_MENU_BEFORE_ALL->value . Str::slug($groupName), ''); ?>

                <?php echo $menuService->render($groupItems); ?>

                <?php echo Hook::applyFilters(AdminFilterHook::SIDEBAR_MENU_AFTER_ALL->value . Str::slug($groupName), ''); ?>

            </ul>
        </div>
        <?php echo Hook::applyFilters(AdminFilterHook::SIDEBAR_MENU_GROUP_AFTER->value . Str::slug($groupName), ''); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
</nav>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/sidebar/menu.blade.php ENDPATH**/ ?>