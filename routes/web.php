<?php

use App\Models\Staff;
use App\Models\Client;
use App\Models\Package;
use App\Models\Service;
use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\Portfolio;
use App\Models\ClientReview;
use App\Models\PortfolioTag;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\PortfolioTagController;
use App\Http\Controllers\Admin\ContactMessageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// URL::forceScheme('https');

Route::get('/', function () {
    $services = Service::all();
    // $clients = Client::all();
    // $staffs = Staff::all();
    // $portfolioTags = PortfolioTag::all();
    // $portfolios = Portfolio::all();
    // $reviews = ClientReview::all()->take(5);
    $packages = Package::all();
    $uniqueServices = Package::with('service')->get()->pluck('service')->unique('id');
    $settings = Setting::find(1);

    return view('front.homepage',
        compact('services','packages','uniqueServices','settings')
    );
})->name('home');

// Route::get('/storage/link', function () {
//     $tergetFol = storage_path('app/public');
//     $linkFol = $_SERVER['DOCUMENT_ROOT'] . '/public/storage';
//     symlink($tergetFol, $linkFol);

//     return 'Storage link created successfully!';
// });


// Route::get('/artisan/{command}', function ($command) {
//     $allowedCommands = ['config:clear', 'cache:clear', 'route:clear', 'view:clear', 'optimize:clear'];

//     // if (!in_array($command, $allowedCommands)) {
//     //     return response()->json(['error' => 'Command not allowed!'], 403);
//     // }

//     Artisan::call($command);
//     return "Command '{$command}' executed successfully!";
// });


Route::resource('/service', \App\Http\Controllers\ServiceController::class);
Route::resource('/front-portfolio', \App\Http\Controllers\ProtfolioController::class);
Route::resource('/front-contact-message', \App\Http\Controllers\ContactMessageController::class);
Route::post('/front-contact-message/send-mail', [\App\Http\Controllers\ContactMessageController::class, 'sendMail'])->name('send.mail');
Route::get('/login', [\App\Http\Controllers\ServiceController::class, 'showLoginForm'])->name('login');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('permissions', PermissionController::class);

    Route::resource('users', UserController::class);
    // Route::resource('clients', ClientController::class);
    // Route::resource('client-review', ClientReviewController::class);

    // Route::resource('message', ContactMessageController::class);
    // Route::post('delete-messages', [ContactMessageController::class, 'destroyMultiple'])->name('destroyMultiple');

    // Route::resource('staffs', StaffController::class);
    // Route::resource('portfolio_tags', PortfolioTagController::class);
    // Route::resource('portfolio', PortfolioController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('packages', PackageController::class);

    // Route::resource('page', PageController::class);
    // Route::get('page_create', [PageController::class, 'createPage'])->name('page.create');
    // Route::get('page/{slug}', [PageController::class, 'show'])->name('page.show');


    Route::resource('menu-item', MenuItemController::class);

    Route::resource('profile', UserProfileController::class);

    Route::resource('roles', RoleController::class);
    Route::get('roles/add_permissions/{id}', [RoleController::class, 'addPermissions'])->name('roles.add_permissions');
    Route::put('roles/add_permissions/{id}', [RoleController::class, 'updatePermissions'])->name('roles.update_permissions');

    Route::post('update.settings', [SettingController::class, 'updateSetting'])->name('update.settings');
});

// Route::get('{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('front-page.show');


require __DIR__.'/auth.php';
