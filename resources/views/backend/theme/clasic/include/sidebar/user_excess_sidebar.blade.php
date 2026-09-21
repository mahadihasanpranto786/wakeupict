<!-- Main Sidebar Container -->
<aside id='sidebar_color' class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <h3 class="p-1 text-center text-white">WAKE UP ICT</h3>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @php
                    
                    //parent start
                    $dashboard = 0;
                    $Accounts = 0;
                    $Appearance = 0;
                    $Students = 0;
                    $Users_Or_Employees = 0;
                    //parent end
                    //invest start
                    $Invest = 0;
                    $Investor = 0;
                    $Investor_Type = 0;
                    $Investment = 0;
                    //invest end
                    //asset start
                    $Assets = 0;
                    $Asset_Type = 0;
                    $Add_Asset = 0;
                    $Assets_List = 0;
                    //asset end
                    //loan start
                    $Loan = 0;
                    $Add_Loan = 0;
                    $Loans_List = 0;
                    //loan end
                    //category start
                    $Accounts_Categories = 0;
                    //category end
                    //payroll start
                    $Payroll = 0;
                    $Employee_Salaries = 0;
                    $Payrolls_List = 0;
                    $Add_Payroll = 0;
                    // payroll end
                    //expense start
                    $Expense = 0;
                    $Expenses_List = 0;
                    $Add_Expense = 0;
                    $Multiple_Expenses_List = 0;
                    $Add_Multiple_Expense = 0;
                    //expense end
                    
                    //income start
                    $Income = 0;
                    $Incomes_List = 0;
                    $Add_Income = 0;
                    //income end
                    //monthly sheet start
                    $Monthly_Sheet = 0;
                    // monthly sheet end
                    //current month summary start
                    $current_month_summary = 0;
                    //current month summary end
                    //cash in hand start
                    $Cash_In_Hand = 0;
                    //cash in hand end
                    
                    //font awesome start
                    $Font_awesome = 0;
                    //font awesome end
                    
                    //home page start
                    $Home_Page = 0;
                    $Sliders_List = 0;
                    $Development_Project_List = 0;
                    $International_Work = 0;
                    $Local_Projects = 0;
                    $Footer = 0;
                    //home page end
                    
                    // about us page start
                    $About_Us_Page = 0;
                    $About_Page_Banner = 0;
                    $About_Page_History = 0;
                    $About_Hr_Cards = 0;
                    // about us page end
                    
                    //service page start
                    $Service_Page = 0;
                    $Service_Banner = 0;
                    $Add_Service = 0;
                    $Service_List = 0;
                    //service page end
                    
                    // user contact start
                    $User_Contact = 0;
                    // user contact end
                    
                    //SEO pages start
                    $SEO_Pages = 0;
                    //SEO Pages end
                    
                    //course start
                    $Course = 0;
                    $Course_Banner = 0;
                    $Create_Course = 0;
                    $Courses_List = 0;
                    //course end
                    
                    //blog start
                    $Blog = 0;
                    $Blog_Categories = 0;
                    $Create_Blog = 0;
                    $Blog_List = 0;
                    //blog end
                    
                    //student start
                    $Batch_Number = 0;
                    $Students_List = 0;
                    $Admitted_Students_List = 0;
                    //student end
                    
                    //user or employee start
                    $Designation = 0;
                    $Users_Or_Employees_List = 0;
                    //user or employee end
                    foreach (userRolls() as $roll) {
                        //parent start
                        if ($roll->module_id == 1) {
                            $dashboard = 1;
                        } elseif ($roll->module_id == 2) {
                            $Accounts = 2;
                        } elseif ($roll->module_id == 29) {
                            $Appearance = 29;
                        } elseif ($roll->module_id == 55) {
                            $Students = 55;
                        } elseif ($roll->module_id == 59) {
                            $Users_Or_Employees = 59;
                        }
                        // parent end
                        //&************* account ***********
                        // invest start
                        elseif ($roll->module_id == 3) {
                            $Invest = 3;
                        } elseif ($roll->module_id == 4) {
                            $Investor = 4;
                        } elseif ($roll->module_id == 5) {
                            $Investor_Type = 5;
                        } elseif ($roll->module_id == 6) {
                            $Investment = 6;
                        }
                    
                        // invest end
                        //asset start
                        elseif ($roll->module_id == 7) {
                            $Assets = 7;
                        } elseif ($roll->module_id == 8) {
                            $Asset_Type = 8;
                        } elseif ($roll->module_id == 9) {
                            $Add_Asset = 9;
                        } elseif ($roll->module_id == 10) {
                            $Assets_List = 10;
                        }
                        //asset end
                        //loan start
                        elseif ($roll->module_id == 11) {
                            $Loan = 11;
                        } elseif ($roll->module_id == 12) {
                            $Add_Loan = 12;
                        } elseif ($roll->module_id == 13) {
                            $Loans_List = 13;
                        }
                        //loan end
                        //category start
                        elseif ($roll->module_id == 14) {
                            $Accounts_Categories = 14;
                        }
                        //category end
                        // Payroll start
                        elseif ($roll->module_id == 15) {
                            $Payroll = 15;
                        } elseif ($roll->module_id == 16) {
                            $Employee_Salaries = 16;
                        } elseif ($roll->module_id == 17) {
                            $Payrolls_List = 17;
                        } elseif ($roll->module_id == 18) {
                            $Add_Payroll = 18;
                        }
                    
                        //payroll end
                        //Expense start
                        elseif ($roll->module_id == 19) {
                            $Expense = 19;
                        } elseif ($roll->module_id == 20) {
                            $Expenses_List = 20;
                        } elseif ($roll->module_id == 21) {
                            $Add_Expense = 21;
                        } elseif ($roll->module_id == 22) {
                            $Multiple_Expenses_List = 22;
                        } elseif ($roll->module_id == 23) {
                            $Add_Multiple_Expense = 23;
                        }
                        //Expense end
                        //Income start
                        elseif ($roll->module_id == 24) {
                            $Income = 24;
                        } elseif ($roll->module_id == 25) {
                            $Incomes_List = 25;
                        } elseif ($roll->module_id == 26) {
                            $Add_Income = 26;
                        }
                        // Income end
                        //monthly sheet start
                        elseif ($roll->module_id == 27) {
                            $Monthly_Sheet = 27;
                        }
                        // monthly sheet end
                        // current month  summary start
                        elseif ($roll->module_id == 72) {
                            $current_month_summary = 72;
                        }
                        // current  month summary end
                        //cash in hand start
                        elseif ($roll->module_id == 28) {
                            $Cash_In_Hand = 28;
                        }
                        //cash in hand end
                        //font awesome start
                        elseif ($roll->module_id == 30) {
                            $Font_awesome = 30;
                        }
                        //font awesome end
                        //home page start
                        elseif ($roll->module_id == 31) {
                            $Home_Page = 31;
                        } elseif ($roll->module_id == 32) {
                            $Sliders_List = 32;
                        } elseif ($roll->module_id == 33) {
                            $Development_Project_List = 33;
                        } elseif ($roll->module_id == 34) {
                            $International_Work = 34;
                        } elseif ($roll->module_id == 35) {
                            $Local_Projects = 35;
                        } elseif ($roll->module_id == 36) {
                            $Footer = 36;
                        }
                        //home page end
                        //about us page start
                        elseif ($roll->module_id == 37) {
                            $About_Us_Page = 37;
                        } elseif ($roll->module_id == 38) {
                            $About_Page_Banner = 38;
                        } elseif ($roll->module_id == 39) {
                            $About_Page_History = 39;
                        } elseif ($roll->module_id == 40) {
                            $About_Hr_Cards = 40;
                        }
                        //about us page end
                        // service start
                        elseif ($roll->module_id == 41) {
                            $Service_Page = 41;
                        } elseif ($roll->module_id == 42) {
                            $Service_Banner = 42;
                        } elseif ($roll->module_id == 43) {
                            $Add_Service = 43;
                        } elseif ($roll->module_id == 44) {
                            $Service_List = 44;
                        }
                    
                        //service end
                        // user contact start
                        elseif ($roll->module_id == 45) {
                            $User_Contact = 45;
                        }
                        //user contact end
                        //SEO pages start
                        elseif ($roll->module_id == 46) {
                            $SEO_Pages = 46;
                        }
                        //SEO Pages end
                        // course start
                        elseif ($roll->module_id == 47) {
                            $Course = 47;
                        } elseif ($roll->module_id == 48) {
                            $Course_Banner = 48;
                        } elseif ($roll->module_id == 49) {
                            $Create_Course = 49;
                        } elseif ($roll->module_id == 50) {
                            $Courses_List = 50;
                        }
                        //course end
                        //blog start
                        elseif ($roll->module_id == 51) {
                            $Blog = 51;
                        } elseif ($roll->module_id == 52) {
                            $Blog_Categories = 52;
                        } elseif ($roll->module_id == 53) {
                            $Create_Blog = 53;
                        } elseif ($roll->module_id == 54) {
                            $Blog_List = 54;
                        }
                    
                        //blog end
                        //student start
                        elseif ($roll->module_id == 56) {
                            $Batch_Number = 56;
                        } elseif ($roll->module_id == 57) {
                            $Students_List = 57;
                        } elseif ($roll->module_id == 58) {
                            $Admitted_Students_List = 58;
                        }
                        // student end
                        //user or employee start
                        elseif ($roll->module_id == 60) {
                            $Designation = 60;
                        } elseif ($roll->module_id == 61) {
                            $Users_Or_Employees_List = 61;
                        }
                    
                        //user or employee end
                    }
                @endphp
                @if ($dashboard == 1)
                    <li class="nav-item has-treeview menu-open">
                        <a href="{{ route('admin') }}" class="nav-link @yield('active_dashboard')">
                            <i class="nav-icon fas fa-house-damage"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif
                @if ($Accounts == 2)
                    {{-- ****************************************** account start ************************************************ --}}

                    <li class="nav-item has-treeview @yield('account')">
                        <a href="#" class="nav-link  @yield('menu_active')">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p>
                                Accounts
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @if ($Invest == 3)
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item  @yield('Invest')">
                                    <a href="#" class="nav-link  @yield('index_investor_active')">
                                        <i class="fas fa-hand-holding-usd nav-icon"></i>
                                        <p>Invest</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    @if ($Investor == 4)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('index_investor') }}"
                                                    class="nav-link @yield('index_investor')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Investor</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Investor_Type == 5)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('index_investor_type') }}"
                                                    class="nav-link @yield('index_investor_type')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Investor Type</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Investment == 6)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('investment_list') }}"
                                                    class="nav-link @yield('investment_list')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Investment</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        @endif

                        {{-- asset start --}}
                        @if ($Assets == 7)
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item  @yield('asset')">
                                    <a href="#" class="nav-link  @yield('index_asset')">
                                        <i class="fas fa-donate nav-icon"></i>
                                        <p>Assets</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    @if ($Asset_Type == 8)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('asset_type') }}"
                                                    class="nav-link @yield('asset_type')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Type</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Add_Asset == 9)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('add_asset') }}"
                                                        class="nav-link @yield('add_asset')">
                                                        <i class="fas fa-plus nav-icon"></i>
                                                        <p>Add Asset</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                    @if ($Assets_List == 10)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('assets_list') }}"
                                                    class="nav-link @yield('assets_list')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Assets list</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                            </ul>
                        @endif



                        {{-- asset end --}}
                        {{-- loan start --}}
                        @if ($Loan == 11)
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item  @yield('loan')">
                                    <a href="#" class="nav-link  @yield('loan_active')">
                                        <i class="fas fa-landmark nav-icon"></i>
                                        <p>Loan</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>

                                    @if ($Add_Loan == 12)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('add_loan') }}"
                                                        class="nav-link @yield('add_loan')">
                                                        <i class="fas fa-plus nav-icon"></i>
                                                        <p>Add Loan</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                    @if ($Loans_List == 13)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('loans-list') }}"
                                                    class="nav-link @yield('loans-list')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Loans list</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif

                                </li>
                            </ul>
                        @endif
                        {{-- loan end --}}
                        @if ($Accounts_Categories == 14)
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('accounts-category') }}"
                                        class="nav-link @yield('account_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                            </ul>
                        @endif

                        @if ($Payroll == 15)
                            {{-- ****************************************** payroll start ************************************************ --}}
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item has-treeview @yield('payroll_active')">
                                    <a href="#" class="nav-link  @yield('menu_active_payroll')">
                                        <i class="nav-icon fas fa-credit-card"></i>
                                        <p>
                                            Payroll
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    @if ($Employee_Salaries == 16)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                            <li class="nav-item">
                                                <a href="{{ route('employee_salaries') }}"
                                                    class="nav-link @yield('employee_salaries')">
                                                    <i class="fas fa-list nav-icon"></i>
                                                    <p>Employee Salaries</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Payrolls_List == 17)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                            <li class="nav-item">
                                                <a href="{{ route('payroll-list') }}"
                                                    class="nav-link @yield('payroll_list_active')">
                                                    <i class="fas fa-list nav-icon"></i>
                                                    <p>Payrolls List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Add_Payroll == 18)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                                <li class="nav-item">
                                                    <a href="{{ route('add-payroll') }}"
                                                        class="nav-link @yield('add_payroll_active')">
                                                        <i class="fas fa-plus nav-icon"></i>
                                                        <p>Add Payroll</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                </li>
                            </ul>
                            {{-- ****************************************** payroll end ************************************************ --}}
                        @endif
                        @if ($Expense == 19)
                            {{-- expense start --}}
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item  @yield('expense')">
                                    <a href="#" class="nav-link  @yield('expense_active')">
                                        <i class="fas fa-money-bill-alt nav-icon"></i>
                                        <p>Expense</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    @if ($Expenses_List == 20)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('expenses-list') }}"
                                                    class="nav-link @yield('expense_list')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Expences List </p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Add_Expense == 21)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('add-expense') }}"
                                                        class="nav-link @yield('add_expense_active')">
                                                        <i class="fas fa-plus nav-icon"></i>
                                                        <p>Add Expence </p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                    @if ($Multiple_Expenses_List == 22)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('multiple-expense-list') }}"
                                                    class="nav-link @yield('multiple_expense_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Multiple Expences List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Add_Multiple_Expense == 23)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('add-multiple-expense') }}"
                                                        class="nav-link @yield('add_multiple_expense_active')">
                                                        <i class="fas fa-plus nav-icon"></i>
                                                        <p>Add Multiple Expence </p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                </li>
                            </ul>

                            {{-- expense end --}}
                        @endif

                        @if ($Income == 24)
                            {{-- income start --}}

                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item  @yield('income')">
                                    <a href="#" class="nav-link  @yield('income_menu')">
                                        <i class="fas fa-hands nav-icon"></i>
                                        <p>Income</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>

                                    @if ($Incomes_List == 25)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('income-list') }}"
                                                    class="nav-link @yield('income_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Incomes List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Add_Income == 26)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('add-income') }}"
                                                        class="nav-link @yield('add_income_active')">
                                                        <i class="fas fa-plus nav-icon"></i>
                                                        <p>Add Income </p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif

                                </li>
                            </ul>

                            {{-- income end --}}
                        @endif

                        @if ($Monthly_Sheet == 27)
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('monthly-sheet') }}"
                                        class="nav-link @yield('monthly_sheet_active')">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Monthly Sheet </p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if ($current_month_summary == 72)
                            {{-- montly summary start --}}
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('monthly_summary') }}"
                                        class="nav-link @yield('monthly_summary')">
                                        <i class="fas fa-file-alt nav-icon"></i>
                                        <p>Current Month Summary </p>
                                    </a>
                                </li>
                            </ul>
                            {{-- montly summary end --}}
                        @endif
                        @if ($Cash_In_Hand == 28)
                            <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('cash_in_hand') }}" class="nav-link @yield('cash_in_hand')">
                                        <i class="fas fa-hryvnia nav-icon"></i>
                                        <p>Cash In Hand </p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>

                    {{-- ****************************************** account end ************************************************ --}}
                @endif
                @if ($Appearance == 29)
                    <li class="nav-item has-treeview @yield('apparance')">
                        <a href="#" class="nav-link  @yield('apparance_active')">
                            <i class="nav-icon fab fa-pagelines"></i>
                            <p>
                                Apparance
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-1" style="background-color: #032e22;">
                            {{-- ****************************************** fontawesome start ************************************************ --}}
                            @if ($Font_awesome == 30)
                                <li class="nav-item has-treeview">
                                    <a href="{{ route('fontawesome-icon') }}"
                                        class="nav-link @yield('font_active')">
                                        <i class="nav-icon fab fa-font-awesome-flag"></i>
                                        <p>
                                            Fontawesome
                                        </p>
                                    </a>
                                </li>
                            @endif
                            {{-- ****************************************** fontawesome end ************************************************ --}}
                            @if ($Home_Page == 31)
                                {{-- ****************************************** home page start ************************************************ --}}

                                <li class="nav-item has-treeview  @yield('home_page')">
                                    <a href="#" class="nav-link  @yield('menu_active_home')">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Home Page
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    @if ($Sliders_List == 32)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('home-slider-list') }}"
                                                    class="nav-link @yield('home_list')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Sliders List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Development_Project_List == 33)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('development-project-list') }}"
                                                    class="nav-link @yield('project_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Development Project List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($International_Work == 34)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('international-work') }}"
                                                    class="nav-link @yield('international_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>International Work</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Local_Projects == 35)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('local-project') }}"
                                                    class="nav-link @yield('local_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Local Projects</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Footer == 36)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('footer') }}"
                                                    class="nav-link @yield('footer_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Footer</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif

                                </li>
                                {{-- ****************************************** home page end ************************************************ --}}

                            @endif
                            @if ($About_Us_Page == 37)
                                {{-- ****************************************** about page start ************************************************ --}}

                                <li class="nav-item has-treeview @yield('about_page')">
                                    <a href="#" class="nav-link  @yield('menu_active_about')">
                                        <i class="nav-icon fab fa-amilia"></i>
                                        <p>
                                            About Us Page
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    {{-- <ul class="nav nav-treeview" style="background-color: #032e22;">
                                    <li class="nav-item">
                                        <a href="{{ route('about-create') }}" class="nav-link @yield('about_create_active')">
                                            <i class="fas fa-plus-circle nav-icon"></i>
                                            <p>Create Who We Are</p>
                                        </a>
                                    </li>
                                </ul> --}}

                                    @if ($About_Page_Banner == 38)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('about_banner') }}"
                                                    class="nav-link @yield('about_banner')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>About Page Banner</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($About_Page_History == 39)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('about_history') }}"
                                                    class="nav-link @yield('about_history')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>About Page History</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($About_Hr_Cards == 40)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('who-we-are-list') }}"
                                                    class="nav-link @yield('about_list_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>About Hr Cards</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif

                                </li>

                                {{-- ****************************************** about page end ************************************************ --}}

                            @endif
                            @if ($Service_Page == 41)
                                {{-- ****************************************** service page start ************************************************ --}}

                                <li class="nav-item has-treeview @yield('service_page')">
                                    <a href="#" class="nav-link  @yield('menu_active_service')">
                                        <i class="nav-icon fas fa-hands-helping"></i>
                                        <p>
                                            Service Page
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    @if ($Service_Banner == 42)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('service-banner') }}"
                                                    class="nav-link @yield('service_banner')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Service Banner</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Add_Service == 43)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('service-insert') }}"
                                                        class="nav-link @yield('service_create_active')">
                                                        <i class="fas fa-plus-circle nav-icon"></i>
                                                        <p>Add Service</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                    @if ($Service_List == 44)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('service-list') }}"
                                                    class="nav-link @yield('service_list_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Service List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>

                                {{-- ****************************************** service page end ************************************************ --}}
                            @endif

                            {{-- ****************************************** contact page start ************************************************ --}}
                            @if ($User_Contact == 45)
                                <li class="nav-item has-treeview @yield('contact_page')">
                                    <a href="#" class="nav-link  @yield('menu_active_contact')">
                                        <i class="nav-icon fas fa-envelope-open-text"></i>
                                        <p>
                                            User Contact
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                        <li class="nav-item">
                                            <a href="{{ route('contact-list') }}"
                                                class="nav-link @yield('contact_list_active')">
                                                <i class="fas fa-list-ul nav-icon"></i>
                                                <p>Contacts List</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif


                            {{-- ****************************************** contact page end ************************************************ --}}

                            @if (checkUserType() == 0)
                                @if ($SEO_Pages == 46)
                                    {{-- ****************************************** SEO page start ************************************************ --}}

                                    <li class="nav-item has-treeview @yield('seo_pages')">
                                        <a href="#" class="nav-link  @yield('menu_active_seo')">
                                            <i class="nav-icon fas fa-book"></i>
                                            <p>
                                                SEO Pages
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('pages') }}"
                                                    class="nav-link @yield('pages_list_active')">
                                                    <i class="fas fa-plus-circle nav-icon"></i>
                                                    <p>Pages List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    {{-- ****************************************** SEO page end ************************************************ --}}
                                @endif

                            @endif

                            @if ($Course == 47)
                                {{-- ****************************************** course  start ************************************************ --}}

                                <li class="nav-item has-treeview @yield('course_active')">
                                    <a href="#" class="nav-link  @yield('menu_active_course')">
                                        <i class="nav-icon fas fa-star"></i>
                                        <p>
                                            Course
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    @if ($Course_Banner == 48)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('course_banner') }}"
                                                    class="nav-link @yield('course_banner')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Course Banner</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Create_Course == 49)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('create-course') }}"
                                                        class="nav-link @yield('create_course_active')">
                                                        <i class="fas fa-plus-circle nav-icon"></i>
                                                        <p>Create Course</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                    @if ($Courses_List == 50)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('courses-list') }}"
                                                    class="nav-link @yield('course_list_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Courses List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>

                                {{-- ****************************************** course  end ************************************************ --}}
                            @endif

                            @if ($Blog == 51)
                                {{-- ****************************************** blog start ************************************************ --}}

                                <li class="nav-item has-treeview @yield('blog_active')">
                                    <a href="#" class="nav-link  @yield('menu_active_blog')">
                                        <i class="nav-icon fas fa-blog"></i>
                                        <p>
                                            Blog
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    @if ($Blog_Categories == 52)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('blog-category') }}"
                                                    class="nav-link @yield('blog_category_active')">
                                                    <i class="fas fa-list nav-icon"></i>
                                                    <p>Blog Categories</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                    @if ($Create_Blog == 53)
                                        @if (checkUserType() == 0)
                                            <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                                <li class="nav-item">
                                                    <a href="{{ route('create-blog') }}"
                                                        class="nav-link @yield('create_blog_active')">
                                                        <i class="fas fa-plus-circle nav-icon"></i>
                                                        <p>Create Blog</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        @endif
                                    @endif
                                    @if ($Blog_List == 54)
                                        <ul class="nav nav-treeview ml-1" style="background-color: #0b5c46;">
                                            <li class="nav-item">
                                                <a href="{{ route('blogs-list') }}"
                                                    class="nav-link @yield('blog_list_active')">
                                                    <i class="fas fa-list-ul nav-icon"></i>
                                                    <p>Blog List</p>
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                                {{-- ****************************************** blog end ************************************************ --}}

                            @endif
                        </ul>
                    </li>
                @endif
                @if ($Students == 55)
                    {{-- ****************************************** student start ************************************************ --}}

                    <li class="nav-item has-treeview @yield('student_active')">
                        <a href="#" class="nav-link  @yield('menu_active_active')">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Students
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @if ($Batch_Number == 56)
                            <ul class="nav nav-treeview" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('batch-list') }}"
                                        class="nav-link @yield('batch_list_active')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Batch Number</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if ($Students_List == 57)
                            <ul class="nav nav-treeview" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('students-list') }}"
                                        class="nav-link @yield('student_list_active')">
                                        <i class="fas fa-list  nav-icon"></i>
                                        <p> Students List</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if ($Admitted_Students_List == 58)
                            <ul class="nav nav-treeview" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('admited-students-list') }}"
                                        class="nav-link @yield('admited_student_list')">
                                        <i class="fas fa-list  nav-icon"></i>
                                        <p>Admited Students List</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                    {{-- ****************************************** student end ************************************************ --}}
                @endif
                @if ($Users_Or_Employees == 59)
                    {{-- ****************************************** user  start ************************************************ --}}

                    <li class="nav-item has-treeview @yield('user_active')">
                        <a href="#" class="nav-link  @yield('menu_active_user')">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users Or Employees
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @if ($Designation == 60)
                            <ul class="nav nav-treeview" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('designation') }}" class="nav-link @yield('designation')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Designation</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if ($Users_Or_Employees_List == 61)
                            <ul class="nav nav-treeview" style="background-color: #032e22;">
                                <li class="nav-item">
                                    <a href="{{ route('user-list') }}" class="nav-link @yield('user_list_list')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Users Or Employees List</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>

                    {{-- ****************************************** user end ************************************************ --}}
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
