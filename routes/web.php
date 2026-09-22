<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    //**************************************** BACKEND ROUTES*************************************************** */
    Auth::routes();

    // Global Language Switcher
    Route::get('/language/{locale}', 'LanguageController@switchLanguage')->name('language.switch');

    // Appearance / CMS Routes
    Route::group(['prefix' => 'admin/appearance'], function () {
        Route::get('/theme', 'backend\AppearanceController@theme')->name('appearance.theme');
        Route::post('/theme/update', 'backend\AppearanceController@updateTheme')->name('appearance.theme.update');
        Route::get('/global', 'backend\AppearanceController@globalSettings')->name('appearance.global');
        Route::post('/global/update', 'backend\AppearanceController@updateGlobal')->name('appearance.global.update');
        Route::get('/home', 'backend\AppearanceController@home')->name('appearance.home');
        Route::post('/home/update', 'backend\AppearanceController@updateHome')->name('appearance.home.update');
        Route::get('/sections', 'backend\AppearanceController@sections')->name('appearance.sections');
        Route::post('/sections/update', 'backend\AppearanceController@updateSections')->name('appearance.sections.update');
    });

    // Facebook Graph API Posts Feed
    Route::get('/facebook-posts', 'frontend\theme\clasic\FacebookPostController@index')->name('facebook-posts');

    // ================================== talent hunt route start ======================================//

    Route::get('/talent-page-list', 'backend\theme\clasic\TalentHuntController@index')->name('talent-page-list');
    Route::get('/create-talent-content', 'backend\theme\clasic\TalentHuntController@create')->name('create-talent-content');
    Route::get('/inactive-talent-page/{page_id}', 'backend\theme\clasic\TalentHuntController@inactive')->name('inactive-talent-page');
    Route::get('/active-talent-page/{page_id}', 'backend\theme\clasic\TalentHuntController@active')->name('active-talent-page');
    Route::get('/delete-talent-page/{page_id}', 'backend\theme\clasic\TalentHuntController@delete')->name('delete-talent-page');

    Route::post('/store-talent', 'backend\theme\clasic\TalentHuntController@storeTalent')->name('store-talent');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/dashboard', 'backend\admin\AdminController@index')->name('admin');

    Route::get('/moderator', 'backend\moderator\ModeratorController@index')->name('moderator');

    Route::get('/income-expense-chart-ajax', 'backend\admin\AdminController@incomeExpenseChart');

    // ================================== home page  route start ======================================//

    //slider
    Route::get('/home-slider', 'backend\theme\clasic\home\HomeController@createSlider')->name('home-slider');

    Route::post('/create-slider', 'backend\theme\clasic\home\HomeController@storeSlider')->name('create-slider');

    Route::get('/home-slider-list', 'backend\theme\clasic\home\HomeController@index')->name('home-slider-list');

    Route::get('/home-slider/slider-edit/{slider_id}', 'backend\theme\clasic\home\HomeController@editSlider')->name('slider-edit');

    Route::post('/slider-update', 'backend\theme\clasic\home\HomeController@updateSlider')->name('slider-update');

    Route::get('/delete-slider/{slider_id}', 'backend\theme\clasic\home\HomeController@deleteSlider')->name('delete-slider');

    Route::get('/slider-inactive/{slider_id}', 'backend\theme\clasic\home\HomeController@inactiveSlider')->name('inactive-slider');

    Route::get('/slider-active/{slider_id}', 'backend\theme\clasic\home\HomeController@activeSlider')->name('active-slider');

    // on going projects or development project

    Route::get('/create-development-project', 'backend\theme\clasic\home\HomeController@createDevelopmentProject')->name('add-development-project');

    Route::post('/store-development-project', 'backend\theme\clasic\home\HomeController@storeDevelopmentProject')->name('store-development-project');

    Route::get('/development-project-list', 'backend\theme\clasic\home\HomeController@indexDevelopmentProject')->name('development-project-list');

    Route::get('/project-edit/{project_id}', 'backend\theme\clasic\home\HomeController@editDevelopmentProject')->name('project-edit');

    Route::post('/update-development-project', 'backend\theme\clasic\home\HomeController@updateDevelopmentProject')->name('update-development-project');

    Route::get('/delete-project/{project_id}', 'backend\theme\clasic\home\HomeController@deleteDevelopmentProject')->name('delete-project');

    Route::get('/project-inactive/{project_id}', 'backend\theme\clasic\home\HomeController@inactiveProject')->name('project-inactive');

    Route::get('/project-active/{project_id}', 'backend\theme\clasic\home\HomeController@activeProject')->name('project-active');
    // font awesome
    Route::get('/fontawesome-icon', 'backend\theme\clasic\home\HomeController@fontawesomeIcon')->name('fontawesome-icon');

    Route::post('/insert/fontawesoneIcon', 'backend\theme\clasic\home\HomeController@fontawesomeIconStore')->name('fontawesome-icon-store');

    Route::get('/font-awesome', 'backend\theme\clasic\home\HomeController@indexFontawesome')->name('fontawesome-index');

    Route::get('/fontawesome/edit/{id}', 'backend\theme\clasic\home\HomeController@editFontawesome')->name('fontawesome-edit');

    Route::post('/update/fontawesome', 'backend\theme\clasic\home\HomeController@fontawesomeIconUpdata')->name('fontawesome-icon-update');

    Route::get('/fontawesome/delete/{id}', 'backend\theme\clasic\home\HomeController@deleteFontawesome')->name('fontawesome-delete');
    //development-project-header-update
    Route::post('/development-project-header-update', 'backend\theme\clasic\home\HomeController@developmentProjectHeaderUpdate')->name('development-project-header-update');

    // international work

    Route::get('/international-work', 'backend\theme\clasic\home\HomeController@internationalIndex')->name('international-work');

    Route::post('/insert/international-work', 'backend\theme\clasic\home\HomeController@internationalStore')->name('insert-international-work');

    Route::get('/international-work/edit/{work_id}', 'backend\theme\clasic\home\HomeController@editInternatonalWork')->name('international-work-edit');

    Route::post('/update/international-work', 'backend\theme\clasic\home\HomeController@internationalUpdate')->name('update-international-work');

    Route::get('/delete-internationa-work/{work_id}', 'backend\theme\clasic\home\HomeController@deleteInternatonalWork')->name('international-work-delete');

    Route::get('/work-inactive/{work_id}', 'backend\theme\clasic\home\HomeController@inactiveWork')->name('work-inactive');

    Route::get('/work-active/{work_id}', 'backend\theme\clasic\home\HomeController@activeWork')->name('work-active');
    Route::post('/international-project-header-update', 'backend\theme\clasic\home\HomeController@internationalProjectHeaderUpdate')->name('international-project-header-update');

    // local project

    Route::get('/local-project', 'backend\theme\clasic\home\HomeController@indexLocalProject')->name('local-project');

    Route::post('/insert-local-project', 'backend\theme\clasic\home\HomeController@localProjectStore')->name('insert-local-project');

    Route::get('/local-project-edit/{local_id}', 'backend\theme\clasic\home\HomeController@localProjectEdit')->name('local-project-edit');

    Route::post('/update-local-project', 'backend\theme\clasic\home\HomeController@updateLocalProject')->name('update-local-project');

    Route::get('/local-project-delete/{local_id}', 'backend\theme\clasic\home\HomeController@localProjectDelete')->name('local-project-delete');

    Route::get('/local-inactive/{local_id}', 'backend\theme\clasic\home\HomeController@inactiveLocal')->name('local-inactive');

    Route::get('/local-active/{local_id}', 'backend\theme\clasic\home\HomeController@activeLocal')->name('local-active');
    Route::post('/local-project-header-update', 'backend\theme\clasic\home\HomeController@localProjectHeaderUpdate')->name('local-project-header-update');

    //footer home page
    Route::get('/footer', 'backend\theme\clasic\home\HomeController@createFooter')->name('footer');
    Route::post('/store_footer', 'backend\theme\clasic\home\HomeController@store_footer')->name('store_footer');
    Route::post('/update_footer', 'backend\theme\clasic\home\HomeController@update_footer')->name('update_footer');
    Route::get('/footer-inactive/{footer_id}', 'backend\theme\clasic\home\HomeController@inActiveFooter');
    Route::get('/footer-active/{footer_id}', 'backend\theme\clasic\home\HomeController@activeFooter');
    Route::get('/footer-delete/{footer_id}', 'backend\theme\clasic\home\HomeController@deleteFooter');

    // ================================== home page  route end ======================================//

    // ================================== service page route start ======================================//
    //service page
    Route::get('/service-list', 'backend\theme\clasic\service\ServiceController@indexService')->name('service-list');

    Route::get('/service-insert', 'backend\theme\clasic\service\ServiceController@insertService')->name('service-insert');

    Route::post('/service-store', 'backend\theme\clasic\service\ServiceController@storeService')->name('service-store');

    Route::get('/edit-service/{service_id}', 'backend\theme\clasic\service\ServiceController@editService')->name('edit-service');

    Route::post('/service-update', 'backend\theme\clasic\service\ServiceController@updateService')->name('service-update');

    Route::get('/delete-service/{service_id}', 'backend\theme\clasic\service\ServiceController@deleteService')->name('delete-service');
    //bannder course
    Route::get('/service-banner', 'backend\theme\clasic\service\ServiceController@serviceBanner')->name('service-banner');
    Route::post('/service_banner_store', 'backend\theme\clasic\service\ServiceController@serviceBannerStore')->name('service_banner_store');
    Route::post('/service_banner_update', 'backend\theme\clasic\service\ServiceController@serviceBannerUpdate')->name('service_banner_update');
    Route::get('/service-banner-inactive/{banner_id}', 'backend\theme\clasic\service\ServiceController@inactiveBanner');
    Route::get('/service-banner-active/{banner_id}', 'backend\theme\clasic\service\ServiceController@activeBanner');
    Route::get('/service-banner-delete/{banner_id}', 'backend\theme\clasic\service\ServiceController@deleteBanner');

    // ================================== service page route end ======================================//

    // ================================== Pages route ======================================//
    Route::get('/page-content/{id}', 'backend\theme\clasic\PagesController@index')->name('pages-list');

    Route::get('/pages-seo', 'backend\theme\clasic\PagesController@pageList')->name('pages');

    // Route::get('/add-page-seo', 'backend\theme\clasic\PagesController@seoPage')->name('add-page-seo');

    Route::get('/add-content/{id}', 'backend\theme\clasic\PagesController@seoPage')->name('add-content');

    Route::post('/store-page-seo', 'backend\theme\clasic\PagesController@store')->name('store-page-seo');

    Route::post('/add-page-name', 'backend\theme\clasic\PagesController@addPageName')->name('add-page-name');

    // ================================== Courses route ======================================//
    Route::get('/create-course', 'backend\theme\clasic\courses\CoursesController@create')->name('create-course');

    Route::post('/add-new-course', 'backend\theme\clasic\courses\CoursesController@storeCourse')->name('add-new-course');

    Route::get('/courses-list', 'backend\theme\clasic\courses\CoursesController@index')->name('courses-list');

    Route::get('/course-view/{course_id}', 'backend\theme\clasic\courses\CoursesController@courseView')->name('course-view');

    Route::get('/course-edit/{course_id}', 'backend\theme\clasic\courses\CoursesController@courseEdit')->name('course-edit');

    Route::post('/update-course', 'backend\theme\clasic\courses\CoursesController@updateCourse')->name('update-course');

    Route::get('/delete-course/{course_id}', 'backend\theme\clasic\courses\CoursesController@deleteCourse')->name('delete-course');

    //course slug ajax checker
    Route::get('/course-slug/{replace}', 'backend\theme\clasic\courses\CoursesController@courseSlug')->name('course-slug');

    Route::get('/course-slug-edit/{replace}/{course_id}', 'backend\theme\clasic\courses\CoursesController@courseSlugEdit')->name('course-slug-edit');

    // course item

    Route::post('/store-course-item', 'backend\theme\clasic\courses\CoursesController@storeCourseItem')->name('store-course-item');

    Route::get('/course-items-list/{course_id}', 'backend\theme\clasic\courses\CoursesController@courseItemList')->name('course-items-list');
    // course item list
    Route::get('/course-edit-item/{item_id}', 'backend\theme\clasic\courses\CoursesController@editCourseItem')->name('edit-course-item');

    Route::post('/update-course-item', 'backend\theme\clasic\courses\CoursesController@updateCourseItem')->name('update-course-item');

    Route::get('/delete-course-item/{item_id}', 'backend\theme\clasic\courses\CoursesController@deleteCourseItem')->name('delete-course-item');

    // fassilities
    Route::get('/course-fassilities-list/{course_id}', 'backend\theme\clasic\courses\CoursesController@courseFassilities')->name('course-fassilities-list');

    Route::post('/store-course-fassility', 'backend\theme\clasic\courses\CoursesController@storeCourseFassility')->name('store-course-fassility');

    Route::get('/course-fassility_edit/{fassility_id}', 'backend\theme\clasic\courses\CoursesController@editCourseFassility')->name('edit-course-fassility');

    Route::get('/delete-course-fassility/{fassility_id}', 'backend\theme\clasic\courses\CoursesController@deleteCourseFassility')->name('edit-course-fassility');

    Route::post('/update-course-fassility', 'backend\theme\clasic\courses\CoursesController@updateCourseFassility')->name('update-course-fassility');

    // course member

    Route::get('/course-member-list/{course_id}', 'backend\theme\clasic\courses\CoursesController@courseMember')->name('course-member-list');

    Route::post('/store-course-member', 'backend\theme\clasic\courses\CoursesController@storeCourseMember')->name('store-course-member');

    Route::get('/course-member_edit/{member_id}', 'backend\theme\clasic\courses\CoursesController@editCourseMember')->name('edit-course-member-list');

    Route::post('/update-course-member', 'backend\theme\clasic\courses\CoursesController@updateCourseMember')->name('update-course-member');

    Route::get('/delete-course-member/{member_id}', 'backend\theme\clasic\courses\CoursesController@deleteCourseMember')->name('delete-course-member');
    //bannder course
    Route::get('/course_banner', 'backend\theme\clasic\courses\CoursesController@courseBanner')->name('course_banner');
    Route::post('/tranning_banner_store', 'backend\theme\clasic\courses\CoursesController@tranningBannerStore')->name('tranning_banner_store');
    Route::post('/tranning_banner_update', 'backend\theme\clasic\courses\CoursesController@tranningBannerUpdate')->name('tranning_banner_update');
    Route::get('/training-banner-inactive/{banner_id}', 'backend\theme\clasic\courses\CoursesController@inactiveBanner');
    Route::get('/training-banner-active/{banner_id}', 'backend\theme\clasic\courses\CoursesController@activeBanner');
    Route::get('/training-banner-delete/{banner_id}', 'backend\theme\clasic\courses\CoursesController@deleteBanner');

    // ================================== blog route ======================================//
    //blog category
    Route::get('/blog-category', 'backend\theme\clasic\blogs\BlogController@blogCategory')->name('blog-category');

    Route::post('/store-blog-categry', 'backend\theme\clasic\blogs\BlogController@blogCategoryStore')->name('store-blog-categry');

    Route::get('/edit-blog-category/{blogCategory_id}/{blogCategory_title}', 'backend\theme\clasic\blogs\BlogController@blogCategoryEdit')->name('edit-blog-category');

    Route::post('/update-blog-cagegory', 'backend\theme\clasic\blogs\BlogController@blogCategoryUpdate')->name('update-blog-cagegory');

    Route::get('/delete-blog-category/{blogCategory_id}/{blogCategory_title}', 'backend\theme\clasic\blogs\BlogController@blogCategoryDelete')->name('edit-blog-category');

    // blogs route /
    Route::get('/blogs-list', 'backend\theme\clasic\blogs\BlogController@index')->name('blogs-list');

    Route::get('/create-blog', 'backend\theme\clasic\blogs\BlogController@create')->name('create-blog');

    Route::post('/store-blog', 'backend\theme\clasic\blogs\BlogController@storeBlog')->name('store-blog');

    Route::get('/edit-blog/{blog_id}', 'backend\theme\clasic\blogs\BlogController@editblog')->name('edit-blog');

    Route::post('/update-blog', 'backend\theme\clasic\blogs\BlogController@updateBlog')->name('update-blog');

    Route::get('/delete-blog/{blog_id}', 'backend\theme\clasic\blogs\BlogController@deleteBlog')->name('delete-blog');

    Route::get('/view-this-blog/{blog_id}', 'backend\theme\clasic\blogs\BlogController@viewBlog')->name('view-this-blog');

    //blog slug ajax

    Route::get('/blog-slug/{blog_slug}', 'backend\theme\clasic\blogs\BlogController@blogSlug')->name('blog-slug');

    Route::get('/blog-slug-edit/{blog_slug}/{blog_id}', 'backend\theme\clasic\blogs\BlogController@blogSlugEdit')->name('blog-slug-edit');

    // blog active inactive

    Route::get('/blog-inactive/{blog_id}', 'backend\theme\clasic\blogs\BlogController@blogInactive')->name('blog-inactive');

    Route::get('/blog-active/{blog_id}', 'backend\theme\clasic\blogs\BlogController@blogActive')->name('blog-active');

    // blog content

    Route::get('/add-blog-content/{blog_id}/{blog_title}', 'backend\theme\clasic\blogs\BlogController@addBlogContent')->name('add-blog-content');

    Route::post('/store-blog-content', 'backend\theme\clasic\blogs\BlogController@storeBlogContent')->name('store-blog-content');

    Route::get('/blog-content-list/{blog_id}', 'backend\theme\clasic\blogs\BlogController@indexBlogContent')->name('add-blog-content');

    Route::get('/edit-blog-content/{blogContent_id}', 'backend\theme\clasic\blogs\BlogController@editBlogContent')->name('edit-blog-content');

    Route::post('/update-blog-content', 'backend\theme\clasic\blogs\BlogController@updateBlogContent')->name('update-blog-content');

    Route::get('/delete-blog-content/{blogContent_id}', 'backend\theme\clasic\blogs\BlogController@deleteBlogContent')->name('delete-blog-content');

    Route::get('/view-blog-content/{blogContent_id}', 'backend\theme\clasic\blogs\BlogController@viewBlogContent')->name('view-blog-content');

    // ================================================== student route start=========================================================//
    // students
    Route::get('/insert-student', 'backend\theme\clasic\student\StudentController@insertStudent')->name('insert-student');
    Route::get('/students-list', 'backend\theme\clasic\student\StudentController@studentList')->name('students-list');
    Route::get('/student-print/{student_id}', 'backend\theme\clasic\student\StudentController@studentPrint')->name('students-view');
    Route::get('/student-view/{student_id}', 'backend\theme\clasic\student\StudentController@studentView')->name('students-view');
    Route::get('/student-edit/{student_id}', 'backend\theme\clasic\student\StudentController@editStudent')->name('student-edit');
    Route::get('/delete-student/{student_id}', 'backend\theme\clasic\student\StudentController@deleteStudent')->name('delete-student');
    Route::post('/update-student', 'backend\theme\clasic\student\StudentController@updateStudent')->name('update-student');
    Route::post('/store-student', 'backend\theme\clasic\student\StudentController@storeStudent')->name('store-student');
    Route::post('/course_fee_ajax', 'backend\theme\clasic\student\StudentController@courseFeeAjax')->name('course_fee_ajax');
    Route::get('/search-applied-student', 'backend\theme\clasic\student\StudentController@searchAppliedStudent')->name('search-applied-student');

    //registered student or admitted student

    Route::post('/register-student', 'backend\theme\clasic\student\StudentController@registerStudent')->name('register-student');
    Route::get('/admited-students-list', 'backend\theme\clasic\student\StudentController@admitedStudentIndex')->name('admited-students-list');
    Route::get('/admited-student-edit/{student_id}', 'backend\theme\clasic\student\StudentController@admitedStudentEdit')->name('admited-student-edit');
    Route::post('/admited-student-update', 'backend\theme\clasic\student\StudentController@updateAdmitedStudent')->name('admited-student-update');
    Route::get('/admited-delete-student/{student_id}', 'backend\theme\clasic\student\StudentController@deleteAdmitedStudent')->name('admited-delete-student');
    Route::get('/admited-student-view/{student_id}', 'backend\theme\clasic\student\StudentController@studentAdmitedView')->name('admited-students-view');
    Route::get('/admited-student-print/{student_id}', 'backend\theme\clasic\student\StudentController@studentAdmitedPrint')->name('admited-students-view');
    Route::get('/search-admitted-student', 'backend\theme\clasic\student\StudentController@searchAdmittedStudent')->name('search-admitted-student');
    Route::get('/course-and-batch-wise-student', 'backend\theme\clasic\student\StudentController@batchWiseStudent')->name('batchWiseStudent');
    // ajax course wise batch
    Route::post('/courseWiseBatchAjax', 'backend\theme\clasic\student\StudentController@courseWiseBatchAjax')->name('courseWiseBatchAjax');
    Route::get('/print-all-student', 'backend\theme\clasic\student\StudentController@printAllStudent')->name('print-all-student');
    Route::get('print-searched-student/{student_number}', 'backend\theme\clasic\student\StudentController@printSearchedStudent');
    Route::post('/course-and-batch-wise-student-print', 'backend\theme\clasic\student\StudentController@courseAndBatchWiseStudentPrint')->name('course-and-batch-wise-student-print');

    //student payment

    Route::get('/student-payment/{student_id}', 'backend\theme\clasic\student\StudentController@studentPayment');
    Route::post('/student-payment', 'backend\theme\clasic\student\StudentController@studentPaymentStore')->name('student_payment');
    Route::get('/paid-details/{student_id}', 'backend\theme\clasic\student\StudentController@paidDetails');
    Route::post('/student_payment_update', 'backend\theme\clasic\student\StudentController@student_payment_update')->name('student_payment_update');
    Route::get('/delete-payment/{payment_id}', 'backend\theme\clasic\student\StudentController@paymentDelete');
    Route::get('/payment-view/{payment_id}', 'backend\theme\clasic\student\StudentController@studentPaymentView');
    Route::get('/admitted-student-inactive/{student_id}', 'backend\theme\clasic\student\StudentController@admittedStudentInactive');
    Route::get('/admitted-student-active/{student_id}', 'backend\theme\clasic\student\StudentController@admittedStudentActive');
    Route::post('/student_payment_return', 'backend\theme\clasic\student\StudentController@student_payment_return')->name('student_payment_return');

    // student  batches

    Route::get('/batch-list', 'backend\theme\clasic\student\StudentController@indexBatch')->name('batch-list');
    // insert and update both in insert batch
    Route::post('/insert-batch', 'backend\theme\clasic\student\StudentController@storeBatch')->name('insert-batch');
    Route::get('/batch-delete/{batch_id}', 'backend\theme\clasic\student\StudentController@deleteBatch')->name('batch-delete');
    Route::get('/batch-inactive/{batch_id}', 'backend\theme\clasic\student\StudentController@inactiveBatch')->name('batch-inactive');
    Route::get('/batch-active/{batch_id}', 'backend\theme\clasic\student\StudentController@activeBatch')->name('batch-active');
    Route::get('/search-student', 'backend\theme\clasic\student\StudentController@searchStudent')->name('search-student');
    Route::post('/admitted-student-details', 'backend\theme\clasic\student\StudentController@admittedStudentDetails')->name('admitted-student-details');

    // ================================================== student route end=========================================================//

    // ================================================== contact  route start =========================================================//
    Route::get('/contacts-list', 'backend\theme\clasic\contact_us\ContactUsController@index')->name('contact-list');

    Route::get('/contact-edit/{contact_id}', 'backend\theme\clasic\contact_us\ContactUsController@editContact')->name('contact-edit');

    Route::post('/edit-contact', 'backend\theme\clasic\contact_us\ContactUsController@updateContact')->name('edit-contact');

    Route::get('/delete-contact/{contact_id}', 'backend\theme\clasic\contact_us\ContactUsController@deleteContact')->name('delete-contact');

    Route::get('/view-contact/{contact_id}', 'backend\theme\clasic\contact_us\ContactUsController@viewContact')->name('view-contact');

    // ================================================== contact  route end =========================================================//

    // ================================================== about  route start =========================================================//
    //about hr card
    Route::get('/create-about', 'backend\theme\clasic\about_us\AboutUsController@createAbout')->name('about-create');

    Route::post('/store-who-we-are', 'backend\theme\clasic\about_us\AboutUsController@storeAbout')->name('store-who-we-are');

    Route::get('/who-we-are-list', 'backend\theme\clasic\about_us\AboutUsController@indexAbout')->name('who-we-are-list');

    Route::get('/who-we-are-edit/{about_id}', 'backend\theme\clasic\about_us\AboutUsController@editAbout')->name('who-we-are-edit');

    Route::post('/update-who-we-are', 'backend\theme\clasic\about_us\AboutUsController@updateAbout')->name('update-who-we-are');

    Route::get('/who-we-are-delete/{about_id}', 'backend\theme\clasic\about_us\AboutUsController@deleteAbout')->name('who-we-are-delete');

    Route::get('/about-inactive/{about_id}', 'backend\theme\clasic\about_us\AboutUsController@aboutInactive')->name('about-inactive');

    Route::get('/who-we-are-list/{slug}', 'backend\theme\clasic\about_us\AboutUsController@whoWeAreList')->name('who-we-are-list-details');

    Route::post('/store-about-info', 'backend\theme\clasic\about_us\AboutUsController@storeAboutInfo')->name('store-about-info');

    Route::post('/store-stack', 'backend\theme\clasic\about_us\AboutUsController@storeStack')->name('store-stack');
    Route::post('/assign-stack', 'backend\theme\clasic\about_us\AboutUsController@assignStack')->name('assign-stack');
    Route::get('/delete-assign-asset/{stack_id}', 'backend\theme\clasic\about_us\AboutUsController@deleteAssignAsset');

    Route::post('/update-stack', 'backend\theme\clasic\about_us\AboutUsController@updateStack')->name('update-stack');
    Route::post('/store-project-for-employee', 'backend\theme\clasic\about_us\AboutUsController@storeProjectForEmployee')->name('store-project-for-employee');
    Route::post('/update-project-for-employee', 'backend\theme\clasic\about_us\AboutUsController@updateProjectForEmployee')->name('update-project-for-employee');

    Route::get('/about-active/{about_id}', 'backend\theme\clasic\about_us\AboutUsController@aboutActive')->name('about-active');
    Route::get('/about-employee/{about_id}', 'backend\theme\clasic\about_us\AboutUsController@aboutEmployee')->name('about-employee');
    Route::get('/about-intern/{about_id}', 'backend\theme\clasic\about_us\AboutUsController@aboutIntern')->name('about-intern');
    //about history
    Route::get('/about_history', 'backend\theme\clasic\about_us\AboutUsController@indexHistory')->name('about_history');
    Route::post('/history_store', 'backend\theme\clasic\about_us\AboutUsController@historyStore')->name('history_store');
    Route::post('/history_update', 'backend\theme\clasic\about_us\AboutUsController@historyUpdate')->name('history_update');
    Route::get('/history-inactive/{history_id}', 'backend\theme\clasic\about_us\AboutUsController@inactiveHistory');
    Route::get('/history-active/{history_id}', 'backend\theme\clasic\about_us\AboutUsController@activeHistory');
    Route::get('/history-delete/{history_id}', 'backend\theme\clasic\about_us\AboutUsController@deleteHistory');
    //bannder about
    Route::get('/about_banner', 'backend\theme\clasic\about_us\AboutUsController@about_banner')->name('about_banner');
    Route::post('/banner_store', 'backend\theme\clasic\about_us\AboutUsController@banner_store')->name('banner_store');
    Route::post('/banner_update', 'backend\theme\clasic\about_us\AboutUsController@banner_update')->name('banner_update');
    Route::get('/banner-inactive/{banner_id}', 'backend\theme\clasic\about_us\AboutUsController@inactiveBanner');
    Route::get('/banner-active/{banner_id}', 'backend\theme\clasic\about_us\AboutUsController@activeBanner');
    Route::get('/banner-delete/{banner_id}', 'backend\theme\clasic\about_us\AboutUsController@deleteBanner');

    // ================================================== about  route end =========================================================//

    // ================================================== accounts route end =========================================================//
    //investor
    Route::get('/index_investor', 'backend\theme\clasic\accounts\AccountController@indexInvestor')->name('index_investor');
    Route::post('/insert-investor', 'backend\theme\clasic\accounts\AccountController@insertInvestor')->name('insert-investor');
    Route::get('/edit-investor/{investor_id}', 'backend\theme\clasic\accounts\AccountController@editInvestor')->name('edit-investor');
    Route::post('/update-investor', 'backend\theme\clasic\accounts\AccountController@updateInvestor')->name('update-investor');
    Route::get('/delete-investor/{investor_id}', 'backend\theme\clasic\accounts\AccountController@deleteInvestor')->name('delete-investor');
    //investor type
    Route::get('/index_investor_type', 'backend\theme\clasic\accounts\AccountController@indexInvestorType')->name('index_investor_type');
    Route::post('/insert-investor-type', 'backend\theme\clasic\accounts\AccountController@insertInvestorType')->name('insert-investor-type');
    Route::get('/edit-investor-type/{type_id}', 'backend\theme\clasic\accounts\AccountController@editInvestorType');
    Route::post('/update-investor-type', 'backend\theme\clasic\accounts\AccountController@updateInvestorType')->name('update-investor-type');
    Route::get('/delete-investor-type/{type_id}', 'backend\theme\clasic\accounts\AccountController@deleteInvestorType');

    //investment
    Route::get('/add_investment', 'backend\theme\clasic\accounts\AccountController@addInvestment')->name('add_investment');
    Route::post('/store_investment', 'backend\theme\clasic\accounts\AccountController@storeInvestment')->name('store_investment');
    Route::get('/investment_list', 'backend\theme\clasic\accounts\AccountController@investment_list')->name('investment_list');
    Route::get('/investment_view/{invest_id}', 'backend\theme\clasic\accounts\AccountController@viewInvestment');
    Route::get('/edit-investment/{invest_id}', 'backend\theme\clasic\accounts\AccountController@editInvestment');
    Route::post('/update_investment', 'backend\theme\clasic\accounts\AccountController@updateInvestment')->name('update_investment');

    //category start
    Route::get('/accounts-category', 'backend\theme\clasic\accounts\AccountController@indexCategory')->name('accounts-category');
    Route::get('/create-category', 'backend\theme\clasic\accounts\AccountController@createCategory')->name('create-category');
    Route::post('/insert-category', 'backend\theme\clasic\accounts\AccountController@insertCategory')->name('insert-category');
    Route::get('/edit-account-category/{category_id}', 'backend\theme\clasic\accounts\AccountController@editCategory')->name('edit-account-category');
    Route::post('/update-category', 'backend\theme\clasic\accounts\AccountController@updateCategory')->name('update-category');
    Route::get('/delete-account-category/{category_id}', 'backend\theme\clasic\accounts\AccountController@deletedCategory')->name('delete-account-category');

    //category end

    //expense start\

    Route::get('/expenses-list', 'backend\theme\clasic\accounts\AccountController@indexExpense')->name('expenses-list');
    Route::get('/add-expense', 'backend\theme\clasic\accounts\AccountController@addExpense')->name('add-expense');
    Route::post('/store-expense', 'backend\theme\clasic\accounts\AccountController@storeExpense')->name('store-expense');
    Route::get('/edit-expense/{expense_id}', 'backend\theme\clasic\accounts\AccountController@editExpense')->name('edit-expense');
    Route::post('/update-expense', 'backend\theme\clasic\accounts\AccountController@updateExpense')->name('update-expense');
    Route::get('/delete-expense/{expense_id}', 'backend\theme\clasic\accounts\AccountController@deleteExpense')->name('delete-expense');
    Route::get('/expense-view/{expense_id}', 'backend\theme\clasic\accounts\AccountController@viewExpense')->name('expense-view');
    Route::post('/expense_payback_store', 'backend\theme\clasic\accounts\AccountController@expensePayback')->name('expense_payback_store');
    Route::get('/expense-payroll/{expense_id}', 'backend\theme\clasic\accounts\AccountController@expensePayroll');
    Route::post('/expense_type_ajax', 'backend\theme\clasic\accounts\AccountController@expenseTypeAjax')->name('expense_type_ajax');

    //expense end

    //multiple expense start

    Route::get('/add-multiple-expense', 'backend\theme\clasic\accounts\AccountController@addMultipleExpense')->name('add-multiple-expense');
    Route::post('/store-multiple-expense', 'backend\theme\clasic\accounts\AccountController@storeMultipleExpense')->name('store-multiple-expense');
    Route::get('/multiple-expense-list', 'backend\theme\clasic\accounts\AccountController@indexMultipleExpense')->name('multiple-expense-list');
    Route::get('/expense-multiple-print/{multi_expense_id}', 'backend\theme\clasic\accounts\AccountController@printMutipleExpense');
    Route::get('/delete-multiple-expense/{multi_expense_id}', 'backend\theme\clasic\accounts\AccountController@DeleteMultipleExpense');

    //multiple expense end

    //income start

    Route::get('/income-list', 'backend\theme\clasic\accounts\AccountController@indexIncome')->name('income-list');
    Route::get('/add-income', 'backend\theme\clasic\accounts\AccountController@AddIncome')->name('add-income');
    Route::post('/store-income', 'backend\theme\clasic\accounts\AccountController@storeIncome')->name('store-income');
    Route::get('edit-income/{income_id}', 'backend\theme\clasic\accounts\AccountController@editIncome')->name('edit-income');
    Route::post('/update-income', 'backend\theme\clasic\accounts\AccountController@updateIncome')->name('update-income');
    Route::get('delete-income/{income_id}', 'backend\theme\clasic\accounts\AccountController@deleteIncome')->name('delete-income');
    Route::get('/income-view/{income_id}', 'backend\theme\clasic\accounts\AccountController@viewIncome');
    Route::post('/income_type_ajax', 'backend\theme\clasic\accounts\AccountController@incomeTypeAjax')->name('income_type_ajax');

    //edit income with studend payment

    Route::post('/update-income-with-payment', 'backend\theme\clasic\accounts\AccountController@updateIncomeStudentPayment')->name('update-income-with-student-payment');
    Route::get('/income-student-payment/{payment_id}', 'backend\theme\clasic\accounts\AccountController@incomeStudentPayment');

    //income end

    // start monthly sheet

    Route::get('monthly-sheet', 'backend\theme\clasic\accounts\AccountController@monthlySheet')->name('monthly-sheet');
    Route::get('monthly-sheet-search', 'backend\theme\clasic\accounts\AccountController@monthlySheetSearch')->name('monthly-sheet-search');
    Route::get('monthly-sheet-print', 'backend\theme\clasic\accounts\AccountController@monthlySheetPrint');
    Route::post('/searched-monthly-sheet-print', 'backend\theme\clasic\accounts\AccountController@searchedMonthlySheetPrint');

    // end monthly sheet
    //monthly summary start
    Route::get('monthly-summary', 'backend\theme\clasic\accounts\AccountController@monthlySummary')->name('monthly_summary');

    //monthly summary end
    //start cash in hand
    Route::get('cash_in_hand', 'backend\theme\clasic\accounts\AccountController@CashInHand')->name('cash_in_hand');
    //end cash in hand
    //asset start
    Route::get('/asset_type', 'backend\theme\clasic\accounts\AccountController@assetTypeIndex')->name('asset_type');
    Route::post('/insert_and_update_asset_type', 'backend\theme\clasic\accounts\AccountController@InsertAndUpdateAssetType')->name('insert_and_update_asset_type');
    Route::get('/delete-asset-type/{type_id}', 'backend\theme\clasic\accounts\AccountController@deleteAssetType');
    Route::get('/add-asset', 'backend\theme\clasic\accounts\AccountController@addAsset')->name('add_asset');
    Route::post('/insertAndUpdateAsset', 'backend\theme\clasic\accounts\AccountController@insertAndUpdateAsset')->name('insertAndUpdateAsset');
    Route::get('/assets-list', 'backend\theme\clasic\accounts\AccountController@indexAsset')->name('assets_list');
    Route::get('/edit-asset/{asset_id}', 'backend\theme\clasic\accounts\AccountController@editAsset');
    Route::get('/delete-asset/{asset_id}', 'backend\theme\clasic\accounts\AccountController@deleteAsset');

    //asset end

    //loan start
    Route::get('/add-loan', 'backend\theme\clasic\accounts\AccountController@addLoan')->name('add_loan');
    Route::post('/insertAndUpdateLoan', 'backend\theme\clasic\accounts\AccountController@insertAndUpdateLoan')->name('insertAndUpdateLoan');
    Route::get('/loans-list', 'backend\theme\clasic\accounts\AccountController@indexLoan')->name('loans-list');
    Route::get('/edit-loan/{loan_id}', 'backend\theme\clasic\accounts\AccountController@editLoan');
    Route::get('/delete-loan/{loan_id}', 'backend\theme\clasic\accounts\AccountController@deleteLoan');

    //loan end
    // ================================================== accounts route end =========================================================//

    // ================================================== payroll start =========================================================//
    Route::get('/employee_salaries', 'backend\theme\clasic\payroll\PayrollController@employeeSalaries')->name('employee_salaries');
    Route::post('/employee_monthly_salary_insert', 'backend\theme\clasic\payroll\PayrollController@employeeMonthlySalaryInsert')->name('employee_monthly_salary_insert');
    Route::post('/employee_monthly_salary_update', 'backend\theme\clasic\payroll\PayrollController@employeeMonthlySalaryUpdate')->name('employee_monthly_salary_update');
    Route::get('/employee_monthly_salary_delete/{salary_id}', 'backend\theme\clasic\payroll\PayrollController@employeeMonthlySalaryDelete')->name('employee_monthly_salary_delete');

    //paid payroll
    Route::get('/add-payroll', 'backend\theme\clasic\payroll\PayrollController@addPayroll')->name('add-payroll');
    //ajax

    Route::post('/payroll_employee_ajax', 'backend\theme\clasic\payroll\PayrollController@ajaxPayrollEmployee')->name('payroll_employee_type_ajax');
    Route::post('/payroll_employee_salary_ajax', 'backend\theme\clasic\payroll\PayrollController@ajaxPayrollEmployeeSalary')->name('payroll_employee_salary_ajax');
    Route::post('/store-payroll', 'backend\theme\clasic\payroll\PayrollController@storePayroll')->name('store-payroll');
    Route::get('/payroll-list', 'backend\theme\clasic\payroll\PayrollController@indexPayroll')->name('payroll-list');
    Route::get('/edit-payroll/{payroll_id}', 'backend\theme\clasic\payroll\PayrollController@editPayroll')->name('edit-payroll');
    Route::post('/update-payroll', 'backend\theme\clasic\payroll\PayrollController@updatePayroll')->name('update-payroll');
    Route::get('/delete-payroll/{payroll_id}', 'backend\theme\clasic\payroll\PayrollController@deletePayroll')->name('delete-payroll');
    Route::get('/payroll_view/{payroll_id}', 'backend\theme\clasic\payroll\PayrollController@viewPayroll');
    Route::get('/payroll-search', 'backend\theme\clasic\payroll\PayrollController@payrollSearch')->name('payroll-search');
    Route::get('/print-searched-payroll/{month}/{year}', 'backend\theme\clasic\payroll\PayrollController@printSearchedPayroll')->name('print-searched-payroll');

    // ================================================== payroll end =========================================================//

    // ================================================== user start =========================================================//

    Route::get('/create-user', 'backend\theme\clasic\user\UserController@createUser')->name('create-user');
    Route::get('/user-list', 'backend\theme\clasic\user\UserController@indexUser')->name('user-list');
    Route::get('/delete-user/{user_id}', 'backend\theme\clasic\user\UserController@deleteUser')->name('delete-user');
    Route::post('/store-user', 'backend\theme\clasic\user\UserController@storeUser')->name('store-user');
    Route::get('/edit-user/{user_id}', 'backend\theme\clasic\user\UserController@editUser')->name('edit-user');
    Route::post('/edit-user', 'backend\theme\clasic\user\UserController@updateUser')->name('edit-user');
    Route::post('/change-user-password', 'backend\theme\clasic\user\UserController@changeUserPassword');
    Route::get('/designation', 'backend\theme\clasic\user\UserController@designation')->name('designation');
    Route::post('/add-update-designation', 'backend\theme\clasic\user\UserController@addUpdateDesignation')->name('add-update-designation');
    Route::get('/delete-designation/{designation_id}', 'backend\theme\clasic\user\UserController@deleteDesignation');

    // user excess start
    Route::get('/user_excess/{user_id}', 'backend\theme\clasic\user\UserController@user_excess')->name('user_excess');
    Route::post('/user_excess', 'backend\theme\clasic\user\UserController@user_excess_store')->name('user_excess');
    Route::get('/user_excess_page/{user_id}', 'backend\theme\clasic\user\UserController@user_excess_page')->name('user_excess_page');
    Route::get('/delete_user_excess/{excess_id}', 'backend\theme\clasic\user\UserController@delete_user_excess')->name('delete_user_excess');
    Route::get('/delete-all-excess/{user_id}', 'backend\theme\clasic\user\UserController@deleteAllUserExcess');

    //user excess end

    // ================================================== user end =========================================================//

    // ================================================== user profile start =========================================================//

    Route::get('/profile', 'backend\theme\clasic\user\UserController@indexProfile')->name('profile');
    Route::get('/upload-your-photo', 'backend\theme\clasic\user\UserController@uploadImage')->name('upload-user-image');
    Route::post('/upload-your-photo', 'backend\theme\clasic\user\UserController@storeUserPhoto');
    Route::get('/change-password', 'backend\theme\clasic\user\UserController@changePassword')->name('change-password');
    Route::post('/change-password', 'backend\theme\clasic\user\UserController@changePasswordStore');
    Route::get('/edit-your-profile', 'backend\theme\clasic\user\UserController@editYourProfile')->name('edit-your-profile');
    Route::post('/edit-your-profile', 'backend\theme\clasic\user\UserController@updateYourProfile');

    // ================================================== user profile end =========================================================//

    // ******************************************************* module start*****************************************************************

    // module routes
    Route::get('/module', 'backend\theme\clasic\module\ModuleController@index')->name('module');

    Route::post('/store_module', 'backend\theme\clasic\module\ModuleController@store')->name('store_module');

    Route::get('/module_edit/{id}', 'backend\theme\clasic\module\ModuleController@edit');

    Route::post('/update_module', 'backend\theme\clasic\module\ModuleController@update')->name('update_module');

    Route::get('/module_delete/{id}', 'backend\theme\clasic\module\ModuleController@delete');
    //sub module

    Route::get('/create_sub_module', 'backend\theme\clasic\module\ModuleController@create_sub_module')->name('create_sub_module');

    Route::post('/store_update_sub_module', 'backend\theme\clasic\module\ModuleController@store_update_sub_module')->name('store_update_sub_module');

    //sub sub module

    Route::get('/create_sub_sub_module', 'backend\theme\clasic\module\ModuleController@create_sub_sub_module')->name('create_sub_sub_module');

    Route::get('/sub_module_ajax/{parent_id}', 'backend\theme\clasic\module\ModuleController@subModuleAjax');

    Route::post('/store_update_sub_sub_module', 'backend\theme\clasic\module\ModuleController@store_update_sub_sub_module')->name('store_update_sub_sub_module');

    // ******************************************************* module end*****************************************************************

    // ================================================== employee leave start =========================================================//

    //leave category
    Route::get('/employee_leave', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@addLeaveApplication')->name('employee_leave');
    Route::get('/leave_Category_with_days', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@leaveCategoryWithDays')->name('leave_Category_with_days');
    Route::post('/insertAndUpdateLeaveCategory', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@insertAndUpdateLeaveCategory')->name('insertAndUpdateLeaveCategory');
    Route::get('/delete-leave-category/{categoryId}', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@leaveCategoryDelete');

    // leave application
    Route::post('/leave_application_store', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@leave_application_store')->name('leave_application_store');
    Route::post('/leaveCategoryAjax', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@leaveCategoryAjax')->name('leaveCategoryAjax');
    Route::get('/apply_employee_leave', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@apply_employee_leave')->name('apply_employee_leave');
    Route::get('/print-application/{application_id}', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@applicationPrint');
    Route::get('/approve-application/{application_id}', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@approveApplication');
    Route::get('/deny-application/{application_id}', 'backend\theme\clasic\EmployeeLeave\EmployeeLeaveController@denyApplication');
});
// ================================================== employee leave end =========================================================//

//**************************************** BACKEND ROUTES END*************************************************** */

//**************************************** FRONTEND ROUTES START*************************************************** */

// ================================== home route ======================================
Route::get('/', 'frontend\theme\clasic\HomeController@index')->name('home-page');

// Route::get('/view-blog/{blog_title}', 'frontend\theme\clasic\HomeController@viewBlog')->name('view-blog');

// ================================== our blogs route ======================================
Route::get('/our-blogs', 'frontend\theme\clasic\BlogsController@index')->name('our-blogs');

Route::get('/blog-category-details/{cat_slug}', 'frontend\theme\clasic\BlogsController@catWiseBlog')->name('blog-category-details');
// ==================================  blog details route ======================================
Route::get('/our-blogs/{blog_slug}', 'frontend\theme\clasic\BlogsController@blogDetails')->name('blog-details');
//more blogs
Route::get('/blog-details/{blog_slug}/blog-details/{id}/{blog_title}', 'frontend\theme\clasic\BlogsController@moreBlogDetails')->name('more-blog-details');

// resent blog details
Route::get('/resent-blog/{blog_slug}', 'frontend\theme\clasic\BlogsController@resentblog')->name('resent-blog');
// ================================== about us route ======================================
Route::get('/about-us', 'frontend\theme\clasic\AboutUsController@index')->name('about-page');
Route::get('/members/{slug?}', 'frontend\theme\clasic\AboutUsController@SingleHrCardDetails')->name('about-details-card');
// ================================== Services route ======================================
Route::get('/what-we-do', 'frontend\theme\clasic\ServicesController@index')->name('services-page');
// ================================== contact us route ======================================
Route::get('/contact', 'frontend\theme\clasic\ContactUsController@index')->name('contact-us-page');

Route::post('/contact-us-user', 'frontend\theme\clasic\ContactUsController@contactUsStore')->name('contact-us-user');
// ================================== academic training us route ======================================
Route::get('/training', 'frontend\theme\clasic\AcademicTrainingController@index')->name('academic-training');
// ================================== academic training details route ======================================
Route::get('/training/{course_id}', 'frontend\theme\clasic\AcademicTrainingController@courseDetails')->name('course-details');
// ================================== offer route ======================================
Route::get('/offer', 'frontend\theme\clasic\Offer@index')->name('offer');

// ================================== student route ======================================

Route::get('training/{course_slug}/student-registration', 'frontend\theme\clasic\StudentController@addstudent')->name('student-registration-form');

Route::post('/store-student-form', 'frontend\theme\clasic\StudentController@storeStudnet')->name('store-student-form');

//===================================group route =============================================
Route::group(['prefix' => '/'], function () {
    // Route::get('/home', 'frontend\theme\clasic\FrontendController@index')->name('home');
});

// ************************************************** talent hunt start *************************************************
Route::get('/talent-hunt', 'frontend\theme\clasic\TalentHuntControllerFrontend@index')->name('talent-hunt');
// ************************************************** talent hunt end *************************************************


// ************************************************** test start *************************************************

Route::get('/test_pages', 'backend\theme\clasic\test\TestController@test')->name('test_pages');

Route::get('/sorting', 'backend\theme\clasic\test\TestController@sortingdata')->name('test-sorting');

Route::post('/text_sorting', 'backend\theme\clasic\test\TestController@text_sorting')->name('text_sorting');

// text excel

Route::get('/excel', 'backend\theme\clasic\test\TestController@excel')->name('excel');

Route::get('/export', 'backend\theme\clasic\test\TestController@export')->name('export');

Route::post('/import', 'backend\theme\clasic\test\TestController@import')->name('import');

Route::get('/free-templete', 'backend\theme\clasic\test\TestController@freeTemplete')->name('free-templete');
// data excel

Route::get('/excel-data', 'ExcelDataCotroller@excel')->name('excel-data');

Route::get('/export-data/{id}', 'ExcelDataCotroller@export');

Route::post('/import-data', 'ExcelDataCotroller@import')->name('import-data');

// ************************************************** test end *************************************************
