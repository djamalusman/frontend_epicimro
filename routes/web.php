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
use App\Http\Controllers\UserCandidateController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobClientController;
use App\Http\Controllers\TrainingClientController;
use App\Http\Controllers\ProfessionalTrainingClientController;
use App\Http\Controllers\MenuManagementController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ResumeCandidateController;
use App\Http\Controllers\PosttrainingController;

// Route untuk menu default
// Route untuk menu default (guest)
Route::get('/', [WelcomeController::class, 'welcome']);

// Route untuk mengambil menu berdasarkan role
Route::get('/menu/{role}', [MenuManagementController::class, 'getMenuByRole']);

// Route untuk mengambil menu default (guest)
Route::get('/menu/default', [MenuManagementController::class, 'getDefaultMenu']);

// Route untuk candidate
// Route::middleware(['auth', 'role:candidate'])->group(function () {
//     Route::get('/candidate/profile', [UserCandidateController::class, 'profile']);
//     Route::get('/candidate/applications', [UserCandidateController::class, 'applications']);
// });

// Route untuk profile
Route::middleware(['auth', 'checkRole:candidate'])->group(function () {
    Route::get('/profiles', [UserCandidateController::class, 'profileCandidate'])->name('profiles');

    Route::get('/applicationsjobs', [JobClientController::class, 'JobList'])->name('/applicationsjobs');
    Route::get('/get-content-job-list', [JobClientController::class, 'getContentJobList'])->name('get-content-job-list');
    
    Route::get('/applicationstraining', [TrainingClientController::class, 'CourseList'])->name('/applicationstraining');
    Route::get('/get-content-training-list', [TrainingClientController::class, 'getContentTrainingList'])->name('get-content-training-list');

    //php artisan make:controller TrainingClientController
    //Route::get('/course-list', [TranningCourseController::class, 'CourseList'])->name('course-list');
    
    // Personal routes
    Route::post('/save-personal', [UserCandidateController::class, 'saveSummaryPersonal'])->name('save.personal');
    Route::put('/save-personal/{id}', [UserCandidateController::class, 'saveSummaryPersonal'])->name('update.personal');
    Route::post('/profile/personal/delete/{id}', [UserCandidateController::class, 'deletePersonal'])->name('profile.personal.delete');

    // Experience routes
    Route::post('/save-experience', [UserCandidateController::class, 'saveExperience'])->name('save.experience');
    Route::put('/save-experience/{id}', [UserCandidateController::class, 'saveExperience'])->name('update.experience');
    Route::post('/profile/experience/delete/{id}', [UserCandidateController::class, 'deleteExperience'])->name('profile.personal.delete');
    // Education routes
    Route::post('/education-store', [EducationController::class, 'store'])->name('education.store');
    Route::put('/education-store/{id}', [EducationController::class, 'update'])->name('education.update');
    Route::delete('/education/{id}', [EducationController::class, 'destroy'])->name('education.destroy');
    
    // Certification routes
    Route::post('/certification-store', [CertificationController::class, 'store'])->name('certification.store');
    Route::put('/certification-store/{id}', [CertificationController::class, 'update'])->name('certification.update');
    Route::delete('/certification/{id}', [CertificationController::class, 'destroy'])->name('certification.destroy');

    Route::get('/skills', [SkillController::class, 'index']);
    Route::post('/skills', [UserCandidateController::class, 'storeSkill']);
    Route::get('/skills/search', [UserCandidateController::class, 'search']);
    Route::delete('/skills/{id}', [UserCandidateController::class, 'destroySkill']);

    // Route::post('/resume', [UserCandidateController::class, 'storeResume']);
    // Route::delete('/resume', [UserCandidateController::class, 'destroyResume']);

    Route::get('/resume', [ResumeCandidateController::class, 'index']);
    Route::post('/resume', [ResumeCandidateController::class, 'storeResume']);
    Route::delete('/resume', [ResumeCandidateController::class, 'destroyResume']);

});
// Route untuk employee
Route::middleware(['auth', 'checkRole:company'])->group(function () {

    Route::get('/profile', [UserCompanyController::class, 'profileEmployee']);
    Route::get('/postjobs', [UserCompanyController::class, 'postjobs']);

    Route::get('/course-grid-company', [UserCompanyController::class, 'CourseGrid'])->name('course-grid-company');
    Route::get('/get-content-grid-course-company', [UserCompanyController::class, 'getContentGridCourse'])->name('get-content-grid-course-company');

    Route::get('/posttraining', [PosttrainingController::class, 'posttraining']);

    Route::get('/get-datacourse-filters', [PosttrainingController::class, 'getFilters'])->name('get-datacourse-filters');
    
    Route::get('/get-data-course', [PosttrainingController::class, 'getDataCourses'])->name('get-data-course');

    Route::get('/get-view-store-traningcourse/{id}', [PosttrainingController::class, 'ViewsStoretraningcourse'])->name('get-view-store-traningcourse');

    Route::post('/store-course-endpoint', [PosttrainingController::class, 'storeCourseEndpoint'])->name('store-course-endpoint');

    Route::get('/edit-traningcourse/{id}', [PosttrainingController::class, 'editTraningCourse'])->name('edit-traningcourse');

    Route::post('/update-course-endpoint', [PosttrainingController::class, 'updateCourseEndpoint'])->name('update-course-endpoint');

    Route::get('/remove-persyaratan-endpoint/{id}', [PosttrainingController::class, 'removePersyaratanEndpoint'])->name('remove-persyaratan-endpoint');

    Route::get('/remove-materitraining-endpoint/{id}', [PosttrainingController::class, 'removeMateriTrainingEndpoint'])->name('remove-materitraining-endpoint');

    Route::get('/remove-fasilitas-endpoint/{id}', [PosttrainingController::class, 'removeFasilitasEndpoint'])->name('remove-fasilitas-endpoint');

    Route::get('/remove-photo-endpoint/{id}', [PosttrainingController::class, 'removePhotoEndpoint'])->name('remove-photo-endpoint');

    Route::get('/remove-trainingcourse/{id}', [PosttrainingController::class, 'removePTrainingCourse'])->name('remove-trainingcourse');

    Route::get('/stop-data-course/{id}', [PosttrainingController::class, 'stopTrainingCourse'])->name('stop-data-course');

    Route::get('/copy-training-course-list/{id}', [PosttrainingController::class, 'copyTrainingCourseList'])->name('copy-training-course-list');

    Route::put('/update-copy-training-course', [PosttrainingController::class, 'updateCopyTrainingCourseList'])->name('update-copy-training-course');

    Route::get('/delete-data-course/{id}', [PosttrainingController::class, 'removePTrainingCourse'])->name('delete-data-course');

    Route::get('/edit-traningcourse-detail/{id}', [PosttrainingController::class, 'editTraningCourseDetail'])->name('edit-traningcourse-detail');

    Route::post('/save-company-profile', [UserCompanyController::class, 'saveCompanyProfile'])->name('save.company.profile');
    Route::put('/save-company-profile/{id}', [UserCompanyController::class, 'saveCompanyProfile'])->name('update.company.profile');
});

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
// Route::get('/get-content-job-list', [JobVacancyController::class, 'getContentJobList'])->name('get-content-job-list');
Route::get('/get-content-job-grid', [JobVacancyController::class, 'getContentJobGrid'])->name('get-content-job-grid');
Route::get('/load-filter-employeeStatusTop', [JobVacancyController::class, 'priviewEmployeeStatusTop'])->name('load-filter-employeeStatusTop');
Route::get('fetch-upcoming-jobs-sidebar', [JobVacancyController::class, 'SidebarJobvacancy'])->name('fetch-upcoming-jobs-sidebar');
// end route Job vacancy

// registratis user


Route::get('/login', [UserCandidateController::class, 'showLoginForm'])->name('login');
Route::get('/logincompany', [UserCompanyController::class, 'showLoginForm'])->name('logincompany');
Route::post('/signIn', [UserCandidateController::class, 'login'])->name('signIn');
Route::get('/redirectToLogin', [UserCandidateController::class, 'redirectToLogin'])->name('redirectToLogin');
Route::post('/signup', [UserCandidateController::class, 'signup'])->name('signup');
Route::post('/signupcompany', [UserCompanyController::class, 'signup'])->name('signupcompany');
Route::post('/logout', [UserCandidateController::class, 'logout'])->name('logout');
Route::get('/profleclientindex', [UserCandidateController::class, 'profleclientindex'])->name('profleclientindex');
Route::post('/updatedtuser', [UserCandidateController::class, 'updtaeUserClient'])->name('updatedtuser');
Route::get('/getdtuserclient', [UserCandidateController::class, 'getdtUserclient'])->name('getdtuserclient');

Route::get('/forgot-password', function () {
    return view('template2.forgot-password');
})->name('forgot.password');

Route::post('/forgot-password', [UserCandidateController::class, 'sendPasswordResetLink'])->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    Log::info('Token received for reset: ' . $token);
    return view('template2.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', [UserCandidateController::class, 'resetPassword'])->name('password.update');

Route::get('/get-chart-data', [DashboardController::class, 'getChartData']);
Route::get('/dashboardindex', [DashboardController::class, 'index'])->middleware('auth')->name('dashboardindex');
Route::get('/activitiesJob', [DashboardController::class, 'ActivitiesJob'])->name('activitiesJob');
Route::get('/activitiesTraining', [DashboardController::class, 'ActivitiesTraining'])->name('activitiesTraining');

Route::get('/jobclinetindex', [JobClientController::class, 'indexJoblient'])->name('jobclinetindex');
Route::get('/jobclinetdetail/{id}', [JobClientController::class, 'detailJobClient'])->name('jobclinetdetail');
Route::get('/viewapplyjob/{id}', [JobClientController::class, 'ViewApplyJob'])->name('viewapplyjob');
Route::post('/storeJobClient', [JobClientController::class, 'StoreJobClient'])->name('storeJobClient');

Route::get('/trainingclientindex', [TrainingClientController::class, 'indextrainingclient'])->name('trainingclientindex');
Route::get('/registertraining/{id}', [TrainingClientController::class, 'registerTraining'])->name('registertraining');
Route::post('/storeTrainingClient', [TrainingClientController::class, 'StoreTrainingClient'])->name('storeTrainingClient');
Route::get('/trainingpayment/{id}', [TrainingClientController::class, 'indexPaymentTraining'])->name('trainingpayment');
Route::get('/trainingclinetdetail/{id}', [TrainingClientController::class, 'detailTrainingClient'])->name('trainingclinetdetail');
Route::post('/store-payment', [TrainingClientController::class, 'storePayment'])->name('storePayment');
Route::get('/accounts-transfer/{idbank}', [TrainingClientController::class, 'getAccountsTransfer'])->name('accounts-transfer');

Route::get('/professionalclientindex', [ProfessionalTrainingClientController::class, 'indexProfessionalclient'])->name('professionalclientindex');
Route::get('/get-tasksprofTraining', [ProfessionalTrainingClientController::class, 'getTasks'])->name('get-tasksprofTraining');
Route::get('/detailproftrainer/{id}', [ProfessionalTrainingClientController::class, 'dteailProfessionalclient'])->name('detailproftrainer');

Route::get('/viewstoreproftrainer', [ProfessionalTrainingClientController::class, 'ViewStoreProfTran'])->name('viewstoreproftrainer');
Route::post('/insert-task', [ProfessionalTrainingClientController::class, 'insertTask']);

Route::get('/vieweditprof/{id}', [ProfessionalTrainingClientController::class, 'viewEditProf'])->name('vieweditprof');
Route::get('/get-taskedit/{id}', [ProfessionalTrainingClientController::class, 'getTaskEdit']);  // Mengambil data yang akan diedit
Route::post('/update-task', [ProfessionalTrainingClientController::class, 'updateTask']);

Route::get('/get-profesionalPatner', [ProfessionalTrainingClientController::class, 'getprofesionalPatner']);
Route::get('/get-background-pendidikan', [ProfessionalTrainingClientController::class, 'getBackgroundPendidikan']);
Route::get('/get-jenjang-pendidikan', [ProfessionalTrainingClientController::class, 'getJenjangPendidikan']);
Route::get('/get-province-data', [ProfessionalTrainingClientController::class, 'getProvinceData']);
Route::get('/get-age-Data', [ProfessionalTrainingClientController::class, 'getAgeData']);
Route::get('/get-workexperience-Data', [ProfessionalTrainingClientController::class, 'getWorkExperienceData']);
Route::get('/get-sertifikat-Data', [ProfessionalTrainingClientController::class, 'getsertifikatData']);

Route::get('/get-bidang-Data', [ProfessionalTrainingClientController::class, 'getBidangData']);
Route::get('/get-software-Data', [ProfessionalTrainingClientController::class, 'getSoftwareData']);
Route::get('/get-trainer-Data', [ProfessionalTrainingClientController::class, 'getTrainerData']);

Route::get('/get-posisi-diminati', [ProfessionalTrainingClientController::class, 'getPosisiDiminati']);
Route::get('/get-epc', [ProfessionalTrainingClientController::class, 'getepcData']);
Route::get('/get-salaray', [ProfessionalTrainingClientController::class, 'getsalarayData']);
