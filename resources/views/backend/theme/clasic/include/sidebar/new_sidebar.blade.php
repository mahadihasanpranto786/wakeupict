<!-- Main Sidebar Container -->
<aside id='sidebar_color' class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <h3 class="p-1 text-center text-white"><a href="{{ route('home-page') }}" target="_blank">WAKE UP ICT</a></h3>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('admin') }}" class="nav-link @yield('active_dashboard')">
                        <i class="nav-icon fas fa-house-damage"></i>
                        <p>
                            {{ __('admin.menu.dashboard') }}
                        </p>
                    </a>
                </li>

                {{-- ****************************************** Appearance CMS start ************************************************ --}}
                <li class="nav-item has-treeview @yield('appearance_menu_open')">
                    <a href="#" class="nav-link @yield('appearance_active')" style="@yield('appearance_style')">
                        <i class="nav-icon fas fa-palette text-warning"></i>
                        <p>
                            {{ __('admin.menu.appearance') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('appearance.theme') }}" class="nav-link @yield('appearance_theme_active')">
                                <i class="fas fa-brush nav-icon text-info"></i>
                                <p>{{ __('admin.menu.theme_color') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('appearance.global') }}" class="nav-link @yield('appearance_global_active')">
                                <i class="fas fa-globe nav-icon text-success"></i>
                                <p>{{ __('admin.menu.global_settings') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('appearance.home') }}" class="nav-link @yield('appearance_home_active')">
                                <i class="fas fa-desktop nav-icon text-primary"></i>
                                <p>{{ __('admin.menu.home_cms') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('appearance.sections') }}" class="nav-link @yield('appearance_sections_active')">
                                <i class="fas fa-layer-group nav-icon text-purple"></i>
                                <p>{{ __('admin.menu.sections_cms') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home-slider-list') }}" class="nav-link @yield('appearance_sliders_active')">
                                <i class="fas fa-images nav-icon text-danger"></i>
                                <p>{{ __('admin.menu.sliders') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- ****************************************** Appearance CMS end ************************************************ --}}

                {{-- ****************************************** account start ************************************************ --}}

                <li class="nav-item has-treeview @yield('account')">
                    <a href="#" class="nav-link  @yield('menu_active')">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Accounts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item  @yield('Invest')">
                            <a href="#" class="nav-link  @yield('index_investor_active')">
                                <i class="fas fa-hand-holding-usd nav-icon"></i>
                                <p>Invest</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('index_investor') }}" class="nav-link @yield('index_investor')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Investor</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('index_investor_type') }}" class="nav-link @yield('index_investor_type')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Investor Type</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('investment_list') }}" class="nav-link @yield('investment_list')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Investment</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                    {{-- asset start --}}
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item  @yield('asset')">
                            <a href="#" class="nav-link  @yield('index_asset')">
                                <i class="fas fa-donate nav-icon"></i>
                                <p>Assets</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('asset_type') }}" class="nav-link @yield('asset_type')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Type</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('add_asset') }}" class="nav-link @yield('add_asset')">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Asset</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('assets_list') }}" class="nav-link @yield('assets_list')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Assets list</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    {{-- asset end --}}
                    {{-- loan start --}}

                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item  @yield('loan')">
                            <a href="#" class="nav-link  @yield('loan_active')">
                                <i class="fas fa-landmark nav-icon"></i>
                                <p>Loan</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('add_loan') }}" class="nav-link @yield('add_loan')">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Loan</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('loans-list') }}" class="nav-link @yield('loans-list')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Loans list</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- loan end --}}
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item has-treeview @yield('category_active')">
                            <a href="#" class="nav-link  @yield('menu_active_category')">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>
                                    Category
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('accounts-category') }}" class="nav-link @yield('account_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('category-report') }}" class="nav-link @yield('category_report')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Category Report</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- ****************************************** payroll start ************************************************ --}}
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item has-treeview @yield('payroll_active')">
                            <a href="#" class="nav-link  @yield('menu_active_payroll')">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Payroll
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('employee_salaries') }}" class="nav-link @yield('employee_salaries')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Employee Salaries</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('payroll-list') }}" class="nav-link @yield('payroll_list_active')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Payrolls List</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('generate-payroll') }}" class="nav-link @yield('generate_payroll_active')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Generate Payrolls </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('add-payroll') }}" class="nav-link @yield('add_payroll_active')">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Single Payroll</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- ****************************************** payroll end ************************************************ --}}

                    {{-- expense start --}}
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item  @yield('expense')">
                            <a href="#" class="nav-link  @yield('expense_active')">
                                <i class="fas fa-money-bill-alt nav-icon"></i>
                                <p>Expense</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('expenses-list') }}" class="nav-link @yield('expense_list')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Expences List </p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('add-expense') }}" class="nav-link @yield('add_expense_active')">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Expence </p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('multiple-expense-list') }}"
                                        class="nav-link @yield('multiple_expense_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Multiple Expences List</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('add-multiple-expense') }}"
                                        class="nav-link @yield('add_multiple_expense_active')">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Multiple Expence </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    {{-- expense end --}}

                    {{-- income start --}}

                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item  @yield('income')">
                            <a href="#" class="nav-link  @yield('income_menu')">
                                <i class="fas fa-hands nav-icon"></i>
                                <p>Income</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('income-list') }}" class="nav-link @yield('income_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Incomes List</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('add-income') }}" class="nav-link @yield('add_income_active')">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Add Income </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>

                    {{-- income end --}}

                    {{-- montly sheet start --}}
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('monthly-sheet') }}" class="nav-link @yield('monthly_sheet_active')">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Monthly Sheet </p>
                            </a>
                        </li>
                    </ul>
                    {{-- montly sheet end --}}

                    {{-- montly summary start --}}
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('monthly_summary') }}" class="nav-link @yield('monthly_summary')">
                                <i class="fas fa-file-alt nav-icon"></i>
                                <p>Current Month Summary </p>
                            </a>
                        </li>
                    </ul>
                    {{-- montly summary end --}}
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('cash_in_hand') }}" class="nav-link @yield('cash_in_hand')">
                                <i class="fas fa-hryvnia nav-icon"></i>
                                <p>Cash In Hand </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ****************************************** account end ************************************************ --}}


                <li class="nav-item has-treeview @yield('apparance')">
                    <a href="#" class="nav-link  @yield('apparance_active')">
                        <i class="nav-icon fab fa-pagelines"></i>
                        <p>
                            Apparance
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                        {{-- ****************************************** fontawesome start ************************************************ --}}
                        <li class="nav-item has-treeview">
                            <a href="{{ route('fontawesome-icon') }}" class="nav-link @yield('font_active')">
                                <i class="nav-icon fab fa-font-awesome-flag"></i>
                                <p>
                                    Fontawesome
                                </p>
                            </a>
                        </li>
                        {{-- ****************************************** fontawesome end ************************************************ --}}

                        {{-- ****************************************** home page start ************************************************ --}}

                        <li class="nav-item has-treeview  @yield('home_page')">
                            <a href="#" class="nav-link  @yield('menu_active_home')">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home Page
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('home-slider-list') }}" class="nav-link @yield('home_list')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Sliders List</p>
                                    </a>
                                </li>
                            </ul>

                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('national-work') }}" class="nav-link @yield('national_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>National Work</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('international-work') }}" class="nav-link @yield('international_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>International Work</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('local-project') }}" class="nav-link @yield('local_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Local Projects</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('development-project-list') }}"
                                        class="nav-link @yield('project_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Development Project List</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('footer') }}" class="nav-link @yield('footer_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Footer</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- ****************************************** home page end ************************************************ --}}
                        {{-- ****************************************** about page start ************************************************ --}}

                        <li class="nav-item has-treeview @yield('about_page')">
                            <a href="#" class="nav-link  @yield('menu_active_about')">
                                <i class="nav-icon fab fa-amilia"></i>
                                <p>
                                    About Us Page
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            {{-- <ul class="nav nav-treeview" style="background-color: transparent;">
                                    <li class="nav-item">
                                        <a href="{{ route('about-create') }}" class="nav-link @yield('about_create_active')">
                                            <i class="fas fa-plus-circle nav-icon"></i>
                                            <p>Create Who We Are</p>
                                        </a>
                                    </li>
                                </ul> --}}
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('about_banner') }}" class="nav-link @yield('about_banner')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>About Page Banner</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('about_history') }}" class="nav-link @yield('about_history')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>About Page History</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('who-we-are-list') }}" class="nav-link @yield('about_list_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>About Hr Cards</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ****************************************** about page end ************************************************ --}}
                        {{-- ****************************************** service page start ************************************************ --}}

                        <li class="nav-item has-treeview @yield('service_page')">
                            <a href="#" class="nav-link  @yield('menu_active_service')">
                                <i class="nav-icon fas fa-hands-helping"></i>
                                <p>
                                    Service Page
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('service-banner') }}" class="nav-link @yield('service_banner')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Service Banner</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('service-insert') }}" class="nav-link @yield('service_create_active')">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Add Service</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('service-list') }}" class="nav-link @yield('service_list_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Service List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ****************************************** service page end ************************************************ --}}
                        {{-- ****************************************** contact page start ************************************************ --}}

                        <li class="nav-item has-treeview @yield('contact_page')">
                            <a href="#" class="nav-link  @yield('menu_active_contact')">
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                <p>
                                    User Contact
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('contact-list') }}" class="nav-link @yield('contact_list_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Contacts List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ****************************************** contact page end ************************************************ --}}


                        {{-- ****************************************** SEO page start ************************************************ --}}

                        <li class="nav-item has-treeview @yield('seo_pages')">
                            <a href="#" class="nav-link  @yield('menu_active_seo')">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    SEO Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('pages') }}" class="nav-link @yield('pages_list_active')">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Pages List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- ****************************************** SEO page end ************************************************ --}}

                        {{-- ****************************************** course  start ************************************************ --}}

                        <li class="nav-item has-treeview @yield('course_active')">
                            <a href="#" class="nav-link  @yield('menu_active_course')">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    Course
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('course_banner') }}" class="nav-link @yield('course_banner')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Course Banner</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('create-course') }}" class="nav-link @yield('create_course_active')">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Create Course</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('courses-list') }}" class="nav-link @yield('course_list_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Courses List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ****************************************** course  end ************************************************ --}}
                        {{-- ****************************************** blog start ************************************************ --}}

                        <li class="nav-item has-treeview @yield('blog_active')">
                            <a href="#" class="nav-link  @yield('menu_active_blog')">
                                <i class="nav-icon fas fa-blog"></i>
                                <p>
                                    Blog
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('blog-category') }}" class="nav-link @yield('blog_category_active')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Blog Categories</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('create-blog') }}" class="nav-link @yield('create_blog_active')">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Create Blog</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('blogs-list') }}" class="nav-link @yield('blog_list_active')">
                                        <i class="fas fa-list-ul nav-icon"></i>
                                        <p>Blog List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- ****************************************** blog end ************************************************ --}}
                     
                     
                        {{-- ****************************************** talent start ************************************************ --}}

                        <li class="nav-item has-treeview @yield('Talent')">
                            <a href="#" class="nav-link  @yield('Talent_active')">
                                <i class="nav-icon fas fa-blog"></i>
                                <p>
                                    Talent Hunt
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('create-talent-content') }}" class="nav-link @yield('create-talent-content')">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Create Page</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview ml-1" style="background-color: transparent;">
                                <li class="nav-item">
                                    <a href="{{ route('talent-page-list') }}" class="nav-link @yield('talent-page-list')">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Talent Page List</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- ****************************************** talent end ************************************************ --}}
                 
                   
                    </ul>



                    {{-- ****************************************** student start ************************************************ --}}

                <li class="nav-item has-treeview @yield('student_active')">
                    <a href="#" class="nav-link  @yield('menu_active_active')">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('batch-list') }}" class="nav-link @yield('batch_list_active')">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Batch Number</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('students-list') }}" class="nav-link @yield('student_list_active')">
                                <i class="fas fa-list  nav-icon"></i>
                                <p> Students List</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('admited-students-list') }}" class="nav-link @yield('admited_student_list')">
                                <i class="fas fa-list  nav-icon"></i>
                                <p>Admited Students List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- ****************************************** student end ************************************************ --}}

                {{-- ****************************************** user  start ************************************************ --}}

                <li class="nav-item has-treeview @yield('user_active')">
                    <a href="#" class="nav-link  @yield('menu_active_user')">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users Or Employees
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('designation') }}" class="nav-link @yield('designation')">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Designation</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('user-list') }}" class="nav-link @yield('user_list_list')">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Users Or Employees List</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ url('module') }}" class="nav-link  @yield('module')">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Module</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- ****************************************** user end ************************************************ --}}


                {{-- ************************************* employee leave start****************************************? --}}



                {{-- <li class="nav-item has-treeview @yield('leave_active')">
                    <a href="#" class="nav-link  @yield('leave_menu_active')">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Exployee Leave
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('leave_Category_with_days') }}"
                                class="nav-link @yield('leave_Category_with_days')">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Leave Categoery With Days</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('employee_leave') }}" class="nav-link @yield('employee_leave')">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Apply for Leave</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('apply_employee_leave') }}"
                                class="nav-link @yield('employee_leave_list')">
                                <i class="fas fa-list nav-icon"></i>
                                <p>List Of Application</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- ************************************* employee leave end****************************************? --}}



                {{-- *************************************************** test start ******************************* --}}


                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Testing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="background-color: transparent;">
                        <li class="nav-item">
                            <a href="{{ route('excel') }}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>testing excel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('test_pages') }}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>testing</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('test-sorting') }}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Sorting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('excel-data') }}" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Excel-data</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
