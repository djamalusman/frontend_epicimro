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
Route::get('/visimisi', [AboutController::class, 'visiMisi'])->name('visimisi');
Route::get('/companybrief', [AboutController::class, 'companyBrief'])->name('companybrief');
Route::get('/contact', [ContactCotroller::class, 'contact'])->name('contact');

Route::get('/certification', [SertifikatController::class, 'index'])->name('certification');
Route::get('/getdata-certification', [SertifikatController::class, 'getData'])->name('getdata-certification');

Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');

// General Route
Route::get('/fetch-upcoming-trainings', [GeneralController::class, 'fetchUpcomingTrainings'])->name('fetch-upcoming-trainings');
Route::get('/fetch-upcoming-jobvacancy', [GeneralController::class, 'fetchUpcomingJobvacancy'])->name('fetch-upcoming-jobvacancy');
Route::get('/fetch-upcoming-news', [GeneralController::class, 'fetcUpcominghNews'])->name('fetch-upcoming-news');
Route::get('/load-filter-provinsiTop', [GeneralController::class, 'privieProvinsiTop'])->name('load-filter-provinsiTop');
Route::get('/load-filter-status', [GeneralController::class, 'statusCourse'])->name('load-filter-status');
// end route General Route

// route training course
Route::get('/course-list', [TranningCourseController::class, 'CourseList'])->name('course-list');
Route::get('/course-grid', [TranningCourseController::class, 'CourseGrid'])->name('course-grid');
Route::get('/detail-course/{id}/{slug}', [TranningCourseController::class, 'detailCourse'])->name('detail-course');
Route::get('/detail-course-content/{courseId}/{tabId}', [TranningCourseController::class, 'getTabContent'])->name('detail-course-content');
Route::get('/get-content-list-course', [TranningCourseController::class, 'getContentListCourse'])->name('get-content-list-course');
Route::get('/get-content-grid-course', [TranningCourseController::class, 'getContentGridCourse'])->name('get-content-grid-course');
// Route::get('/preview-filter-jenis-sertifikasi-course', [TranningCourseController::class, 'previewFilter_jenis_sertifikasi'])->name('preview-filter-jenis-sertifikasi-course');
// Route::get('/filter-type-course', [TranningCourseController::class, 'previewFilter_Type_course'])->name('filter-type-course');
Route::get('/load-dropdown-category', [TranningCourseController::class, 'loadDataCategory'])->name('load-dropdown-category');
Route::get('/load-dropdown-certificatetype', [TranningCourseController::class, 'loadDataCertificate'])->name('load-dropdown-certificatetype');
Route::get('/load-dropdown-type', [TranningCourseController::class, 'loadDataType'])->name('load-dropdown-type');
// End route training course

//Latest News
Route::get('/news-list', [NewsUpdateController::class, 'NewsList'])->name('news-list');
Route::get('/news-grid', [NewsUpdateController::class, 'NewsGrid'])->name('news-grid');
Route::get('/get-content-news-list', [NewsUpdateController::class, 'getContentNewsList'])->name('get-content-news-list');
Route::get('/get-content-news-grid', [NewsUpdateController::class, 'getContentNewsGrid'])->name('get-content-news-grid');
Route::get('/detail-news/{id}/{slug}', [NewsUpdateController::class, 'detailNews'])->name('detail-news');
Route::get('/load-filter-jenis-berita', [NewsUpdateController::class, 'previewJenisBerita'])->name('load-filter-jenis-berita');
//End Latest News

// route Job vacancy
Route::get('/job-list', [JobVacancyController::class, 'JobList'])->name('job-list');
Route::get('/job-grid', [JobVacancyController::class, 'JobGrid'])->name('job-grid');
Route::get('/detail-job/{id}/{slug}', [JobVacancyController::class, 'detailJob'])->name('detail-job');
Route::get('/preview-filter-job', [JobVacancyController::class, 'previewFilter'])->name('preview-filter-job');
Route::get('/load-filter-salaray-range', [JobVacancyController::class, 'previewFilterSalarayRange'])->name('load-filter-salaray-range');
Route::get('/filter-placement', [JobVacancyController::class, 'previewFilterPlacement'])->name('filter-placement');
Route::get('/filter-experience-level-job', [JobVacancyController::class, 'previewFilterExperienceLevel'])->name('filter-experience-level-job');
Route::get('/filter-education-job', [JobVacancyController::class, 'previewFilterEducation'])->name('filter-education-job');
Route::get('/get-content-job-list', [JobVacancyController::class, 'getContentJobList'])->name('get-content-job-list');
Route::get('/get-content-job-grid', [JobVacancyController::class, 'getContentJobGrid'])->name('get-content-job-grid');
Route::get('/load-filter-employeeStatusTop', [JobVacancyController::class, 'priviewEmployeeStatusTop'])->name('load-filter-employeeStatusTop');
Route::get('fetch-upcoming-jobs-sidebar', [JobVacancyController::class, 'SidebarJobvacancy'])->name('fetch-upcoming-jobs-sidebar');
// end route Job vacancy

// registratis user

// Menampilkan halaman login
Route::get('login', [UserController::class, 'login'])->name('login');

// Halaman dashboard yang hanya bisa diakses setelah login
Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

// Menangani signup (POST request)
// Route::post('/signup', [UserController::class, 'signUp'])->name('signup');
Route::post('/signup', [UserController::class, 'signUp'])->name('signup')->middleware('web');

// Menangani signin (POST request)
Route::post('/signin', [UserController::class, 'signIn'])->name('signin');

// Menangani logout (menghapus session)



