<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
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

// cache clearer
Route::get('/clear-cache', function() {
        $run = Artisan::call('config:clear');
        $run = Artisan::call('cache:clear');
        $run = Artisan::call('config:cache');
        $run =  Artisan::call('view:clear');
        // $run =  Artisan::call('route:cache');
        
        // $run = Artisan::call('storage:link');
        return 'FINISHED';  
    });


// mail tester

// Route::get('/mail', function () {

//  $data =['name' => 'sheriff', 'email' => 'jimohsherifdeen6@gmail.com'];

//   Mail::raw('New Account confirmation email', function($message) use($data)
// {
//   $message->subject('Mailgun and Laravel new!');
// //   $message->from('contact@tomxinvest.com', 'Tomxcredit');
//   $message->to('jimohsherifdeen6@gmail.com');
// });



// });

// Route::get('/', function () {
//     return view('website.index');
// });
Route::view('/projects','website.slatefile');

Route::get('/investment', function () {
    return view('website.investment_register');
});

Route::get('/contact', function () {
    return view('website.contact');
});

Route::get('/about', function () {
    return view('website.about');
});

Auth::routes();

Route::get('/faq', function () {
    return view('website.faq');
});
Route::get('/warning', function () {
    return view('website.dev-mode');
});

Route::get('/unknown', function () {
    return view('website.error404');
});

Route::get('/terms-condition', function () {
    return view('website.terms-condition');
}); 



Route::get('/', function () {

     $date = date('Y-m-d');
     $datecheck = date('Y-m-d', strtotime('+10 day'));
     if ($date == $datecheck || $date >  $datecheck ) {

      return redirect('/warning');

     }else{
       return view('website.index');
     }

    });

Route::post('/contactForm','MainController@contactForm');

Route::post('/registrations/create_investment','RegistrationController@create_investment');

Route::resource('registrations','RegistrationController');

Route::get('/verify_user/{key}', 'MainController@verify_user');

Route::get('/get_document_pdf/{key}', "MainController@get_pdf");
 
Route::group(['middleware'=>'CustomAuth'], function () {






 Route::get('/mandate_setup','MainController@mandate_setup');
Route::get('/admin','MainController@admin');
Route::get('/admin/{key}','MainController@admin');
Route::get('/guess','MainController@guess');
Route::get('/investor','MainController@guess');
Route::get('/guess/{key}','MainController@guess');
Route::get('/investor/{key}','MainController@guess');
Route::get('/authorized', 'MainController@Authorized');

Route::get('/create_admin/','MainController@create_admin');
Route::post('/create_new_admin','MainController@create_new_admin');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user_preview/{key}', 'MainController@user_preview');

Route::get('/new_customers', 'MainController@new_customers');
Route::post('/addfund', 'MainController@addfund');


Route::get('/loan-list','MainController@loanlist');



 
Route::get('/continue','MainController@continue_registration' );
Route::get('/documents','MainController@continue_registration' );
Route::post('/updatedocuments','MainController@updatecustomerdocument');
Route::get('/mywallet','MainController@user_wallet');
Route::post('/withdraw','MainController@withdraw');
Route::post('/update_personal_info', 'MainController@update_personal_info');
Route::get('/user_profile', 'MainController@user_profile');
Route::post('/update_user_profile', 'MainController@update_user_profile');
Route::get('/verify_payment/{key}','MainController@verify_payment');
Route::post('/updateprofile_pic', 'MainController@updateprofile_pic');
Route::get('/manage_account', 'MainController@manage_account');
Route::get('/activate_customer/{key}','MainController@activate_customer');

Route::get('/activate_admin/{key}','MainController@activate_admin');


 Route::get('/test', 'MainController@test');
Route::get('/user-view/{key}','MainController@user_view' );
Route::get('/all_customer/','MainController@allcustomer' );
Route::get('/transaction_logs/','MainController@transaction_logs' );


// Loans

Route::get('/repay_single_overdue/{key}','LoanController@mark_repayment_overdue_single');
Route::get('/repay_day/','LoanController@daily_loan_repayment' );
Route::get('/overdue/','LoanController@overdue_repayment' );
Route::get('/loan-list','LoanController@loanlist');
Route::post('/loan_process', 'LoanController@loan_process');
Route::get('/loan-application','LoanController@loan_application' );
Route::get('/loan-disburst','LoanController@loan_disburst' );
Route::get('/loan-review','LoanController@loan_review' );
Route::get('/loan-reject','LoanController@loan_reject' );
Route::get('/loan-matured','LoanController@loan_matured' );
Route::get('/loanreview-preview/{key}','LoanController@loanreview_preview' );
Route::get('/loan-wallet', 'LoanController@loan_wallets');
Route::get('/markall', 'LoanController@markall');
Route::get('/markrepayment/{key}','LoanController@mark_repayment' );
Route::get('/markall_overdue', 'LoanController@markall_overdue');

// User Loans

Route::get('/user_loans','LoanController@user_loans');
Route::get('/myloan_information', 'LoanController@user_loan_information');
Route::get('/user_loans_repayments','LoanController@user_loans_repayments');
Route::get('/user_loans_rejected','LoanController@user_loans_rejected');
Route::get('/user_loans_review','LoanController@user_loans_reviews');
Route::get('/user_transaction_logs','LoanController@user_transaction_log');
Route::get('/user_loan_review_agreed/{key}', 'LoanController@user_loan_review_agreed');
Route::get('/user_loan_review_disagreed/{key}', 'LoanController@user_loan_review_disagreed');
Route::get('/user_manual_repayments', 'LoanController@user_manual_repayment');
Route::get('/new_loan_application', 'LoanController@new_loan_application_form');
Route::post('/loan_request', 'LoanController@loan_request');




// Investment


Route::get('/investment_customers', 'MainController@investment_customers');
Route::get('/investment-applications','InvestmentController@investment_application');
Route::get('/mark_investment/{key}','InvestmentController@investment_application_mark');
Route::get('/reject_investment/{key}','InvestmentController@investment_application_reject');
Route::get('/delete_investment/{key}','DeleteController@investment_application_delete');
Route::get('/investment-porfolio', 'InvestmentController@investment_portfolio');
Route::get('/investment-rejected', 'InvestmentController@investment_rejected');
Route::get('/investment-records', 'InvestmentController@investment_record');
Route::get('/investment-matured', 'InvestmentController@investment_matured');
Route::get('/investment-wallet', 'InvestmentController@investment_wallet');
Route::get('/user-view-investment/{key}','MainController@user_view_investment' );


// User Investment

Route::get('/new_investment_application','InvestmentController@application_form' );
Route::post('/create_new_investment_application/','InvestmentController@application_create' );
Route::get('/portfolios','InvestmentController@portfolio' );
Route::get('/matured','InvestmentController@matured' );
Route::get('/rejected','InvestmentController@rejected' );
Route::get('/transactions','InvestmentController@transaction' );
Route::get('/wallet','InvestmentController@wallet' );
Route::get('/bank_information','InvestmentController@bank_information' );

Route::get('/inv-repay', 'InvestmentController@investment_repayment');

// RCP_bgx5xoqot7luss2


// Detete records
Route::get('/deletecustomer/{key}', 'DeleteController@delete_customer');
Route::get('/deleteloan/{key}', 'DeleteController@delete_loan');
Route::get('/deletewallet/{key}', 'DeleteController@delete_wallet');
Route::get('/deletetransact/{key}', 'DeleteController@delete_transact');
Route::get('/delete_admin_account/{key}', 'DeleteController@delete_admin_account');
Route::get('/delete_user_account/{key}', 'DeleteController@delete_user_account');

});