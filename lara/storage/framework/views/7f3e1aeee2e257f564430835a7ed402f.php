<?php if (isset($component)) { $__componentOriginald9fb673dbe1fc7675050b644042985bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald9fb673dbe1fc7675050b644042985bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.backend-layout','data' => ['breadcrumbs' => $breadcrumbs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.backend-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumbs)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php echo Hook::applyFilters(ModuleFilterHook::MODULE_SHOW_AFTER_BREADCRUMBS, '', $module); ?>


     <?php $__env->slot('breadcrumbsData', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginal360d002b1b676b6f84d43220f22129e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal360d002b1b676b6f84d43220f22129e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.breadcrumbs','data' => ['breadcrumbs' => $breadcrumbs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumbs'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['breadcrumbs' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($breadcrumbs)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

             <?php $__env->slot('title_before', null, []); ?> 
                <?php if (isset($component)) { $__componentOriginald5904a19266984951c04b28a7da97974 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5904a19266984951c04b28a7da97974 = $attributes; } ?>
<?php $component = App\View\Components\ModuleLogo::resolve(['module' => $module,'size' => 'sm'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModuleLogo::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald5904a19266984951c04b28a7da97974)): ?>
<?php $attributes = $__attributesOriginald5904a19266984951c04b28a7da97974; ?>
<?php unset($__attributesOriginald5904a19266984951c04b28a7da97974); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5904a19266984951c04b28a7da97974)): ?>
<?php $component = $__componentOriginald5904a19266984951c04b28a7da97974; ?>
<?php unset($__componentOriginald5904a19266984951c04b28a7da97974); ?>
<?php endif; ?>
             <?php $__env->endSlot(); ?>
             <?php $__env->slot('title_after', null, []); ?> 
                <span class="text-sm text-gray-500 dark:text-gray-400 ml-2">v<?php echo e($module->version); ?></span>
             <?php $__env->endSlot(); ?>
             <?php $__env->slot('actions_after', null, []); ?> 
                <div class="flex gap-2" x-data="{ isToggling: false, isMigrating: false }">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->documentation_url): ?>
                        <a
                            href="<?php echo e($module->documentation_url); ?>"
                            target="_blank"
                            rel="noopener"
                            class="btn-default"
                        >
                            <iconify-icon icon="lucide:book-open" class="mr-2"></iconify-icon>
                            <?php echo e(__('Documentation')); ?>

                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <button
                        type="button"
                        @click="
                            if (isMigrating) return;
                            isMigrating = true;
                            fetch('<?php echo e(route('admin.modules.run-migrations', $module->name)); ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                    'Accept': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                isMigrating = false;
                                if (data.success) {
                                    alert('<?php echo e(__('Migrations completed successfully.')); ?>');
                                } else {
                                    alert(data.message || '<?php echo e(__('Migrations failed.')); ?>');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                isMigrating = false;
                                alert('<?php echo e(__('An error occurred while running migrations.')); ?>');
                            });
                        "
                        :disabled="isMigrating"
                        class="btn-default"
                        title="<?php echo e(__('Run database migrations for this module')); ?>"
                    >
                        <iconify-icon x-show="!isMigrating" icon="lucide:database" class="mr-2"></iconify-icon>
                        <iconify-icon x-show="isMigrating" icon="lucide:loader-2" class="mr-2 animate-spin"></iconify-icon>
                        <span x-text="isMigrating ? '<?php echo e(__('Running...')); ?>' : '<?php echo e(__('Run Migrations')); ?>'"></span>
                    </button>

                    <button
                        type="button"
                        @click="
                            if (isToggling) return;
                            isToggling = true;
                            fetch('<?php echo e(route('admin.modules.toggle-status', $module->name)); ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                    'Accept': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.location.reload();
                                } else {
                                    alert(data.message || '<?php echo e(__('An error occurred')); ?>');
                                    isToggling = false;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('<?php echo e(__('An error occurred while updating module status.')); ?>');
                                isToggling = false;
                            });
                        "
                        :disabled="isToggling"
                        class="<?php echo e($module->status ? 'btn-warning' : 'btn-success'); ?>"
                    >
                        <iconify-icon x-show="!isToggling" icon="<?php echo e($module->status ? 'lucide:power-off' : 'lucide:power'); ?>" class="mr-2"></iconify-icon>
                        <iconify-icon x-show="isToggling" icon="lucide:loader-2" class="mr-2 animate-spin"></iconify-icon>
                        <span x-text="isToggling ? '<?php echo e(__('Processing...')); ?>' : '<?php echo e($module->status ? __('Disable') : __('Enable')); ?>'"></span>
                    </button>
                </div>
             <?php $__env->endSlot(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal360d002b1b676b6f84d43220f22129e2)): ?>
<?php $attributes = $__attributesOriginal360d002b1b676b6f84d43220f22129e2; ?>
<?php unset($__attributesOriginal360d002b1b676b6f84d43220f22129e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal360d002b1b676b6f84d43220f22129e2)): ?>
<?php $component = $__componentOriginal360d002b1b676b6f84d43220f22129e2; ?>
<?php unset($__componentOriginal360d002b1b676b6f84d43220f22129e2); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>

    <div class="space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->hasBannerImage()): ?>
                    <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-800">
                        <img
                            src="<?php echo e($module->getBannerUrl()); ?>"
                            alt="<?php echo e($module->title); ?> Banner"
                            class="w-full h-auto object-cover max-h-64"
                        />
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['bodyClass' => '!p-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => '!p-5']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                     <?php $__env->slot('header', null, []); ?> <?php echo e(__('Module Details')); ?> <?php $__env->endSlot(); ?>

                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        <?php echo $module->description; ?>

                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Module Name')); ?></label>
                            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 font-mono"><?php echo e($module->name); ?></p>
                        </div>

                        <div>
                            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Version')); ?></label>
                            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300"><?php echo e($module->version); ?></p>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->category): ?>
                            <div>
                                <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Category')); ?></label>
                                <p class="mt-1 text-sm text-gray-700 dark:text-gray-300"><?php echo e(ucfirst($module->category)); ?></p>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div>
                            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Priority')); ?></label>
                            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300"><?php echo e($module->priority); ?></p>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->author): ?>
                            <div>
                                <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Author')); ?></label>
                                <p class="flex gap-4 mt-1 text-sm text-gray-700 dark:text-gray-300">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->author_url): ?>
                                        <a href="<?php echo e($module->author_url); ?>" target="_blank" rel="noopener" class="text-primary-600 hover:underline">
                                            <?php echo e($module->author); ?>

                                        </a>
                                    <?php else: ?>
                                        <?php echo e($module->author); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->author_url): ?>
                                        <a href="<?php echo e($module->author_url); ?>" target="_blank" rel="noopener" class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400">
                                            <iconify-icon icon="lucide:external-link" class="text-base"></iconify-icon>
                                            <?php echo e(__('Author Website')); ?>

                                        </a>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </p>


                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $attributes = $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $component = $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>

                <?php echo Hook::applyFilters(ModuleFilterHook::MODULE_SHOW_AFTER_MAIN_CONTENT, '', $module); ?>

            </div>

            
            <div class="lg:col-span-1 space-y-6">
                <?php echo Hook::applyFilters(ModuleFilterHook::MODULE_SHOW_SIDEBAR_BEFORE, '', $module); ?>

                
                <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['bodyClass' => '!p-4 !space-y-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => '!p-4 !space-y-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                     <?php $__env->slot('header', null, []); ?> <?php echo e(__('Status')); ?> <?php $__env->endSlot(); ?>

                    <div>
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Module Status')); ?></label>
                        <div class="mt-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->status): ?>
                                <span class="badge badge-success">
                                    <iconify-icon icon="lucide:check-circle" class="mr-1"></iconify-icon>
                                    <?php echo e(__('Enabled')); ?>

                                </span>
                            <?php else: ?>
                                <span class="badge badge-danger">
                                    <iconify-icon icon="lucide:x-circle" class="mr-1"></iconify-icon>
                                    <?php echo e(__('Disabled')); ?>

                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($module->hasLogoImage()): ?>
                        <div>
                            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Logo')); ?></label>
                            <div class="mt-1">
                                <?php if (isset($component)) { $__componentOriginald5904a19266984951c04b28a7da97974 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5904a19266984951c04b28a7da97974 = $attributes; } ?>
<?php $component = App\View\Components\ModuleLogo::resolve(['module' => $module,'size' => 'lg'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('module-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModuleLogo::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald5904a19266984951c04b28a7da97974)): ?>
<?php $attributes = $__attributesOriginald5904a19266984951c04b28a7da97974; ?>
<?php unset($__attributesOriginald5904a19266984951c04b28a7da97974); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5904a19266984951c04b28a7da97974)): ?>
<?php $component = $__componentOriginald5904a19266984951c04b28a7da97974; ?>
<?php unset($__componentOriginald5904a19266984951c04b28a7da97974); ?>
<?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div>
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Icon')); ?></label>
                        <div class="mt-1 flex items-center gap-2">
                            <iconify-icon icon="<?php echo e($module->icon); ?>" class="text-xl text-gray-500 dark:text-gray-400"></iconify-icon>
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-mono"><?php echo e($module->icon); ?></span>
                        </div>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $attributes = $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $component = $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($module->tags)): ?>
                    <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['bodyClass' => '!p-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => '!p-4']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                         <?php $__env->slot('header', null, []); ?> <?php echo e(__('Tags')); ?> <?php $__env->endSlot(); ?>

                        <div class="flex flex-wrap gap-1.5">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $module->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                    <?php echo e($tag); ?>

                                </span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $attributes = $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $component = $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php echo Hook::applyFilters(ModuleFilterHook::MODULE_SHOW_SIDEBAR_AFTER, '', $module); ?>

            </div>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $module)): ?>
            <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['class' => 'border-red-200 dark:border-red-900/50']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'border-red-200 dark:border-red-900/50']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                 <?php $__env->slot('header', null, []); ?> 
                    <span class="text-red-600 dark:text-red-400"><?php echo e(__('Danger Zone')); ?></span>
                 <?php $__env->endSlot(); ?>

                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300"><?php echo e(__('Delete this module')); ?></h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo e(__('Once you delete a module, there is no going back. All module files will be removed.')); ?></p>
                    </div>

                    <div x-data="{ deleteModalOpen: false }">
                        <button
                            @click="deleteModalOpen = true"
                            type="button"
                            class="btn-danger"
                        >
                            <iconify-icon icon="lucide:trash-2" class="mr-2"></iconify-icon>
                            <?php echo e(__('Delete Module')); ?>

                        </button>

                        <?php if (isset($component)) { $__componentOriginalca6d1ceba306f01b7889f217adc4dd4a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalca6d1ceba306f01b7889f217adc4dd4a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modals.confirm-delete','data' => ['id' => 'delete-modal-'.e($module->name).'','title' => __('Delete Module'),'content' => __('Are you sure you want to delete the module :name? This action cannot be undone and will remove all module files.', ['name' => $module->title]),'formAction' => route('admin.modules.delete', $module->name),'modalTrigger' => 'deleteModalOpen','cancelButtonText' => __('No, Cancel'),'confirmButtonText' => __('Yes, Delete')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modals.confirm-delete'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'delete-modal-'.e($module->name).'','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Delete Module')),'content' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Are you sure you want to delete the module :name? This action cannot be undone and will remove all module files.', ['name' => $module->title])),'formAction' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('admin.modules.delete', $module->name)),'modalTrigger' => 'deleteModalOpen','cancelButtonText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('No, Cancel')),'confirmButtonText' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Yes, Delete'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalca6d1ceba306f01b7889f217adc4dd4a)): ?>
<?php $attributes = $__attributesOriginalca6d1ceba306f01b7889f217adc4dd4a; ?>
<?php unset($__attributesOriginalca6d1ceba306f01b7889f217adc4dd4a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalca6d1ceba306f01b7889f217adc4dd4a)): ?>
<?php $component = $__componentOriginalca6d1ceba306f01b7889f217adc4dd4a; ?>
<?php unset($__componentOriginalca6d1ceba306f01b7889f217adc4dd4a); ?>
<?php endif; ?>
                    </div>
                </div>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $attributes = $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec)): ?>
<?php $component = $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec; ?>
<?php unset($__componentOriginal42d934a7d1fb95b9706d4d8ab536daec); ?>
<?php endif; ?>
        <?php endif; ?>
    </div>

    <?php echo Hook::applyFilters(ModuleFilterHook::MODULE_SHOW_AFTER_CONTENT, '', $module); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald9fb673dbe1fc7675050b644042985bc)): ?>
<?php $attributes = $__attributesOriginald9fb673dbe1fc7675050b644042985bc; ?>
<?php unset($__attributesOriginald9fb673dbe1fc7675050b644042985bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald9fb673dbe1fc7675050b644042985bc)): ?>
<?php $component = $__componentOriginald9fb673dbe1fc7675050b644042985bc; ?>
<?php unset($__componentOriginald9fb673dbe1fc7675050b644042985bc); ?>
<?php endif; ?>
<?php /**PATH D:\projects\php8\lara\resources\views/backend/pages/modules/show.blade.php ENDPATH**/ ?>