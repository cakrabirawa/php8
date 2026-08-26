<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Assets\Js;
use App\Filament\Pages\Auth\CustomLogin;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Navigation\NavigationItem;
use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Tables\Table;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use WatheqAlshowaiter\FilamentStickyTableHeader\StickyTableHeaderPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->login(CustomLogin::class)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([Dashboard::class,])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([AccountWidget::class, FilamentInfoWidget::class,])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->assets([
                // Pindahkan JS ke AlpineComponent agar kompatibel dengan SPA
                // AlpineComponent::make('stimulsoft-scripts', resource_path('js/stimulsoft-loader.js')),
                Css::make('custom-styles', resource_path('css/custom-filament.css')),
            ])
            ->font('Poppins')
            ->spa()
            ->colors([
                'primary' => Color::Emerald,
                'secondary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
                'danger' => Color::Rose,
                'active' => Color::Emerald,
                'inactive' => Color::Rose,
                'latest' => Color::Sky,
            ])
            ->plugins([
                StickyTableHeaderPlugin::make()
                    ->shouldScrollToTopOnPageChanged(enabled: true, behavior: 'smooth'),
                FilamentShieldPlugin::make()
                    ->navigationGroup('Admin'),
            ])
            // Menyisipkan Tombol Keluar Sistem secara manual agar bisa mengirim form POST
            ->renderHook(
                PanelsRenderHook::SIDEBAR_NAV_END,
                fn(): string => Blade::render('
                    @if(auth()->check())
                        <div class="px-6 py-3">
                            <form id="sidebar-logout-form-final" action="{{ route(\'filament.admin.auth.logout\') }}" method="POST" class="hidden">
                                @csrf
                            </form>

                            <!-- Tombol Keluar Sistem Latar Merah Full Rata Tengah -->
                            <center><button
                                type="button"
                                data-laravel-spa-link-skip="true"
                                onclick="event.preventDefault(); document.getElementById(\'sidebar-logout-form-final\').submit();"
                                class="flex w-full items-center justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm outline-none transition duration-75 hover:bg-red-500 focus-visible:bg-red-700 dark:bg-red-500 dark:hover:bg-red-400"
                            >
                                <span>Sign Out</span>
                            </button></center>
                        </div>
                    @endif
                ')
            )
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn(): string => view('filament.components.custom-user-menu')->render(),
            )
            ->renderHook(
                PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
                fn(): string => Blade::render('
                <div class="text-sm font-medium text-green-500 me-3">
                    Halo, Selamat Datang, {{ auth()->user()->name ?? "User" }}!
                </div>
            '),
            )
            ->maxContentWidth('full');;
    }

    public function boot(): void
    {
        // Memaksa seluruh tabel di Filament menggunakan loading placeholder secara global
        Table::configureUsing(function (Table $table): void {
            $table->deferLoading();
        });
    }
}
