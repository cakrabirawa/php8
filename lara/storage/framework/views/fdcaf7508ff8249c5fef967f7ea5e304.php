<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => 'confirm-delete-modal',
    'title' => __('Delete Confirmation'),
    'content' => __('Are you sure you want to delete this item?'),
    'formId' => 'delete-form',
    'formAction' => '',
    'modalTrigger' => 'deleteModalOpen',
    'cancelButtonText' => __('No, cancel'),
    'confirmButtonText' => __('Yes, Confirm'),
    'wireClick' => null,
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
    'id' => 'confirm-delete-modal',
    'title' => __('Delete Confirmation'),
    'content' => __('Are you sure you want to delete this item?'),
    'formId' => 'delete-form',
    'formAction' => '',
    'modalTrigger' => 'deleteModalOpen',
    'cancelButtonText' => __('No, cancel'),
    'confirmButtonText' => __('Yes, Confirm'),
    'wireClick' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<template x-teleport="body">
    <div
        x-cloak
        x-show="<?php echo e($modalTrigger); ?>"
        x-transition.opacity.duration.200ms
        x-trap.inert.noscroll="<?php echo e($modalTrigger); ?>"
        x-on:keydown.esc.window="<?php echo e($modalTrigger); ?> = false"
        x-on:click.self="<?php echo e($modalTrigger); ?> = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 p-4 backdrop-blur-md"
        role="dialog"
        aria-modal="true"
        aria-labelledby="<?php echo e($id); ?>-title"
    >
    <div
        x-show="<?php echo e($modalTrigger); ?>"
        x-transition:enter="transition ease-out duration-200 delay-100"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="flex max-w-md flex-col gap-4 overflow-hidden rounded-md border border-outline border-gray-100 dark:border-gray-800 bg-white text-on-surface dark:border-outline-dark dark:bg-gray-700 dark:text-gray-300"
    >
        <div class="flex items-center justify-between border-b border-gray-100 px-4 py-2 dark:border-gray-800">
            <div class="flex items-center justify-center rounded-full bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400 p-1">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </div>
            <h3 id="<?php echo e($id); ?>-title" class="font-semibold tracking-wide text-gray-700 dark:text-white"><?php echo e($title); ?></h3>
            <button
                x-on:click="<?php echo e($modalTrigger); ?> = false"
                aria-label="close modal"
                class="text-gray-400 hover:bg-gray-200 hover:text-gray-700 rounded-md p-1 dark:hover:bg-gray-600 dark:hover:text-white"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="px-4 text-center">
            <p class="text-gray-500 dark:text-gray-300"><?php echo e($content); ?></p>
        </div>
        <div class="flex items-center justify-end gap-3 border-t border-gray-100 p-4 dark:border-gray-800">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($wireClick): ?>
                <button
                    type="button"
                    x-on:click="<?php echo e($modalTrigger); ?> = false"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                >
                    <?php echo e($cancelButtonText); ?>

                </button>
                <button
                    type="button"
                    wire:click="<?php echo e($wireClick); ?>"
                    x-on:click="<?php echo e($modalTrigger); ?> = false"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-800"
                >
                    <?php echo e($confirmButtonText); ?>

                </button>
            <?php else: ?>
                <form id="<?php echo e($formId); ?>" action="<?php echo e($formAction); ?>" method="POST">
                    <?php echo method_field('DELETE'); ?>
                    <?php echo csrf_field(); ?>
                    <button
                        type="button"
                        x-on:click="<?php echo e($modalTrigger); ?> = false"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                    >
                        <?php echo e($cancelButtonText); ?>

                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-300 dark:focus:ring-red-800"
                    >
                        <?php echo e($confirmButtonText); ?>

                    </button>
                </form>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
    </div>
</template>
<?php /**PATH D:\projects\php8\lara\resources\views/components/modals/confirm-delete.blade.php ENDPATH**/ ?>