<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\TranningCourseController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ContactCotroller;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\NewsUpdateController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;

Route::get('/', [WelcomeController::class, 'welcome']);
Route::get('/welcome', [WelcomeController::class, 'welcome'])->name('welcome');


Route::prefix('about')->group(function () {
    Route::get('/visimisi', [AboutController::class, 'visiMisi'])->name('visimisi');
    Route::get('/companybrief', [AboutController::class, 'companyBrief'])->name('companybrief');
});

Route::get('/contact', [ContactCotroller::class, 'contact'])->name('contact');

Route::prefix('certification')->group(function () {
    Route::get('/', [SertifikatController::class, 'index'])->name('certification');
    Route::get('/getdata', [SertifikatController::class, 'getData'])->name('getdata-certification');
});

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');

// General Route
Route::middleware(['template:template1'])->prefix('general')->group(function () {
    Route::get('/fetch-upcoming-trainings', [GeneralController::class, 'fetchUpcomingTrainings'])->name('fetch-upcoming-trainings');
    Route::get('/fetch-upcoming-jobvacancy', [GeneralController::class, 'fetchUpcomingJobvacancy'])->name('fetch-upcoming-jobvacancy');
    Route::get('/fetch-upcoming-news', [GeneralController::class, 'fetchUpcomingNews'])->name('fetch-upcoming-news');  // Perbaiki typo "fetcUpcominghNews"
    Route::get('/load-filter-provinsiTop', [GeneralController::class, 'privieProvinsiTop'])->name('load-filter-provinsiTop');
    Route::get('/load-filter-status', [GeneralController::class, 'statusCourse'])->name('load-filter-status');
});


// Training Course Routes
Route::prefix('course')->group(function () {
    Route::get('/list', [TranningCourseController::class, 'CourseList'])->name('course-list');
    Route::get('/grid', [TranningCourseController::class, 'CourseGrid'])->name('course-grid');
    Route::get('/detail/{id}/{slug}', [TranningCourseController::class, 'detailCourse'])->name('detail-course');
    Route::get('/detail-content/{courseId}/{tabId}', [TranningCourseController::class, 'getTabContent'])->name('detail-course-content');
    Route::get('/get-list', [TranningCourseController::class, 'getContentListCourse'])->name('get-content-list-course');
    Route::get('/get-grid', [TranningCourseController::class, 'getContentGridCourse'])->name('get-content-grid-course');
    Route::get('/load-dropdown-category', [TranningCourseController::class, 'loadDataCategory'])->name('load-dropdown-category');
    Route::get('/load-dropdown-certificatetype', [TranningCourseController::class, 'loadDataCertificate'])->name('load-dropdown-certificatetype');
    Route::get('/load-dropdown-type', [TranningCourseController::class, 'loadDataType'])->name('load-dropdown-type');
    Route::get('/register/{id}/{slug}', [TranningCourseController::class, 'registerCourse'])->name('register-course');
    Route::get('/get-backgroundeducation', [TranningCourseController::class, 'getDatabackgroundeducation'])->name('get-backgroundeducation');
});

// News Routes
Route::prefix('news')->group(function () {
    Route::get('/list', [NewsUpdateController::class, 'NewsList'])->name('news-list');
    Route::get('/grid', [NewsUpdateController::class, 'NewsGrid'])->name('news-grid');
    Route::get('/get-list', [NewsUpdateController::class, 'getContentNewsList'])->name('get-content-news-list');
    Route::get('/get-grid', [NewsUpdateController::class, 'getContentNewsGrid'])->name('get-content-news-grid');
    Route::get('/detail/{id}/{slug}', [NewsUpdateController::class, 'detailNews'])->name('detail-news');
    Route::get('/load-filter-jenis', [NewsUpdateController::class, 'previewJenisBerita'])->name('load-filter-jenis-berita');
});

// Job Vacancy Routes
Route::prefix('job')->group(function () {
    Route::get('/list', [JobVacancyController::class, 'JobList'])->name('job-list');
    Route::get('/grid', [JobVacancyController::class, 'JobGrid'])->name('job-grid');
    Route::get('/detail/{id}/{slug}', [JobVacancyController::class, 'detailJob'])->name('detail-job');
    Route::get('/preview-filter', [JobVacancyController::class, 'previewFilter'])->name('preview-filter-job');
    Route::get('/load-filter-salary-range', [JobVacancyController::class, 'previewFilterSalarayRange'])->name('load-filter-salaray-range');
    Route::get('/filter-placement', [JobVacancyController::class, 'previewFilterPlacement'])->name('filter-placement');
    Route::get('/filter-experience-level', [JobVacancyController::class, 'previewFilterExperienceLevel'])->name('filter-experience-level-job');
    Route::get('/filter-education', [JobVacancyController::class, 'previewFilterEducation'])->name('filter-education-job');
    Route::get('/get-list', [JobVacancyController::class, 'getContentJobList'])->name('get-content-job-list');
    Route::get('/get-grid', [JobVacancyController::class, 'getContentJobGrid'])->name('get-content-job-grid');
    Route::get('/load-filter-employee-status', [JobVacancyController::class, 'priviewEmployeeStatusTop'])->name('load-filter-employeeStatusTop');
    Route::get('/fetch-upcoming-sidebar', [JobVacancyController::class, 'SidebarJobvacancy'])->name('fetch-upcoming-jobs-sidebar');
});

// registratis user

Route::get('login', [UserController::class, 'login'])->name('login');
