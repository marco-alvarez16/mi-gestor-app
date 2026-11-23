<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureSingleSession;

use Illuminate\Support\Facades\Artisan;


Route::get('/', function () {
    return view('welcome');
});

Route::get(
    '/registro/verificar/{token}',
    [RegisteredUserController::class, 'confirm']
)->name('register.confirm');

Route::post(
    '/registro/verificar/{token}',
    [RegisteredUserController::class, 'verify']
)->middleware('throttle:5,1')
  ->name('register.verify');


Route::get('/dashboard', function () {

    $user = auth()->user();


    $stats = [

        'pending' =>
            $user
                ->tasks()
                ->where('status', 'pendiente')
                ->count(),

        'completed' =>
            $user
                ->tasks()
                ->where('status', 'completada')
                ->count(),

        'total' =>
            $user
                ->tasks()
                ->count(),

        'today' =>
            $user
                ->tasks()
                ->whereDate(
                    'due_date',
                    now()->toDateString()
                )
                ->count(),
    ];


    $recentTasks =
        $user
            ->tasks()
            ->latest()
            ->take(5)
            ->get();


    return view(
        'dashboard',
        compact(
            'stats',
            'recentTasks'
        )
    );

})
->middleware([
    'auth',
    'verified',
    EnsureSingleSession::class,
])
->name('dashboard');



Route::middleware(['auth', 'verified', EnsureSingleSession::class])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | TAREAS
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/tasks/completed',
        [TaskController::class, 'completed']
    )
    ->name('tasks.completed');


    Route::get(
        '/tasks',
        [TaskController::class, 'index']
    )
    ->name('tasks.index');


    Route::get(
        '/tasks/create',
        [TaskController::class, 'create']
    )
    ->name('tasks.create');


    Route::post(
        '/tasks',
        [TaskController::class, 'store']
    )
    ->name('tasks.store');


    Route::get(
        '/tasks/{task}/edit',
        [TaskController::class, 'edit']
    )
    ->name('tasks.edit');


    Route::put(
        '/tasks/{task}',
        [TaskController::class, 'update']
    )
    ->name('tasks.update');


    Route::delete(
        '/tasks/{task}',
        [TaskController::class, 'destroy']
    )
    ->name('tasks.destroy');



    /*
    |--------------------------------------------------------------------------
    | PERFIL
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )
    ->name('profile.edit');


    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )
    ->name('profile.update');


    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )
    ->name('profile.destroy');


});


require __DIR__.'/auth.php';






Route::get('/run-migrate-once-9482', function () {
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('config:cache');
    return 'Migraciones ejecutadas correctamente';
});
