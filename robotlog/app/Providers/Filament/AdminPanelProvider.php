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
            ])
            ->plugins([
                StickyTableHeaderPlugin::make()
                    ->shouldScrollToTopOnPageChanged(enabled: true, behavior: 'smooth'),
                FilamentShieldPlugin::make()
                    ->navigationGroup('Admin'),
            ])
            ->navigationItems([
                NavigationItem::make('Logout')
                    ->label('Keluar Sistem')
                    ->url(fn(): string => "javascript:document.getElementById('logout-form').submit();")
                    ->icon('heroicon-o-arrow-left-on-rectangle')
                    ->sort(1000)
                    ->group('Sistem')
                    ->visible(fn(): bool => auth()->check()),
            ])
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn(): string => view('filament.components.custom-user-menu')->render(),
            )
            ->renderHook(
                PanelsRenderHook::GLOBAL_SEARCH_BEFORE,
                fn(): string => Blade::render('
                <div class="text-sm font-medium text-gray-500 me-3">
                    Halo, Selamat Datang, {{ auth()->user()->name ?? "User" }}!
                </div>
            '),
            )
            ->maxContentWidth('full')
        ;
    }

    public function boot(): void {}
}
