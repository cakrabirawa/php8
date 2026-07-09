<aside
    :class="sidebarToggle ? 'translate-x-0 lg:w-[85px] app-sidebar-minified' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-10 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 transition-all duration-300 ease-in-out <?php echo e(config('settings.sidebar_bg_lite') ? '' : 'bg-white'); ?> dark:border-gray-900 dark:bg-gray-900 lg:static lg:translate-x-0"
    id="appSidebar"
    x-data="{
        isHovered: false,
        init() {
            this.updateBg();
            const observer = new MutationObserver(() => this.updateBg());
            observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

            // Check if sidebarToggle value is present in localStorage and use it
            if (localStorage.getItem('sidebarToggle')) {
                sidebarToggle = JSON.parse(localStorage.getItem('sidebarToggle'));
            }
        },
        updateBg() {
            const htmlHasDark = document.documentElement.classList.contains('dark');
            const liteBg = '<?php echo e(config('settings.sidebar_bg_lite')); ?>';
            const darkBg = '<?php echo e(config('settings.sidebar_bg_dark')); ?>';
            const bg = htmlHasDark ? darkBg : liteBg;
            this.$el.style.backgroundColor = bg;

            // Detect if sidebar bg is dark or light to set appropriate hover/active overlays
            const isDarkBg = this.isColorDark(bg);
            const overlay = isDarkBg ? '255,255,255' : '0,0,0';
            this.$el.style.setProperty('--sidebar-hover-bg', `rgba(${overlay}, 0.08)`);

            if (isDarkBg) {
                // Dark sidebar: use transparent overlays for active state
                this.$el.style.setProperty('--sidebar-active-bg', `rgba(255, 255, 255, 0.12)`);
                this.$el.style.setProperty('--sidebar-active-text', `#ffffff`);
            } else {
                // Light sidebar: use brand colors for active state (default from CSS)
                this.$el.style.removeProperty('--sidebar-active-bg');
                this.$el.style.removeProperty('--sidebar-active-text');
            }
        },
        isColorDark(hex) {
            if (!hex || hex.length < 4) return false;
            hex = hex.replace('#', '');
            if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
            const r = parseInt(hex.substr(0, 2), 16);
            const g = parseInt(hex.substr(2, 2), 16);
            const b = parseInt(hex.substr(4, 2), 16);
            // Relative luminance formula
            return (r * 299 + g * 587 + b * 114) / 1000 < 128;
        }
    }"
    x-init="init()"
    @mouseenter="if(sidebarToggle) { isHovered = true; $el.classList.add('lg:w-[290px]'); $el.classList.remove('lg:w-[85px]', 'app-sidebar-minified'); }"
    @mouseleave="if(sidebarToggle) { isHovered = false; $el.classList.add('lg:w-[85px]', 'app-sidebar-minified'); $el.classList.remove('lg:w-[290px]'); }"
>
    <!-- Sidebar Header -->
    <div class="flex items-center justify-center gap-2 py-5 px-6 h-[100px] transition-all duration-300">
        <?php
            $sidebarLogoOverride = \App\Support\Facades\Hook::applyFilters(
                \App\Enums\Hooks\AdminFilterHook::SIDEBAR_LOGO_OVERRIDE,
                ''
            );
        ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebarLogoOverride): ?>
            <?php echo $sidebarLogoOverride; ?>

        <?php else: ?>
            <?php
                $siteName = config('settings.app_name') ?: config('app.name', 'Lara Dashboard');
                $hasLiteLogo = !empty(config('settings.site_logo_lite'));
                $hasDarkLogo = !empty(config('settings.site_logo_dark'));
                $hasIcon = !empty(config('settings.site_icon'));
                $primaryColor = config('settings.theme_primary_color', '#635bff');
            ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>">
                <span class="logo transition-opacity duration-300" :class="sidebarToggle && !isHovered ? 'hidden opacity-0' : 'opacity-100'">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasLiteLogo): ?>
                        <img
                            class="dark:hidden max-h-20"
                            src="<?php echo e(config('settings.site_logo_lite')); ?>"
                            alt="<?php echo e($siteName); ?>"
                        />
                    <?php else: ?>
                        
                        <span class="dark:hidden text-xl font-bold text-gray-900" style="color: <?php echo e($primaryColor); ?>">
                            <?php echo e($siteName); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasDarkLogo): ?>
                        <img
                            class="hidden dark:block max-h-20"
                            src="<?php echo e(config('settings.site_logo_dark')); ?>"
                            alt="<?php echo e($siteName); ?>"
                        />
                    <?php else: ?>
                        
                        <span class="hidden dark:inline text-xl font-bold text-white">
                            <?php echo e($siteName); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasIcon): ?>
                    <img
                        class="logo-icon w-20 lg:w-12 transition-opacity duration-300"
                        :class="sidebarToggle && !isHovered ? 'lg:block opacity-100' : 'hidden opacity-0'"
                        src="<?php echo e(config('settings.site_icon')); ?>"
                        alt="<?php echo e($siteName); ?>"
                    />
                <?php else: ?>
                    
                    <span
                        class="logo-icon w-12 h-12 rounded-lg flex items-center justify-center text-white font-bold text-xl transition-opacity duration-300"
                        :class="sidebarToggle && !isHovered ? 'lg:flex opacity-100' : 'hidden opacity-0'"
                        style="background-color: <?php echo e($primaryColor); ?>"
                    >
                        <?php echo e(strtoupper(substr($siteName, 0, 1))); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <!-- End Sidebar Header -->

    <div
        class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar"
    >
        <?php echo $__env->make('backend.layouts.partials.sidebar.menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</aside>
<!-- End Sidebar -->
<?php /**PATH D:\projects\php8\lara\resources\views/backend/layouts/partials/sidebar/logo.blade.php ENDPATH**/ ?>