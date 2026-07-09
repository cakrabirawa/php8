<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => '',
    'enableLivewire' => true,

    'enableSearchbar' => true,
    'searchbarPlaceholder' => __('Search...'),
    'customSeachForm' => null,

    'enableFilters' => true,
    'filters' => [],
    'customFilters' => null,
    'enableBulkActions' => true,
    'customBulkActions' => null,
    'direction' => 'desc',

    'enableNewResourceLink' => false,
    'newResourceLinkPermission' => '',
    'newResourceLinkIcon' => 'feather:plus',
    'newResourceLinkRouteName' => '',
    'newResourceLinkRouteUrl' => '',
    'newResourceLinkLabel' => __('Create New'),
    'customNewResourceLink' => null,

    'data' => [],
    'enableCheckbox' => true,
    'noResultsMessage' => __('No data found.'),
    'customNoResultsMessage' => null,
    'enablePagination' => true,
    'headers' => [],
    'sort' => '',
    'perPage' => 10,
    'perPageOptions' => [10, 20, 50, 100, __('All')],
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => '',
    'enableLivewire' => true,

    'enableSearchbar' => true,
    'searchbarPlaceholder' => __('Search...'),
    'customSeachForm' => null,

    'enableFilters' => true,
    'filters' => [],
    'customFilters' => null,
    'enableBulkActions' => true,
    'customBulkActions' => null,
    'direction' => 'desc',

    'enableNewResourceLink' => false,
    'newResourceLinkPermission' => '',
    'newResourceLinkIcon' => 'feather:plus',
    'newResourceLinkRouteName' => '',
    'newResourceLinkRouteUrl' => '',
    'newResourceLinkLabel' => __('Create New'),
    'customNewResourceLink' => null,

    'data' => [],
    'enableCheckbox' => true,
    'noResultsMessage' => __('No data found.'),
    'customNoResultsMessage' => null,
    'enablePagination' => true,
    'headers' => [],
    'sort' => '',
    'perPage' => 10,
    'perPageOptions' => [10, 20, 50, 100, __('All')],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $allIds = $data->getCollection()->pluck('id')->toArray();
?>

<div class="space-y-6"
     x-data="{
        selectedItems: Array.isArray($wire.selectedItems) ? $wire.selectedItems : [],
        selectAll: false,
        allIds: <?php echo e(json_encode($allIds)); ?>,
        bulkDeleteModalOpen: false,
        toggleSelectAll() {
            if (this.selectAll) {
                // Add current page items to selection (preserve items from other pages)
                this.allIds.forEach(id => {
                    if (!this.selectedItems.includes(id)) {
                        this.selectedItems.push(id);
                    }
                });
            } else {
                // Remove only current page items from selection (preserve items from other pages)
                this.selectedItems = this.selectedItems.filter(id => !this.allIds.includes(id));
            }
            // Update all checkboxes on current page
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                checkbox.checked = this.selectAll;
            });
            // Sync with Livewire
            if (<?php echo json_encode($enableLivewire, 15, 512) ?>) {
                $wire.set('selectedItems', this.selectedItems);
            }
        },
        updateSelectAll() {
            // Check if all current page items are selected
            this.selectAll = this.allIds.length > 0 && this.allIds.every(id => this.selectedItems.includes(id));
            // Sync with Livewire
            if (<?php echo json_encode($enableLivewire, 15, 512) ?>) {
                $wire.set('selectedItems', this.selectedItems);
            }
        },
        // Method to refresh allIds when Livewire updates
        refreshIds(newIds) {
            this.allIds = newIds;
            // Filter selectedItems to only include items that still exist
            this.selectedItems = this.selectedItems.filter(id => newIds.includes(id));
            this.updateSelectAll();
        },
        init() {
            // Set initial selectAll state based on loaded selectedItems
            this.selectAll = this.allIds.length > 0 && this.allIds.every(id => this.selectedItems.includes(id));

            // Update allIds when Livewire re-renders (e.g., pagination/perPage change)
            Livewire.hook('morph.updated', ({ el, component }) => {
                if (el === this.$root) {
                    // Get fresh IDs from the DOM after Livewire update
                    const checkboxes = this.$root.querySelectorAll('.item-checkbox');
                    // Handle both numeric and string IDs
                    this.allIds = Array.from(checkboxes).map(cb => {
                        const val = cb.value;
                        const num = parseInt(val);
                        return isNaN(num) ? val : num;
                    });
                    // Update selectAll state based on new page items
                    this.selectAll = this.allIds.length > 0 && this.allIds.every(id => this.selectedItems.includes(id));
                }
            });

            window.addEventListener('resetSelectedItems', () => {
                this.selectedItems = [];
                this.selectAll = false;

                // Uncheck all checkboxes.
                document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
            });
        }
     }"
>
    <div class="rounded-md border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex flex-col md:flex-row justify-between items-center gap-3">
            <?php echo Hook::applyFilters(DatatableHook::BEFORE_SEARCHBOX, '', $searchbarPlaceholder); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableLivewire): ?>
                <?php echo e(method_exists($this, 'renderBeforeSearchbar') ? $this->renderBeforeSearchbar() : ''); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableSearchbar): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customSeachForm): ?>
                    <?php echo $customSeachForm; ?>

                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginalb8a2867efa50924a6013800e45f17e21 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb8a2867efa50924a6013800e45f17e21 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.searchbar','data' => ['placeholder' => $searchbarPlaceholder,'enableLivewire' => $enableLivewire]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datatable.searchbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($searchbarPlaceholder),'enableLivewire' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enableLivewire)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb8a2867efa50924a6013800e45f17e21)): ?>
<?php $attributes = $__attributesOriginalb8a2867efa50924a6013800e45f17e21; ?>
<?php unset($__attributesOriginalb8a2867efa50924a6013800e45f17e21); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb8a2867efa50924a6013800e45f17e21)): ?>
<?php $component = $__componentOriginalb8a2867efa50924a6013800e45f17e21; ?>
<?php unset($__componentOriginalb8a2867efa50924a6013800e45f17e21); ?>
<?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableLivewire): ?>
                <?php echo e(method_exists($this, 'renderAfterSearchbar') ? $this->renderAfterSearchbar() : ''); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php echo Hook::applyFilters(DatatableHook::AFTER_SEARCHBOX, '', $searchbarPlaceholder); ?>


            <div class="flex items-center gap-3 flex-wrap md:flex-nowrap w-full md:w-auto">
                <div
                    class="flex items-center gap-2"
                    x-show="selectedItems.length > 0"
                >
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableBulkActions): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customBulkActions): ?>
                            <?php echo $customBulkActions; ?>

                        <?php else: ?>
                            <div class="relative flex items-center" x-data="{ open: false }">
                                <button @click="open = !open" class="btn-secondary flex items-center gap-2 text-sm whitespace-nowrap" type="button">
                                    <iconify-icon icon="lucide:more-vertical"></iconify-icon>
                                    <span><?php echo e(__('Bulk Actions')); ?> (<span x-text="selectedItems.length"></span>)</span>
                                    <iconify-icon icon="lucide:chevron-down"></iconify-icon>
                                </button>
                                <div x-show="open" @click.outside="open = false" x-transition
                                        class="absolute right-0 top-10 mt-2 w-48 rounded-md shadow bg-white dark:bg-gray-700 z-10 p-2">
                                    <ul class="space-y-2">
                                        <li class="cursor-pointer flex items-center gap-1 text-sm text-red-600 dark:text-red-500 hover:bg-red-50 dark:hover:bg-red-500 dark:hover:text-red-50 px-2 py-1.5 rounded transition-colors duration-300"
                                            @click="open = false; bulkDeleteModalOpen = true">
                                            <iconify-icon icon="lucide:trash"></iconify-icon> <?php echo e(__('Delete Selected')); ?>

                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div
                                x-cloak
                                x-show="bulkDeleteModalOpen"
                                x-transition.opacity.duration.200ms
                                x-trap.inert.noscroll="bulkDeleteModalOpen"
                                x-on:keydown.esc.window="bulkDeleteModalOpen = false"
                                x-on:click.self="bulkDeleteModalOpen = false"
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 p-4 backdrop-blur-md"
                                role="dialog"
                                aria-modal="true"
                                aria-labelledby="bulk-delete-modal-title"
                            >
                                <div
                                    x-show="bulkDeleteModalOpen"
                                    x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                    x-transition:enter-start="opacity-0 scale-50"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    class="flex max-w-md flex-col gap-4 overflow-hidden rounded-md border border-outline border-gray-100 dark:border-gray-800 bg-white text-on-surface dark:border-outline-dark dark:bg-gray-700 dark:text-gray-300"
                                >
                                    <div class="flex items-center justify-between border-b border-gray-100 px-4 py-2 dark:border-gray-800">
                                        <div class="flex items-center justify-center rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 p-1">
                                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                        </div>
                                        <h3 id="bulk-delete-modal-title" class="font-semibold tracking-wide text-gray-700 dark:text-white">
                                            <?php echo e(__('Delete Selected Items')); ?>

                                        </h3>
                                        <button
                                            x-on:click="bulkDeleteModalOpen = false"
                                            aria-label="close modal"
                                            class="text-gray-400 hover:bg-gray-200 hover:text-gray-700 rounded-md p-1 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="px-4 text-center">
                                        <p class="text-gray-500 dark:text-gray-300">
                                            <?php echo e(__('Are you sure you want to delete the selected items?')); ?>

                                            <?php echo e(__('This action cannot be undone.')); ?>

                                        </p>
                                    </div>
                                    <div class="flex items-center justify-end gap-3 border-t border-gray-100 p-4 dark:border-gray-800">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->getBulkDeleteAction()['url']): ?>
                                            <form id="bulk-delete-form" action="<?php echo e($this->getBulkDeleteAction()['url']); ?>" method="POST">
                                                <?php echo method_field($this->getBulkDeleteAction()['method']); ?>
                                                <?php echo csrf_field(); ?>

                                                <template x-for="id in selectedItems" :key="id">
                                                    <input type="hidden" name="ids[]" :value="id">
                                                </template>

                                                <button
                                                    type="button"
                                                    x-on:click="bulkDeleteModalOpen = false"
                                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                                                >
                                                    <?php echo e(__('No, Cancel')); ?>

                                                </button>

                                                <button
                                                    type="submit"
                                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-800"
                                                >
                                                    <?php echo e(__('Yes, Delete')); ?>

                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <button
                                                type="button"
                                                x-on:click="bulkDeleteModalOpen = false"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                                            >
                                                <?php echo e(__('No, Cancel')); ?>

                                            </button>
                                            <button
                                                type="button"
                                                @click="bulkDeleteModalOpen = false"
                                                <?php if($enableLivewire): ?>
                                                    wire:click="bulkDelete"
                                                    wire:loading.attr="disabled"
                                                <?php endif; ?>
                                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-800"
                                            >
                                                <?php echo e(__('Yes, Delete')); ?>

                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableFilters): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customFilters): ?>
                        <?php echo $customFilters; ?>

                    <?php else: ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($filters) && count($filters) > 0): ?>
                            <?php if (isset($component)) { $__componentOriginal1e5af5b0d78d2bc1132f4097c102b116 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1e5af5b0d78d2bc1132f4097c102b116 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.responsive-filters','data' => ['filters' => $filters,'enableLivewire' => $enableLivewire,'hasActiveFilters' => $enableLivewire && method_exists($this, 'hasActiveFilters') && $this->hasActiveFilters()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('datatable.responsive-filters'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['filters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($filters),'enableLivewire' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enableLivewire),'hasActiveFilters' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($enableLivewire && method_exists($this, 'hasActiveFilters') && $this->hasActiveFilters())]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1e5af5b0d78d2bc1132f4097c102b116)): ?>
<?php $attributes = $__attributesOriginal1e5af5b0d78d2bc1132f4097c102b116; ?>
<?php unset($__attributesOriginal1e5af5b0d78d2bc1132f4097c102b116); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1e5af5b0d78d2bc1132f4097c102b116)): ?>
<?php $component = $__componentOriginal1e5af5b0d78d2bc1132f4097c102b116; ?>
<?php unset($__componentOriginal1e5af5b0d78d2bc1132f4097c102b116); ?>
<?php endif; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableNewResourceLink): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customNewResourceLink): ?>
                        <?php echo $customNewResourceLink; ?>

                    <?php elseif($newResourceLinkPermission && ($newResourceLinkRouteUrl || $newResourceLinkRouteName) && auth()->user()->can($newResourceLinkPermission)): ?>
                        <a href="<?php echo e($newResourceLinkRouteUrl ?: route($newResourceLinkRouteName)); ?>" class="btn-primary flex items-center gap-2">
                            <iconify-icon icon="<?php echo e($newResourceLinkIcon); ?>" height="16"></iconify-icon>
                            <?php echo e($newResourceLinkLabel); ?>

                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="table-responsive">
            <table id="dataTable" class="table">
                <thead class="table-thead">
                    <tr class="table-tr">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableCheckbox ?? true): ?>
                            <th width="3%" class="table-thead-th" wire:ignore>
                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        class="form-checkbox"
                                        x-model="selectAll"
                                        @change="toggleSelectAll()"
                                    >
                                </div>
                            </th>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $headers ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <th
                            <?php if(isset($header['width'])): ?> width="<?php echo e($header['width']); ?>" <?php endif; ?>
                            class="table-thead-th <?php echo e(count($headers) - 1 === $loop->index ? 'table-thead-th-last' : ''); ?> <?php echo e(isset($header['align']) ? 'text-' . $header['align'] : ''); ?>"
                        >
                            <div class="flex w-full items-center <?php echo e(isset($header['align']) ? 'justify-' . ($header['align'] === 'right' ? 'end' : 'start') : ''); ?>">
                                <?php echo e(__($header['title'])); ?>


                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($header['sortable'] ?? false): ?>
                                <button
                                    <?php if($enableLivewire): ?>
                                        wire:click="sortBy('<?php echo e($header['sortBy'] ?? strtolower(str_replace(' ', '_', $header['title']))); ?>')"
                                    <?php else: ?>
                                        <?php
                                            $sortKey = $header['sortBy'] ?? strtolower(str_replace(' ', '_', $header['title']));
                                            $nextDirection = ($sort === $sortKey && $direction === 'asc') ? 'desc' : 'asc';
                                        ?>
                                        onclick="window.location='<?php echo e(request()->fullUrlWithQuery(['sort' => $sortKey, 'direction' => $nextDirection])); ?>'"
                                    <?php endif; ?>
                                    class="ml-1 focus:outline-none"
                                >
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header['sortBy']) && $sort === $header['sortBy'] && $direction === 'asc'): ?>
                                        <iconify-icon icon="lucide:sort-asc" class="text-primary"></iconify-icon>
                                    <?php elseif(isset($header['sortBy']) && $sort === $header['sortBy'] && $direction === 'desc'): ?>
                                        <iconify-icon icon="lucide:sort-desc" class="text-primary"></iconify-icon>
                                    <?php else: ?>
                                        <iconify-icon icon="lucide:arrow-up-down" class="text-gray-400"></iconify-icon>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </th>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </tr>
                </thead>

                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php
                            $afterRowContent = ($enableLivewire && method_exists($this, 'renderAfterRow')) ? $this->renderAfterRow($item) : null;
                            $hasAfterRow = $afterRowContent !== null;
                            $showRowBorder = !$hasAfterRow && $loop->index + 1 != count($data);
                        ?>
                        <tr class="<?php echo e($showRowBorder ? 'table-tr' : ''); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enableCheckbox ?? true && can('delete', $item)): ?>
                                <?php
                                    $itemId = $item->id;
                                    $itemIdJson = json_encode($itemId);
                                ?>
                                <td class="table-td table-td-checkbox" wire:ignore>
                                    <input
                                        type="checkbox"
                                        class="item-checkbox form-checkbox"
                                        value="<?php echo e($itemId); ?>"
                                        :checked="selectedItems.includes(<?php echo e($itemIdJson); ?>)"
                                        @change="
                                            const itemId = <?php echo e($itemIdJson); ?>;
                                            if ($event.target.checked) {
                                                if (!selectedItems.includes(itemId)) {
                                                    selectedItems.push(itemId);
                                                }
                                            } else {
                                                selectedItems = selectedItems.filter(id => id !== itemId);
                                            }
                                            updateSelectAll();
                                        "
                                    />
                                </td>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $headers ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <td class="table-td <?php echo e(isset($header['align']) ? 'text-' . $header['align'] : ''); ?>">
                                    <?php
                                        $pascalCaseId = collect(explode('_', $header['id']))->map(fn($part) => ucfirst($part))->implode('');
                                        $content = isset($data[$loop->index][$header['id']]) ? $data[$loop->index][$header['id']] : null;
                                        if ($enableLivewire){
                                            // Convert snake_case to PascalCase for method name discovery
                                            $autoDiscoverableMethodName = 'render' . $pascalCaseId . 'Column';

                                            // Custom Blade include/component.
                                            if (isset($header['renderContent']) && is_string($header['renderContent'])) {
                                                $content = $this->{$header['renderContent']}($item, $header);
                                            } elseif (isset($header['renderRawContent'])) {
                                                $content = $header['renderRawContent'];
                                            } elseif (method_exists($this, $autoDiscoverableMethodName)) { // Auto-discovered method - `render[Id]Cell()`
                                                $content = $this->{$autoDiscoverableMethodName}($item, $header);
                                            } elseif (isset($item->{$header['id']})) { // model property
                                                $content = $item->{$header['id']} ?? '';
                                            }
                                        }
                                    ?>
                                    <?php echo $content; ?>

                                </td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tr>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasAfterRow): ?>
                            <tr class="after-row-content <?php echo e($loop->index + 1 != count($data) ? 'table-tr' : ''); ?>">
                                <td colspan="<?php echo e(count($headers ?? []) + ($enableCheckbox ?? true ? 1 : 0)); ?>" class="p-0 border-0">
                                    <?php echo e($afterRowContent); ?>

                                </td>
                            </tr>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="<?php echo e(count($headers ?? []) + ($enableCheckbox ?? true ? 1 : 0)); ?>" class="text-center py-4">
                                <p class="text-gray-500 dark:text-gray-300">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($customNoResultsMessage ?? false): ?>
                                        <?php echo $customNoResultsMessage; ?>

                                    <?php else: ?>
                                        <?php echo $noResultsMessage ?? __('No data found.'); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($enablePagination ?? true): ?>
                <div class="my-4 px-4 sm:px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <label for="perPage" class="text-sm text-gray-600 dark:text-gray-300"><?php echo e(__('Per page')); ?></label>
                        <select
                            id="perPage"
                            wire:model.live="perPage"
                            class="form-control w-20"
                        >
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $perPageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <option value="<?php echo e($option == 'All' ? 999999 : $option); ?>">
                                    <?php echo e($option); ?>

                                </option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="pagination-links">
                        <?php echo e($data->links()); ?>

                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div><?php /**PATH D:\projects\php8\lara\resources\views/components/datatable/datatable.blade.php ENDPATH**/ ?>