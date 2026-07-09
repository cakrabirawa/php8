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

    <?php echo Hook::applyFilters(PostFilterHook::POSTS_SHOW_AFTER_BREADCRUMBS, '', $postType); ?>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
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

                 <?php $__env->slot('header', null, []); ?> <?php echo e(__('Content')); ?> <?php $__env->endSlot(); ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->content): ?>
                    <div class="prose max-w-none dark:prose-invert prose-headings:font-medium prose-headings:text-gray-700 dark:prose-headings:text-white/90 prose-p:text-gray-700 dark:prose-p:text-gray-300 lb-content-preview">
                        <?php echo $post->renderContent(); ?>

                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->design_json): ?>
                        
                        <style>
                            /* Base block styles */
                            .lb-content-preview .lb-block { display: block; margin-bottom: 16px; }
                            .lb-content-preview .lb-content { max-width: 100%; }

                            /* Text blocks */
                            .lb-content-preview .lb-heading { margin-bottom: 16px; }
                            .lb-content-preview .lb-text { margin-bottom: 16px; }
                            .lb-content-preview .lb-text-editor { margin-bottom: 16px; }
                            .lb-content-preview .lb-list { margin-bottom: 16px; }

                            /* Image block */
                            .lb-content-preview .lb-image { margin-bottom: 16px; }
                            .lb-content-preview .lb-image img { max-width: 100%; height: auto; }

                            /* Button block */
                            .lb-content-preview .lb-button { margin-bottom: 16px; }
                            .lb-content-preview .lb-button a { text-decoration: none; transition: opacity 0.2s ease; }
                            .lb-content-preview .lb-button a:hover { opacity: 0.9; }

                            /* Columns block */
                            .lb-content-preview .lb-columns { margin-bottom: 16px; }
                            .lb-content-preview .lb-column { flex: 1; min-width: 0; }

                            /* Divider & Spacer */
                            .lb-content-preview .lb-divider { border: none; }
                            .lb-content-preview .lb-spacer { display: block; }

                            /* Quote block */
                            .lb-content-preview .lb-quote { margin-bottom: 16px; }

                            /* Video block */
                            .lb-content-preview .lb-video { margin-bottom: 16px; }
                            .lb-content-preview .lb-video-container { cursor: pointer; }
                            .lb-content-preview .lb-video-play-btn:hover { background: rgba(0,0,0,0.9) !important; }

                            /* Social block */
                            .lb-content-preview .lb-social { margin-bottom: 16px; }

                            /* Table block */
                            .lb-content-preview .lb-table { margin-bottom: 16px; }
                            .lb-content-preview .lb-table-inner { width: 100%; border-collapse: collapse; }

                            /* Footer block */
                            .lb-content-preview .lb-footer { margin-bottom: 16px; }

                            /* Countdown block */
                            .lb-content-preview .lb-countdown { margin-bottom: 16px; }

                            /* Accordion block */
                            .lb-content-preview .lb-accordion { margin-bottom: 16px; }

                            /* Section block */
                            .lb-content-preview .lb-section { margin-bottom: 16px; }

                            /* Code block */
                            .lb-content-preview .lb-code { margin-bottom: 16px; }

                            /* HTML block */
                            .lb-content-preview .lb-html { margin-bottom: 16px; }

                            /* Table of Contents block */
                            .lb-content-preview .lb-toc { margin-bottom: 16px; }
                            .lb-content-preview .lb-toc-list { margin: 0; padding: 0; }
                            .lb-content-preview .lb-toc-list li { margin-bottom: 6px; line-height: 1.6; }
                            .lb-content-preview .lb-toc-list a { text-decoration: none; transition: opacity 0.2s; }
                            .lb-content-preview .lb-toc-list a:hover { opacity: 0.8; text-decoration: underline; }

                            /* Markdown block */
                            .lb-content-preview .lb-markdown { margin-bottom: 16px; }
                            .lb-content-preview .markdown-source { margin-bottom: 12px; padding: 8px 12px; background: #f9fafb; border-radius: 6px; font-size: 12px; color: #6b7280; }
                            .lb-content-preview .markdown-source a { color: #6366f1; text-decoration: underline; }
                            .lb-content-preview .markdown-body { line-height: 1.6; }
                            .lb-content-preview .markdown-body h1 { font-size: 2em; font-weight: 700; margin: 1em 0 0.5em; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.3em; }
                            .lb-content-preview .markdown-body h2 { font-size: 1.5em; font-weight: 600; margin: 1em 0 0.5em; border-bottom: 1px solid #e5e7eb; padding-bottom: 0.3em; }
                            .lb-content-preview .markdown-body h3 { font-size: 1.25em; font-weight: 600; margin: 1em 0 0.5em; }
                            .lb-content-preview .markdown-body h4 { font-size: 1em; font-weight: 600; margin: 1em 0 0.5em; }
                            .lb-content-preview .markdown-body p { margin: 0 0 1em; }
                            .lb-content-preview .markdown-body ul, .lb-content-preview .markdown-body ol { margin: 0 0 1em; padding-left: 2em; }
                            .lb-content-preview .markdown-body li { margin: 0.25em 0; }
                            .lb-content-preview .markdown-body code { background: #f3f4f6; padding: 0.2em 0.4em; border-radius: 4px; font-size: 0.875em; font-family: ui-monospace, monospace; }
                            .lb-content-preview .markdown-body pre { background: #1f2937; color: #e5e7eb; padding: 1em; border-radius: 8px; overflow-x: auto; margin: 0 0 1em; }
                            .lb-content-preview .markdown-body pre code { background: transparent; padding: 0; color: inherit; }
                            .lb-content-preview .markdown-body blockquote { border-left: 4px solid #6366f1; padding-left: 1em; margin: 0 0 1em; color: #6b7280; font-style: italic; }
                            .lb-content-preview .markdown-body a { color: #6366f1; text-decoration: underline; }
                            .lb-content-preview .markdown-body a:hover { color: #4f46e5; }
                            .lb-content-preview .markdown-body table { border-collapse: collapse; width: 100%; margin: 0 0 1em; }
                            .lb-content-preview .markdown-body th, .lb-content-preview .markdown-body td { border: 1px solid #e5e7eb; padding: 0.5em 1em; text-align: left; }
                            .lb-content-preview .markdown-body th { background: #f9fafb; font-weight: 600; }
                            .lb-content-preview .markdown-body hr { border: none; border-top: 1px solid #e5e7eb; margin: 2em 0; }
                            .lb-content-preview .markdown-body img { max-width: 100%; height: auto; border-radius: 8px; }
                            .lb-content-preview .markdown-body input[type="checkbox"] { margin-right: 0.5em; }

                            /* Markdown empty state */
                            .lb-content-preview .markdown-empty { padding: 24px; padding-top: 10px; text-align: center; color: #9ca3af; background: #f9fafb; border: 1px dashed #e5e7eb; border-radius: 8px; }
                            .lb-content-preview .markdown-error { margin-bottom: 16px; }

                            /* Syntax highlighting overrides for Prism */
                            .lb-content-preview .markdown-body pre { background: #1e1e1e; padding: 0; }
                            .lb-content-preview .markdown-body pre code { display: block; padding: 1em; background: transparent; font-size: 0.875em; line-height: 1.5; }
                            .lb-content-preview .markdown-body code:not([class*="language-"]) { background: #f3f4f6; color: #e83e8c; }

                            /* Responsive */
                            @media (max-width: 768px) {
                                .lb-content-preview .lb-columns { flex-direction: column; }
                                .lb-content-preview .lb-column { flex: none !important; width: 100% !important; }
                            }
                        </style>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(str_contains($post->content ?? '', 'markdown') || str_contains($post->content ?? '', 'language-') || str_contains($post->content ?? '', '"code"')): ?>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" />
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.css" />
                            <style>
                                /* Copy button styling */
                                .code-toolbar .toolbar { opacity: 1; }
                                .code-toolbar .toolbar-item button {
                                    background: #3b3b3b !important;
                                    color: #e5e7eb !important;
                                    border-radius: 4px !important;
                                    padding: 4px 10px !important;
                                    font-size: 12px !important;
                                    box-shadow: none !important;
                                    border: 1px solid #4b4b4b !important;
                                    transition: all 0.2s ease !important;
                                }
                                .code-toolbar .toolbar-item button:hover {
                                    background: #4b4b4b !important;
                                    color: #fff !important;
                                }
                                .code-toolbar .toolbar-item button:focus {
                                    outline: none !important;
                                }
                            </style>
                            <script>
                                (function() {
                                    // Load Prism core first, then languages sequentially
                                    function loadScript(src) {
                                        return new Promise(function(resolve, reject) {
                                            var script = document.createElement('script');
                                            script.src = src;
                                            script.onload = resolve;
                                            script.onerror = reject;
                                            document.head.appendChild(script);
                                        });
                                    }

                                    var baseUrl = 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/';
                                    // Order matters: markup -> markup-templating -> php (dependency chain)
                                    var languages = ['markup', 'css', 'clike', 'javascript', 'markup-templating', 'php', 'typescript', 'jsx', 'tsx', 'scss', 'bash', 'json', 'yaml', 'sql', 'python'];

                                    // Load core first
                                    loadScript(baseUrl + 'prism.min.js').then(function() {
                                        // Load languages sequentially to handle dependencies
                                        return languages.reduce(function(promise, lang) {
                                            return promise.then(function() {
                                                return loadScript(baseUrl + 'components/prism-' + lang + '.min.js').catch(function() {
                                                    console.warn('Failed to load Prism language: ' + lang);
                                                });
                                            });
                                        }, Promise.resolve());
                                    }).then(function() {
                                        // Load toolbar plugin (required for copy button)
                                        return loadScript(baseUrl + 'plugins/toolbar/prism-toolbar.min.js');
                                    }).then(function() {
                                        // Load copy-to-clipboard plugin
                                        return loadScript(baseUrl + 'plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js');
                                    }).then(function() {
                                        // Highlight all code blocks
                                        if (window.Prism) {
                                            Prism.highlightAll();
                                        }
                                    });
                                })();
                            </script>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <p class="text-gray-400 dark:text-gray-500 italic"><?php echo e(__('No content available.')); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
        </div>

        
        <div class="lg:col-span-1 space-y-6">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->hasFeaturedImage()): ?>
                <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['bodyClass' => '!p-4 !space-y-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => '!p-4 !space-y-0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                     <?php $__env->slot('header', null, []); ?> <?php echo e(__('Featured Image')); ?> <?php $__env->endSlot(); ?>

                    <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-800">
                        <img src="<?php echo e($post->getFeaturedImageUrl()); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-auto object-cover max-h-96">
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

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->excerpt): ?>
                <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['bodyClass' => '!p-4 !space-y-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => '!p-4 !space-y-0']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                     <?php $__env->slot('header', null, []); ?> <?php echo e(__('Excerpt')); ?> <?php $__env->endSlot(); ?>

                    <p class="text-gray-600 dark:text-gray-300 italic leading-relaxed text-sm"><?php echo e($post->excerpt); ?></p>
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

            
            <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['bodyClass' => '!space-y-4 pt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => '!space-y-4 pt-2']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                 <?php $__env->slot('header', null, []); ?> <?php echo e(__('Status & Info')); ?> <?php $__env->endSlot(); ?>
                
                <div>
                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Slug')); ?></label>
                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 break-words"><?php echo e($post->slug); ?></p>
                </div>

                
                <div>
                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Status')); ?></label>
                    <div class="mt-1">
                        <span class="badge <?php echo e(get_post_status_class($post->status)); ?>">
                            <?php echo e(ucfirst($post->status)); ?>

                        </span>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->published_at): ?>
                    <div>
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Published')); ?></label>
                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">
                            <?php echo e($post->published_at->format('M d, Y h:i A')); ?>

                        </p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <div>
                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Author')); ?></label>
                    <div class="mt-1 flex items-center gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($post->user->avatar_url)): ?>
                            <img src="<?php echo e($post->user->avatar_url); ?>" alt="<?php echo e($post->user->full_name); ?>" class="w-6 h-6 rounded-full">
                        <?php else: ?>
                            <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <iconify-icon icon="lucide:user" class="text-xs text-gray-500 dark:text-gray-400"></iconify-icon>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <span class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($post->user->full_name); ?></span>
                    </div>
                </div>

                
                <div>
                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Created')); ?></label>
                    <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">
                        <?php echo e($post->created_at->format('M d, Y h:i A')); ?>

                    </p>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->created_at != $post->updated_at): ?>
                    <div>
                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(__('Last Updated')); ?></label>
                        <p class="mt-1 text-sm text-gray-700 dark:text-gray-300">
                            <?php echo e($post->updated_at->format('M d, Y h:i A')); ?>

                        </p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->terms->count() > 0): ?>
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

                     <?php $__env->slot('header', null, []); ?> <?php echo e(__('Taxonomies')); ?> <?php $__env->endSlot(); ?>

                    <?php
                        $groupedTerms = $post->terms->groupBy('taxonomy');
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $groupedTerms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taxonomy => $terms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div>
                            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e(ucfirst($taxonomy)); ?></label>
                            <div class="mt-2 flex flex-wrap gap-1.5">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">
                                        <?php echo e($term->name); ?>

                                    </span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->postMeta && $post->postMeta->count() > 0): ?>
                <?php if (isset($component)) { $__componentOriginal42d934a7d1fb95b9706d4d8ab536daec = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42d934a7d1fb95b9706d4d8ab536daec = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.card','data' => ['bodyClass' => '!p-4 !space-y-3']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['bodyClass' => '!p-4 !space-y-3']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                     <?php $__env->slot('header', null, []); ?> <?php echo e(__('Custom Fields')); ?> <?php $__env->endSlot(); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $post->postMeta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div>
                            <label class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"><?php echo e($meta->meta_key); ?></label>
                            <p class="mt-1 text-sm text-gray-700 dark:text-gray-300 break-words"><?php echo e($meta->meta_value); ?></p>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
        </div>
    </div>

    <?php echo Hook::applyFilters(PostFilterHook::POSTS_SHOW_AFTER_CONTENT, '', $postType); ?>

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
<?php /**PATH D:\projects\php8\lara\resources\views/backend/pages/posts/show.blade.php ENDPATH**/ ?>