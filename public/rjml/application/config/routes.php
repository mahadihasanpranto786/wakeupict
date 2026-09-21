<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['dashboard'] = 'welcome/index';

// User Access
$route['login'] = 'authority/Login/index';
$route['logout'] = 'authority/Login/user_logout';

$route['forgot_password'] = 'authority/Login/forgot_password';
$route['forgot_password_request'] = 'authority/Login/forgot_password_request';



$route['404_override'] = '';
$route['translate_uri_dashes'] = false;


//Administration Access 1
$route['administration'] = 'authority/Administration/index';

//Operator Access 10
$route['operator'] = 'authority/Operator/index';

//Security_head Access 101
$route['security_head'] = 'authority/Security_head/index';

//security_operator Access 102
$route['security_operator'] = 'authority/Security_operator/index';

//weight_head Access 201
$route['weight_head'] = 'authority/Weight_head/index';

//weight_operator Access 202
$route['weight_operator'] = 'authority/Weight_operator/index';

//jute_head Access 301
$route['jute_head'] = 'authority/Jute_head/index';

//jute_operator Access 302
$route['jute_operator'] = 'authority/Jute_operator/index';

//Accounts_head Access 401
$route['accounts_head'] = 'authority/Accounts_head/index';

//Accounts_operator Access 402
$route['accounts_operator'] = 'authority/Accounts_operator/index';

//Production_head Access 501
$route['production_head'] = 'authority/Production_head/index';

//Production_operator Access 502
$route['production_operator'] = 'authority/Production_operator/index';

//Gm Access 601
$route['gm'] = 'authority/Gm/index';

//shareholder Access 602
$route['shareholder'] = 'authority/Shareholder/index';

//System_administrator Access 602
$route['system_administrator'] = 'authority/System_administrator/index';

//System_administrator Access 701
$route['store_head'] = 'authority/Store_head/index';

//System_administrator Access 702
$route['store_operator'] = 'authority/Store_operator/index';


//Area
$route['add_area'] = 'setup/Area/addArea';
$route['insert_area'] = 'setup/Area/insertArea';
$route['update_area'] = 'setup/Area/updateArea';

//Mokam
$route['add_mokam'] = 'setup/Mokam/addMokam';
$route['insert_mokam'] = 'setup/Mokam/insertMokam';
$route['update_mokam'] = 'setup/Mokam/updateMokam';

//supplier Type
$route['supplier_type'] = 'setup/Supplier/supplierType';
$route['insert_supplier_type'] = 'setup/Supplier/insertSupplierType';

//supplier
$route['add_supplier'] = 'setup/Supplier/addSupplier';
$route['insert_supplier'] = 'setup/Supplier/insertSupplier';
$route['list_supplier'] = 'setup/Supplier/listSupplier';
$route['update_supplier'] = 'setup/Supplier/updateSupplier';

//Jute Supplier Payment
$route['insert_supplier_payment'] = 'setup/Supplier/insertSupplierPayment';
$route['update_supplier_payment'] = 'setup/Supplier/updateSupplierPayment';
$route['jute_supplier_report'] = 'setup/Supplier/juteSupplierReport';
$route['view_supplier_wise_payment'] = 'setup/Supplier/viewSupplierWisePayment';
$route['insert_approx_supplier_payment'] = 'setup/Supplier/insertApproxSupplierPayment';
$route['list_approx_supplier_payment'] = 'setup/Supplier/juteSupplierPaymentCalculator';

//multi
$route['add_multi_payment'] = 'setup/Supplier/addMultiPayment';
$route['insert_multi_payment'] = 'setup/Supplier/insertMultiSupplierPayment';
$route['daily_payment_report'] = 'setup/Supplier/dailyPaymentReport';


//Grade
$route['add_jute_grade'] = 'setup/Grade/addJuteGrade';
$route['insert_jute_grade'] = 'setup/Grade/insertJuteGrade';

//Jute_rate
$route['add_jute_rate'] = 'setup/Jute_rate/addJuteRate';
$route['insert_jute_rate'] = 'setup/Jute_rate/insertJuteRate';

$route['list_jute_rate'] = 'setup/Jute_rate/listJuteRate';
//$route['view_jute_rate'] = '';


// Adjustment
$route['add_adjustment'] = 'setup/Adjustment/addAdjustment';
$route['list_adjustment'] = 'setup/Adjustment/listAdjustment';
$route['insert_adjustment'] = 'setup/Adjustment/insertAdjustment';
$route['update_adjustment'] = 'setup/Adjustment/updateAdjustment';

// Bank
$route['add_bank'] = 'setup/Bank/addBank';
$route['insert_bank'] = 'setup/Bank/insertBank';
$route['update_bank'] = 'setup/Bank/updateBank';

$route['add_bank_branch'] = 'setup/Bank/addBankBranch';
$route['insert_bank_branch'] = 'setup/Bank/insertBankBranch';
$route['update_bank_branch'] = 'setup/Bank/updateBankBranch';

$route['add_bank_account_info'] = 'setup/Bank/addBankAccountInfo';
$route['insert_bank_account_info'] = 'setup/Bank/insertBankAccountInfo';
$route['list_bank_account_info'] = 'setup/Bank/listBankAccountInfo';

$route['add_bank_deposit'] = 'setup/Bank/addBankDeposit';
$route['insert_bank_deposit'] = 'setup/Bank/insertBankDeposit';
$route['insert_bank_withdraw_balance'] = 'setup/Bank/insertBankWithdrawBalance';





// Monthly Reports
$route['monthly_jute_sale_report'] = 'setup/Jute_report/monthlyJuteSaleReport';
$route['monthly_jute_purchase_report'] = 'setup/Jute_report/monthlyJutePurchaseReport';
$route['monthly_jute_issue_report'] = 'setup/Jute_report/monthlyJuteIssueReport';
$route['monthly_jute_purchase_payment_report'] = 'setup/Jute_report/monthlyJutePurchasePaymentReport';
$route['monthly_jute_sale_payment_report'] = 'setup/Jute_report/monthlyJuteSalePaymentReport';


$route['add_jute_stock_alert_quantity'] = 'setup/Jute_report/addJuteStockAlertQuantity';
$route['update_jute_stock_alert_quantity'] = 'setup/Jute_report/updateJuteStockAlertQuantity';




$route['list_jute_purchase_order'] = 'setup/Purchase/listPurchaseOrder';
$route['add_jute_purchase_order'] = 'setup/Purchase/addPurchaseOrder';
$route['update_jute_purchase_order'] = 'setup/Purchase/updatePurchaseOrder';
$route['insert_purchase_order'] = 'setup/Purchase/insertPurchaseOrder';
$route['view_purchase_order'] = 'setup/Purchase/viewPurchaseOrder';




/* ================ For operator routes ================ */
//Entry
$route['add_entry'] = 'jute/Entry/addEntry';
$route['list_jute_entry'] = 'jute/Entry/listJuteEntry';
$route['list_jute_entry/:num'] = 'jute/Entry/listJuteEntry';
$route['update_jute_entry'] = 'jute/Entry/updateJuteEntry';


$route['list_jute_return_info'] = 'jute/Entry/listJuteReturnInfo';
$route['insert_jute_return_info'] = 'jute/Entry/insertJuteReturnInfo';

$route['add_out_turn_report'] = 'jute/Entry/addOutTurnReport';
$route['list_out_turn_report'] = 'jute/Entry/listOutTurnReport';
$route['list_monthly_out_turn_report'] = 'jute/Entry/listMonthlyOutTurnReport';
$route['update_out_turn_report'] = 'jute/Entry/updateOutTurnReport';
$route['add_invoice'] = 'jute/Entry/AddInvoice';
$route['list_purchase'] = 'jute/Entry/listPurchase';
$route['list_new_purchase'] = 'jute/Entry/listNewPurchase';
$route['list_coming_purchase'] = 'jute/Entry/listComingPurchase';
$route['list_processing_purchase'] = 'jute/Entry/listProcessingPurchase';
$route['list_returned_purchase'] = 'jute/Entry/listReturnedPurchase';
$route['list_approved_purchase'] = 'jute/Entry/listApprovedPurchase';
$route['view_invoice'] = 'jute/Entry/viewPurchaseInvoice';
$route['supplier_report'] = 'jute/Entry/supplierReport';

$route['list_mismatch_area'] = 'jute/Entry/listMismatchArea';
$route['entryChalanCount'] = 'jute/Entry/entryChalanCount';


//
$route['approved_bill_returned'] = 'jute/Entry/approvedBillReturn';

//Godown
$route['add_godown'] = 'jute/Godown/addGodown';
$route['insert_godown'] = 'jute/Godown/insertGodown';
$route['update_godown'] = 'jute/Godown/updateGodown';
$route['godown_reports_old'] = 'jute/Godown/godownReportsOld';
$route['godown_reports'] = 'jute/Godown/godownReports';
$route['factory_reports'] = 'jute/Godown/factoryReports';

// Jute Calculation Helper
$route['add_jute_calculation_helper'] = 'jute/Godown/addJuteCalculationHelper';
$route['insert_jute_calculation_helper'] = 'jute/Godown/insertJuteCalculationHelper';
$route['update_jute_calculation_helper'] = 'jute/Godown/updateJuteCalculationHelper';

//Khamal
$route['add_khamal'] = 'jute/Khamal/addKhamal';
$route['insert_khamal'] = 'jute/Khamal/insertKhamal';
$route['update_khamal'] = 'jute/Khamal/updateKhamal';
$route['delete_khamal'] = 'jute/khamal/deleteKhamal';

$route['khamal_final_stock_old'] = 'jute/Khamal/khamalFinalStockOld';
$route['khamal_final_stock'] = 'jute/Khamal/khamalFinalStock';

$route['daily_jute_khamal_report'] = 'jute/Khamal/dailyJuteKhamalReport';

// UnAssorted Added
$route['add_unassorted_added'] = 'jute/Khamal/addUnAssortedAdded';
$route['insert_unassorted_added'] = 'jute/Khamal/insertUnAssortedAdded';
$route['list_unassorted_added'] = 'jute/Khamal/listUnAssortedAdded';
$route['update_unassorted_added'] = 'jute/Khamal/updateUnAssortedAdded';

$route['list_unassorted_out_turn_report'] = 'jute/Khamal/listUnassortedOutTurnReport';
$route['list_unassorted_out_turn_report/:num'] = 'jute/Khamal/listUnassortedOutTurnReport';
// UnAssorted Deduction
$route['add_unassorted_deduction'] = 'jute/Khamal/addUnAssortedDeduction';
$route['insert_unassorted_deduction'] = 'jute/Khamal/insertUnAssortedDeduction';
$route['list_unassorted_deduction'] = 'jute/Khamal/listUnAssortedDeduction';
$route['update_unassorted_deduction'] = 'jute/Khamal/updateUnAssortedDeduction';
// Assorted Uncut Added
$route['add_assorted_uncut_added'] = 'jute/Khamal/addAssortedUncutAdded';
$route['insert_assorted_uncut_added'] = 'jute/Khamal/insertAssortedUncutAdded';
$route['list_assorted_uncut_added'] = 'jute/Khamal/listAssortedUncutAdded';
$route['update_assorted_uncut_added'] = 'jute/Khamal/updateAssortedUncutAdded';
// Assorted Uncut Deduction
$route['add_assorted_uncut_deduction'] = 'jute/Khamal/addAssortedUncutDeduction';
$route['insert_assorted_uncut_deduction'] = 'jute/Khamal/insertAssortedUncutDeduction';
$route['list_assorted_uncut_deduction'] = 'jute/Khamal/listAssortedUncutDeduction';
$route['update_assorted_uncut_deduction'] = 'jute/Khamal/updateAssortedUncutDeduction';
// Assorted Cut Added
$route['add_assorted_cut_added'] = 'jute/Khamal/addAssortedCutAdded';
$route['insert_assorted_cut_added'] = 'jute/Khamal/insertAssortedCutAdded';
$route['list_assorted_cut_added'] = 'jute/Khamal/listAssortedCutAdded';
$route['update_assorted_cut_added'] = 'jute/Khamal/updateAssortedCutAdded';
// Assorted Cut Deduction
$route['add_assorted_cut_deduction'] = 'jute/Khamal/addAssortedCutDeduction';
$route['insert_assorted_cut_deduction'] = 'jute/Khamal/insertAssortedCutDeduction';
$route['list_assorted_cut_deduction'] = 'jute/Khamal/listAssortedCutDeduction';
$route['update_assorted_cut_deduction'] = 'jute/Khamal/updateAssortedCutDeduction';
// Khamal Opening
$route['add_opening_khamal'] = 'jute/Khamal/addOpeningKhamal';
$route['list_opening_khamal'] = 'jute/Khamal/listOpeningKhamal';
$route['insert_opening_khamal'] = 'jute/Khamal/insertOpeningKhamal';
$route['update_opening_khamal'] = 'jute/Khamal/updateOpeningKhamal';
// Khamal Running Stock
$route['add_khamal_running_stock'] = 'jute/Khamal/addKhamalRunningStock';
$route['list_khamal_running_stock'] = 'jute/Khamal/listKhamalRunningStock';
$route['insert_khamal_running_stock'] = 'jute/Khamal/insertKhamalRunningStock';
$route['update_khamal_running_stock'] = 'jute/Khamal/updateKhamalRunningStock';

//Daily Issue
$route['add_daily_issue'] = 'jute/Daily_issue/addDailyIssue';
$route['insert_daily_issue'] = 'jute/Daily_issue/insertDailyJuteIssue';
$route['list_daily_issue'] = 'jute/Daily_issue/listDailyIssue';
$route['view_daily_issue'] = 'jute/Daily_issue/viewDailyIssue';
$route['add_daily_requisition'] = 'jute/Daily_issue/addDailyRequisition';
$route['insert_daily_requisition'] = 'jute/Daily_issue/insertDailyRequisition';
$route['list_daily_requisition'] = 'jute/Daily_issue/listDailyRequisition';
$route['view_daily_requisition'] = 'jute/Daily_issue/viewDailyRequisition';
$route['list_add_new_daily_issue'] = 'jute/Daily_issue/listAddNewDailyIssue';
$route['update_daily_requisition'] = 'jute/Daily_issue/updateDailyRequisition';
$route['update_daily_issue'] = 'jute/Daily_issue/updateDailyIssue';

$route['view_daily_requisition_issue'] = 'jute/Daily_issue/viewDailyRequisitionIssue';
$route['total_issued_quantity'] = 'jute/Daily_issue/totalIssuedQuantity';

//Production Unit
$route['add_production_unit'] = 'jute/Production_unit/addProductionUnit';
$route['insert_production_unit'] = 'jute/Production_unit/insertProductionUnit';
$route['update_production_unit'] = 'jute/Production_unit/updateProductionUnit';
// Assorted
$route['add_assorted'] = 'jute/Assorted/addAssorted';
$route['list_assorted'] = 'jute/Assorted/listAssorted';

$route['add_opening_jute'] = 'jute/Opening_jute/addOpeningJute';
$route['insert_opening_jute'] = 'jute/Opening_jute/insertOpeningJute';
$route['list_opening_jute'] = 'jute/Opening_jute/listOpeningJute';
$route['update_opening_jute'] = 'jute/Opening_jute/updateOpeningJute';
//Financial Year
$route['add_financial_year'] = 'jute/Financial_year/addFinancialYear';
$route['insert_financial_year'] = 'jute/Financial_year/insertFinancialYear';
$route['update_financial_year'] = 'jute/Financial_year/updateFinancialYear';
//Labour
$route['add_labour'] = 'jute/Labour/addLabour';
$route['insert_labour'] = 'jute/Labour/insertLabour';
$route['update_labour'] = 'jute/Labour/updateLabour';
$route['list_labour'] = 'jute/Labour/listLabour';
$route['edit_labour'] = 'jute/Labour/editLabour';
$route['view_labour'] = 'jute/Labour/viewLabour';
//Labour -> Attendance
$route['add_labour_attendance'] = 'jute/Labour/addLabourAttendance';
$route['insert_labour_attendance'] = 'jute/Labour/insertLabourAttendance';
$route['list_labour_attendance'] = 'jute/Labour/listLabourAttendance';
$route['searchByDate'] = 'jute/Labour/searchByDate';
//Labour -> Rate Per Work
$route['add_labour_hourly_rate'] = 'jute/Labour/addHourlyRate';
$route['insert_labour_hourly_rate'] = 'jute/Labour/insertHourlyRate';
$route['update_labour_hourly_rate'] = 'jute/Labour/updateHourlyRate';
//Labour -> Labour Bonus
$route['add_labour_bonus'] = 'jute/Labour/addLabourBonus';
$route['insert_labour_bonus'] = 'jute/Labour/insertLabourBonus';
$route['update_labour_bonus'] = 'jute/Labour/updateLabourBonus';
//Labour-> Designation
$route['add_labour_designation'] = 'jute/Labour/addLabourDesignation';
$route['insert_labour_designation'] = 'jute/Labour/insertLabourDesignation';
$route['update_labour_designation'] = 'jute/Labour/updateLabourDesignation';
//Labour-> Jute Processing Category
$route['add_jute_processing_category'] = 'jute/Labour/addJuteProcessingCategory';
$route['insert_jute_processing_category'] = 'jute/Labour/insertJuteProcessingCategory';
$route['update_jute_processing_category'] = 'jute/Labour/updateJuteProcessingCategory';
$route['add_jute_processing_subcategory'] = 'jute/Labour/addJuteProcessingSubCategory';
$route['add_jute_processing_sub_category'] = 'jute/Labour/insertJuteProcessingSubCategory';
$route['update_jute_processing_sub_category'] = 'jute/Labour/updateJuteProcessingSubCategory';
//Department
$route['add_department'] = 'jute/Department/addDepartment';
$route['insert_department'] = 'jute/Department/insertDepartment';
$route['update_department'] = 'jute/Department/updateDepartment';
$route['add_sub_department'] = 'jute/Department/addSubDepartment';
$route['insert_sub_department'] = 'jute/Department/insertSubDepartment';
$route['update_sub_department'] = 'jute/Department/updateSubDepartment';

/* ============= Client->client type ============= */
$route['client_type'] = 'setup/Client/clientType';
$route['insert_client_type'] = 'setup/Client/insertClientType';
$route['update_client_type'] = 'setup/Client/updateClientType';
// Client->clients 
$route['add_client'] = 'setup/Client/addClient';
$route['insert_client'] = 'setup/Client/insertClient';
$route['update_client'] = 'setup/Client/updateClient';
$route['delete_client'] = 'setup/Client/deleteClient';


$route['jute_client_report'] = 'setup/Client/juteClientReport';
$route['insert_client_payment'] = 'setup/Client/insertClientPayment';
$route['list_all_payment'] = 'setup/Client/listAllPayment';
$route['update_client_payment'] = 'setup/Client/updateClientPayment';
$route['jute_client_wise_payment'] = 'setup/Client/juteClientWisePayment';



$route['add_jute_sell'] = 'setup/Client/addJuteSell';
$route['list_jute_sell'] = 'setup/Client/listJuteSell';
$route['insert_jute_sell'] = 'setup/Client/insertJuteSell';
$route['update_jute_sell'] = 'setup/Client/updateJuteSell';

$route['total_jute_sale_quantity'] = 'setup/Client/totalJuteSaleQuantity';





/* ================ For System Administrator routes ================ */
//User
$route['add_new_user'] = 'setup/User_control/addNewUser';
$route['insert_user'] = 'setup/User_control/insertUser';
$route['update_user'] = 'setup/User_control/updateUser';
$route['delete_user'] = 'setup/User_control/deleteUser';
$route['inactive_user'] = 'setup/User_control/inactiveUser';
$route['active_user'] = 'setup/User_control/activeUser';

// Forgot Password form
$route['add_forgot_password_request'] = 'setup/User_control/addForgotPasswordView';
$route['approve_forgot_password_request'] = 'setup/User_control/approveForgotPasswordRequest';


// User profile
$route['add_user_profile'] = 'setup/User_control/addUserProfile';
$route['update_user_profile_information'] = 'setup/User_control/updateUserProfileInformation';
$route['update_user_profile_password'] = 'setup/User_control/updateUserProfilePassword';

// Invoice Approval setup 
$route['add_invoice_approval'] = 'setup/User_control/addJutePurchaseInvoiceApproval';
$route['insert_jute_purchase_invoice_approval'] = 'setup/User_control/insertJutePurchaseInvoiceApproval';
$route['update_jute_purchase_invoice_approval'] = 'setup/User_control/updateJutePurchaseInvoiceApproval';
$route['delete_jute_purchase_invoice_approval'] = 'setup/User_control/deleteJutePurchaseInvoiceApproval';

// Invoice approval return 
$route['insert_jute_purchase_invoice_approval_return'] = 'jute/Entry/insertJutePurchaseInvoiceApprovalReturn';
