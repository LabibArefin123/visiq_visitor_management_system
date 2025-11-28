<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\PendingVisitor;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register permission middleware globally
        app('router')->aliasMiddleware('permission', \App\Http\Middleware\CheckPermission::class);

        // Only run visitor count logic if table exists
        if (Schema::hasTable('pending_visitors')) {
            $today = Carbon::today();

            $totalPendingVisitors = PendingVisitor::whereDate('visit_date', '<=', $today)->count();

            // Store count in config
            config(['adminlte.notification_counts.pending_visitors' => $totalPendingVisitors]);

            // Update topnav menu dynamically
            $menu = config('adminlte.menu');

            foreach ($menu as &$item) {
                if (isset($item['id']) && $item['id'] === 'notificationBell') {
                    $item['label'] = (string) $totalPendingVisitors;
                    $item['label_color'] = $totalPendingVisitors > 0 ? 'danger' : 'success';

                    if (isset($item['submenu']) && is_array($item['submenu'])) {
                        foreach ($item['submenu'] as &$submenu) {
                            if (isset($submenu['text']) && str_contains($submenu['text'], 'Pending Visitor')) {
                                $submenu['text'] = "Pending Visitor List ({$totalPendingVisitors})";
                            }
                        }
                    }
                }
            }

            config(['adminlte.menu' => $menu]);
        }

        // --- Dark Mode for AdminLTE ---
        $themeMode = Session::get('theme_mode', 'light');
        config(['adminlte.layout_dark_mode' => $themeMode === 'dark']);

        // Share with all views
        View::share('darkMode', $themeMode);
    }
}
