<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LanguageController,
    DashboardController,
    AppsController,
    UserInterfaceController,
    CardsController,
    ComponentsController,
    ExtensionController,
    PageLayoutController,
    FormsController,
    TableController,
    PagesController,
    MiscellaneousController,
    AuthenticationController,
    ChartsController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// ======================
// Rotas Públicas
// ======================
Route::group(['prefix' => 'auth'], function () {
    // Rotas de visualização de autenticação
    Route::get('login-cover', [AuthenticationController::class, 'login_cover'])->name('auth.login.cover');
    Route::get('register-cover', [AuthenticationController::class, 'register_cover'])->name('auth.register.cover');
    Route::get('forgot-password-cover', [AuthenticationController::class, 'forgot_password_cover'])->name('auth.forgot-password.cover');
    Route::get('reset-password-cover', [AuthenticationController::class, 'reset_password_cover'])->name('auth.reset-password.cover');
    Route::get('verify-email-cover', [AuthenticationController::class, 'verify_email_cover'])->name('auth.verify-email.cover');
    Route::get('two-steps-cover', [AuthenticationController::class, 'two_steps_cover'])->name('auth.two-steps.cover');
    Route::get('register-multisteps', [AuthenticationController::class, 'register_multi_steps'])->name('auth.register.multisteps');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth.lock-screen');

    // Rotas de ação de autenticação
    Route::post('login', [AuthenticationController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthenticationController::class, 'register'])->name('auth.register');
    Route::post('forgot-password', [AuthenticationController::class, 'forgot_password'])->name('auth.forgot-password');
    Route::post('reset-password', [AuthenticationController::class, 'reset_password'])->name('auth.reset-password');
});

// Rotas públicas adicionais
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('language.swap');
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

// ======================
// Rotas Protegidas (Autenticadas)
// ======================
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [DashboardController::class, 'dashboardEcommerce'])->name('home');

    // Grupo de dashboards
    Route::prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('analytics');
        Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('ecommerce');
    });

    // Aplicativos
    Route::prefix('app')->name('app.')->group(function () {
        // Email e Comunicação
        Route::get('email', [AppsController::class, 'emailApp'])->name('email');
        Route::get('chat', [AppsController::class, 'chatApp'])->name('chat');

        // Produtividade
        Route::get('todo', [AppsController::class, 'todoApp'])->name('todo');
        Route::get('calendar', [AppsController::class, 'calendarApp'])->name('calendar');
        Route::get('kanban', [AppsController::class, 'kanbanApp'])->name('kanban');

        // Faturamento
        Route::prefix('invoice')->name('invoice.')->group(function() {
            Route::get('list', [AppsController::class, 'invoice_list'])->name('list');
            Route::get('preview/{id}', [AppsController::class, 'invoice_preview'])->name('preview');
            Route::get('edit/{id}', [AppsController::class, 'invoice_edit'])->name('edit');
            Route::get('add', [AppsController::class, 'invoice_add'])->name('add');
            Route::get('print/{id}', [AppsController::class, 'invoice_print'])->name('print');
        });

        // E-commerce
        Route::prefix('ecommerce')->name('ecommerce.')->group(function() {
            Route::get('shop', [AppsController::class, 'ecommerce_shop'])->name('shop');
            Route::get('product/{id}', [AppsController::class, 'ecommerce_details'])->name('product');
            Route::get('wishlist', [AppsController::class, 'ecommerce_wishlist'])->name('wishlist');
            Route::get('checkout', [AppsController::class, 'ecommerce_checkout'])->name('checkout');
        });

        // Arquivos e Acessos
        Route::get('file-manager', [AppsController::class, 'file_manager'])->name('file-manager');

        // Gerenciamento de usuários
        Route::prefix('user')->name('user.')->group(function() {
            Route::get('list', [AppsController::class, 'user_list'])->name('list');
            Route::prefix('view')->name('view.')->group(function() {
                Route::get('account', [AppsController::class, 'user_view_account'])->name('account');
                Route::get('security', [AppsController::class, 'user_view_security'])->name('security');
                Route::get('billing', [AppsController::class, 'user_view_billing'])->name('billing');
                Route::get('notifications', [AppsController::class, 'user_view_notifications'])->name('notifications');
                Route::get('connections', [AppsController::class, 'user_view_connections'])->name('connections');
            });
        });

        // Controle de acesso
        Route::get('access-roles', [AppsController::class, 'access_roles'])->name('access.roles');
        Route::get('access-permission', [AppsController::class, 'access_permission'])->name('access.permission');
    });

    // UI Components
    Route::prefix('ui')->name('ui.')->group(function () {
        Route::get('typography', [UserInterfaceController::class, 'typography'])->name('typography');

        // Icons
        Route::get('icons/feather', [UserInterfaceController::class, 'icons_feather'])->name('icons.feather');
    });

    // Cards
    Route::prefix('card')->name('card.')->group(function () {
        Route::get('basic', [CardsController::class, 'card_basic'])->name('basic');
        Route::get('advance', [CardsController::class, 'card_advance'])->name('advance');
        Route::get('statistics', [CardsController::class, 'card_statistics'])->name('statistics');
        Route::get('analytics', [CardsController::class, 'card_analytics'])->name('analytics');
        Route::get('actions', [CardsController::class, 'card_actions'])->name('actions');
    });

    // Components
    Route::prefix('component')->name('component.')->group(function () {
        Route::get('accordion', [ComponentsController::class, 'accordion'])->name('accordion');
        Route::get('alert', [ComponentsController::class, 'alert'])->name('alert');
        Route::get('avatar', [ComponentsController::class, 'avatar'])->name('avatar');
        Route::get('badges', [ComponentsController::class, 'badges'])->name('badges');
        Route::get('breadcrumbs', [ComponentsController::class, 'breadcrumbs'])->name('breadcrumbs');
        Route::get('buttons', [ComponentsController::class, 'buttons'])->name('buttons');
        Route::get('carousel', [ComponentsController::class, 'carousel'])->name('carousel');
        Route::get('collapse', [ComponentsController::class, 'collapse'])->name('collapse');
        Route::get('divider', [ComponentsController::class, 'divider'])->name('divider');
        Route::get('dropdowns', [ComponentsController::class, 'dropdowns'])->name('dropdowns');
        Route::get('list-group', [ComponentsController::class, 'list_group'])->name('list-group');
        Route::get('modals', [ComponentsController::class, 'modals'])->name('modals');
        Route::get('pagination', [ComponentsController::class, 'pagination'])->name('pagination');
        Route::get('navs', [ComponentsController::class, 'navs'])->name('navs');
        Route::get('offcanvas', [ComponentsController::class, 'offcanvas'])->name('offcanvas');
        Route::get('tabs', [ComponentsController::class, 'tabs'])->name('tabs');
        Route::get('timeline', [ComponentsController::class, 'timeline'])->name('timeline');
        Route::get('pills', [ComponentsController::class, 'pills'])->name('pills');
        Route::get('tooltips', [ComponentsController::class, 'tooltips'])->name('tooltips');
        Route::get('popovers', [ComponentsController::class, 'popovers'])->name('popovers');
        Route::get('pill-badges', [ComponentsController::class, 'pill_badges'])->name('pill-badges');
        Route::get('progress', [ComponentsController::class, 'progress'])->name('progress');
        Route::get('spinner', [ComponentsController::class, 'spinner'])->name('spinner');
        Route::get('toast', [ComponentsController::class, 'toast'])->name('toast');
    });

    // Extensions
    Route::prefix('ext-component')->name('ext-component.')->group(function () {
        Route::get('sweet-alerts', [ExtensionController::class, 'sweet_alert'])->name('sweet-alerts');
        Route::get('block-ui', [ExtensionController::class, 'block_ui'])->name('block-ui');
        Route::get('toastr', [ExtensionController::class, 'toastr'])->name('toastr');
        Route::get('sliders', [ExtensionController::class, 'sliders'])->name('sliders');
        Route::get('drag-drop', [ExtensionController::class, 'drag_drop'])->name('drag-drop');
        Route::get('tour', [ExtensionController::class, 'tour'])->name('tour');
        Route::get('clipboard', [ExtensionController::class, 'clipboard'])->name('clipboard');
        Route::get('plyr', [ExtensionController::class, 'plyr'])->name('plyr');
        Route::get('context-menu', [ExtensionController::class, 'context_menu'])->name('context-menu');
        Route::get('swiper', [ExtensionController::class, 'swiper'])->name('swiper');
        Route::get('tree', [ExtensionController::class, 'tree'])->name('tree');
        Route::get('ratings', [ExtensionController::class, 'ratings'])->name('ratings');
        Route::get('locale', [ExtensionController::class, 'locale'])->name('locale');
    });

    // Page Layouts
    Route::prefix('page-layouts')->name('page-layouts.')->group(function () {
        Route::get('collapsed-menu', [PageLayoutController::class, 'layout_collapsed_menu'])->name('collapsed-menu');
        Route::get('full', [PageLayoutController::class, 'layout_full'])->name('full');
        Route::get('without-menu', [PageLayoutController::class, 'layout_without_menu'])->name('without-menu');
        Route::get('empty', [PageLayoutController::class, 'layout_empty'])->name('empty');
        Route::get('blank', [PageLayoutController::class, 'layout_blank'])->name('blank');
    });

    // Forms
    Route::prefix('form')->name('form.')->group(function () {
        Route::get('input', [FormsController::class, 'input'])->name('input');
        Route::get('input-groups', [FormsController::class, 'input_groups'])->name('input-groups');
        Route::get('input-mask', [FormsController::class, 'input_mask'])->name('input-mask');
        Route::get('textarea', [FormsController::class, 'textarea'])->name('textarea');
        Route::get('checkbox', [FormsController::class, 'checkbox'])->name('checkbox');
        Route::get('radio', [FormsController::class, 'radio'])->name('radio');
        Route::get('custom-options', [FormsController::class, 'custom_options'])->name('custom-options');
        Route::get('switch', [FormsController::class, 'switch'])->name('switch');
        Route::get('select', [FormsController::class, 'select'])->name('select');
        Route::get('number-input', [FormsController::class, 'number_input'])->name('number-input');
        Route::get('file-uploader', [FormsController::class, 'file_uploader'])->name('file-uploader');
        Route::get('quill-editor', [FormsController::class, 'quill_editor'])->name('quill-editor');
        Route::get('date-time-picker', [FormsController::class, 'date_time_picker'])->name('date-time-picker');
        Route::get('layout', [FormsController::class, 'layouts'])->name('layout');
        Route::get('wizard', [FormsController::class, 'wizard'])->name('wizard');
        Route::get('validation', [FormsController::class, 'validation'])->name('validation');
        Route::get('repeater', [FormsController::class, 'form_repeater'])->name('repeater');
    });

    // Tables
    Route::prefix('table')->name('table.')->group(function () {
        Route::get('', [TableController::class, 'table'])->name('basic');
        Route::get('datatable/basic', [TableController::class, 'datatable_basic'])->name('datatable.basic');
        Route::get('datatable/advance', [TableController::class, 'datatable_advance'])->name('datatable.advance');
    });

    // Pages
    Route::prefix('page')->name('page.')->group(function () {
        // Configurações de conta
        Route::prefix('account-settings')->name('account-settings.')->group(function() {
            Route::get('account', [PagesController::class, 'account_settings_account'])->name('account');
            Route::get('security', [PagesController::class, 'account_settings_security'])->name('security');
            Route::get('billing', [PagesController::class, 'account_settings_billing'])->name('billing');
            Route::get('notifications', [PagesController::class, 'account_settings_notifications'])->name('notifications');
            Route::get('connections', [PagesController::class, 'account_settings_connections'])->name('connections');
        });

        // Perfil e ajuda
        Route::get('profile', [PagesController::class, 'profile'])->name('profile');
        Route::get('faq', [PagesController::class, 'faq'])->name('faq');

        // Base de conhecimento
        Route::prefix('knowledge-base')->name('knowledge-base.')->group(function() {
            Route::get('', [PagesController::class, 'knowledge_base'])->name('base');
            Route::get('category', [PagesController::class, 'kb_category'])->name('category');
            Route::get('category/question', [PagesController::class, 'kb_question'])->name('question');
        });

        // Outras páginas
        Route::get('pricing', [PagesController::class, 'pricing'])->name('pricing');
        Route::get('api-key', [PagesController::class, 'api_key'])->name('api-key');
        Route::get('license', [PagesController::class, 'license'])->name('license');

        // Blog
        Route::prefix('blog')->name('blog.')->group(function() {
            Route::get('list', [PagesController::class, 'blog_list'])->name('list');
            Route::get('detail/{id}', [PagesController::class, 'blog_detail'])->name('detail');
            Route::get('edit/{id}', [PagesController::class, 'blog_edit'])->name('edit');
        });
    });

    // Páginas diversas
    Route::prefix('misc')->name('misc.')->group(function () {
        Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('coming-soon');
        Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('not-authorized');
        Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('maintenance');
    });

    // Modal Examples
    Route::get('modal-examples', [PagesController::class, 'modal_examples'])->name('modal-examples');

    // Charts
    Route::prefix('chart')->name('chart.')->group(function () {
        Route::get('apex', [ChartsController::class, 'apex'])->name('apex');
        Route::get('chartjs', [ChartsController::class, 'chartjs'])->name('chartjs');
        Route::get('echarts', [ChartsController::class, 'echarts'])->name('echarts');
    });

    // Mapas
    Route::get('maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('maps.leaflet');
});
