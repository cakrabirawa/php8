<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\IntroductionController;
use App\Http\Controllers\Admin\ChecklistController as AdminChecklistController;
use App\Http\Controllers\Admin\MentoringController as AdminMentoringController;
use App\Http\Controllers\User\MentoringController as UserMentoringController;
use App\Http\Controllers\Admin\EmployeeTrainingScoreController;
use App\Http\Controllers\Admin\EmployeeEvaluationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeReportController;
use App\Http\Controllers\Admin\IDPController as AdminIDPController;
use App\Http\Controllers\Admin\DevController;
use App\Http\Controllers\Admin\CompetencyController;

use App\Http\Controllers\User\ChecklistController as UserChecklistController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ChecklistController as OnboardingChecklistController;
use App\Http\Controllers\User\UserIDPController as UserIDPController;


use App\Http\Controllers\Sales\SalesReportController;
use App\Http\Controllers\Sales\OnboardingSSController;
use App\Http\Controllers\Sales\IndividualDevelopmentPlanController;



use Illuminate\Support\Facades\Route;
    Route::get('/', function () {

        $role = auth()->user()->role;

        if (in_array($role, ['admin','editor','viewer'])) {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'sales_superintendent') {
            return redirect()->route('sales.report.show');
        }

        return redirect()->route('user.dashboard');

    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin,editor,viewer')->prefix('admin')->name('admin.')->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // EMPLOYEES
        Route::get('search/employees',[EmployeeController::class, 'search'])->name('search.employees');
        Route::resource('employees', EmployeeController::class);
        Route::post('employees/import', [EmployeeController::class, 'import'])->name('employees.import');
        Route::get('employees/template-csv', [EmployeeController::class, 'downloadTemplate'])->name('employees.template');

        // STORES
        Route::resource('stores', StoreController::class);
        Route::post('stores/{store}/reset-password', [StoreController::class, 'resetPassword'])->name('stores.reset-password');

        // INTRODUCTIONS
        Route::resource('introductions', IntroductionController::class);
        Route::post('introductions/import', [IntroductionController::class, 'import'])->name('introductions.import');
 
        // EVALUATIONS
        Route::get('evaluations/export', [EmployeeEvaluationController::class, 'export'])->name('evaluations.export');
        Route::post('employee-evaluations/import/{period}', [EmployeeEvaluationController::class, 'import'])->name('employee-evaluations.import');
        Route::post('employee-evaluations/import-assessment', [EmployeeEvaluationController::class, 'importAssessment'])->name('employee-evaluations.import-assessment');
        Route::get('evaluations/template/{type}',[EmployeeEvaluationController::class, 'downloadTemplate'])->name('evaluations.template');
        Route::put('evaluations/reset', [EmployeeEvaluationController::class, 'reset'])->name('evaluations.reset');
        Route::resource('evaluations', EmployeeEvaluationController::class);

        // DEVELOPMENT (TRAINING SCORE)
        Route::resource('development', EmployeeTrainingScoreController::class);
        Route::post('development/import', [EmployeeTrainingScoreController::class, 'import'])->name('development.import');

        // CHECKLIST
        Route::get('checklist', [AdminChecklistController::class, 'index'])->name('checklist.index');
        Route::get('checklist/{id}', [AdminChecklistController::class, 'show'])->name('checklist.show');
        Route::put('checklist/{id}/status', [AdminChecklistController::class, 'updateStatus'])->name('checklist.updateStatus');
        Route::post('checklist/month/update-status', [AdminChecklistController::class, 'updateMonthStatus'])->name('checklist.updateMonthStatus');
        Route::get('checklist/summary/{employee}', [AdminChecklistController::class, 'summary'])->name('checklist.summary');

        // MENTORING
        Route::get('mentoring', [AdminMentoringController::class, 'index'])->name('mentoring.index');
        Route::get('mentoring/{employee_id}', [AdminMentoringController::class, 'show'])->name('mentoring.show');
        Route::patch('mentoring/verify/{id}', [AdminMentoringController::class, 'verify'])->name('mentoring.verify');

        // VIEW REPORT (WEB)
        Route::get('/employees/{employee}/report',[EmployeeReportController::class, 'show'])->name('employees.report.show');
        Route::put('/users/reset-password/{employee_id}', [EmployeeReportController::class, 'resetPassword'])->name('users.reset-password');

        // DOWNLOAD PDF
        Route::get('/employees/{employee}/report/pdf',[EmployeeReportController::class, 'pdf'])->name('employees.report.pdf');
        
        //EDIT CHECKLIST TEMPLATES
        Route::get('/onboarding/template/{month}/{week}/edit', [AdminChecklistController::class, 'editTemplate'])->name('onboarding.template.edit');
        Route::put('/onboarding/template/{template}', [AdminChecklistController::class, 'updateTemplate'])->name('onboarding.template.update'); 

        // ================= IDP HR REVIEW =================
        Route::get('/idp', [AdminIDPController::class, 'index'])->name('idp.index');
        Route::get('/idp/{id}', [AdminIDPController::class, 'show'])->name('idp.show');
        Route::post('/idp/{id}/approve', [AdminIDPController::class, 'approve'])->name('idp.approve');

        Route::get('/competency', [CompetencyController::class, 'index'])->name('competency.index');
        Route::post('/competency', [CompetencyController::class, 'store'])->name('competency.store');
        Route::delete('/competency/{id}', [CompetencyController::class, 'destroy'])->name('competency.delete');

        Route::get('/dev', [DevController::class, 'index'])->name('dev.index');
        Route::post('/import-sql', [DevController::class, 'importSql'])->name('dev.import');
        Route::post('/run-sql', [DevController::class, 'runSql'])->name('dev.run');
        Route::get('/export/{table}', [DevController::class, 'export'])->name('dev.export');
        
        Route::post('/dev/user', [DevController::class, 'storeUser'])->name('dev.user.store');
        Route::post('/dev/user/{id}/reset', [DevController::class, 'resetUser'])->name('dev.user.reset');
        Route::delete('/dev/user/{id}', [DevController::class, 'deleteUser'])->name('dev.user.delete');

        });


    Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        Route::get('/mentoring', [UserMentoringController::class, 'index'])->name('mentoring.index');
        Route::get('/mentoring/create', [UserMentoringController::class, 'create'])->name('mentoring.create');
        Route::post('/mentoring', [UserMentoringController::class, 'store'])->name('mentoring.store');

        Route::get('/onboarding', [UserChecklistController::class, 'index'])->name('onboarding.index');
        Route::get('/onboarding/{employeeId}/{month}', [UserChecklistController::class, 'review'])->name('onboarding.review');
        Route::post('/onboarding/{employeeId}/{month}/confirm', [UserChecklistController::class, 'confirm'])->name('onboarding.confirm');

        Route::get('/report/{employee}', [EmployeeReportController::class, 'show'])->name('employees.report.show');

        Route::get('/idp', [UserIDPController::class, 'index'])->name('idp.index');
        Route::get('/idp/{id}', [UserIDPController::class, 'show'])->name('idp.show');
        Route::post('/idp/{id}/confirm-sm', [UserIDPController::class, 'confirmSM'])->name('idp.confirmSM');

        });
});

Route::middleware(['auth', 'role:sales_superintendent', 'checkID'])->prefix('sales')->name('sales.')->group(function () {
        Route::get('/report', [SalesReportController::class, 'show'])->name('report.show');

        // IDP
        Route::get('/idp', [IndividualDevelopmentPlanController::class,'index'])->name('idp.index');

        Route::get('/idp/create', [IndividualDevelopmentPlanController::class,'create'])->name('idp.create');

        Route::post('/idp', [IndividualDevelopmentPlanController::class,'store'])->name('idp.store');

        Route::get('/idp/{id}/edit', [IndividualDevelopmentPlanController::class,'edit'])->name('idp.edit');

        Route::put('/idp/{id}', [IndividualDevelopmentPlanController::class,'update'])->name('idp.update');


        // TASKS
        Route::post('/idp/{id}/tasks', [IndividualDevelopmentPlanController::class,'addTask'])->name('idp.task.store');

        Route::put('/idp/tasks/{task}', [IndividualDevelopmentPlanController::class,'updateTask'])->name('idp.task.update');

        Route::delete('/idp/tasks/{task}', [IndividualDevelopmentPlanController::class,'deleteTask'])->name('idp.task.delete');


        // ONBOARDING
        Route::get('/onboarding', [OnboardingSSController::class, 'index'])->name('onboarding.index');

        Route::get('/{employee}/{month}/{week}', [OnboardingSSController::class, 'show'])->name('show');
        Route::post('/{employee}/{month}/{week}', [OnboardingSSController::class, 'store'])->name('store');

        });


require __DIR__.'/auth.php';
