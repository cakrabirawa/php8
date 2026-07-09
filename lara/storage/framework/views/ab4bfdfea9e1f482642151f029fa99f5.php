<?php echo Hook::applyFilters(AdminFilterHook::HEADER_RIGHT_MENU_BEFORE, ''); ?>


<div class="flex items-center gap-1">
    <div class="hidden md:block">
        <?php echo $__env->make('backend.layouts.partials.demo-mode-notice', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('components.core-upgrade-notification', []);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2791570248-0', $__key);

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

    <?php echo Hook::applyFilters(AdminFilterHook::HEADER_BEFORE_LOCALE_SWITCHER, ''); ?>

    <?php if (isset($component)) { $__componentOriginal7875b222dc4d64f17fd6d2e345da8799 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tooltip','data' => ['title' => ''.e(__('Change locale')).'','position' => 'bottom']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Change locale')).'','position' => 'bottom']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php echo $__env->make('backend.layouts.partials.locale-switcher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $attributes = $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $component = $__componentOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
    <?php echo Hook::applyFilters(AdminFilterHook::HEADER_AFTER_LOCALE_SWITCHER, ''); ?>


    <?php echo Hook::applyFilters(AdminFilterHook::DARK_MODE_TOGGLER_BEFORE_BUTTON, ''); ?>


    <?php if (isset($component)) { $__componentOriginal7875b222dc4d64f17fd6d2e345da8799 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tooltip','data' => ['title' => ''.e(__('Toggle theme mode')).'','position' => 'bottom']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Toggle theme mode')).'','position' => 'bottom']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <button id="darkModeToggle"
            class="hover:text-dark-900 relative flex items-center justify-center rounded-full text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white p-2 dark-mode-toggle"
            @click.prevent="darkMode = !darkMode" @click="menuToggle = true">
            <iconify-icon icon="lucide:moon" width="24" height="24" class="hidden dark:block"></iconify-icon>
            <iconify-icon icon="lucide:sun" width="24" height="24" class="dark:hidden"></iconify-icon>
        </button>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $attributes = $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $component = $__componentOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
    <?php echo Hook::applyFilters(AdminFilterHook::DARK_MODE_TOGGLER_AFTER_BUTTON, ''); ?>


    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(config('app.show_demo_component_preview', false)): ?>
        <?php if (isset($component)) { $__componentOriginal7875b222dc4d64f17fd6d2e345da8799 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tooltip','data' => ['title' => ''.e(__('Preview demo components')).'','position' => 'bottom']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Preview demo components')).'','position' => 'bottom']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <a href="<?php echo e(route('demo.preview')); ?>" class="hover:text-dark-900 relative flex p-2 items-center justify-center rounded-full text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                <iconify-icon icon="lucide:view" width="22" height="22"></iconify-icon>
            </a>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $attributes = $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $component = $__componentOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(env('GITHUB_LINK')): ?>
        <?php if (isset($component)) { $__componentOriginal7875b222dc4d64f17fd6d2e345da8799 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.tooltip','data' => ['title' => ''.e(__('Go to Github')).'','position' => 'bottom']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('Go to Github')).'','position' => 'bottom']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <a href="<?php echo e(env('GITHUB_LINK')); ?>" target="_blank"
                class="hover:text-dark-900 relative flex p-2 items-center justify-center rounded-full text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                <iconify-icon icon="lucide:github" width="22" height="22"
                    class=""></iconify-icon>
            </a>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $attributes = $__attributesOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__attributesOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799)): ?>
<?php $component = $__componentOriginal7875b222dc4d64f17fd6d2e345da8799; ?>
<?php unset($__componentOriginal7875b222dc4d64f17fd6d2e345da8799); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php echo Hook::applyFilters(AdminFilterHook::HEADER_AFTER_ACTIONS, ''); ?>

</div>

<?php echo Hook::applyFilters(AdminFilterHook::USER_DROPDOWN_BEFORE, ''); ?>


<div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
    <a class="flex items-center text-gray-700 dark:text-gray-300" href="#"
        @click.prevent="dropdownOpen = ! dropdownOpen">
        <span class="mr-3 h-8 w-8 overflow-hidden rounded-full">
            <img src="<?php echo e(auth()->user()->avatar_url ? auth()->user()->avatar_url : auth()->user()->getGravatarUrl()); ?>" alt="User" />
        </span>
    </a>

    <div x-show="dropdownOpen"
        class="absolute right-0 mt-[17px] flex w-[220px] flex-col rounded-md border bg-white dark:bg-gray-700 border-gray-200  p-3 shadow-theme-lg dark:border-gray-800 z-100"
        style="display: none">
        <div class="border-b border-gray-200 pb-2 dark:border-gray-800 mb-2">
            <span class="block font-medium text-gray-700 dark:text-gray-300">
                <?php echo e(auth()->user()->full_name); ?>

            </span>
            <span class="mt-0.5 block text-theme-sm text-gray-700 dark:text-gray-300">
                <?php echo e(auth()->user()->email); ?>

            </span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filter_var(config('settings.auth_enable_email_verification', '0'), FILTER_VALIDATE_BOOLEAN)): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasVerifiedEmail()): ?>
                    <span class="inline-flex items-center gap-1 mt-1 text-xs text-green-600 dark:text-green-400">
                        <iconify-icon icon="lucide:badge-check" width="12" height="12"></iconify-icon>
                        <?php echo e(__('Email Verified')); ?>

                    </span>
                <?php else: ?>
                    <span class="inline-flex items-center gap-1 mt-1 text-xs text-amber-600 dark:text-amber-400">
                        <iconify-icon icon="lucide:alert-circle" width="12" height="12"></iconify-icon>
                        <?php echo e(__('Email Not Verified')); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php echo Hook::applyFilters(AdminFilterHook::USER_DROPDOWN_AFTER_USER_INFO, ''); ?>


        <ul class="flex flex-col gap-1">
            <li>
                <a href="<?php echo e(route('profile.edit')); ?>"
                    class="group flex items-center gap-3 rounded-md px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300">
                    <iconify-icon icon="lucide:user" width="20" height="20" class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300"></iconify-icon>
                    <?php echo e(__('Edit profile')); ?>

                </a>
            </li>
            <?php echo Hook::applyFilters(AdminFilterHook::USER_DROPDOWN_AFTER_PROFILE_LINKS, ''); ?>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings.view')): ?>
            <li>
                <a href="<?php echo e(route('admin.settings.index')); ?>"
                    class="group flex items-center gap-3 rounded-md px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300">
                    <iconify-icon icon="lucide:settings" width="20" height="20" class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300"></iconify-icon>
                    <?php echo e(__('Settings')); ?>

                </a>
            </li>
            <?php endif; ?>
        </ul>

        <?php echo Hook::applyFilters(AdminFilterHook::USER_DROPDOWN_AFTER_SETTINGS_LINK, ''); ?>


        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
            <?php echo csrf_field(); ?>
            <button type="submit"
                class="group flex items-center gap-3 rounded-md px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300 mt-1 w-full">
                <iconify-icon icon="lucide:log-out" width="20" height="20" class="fill-gray-500 group-hover:fill-gray-700 dark:group-hover:fill-gray-300"></iconify-icon>
                <?php echo e(__('Logout')); ?>

            </button>
        </form>

        <?php echo Hook::applyFilters(AdminFilterHook::USER_DROPDOWN_AFTER_LOGOUT, ''); ?>


        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('original_user_id')): ?>
            <?php
                $originalUser = \App\Models\User::find(session('original_user_id'));
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($originalUser): ?>
                <form method="POST" action="<?php echo e(route('admin.users.switch-back')); ?>" class="w-full">
                    <?php echo csrf_field(); ?>
                    <button type="submit"
                        class="group flex w-full items-center justify-start gap-3 rounded-md px-3 py-2 text-left text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-800 dark:text-gray-300 dark:hover:bg-white/5 dark:hover:text-gray-300 mt-1">
                        <iconify-icon icon="lucide:arrow-left" width="16" height="16" class="shrink-0"></iconify-icon>
                        <span><?php echo e(__('Switch back to')); ?> <?php echo e($originalUser->full_name); ?></span>
                    </button>
                </form>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<?php echo Hook::applyFilters(AdminFilterHook::HEADER_RIGHT_MENU_AFTER, ''); ?><?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/header/right-menu.blade.php ENDPATH**/ ?>