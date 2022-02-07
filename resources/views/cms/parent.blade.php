<!DOCTYPE html>
<html lang="en" direction="rtl" style="direction: rtl">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{{ asset('assets/css/vendors.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>

    <!--RTL version:<link href="assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Global Theme Styles -->

    <!--end::Page Vendors Styles -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.ico') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css') }}">
    @yield('styles')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- BEGIN: Header -->
    <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">

                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="index.html" class="m-brand__logo-wrapper">
{{--                                <img alt="" src="{{ asset('assets/img/logo/logo_default_dark.png') }}"/>--}}
                                <span>Hospital</span>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Responsive Header Menu Toggler -->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>

                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>

                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                    <!-- BEGIN: Horizontal Menu -->
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                            id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                    <div id="m_header_menu"
                         class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                        <div class="m-subheader ">
                            <div class="d-flex align-items-center">
                                <div class="mr-auto">
                                    <h3 class="m-subheader__title m-subheader__title--separator bl-0">@yield('sub-title')</h3>
                                </div>
                            </div>
                        </div>
                        <!-- END: Subheader -->
                    </div>

                    <!-- END: Horizontal Menu -->

                    <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light"
                                    m-dropdown-toggle="click" id="m_quicksearch"
                                    m-quicksearch-mode="dropdown" m-dropdown-persistent="1">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-nav__link-icon"><i class="flaticon-search-1"></i></span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner ">
                                            <div class="m-dropdown__header">
                                                <form class="m-list-search__form">
                                                    <div class="m-list-search__form-wrapper">
                                                        <span class="m-list-search__form-input-wrapper">
                                                            <input id="m_quicksearch_input" autocomplete="off"
                                                                   type="text" name="q"
                                                                   class="m-list-search__form-input" value=""
                                                                   placeholder="بحث...">
                                                        </span>
                                                        <span class="m-list-search__form-icon-close"
                                                              id="m_quicksearch_close">
                                                            <i class="la la-remove"></i>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true"
                                                     data-height="300" data-mobile-height="200">
                                                    <div class="m-dropdown__content">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                    m-dropdown-toggle="click"
                                    m-dropdown-persistent="1">
                                    <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                        <span
                                            class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                        <span class="m-nav__link-icon"><i class="flaticon-alarm"></i></span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url({{ asset('assets/img/notification_bg.jpg') }}); background-size: cover;">
                                                <span class="m-dropdown__header-subtitle">الاشعارات</span>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand"
                                                        role="tablist">
                                                        <li class="nav-item m-tabs__item">
                                                            <a class="nav-link m-tabs__link" data-toggle="tab"
                                                               href="#topbar_notifications_events"
                                                               role="tab">الاحداث</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">

                                                        <div class="tab-pane active" id="topbar_notifications_events"
                                                             role="tabpanel">
                                                            <div class="m-scrollable" data-scrollable="true"
                                                                 data-height="250" data-mobile-height="200">
                                                                <div
                                                                    class="m-list-timeline m-list-timeline--skin-light">
                                                                    <div class="m-list-timeline__items">
                                                                        <div class="m-list-timeline__item">
                                                                            <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                            <a href="" class="m-list-timeline__text">اضافة محتوى جديد</a>
                                                                            <span class="m-list-timeline__time">اليوم</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    m-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-topbar__userpic">
                                            <img src="/storage/{{ Auth::user()->image->path }}"
                                                 class="m--img-rounded m--marginless" alt=""/>
                                        </span>
                                        <span class="m-topbar__username m--hide"></span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span
                                            class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url({{ asset('assets/img/user_profile_bg.jpg') }}); background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img src="/storage/{{ Auth::user()->image->path }}"
                                                             class="m--img-rounded m--marginless" alt=""/>
                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span
                                                            class="m-card-user__name m--font-weight-500">{{ Auth::user()->full_name }}</span>
                                                        <span href=""
                                                              class="m-card-user__email m--font-weight-300 m-link">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__section m--hide">
                                                            <span class="m-nav__section-text">Section</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('auth.profile') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
                                                                    <span class="m-nav__link-wrap">
                                                                        <span
                                                                            class="m-nav__link-text">الملف الشخصي</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('changePassword') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
                                                                    <span class="m-nav__link-wrap">
                                                                        <span
                                                                            class="m-nav__link-text">تغيير كلمة المرور</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit">
                                                        </li>
                                                        <li class="m-nav__item">
                                                            @if(Auth::guard('admin')->check())
                                                                <a href="{{ route('admin.logout') }}"
                                                                   class="btn m-btn--pill    btn-secondary m-btn  m-btn--label-brand m-btn--bolder">تسجيل
                                                                    الخروج</a>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Topbar -->
                </div>
            </div>
        </div>
    </header>

    <!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                class="la la-close"></i></button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

            <!-- BEGIN: Aside Menu -->
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                 m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
                        <a href="{{ route('dashboard') }}" class="m-menu__link ">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span
                                        class="m-menu__link-text">الرئيسية</span>
									<span class="m-menu__link-badge"></span> </span></span>
                        </a>
                    </li>

                    <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><span
                            class="m-menu__link "><span class="m-menu__link-title"> <span
                                    class="m-menu__link-wrap"> <span class="m-menu__link-text">المستخدمين</span>
									<span class="m-menu__link-badge"></span></span></span></span>
                    </li>

                    @canany(['show_doctors', 'edit_doctors'])
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i  class="m-menu__link-icon  fa fa-user"></i>
                                <span class="m-menu__link-text">دكتور</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    @can('edit_doctors')
                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('doctors.create') }}"
                                                                                          class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">انشاء حساب جديد</span></a></li>
                                    @endcan
                                    @can('show_doctors')
                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('doctors.index') }}"
                                                                                          class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">عرض الكل</span></a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany
                    @canany(['show_sections', 'edit_sections'])
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i  class="m-menu__link-icon  fa fa-user"></i>
                                <span class="m-menu__link-text">القسام</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    @can('edit_sections')
                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('sections.create') }}"
                                                                                          class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">انشاء حساب جديد</span></a></li>
                                    @endcan
                                    @can('show_sections')
                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('sections.index') }}"
                                                                                          class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">عرض الكل</span></a></li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcanany
                    @canany(['show_users', 'edit_users'])
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                        m-menu-submenu-toggle="hover">
                        <a href="javascript:;" class="m-menu__link m-menu__toggle">
                            <i  class="m-menu__link-icon  fa fa-user"></i>
                            <span class="m-menu__link-text">مستخدمي الموقع</span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                            <ul class="m-menu__subnav">
                                @can('edit_users')
                                    <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('users.create') }}"
                                                                                      class="m-menu__link "><i
                                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                class="m-menu__link-text">انشاء حساب جديد</span></a></li>
                                @endcan
                                @can('show_users')
                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('users.index') }}"
                                                                                          class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">عرض الكل</span></a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                    @endcanany
                    @canany(['edit_admins', 'show_admins'])
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                            m-menu-submenu-toggle="hover">
                            <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                <i  class="m-menu__link-icon  fa fa-suitcase"></i>
                                <span class="m-menu__link-text">حسابات الادارة</span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    @canany('edit_admins')
                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('admins.create') }}"
                                                                                          class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">انشاء حساب جديد</span></a></li>
                                    @endcanany
                                    @canany('show_users')
                                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('admins.index') }}"
                                                                                              class="m-menu__link "><i
                                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                        class="m-menu__link-text">عرض الكل</span></a></li>
                                    @endcanany
                                </ul>
                            </div>
                        </li>
                    @endcanany

{{--                    @canany(['read-teachers', 'create-teachers'])--}}
{{--                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"--}}
{{--                            m-menu-submenu-toggle="hover">--}}
{{--                            <a href="javascript:;" class="m-menu__link m-menu__toggle">--}}
{{--                                <i  class="m-menu__link-icon  fa fa-user"></i>--}}
{{--                                <span class="m-menu__link-text">المحفيظين</span>--}}
{{--                                <i class="m-menu__ver-arrow la la-angle-right"></i>--}}
{{--                            </a>--}}
{{--                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>--}}
{{--                                <ul class="m-menu__subnav">--}}
{{--                                    @can('create-teachers')--}}
{{--                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('teachers.create') }}"--}}
{{--                                                                                          class="m-menu__link "><i--}}
{{--                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span--}}
{{--                                                    class="m-menu__link-text">انشاء حساب جديد</span></a></li>--}}
{{--                                    @endcan--}}
{{--                                    @can('read-teachers')--}}
{{--                                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('teachers.index') }}"--}}
{{--                                                                                          class="m-menu__link "><i--}}
{{--                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span--}}
{{--                                                    class="m-menu__link-text">عرض الكل</span></a></li>--}}
{{--                                    @endcan--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endcanany--}}
{{--                    @can('read-posts')--}}
{{--                        <li class="m-menu__item m-menu__item--submenu pl-3" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon 	fa fa-newspaper"></i><span class="m-menu__link-text">المنشورات</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>--}}
{{--                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>--}}
{{--                                <ul class="m-menu__subnav">--}}
{{--                                    <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('posts.index') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">كل المنشورات</span></a></li>--}}
{{--                                    <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('posts.create') }}" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">إنشاء جديد</span></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('read-messages')--}}
{{--                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"--}}
{{--                            m-menu-submenu-toggle="hover"><a href="{{ route('messages.index') }}"--}}
{{--                                                             class="m-menu__link m-menu__toggle"><i--}}
{{--                                    class="m-menu__link-icon fa fa-envelope"></i><span class="m-menu__link-text"> إرسال إشعارات للمستخدمين</span></a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
                    <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><span
                            class="m-menu__link "><span class="m-menu__link-title"> <span
                                    class="m-menu__link-wrap"> <span class="m-menu__link-text">إعدادات الموقع</span>
									<span class="m-menu__link-badge"></span> </span></span></span>
                    </li>

{{--                   @can('read-permissions')--}}
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                            m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                                    class="m-menu__link-icon  fa fa-user"></i><span
                                    class="m-menu__link-text">الصلاحيات</span><i
                                    class="m-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('permissions.index') }}"
                                                                                      class="m-menu__link "><i
                                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                class="m-menu__link-text">عرض الكل</span></a></li>
                                </ul>
                            </div>
                        </li>
{{--                   @endcan--}}
{{--                    @can('read-roles')--}}
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                            m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                                    class="m-menu__link-icon  fa fa-user"></i><span
                                    class="m-menu__link-text">الأدوار</span><i
                                    class="m-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('roles.index') }}"
                                                                                      class="m-menu__link "><i
                                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                class="m-menu__link-text">عرض الكل</span></a></li>
                                </ul>
                            </div>
                        </li>
{{--                    @endcan--}}
                    @can('show_cities')
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                            m-menu-submenu-toggle="hover"><a href="{{ route('cities.index') }}"
                                                             class="m-menu__link m-menu__toggle"><i
                                    class="m-menu__link-icon fas fa-circle"></i><span class="m-menu__link-text">المدن</span></a>
                        </li>
                    @endcan
                    @can('show_settings')
                        <li class="m-menu__item  m-menu__item--submenu pl-3" aria-haspopup="true"
                            m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                                    class="m-menu__link-icon fa fa-cog"></i><span
                                    class="m-menu__link-text"> إعدادات الموقع</span><i
                                    class="m-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('settings.index') }}"
                                                                                      class="m-menu__link "><i
                                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                class="m-menu__link-text">اعدادات الموقع</span></a></li>
{{--                                    <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('settings.index', 'social') }}"--}}
{{--                                                                                      class="m-menu__link "><i--}}
{{--                                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span--}}
{{--                                                class="m-menu__link-text">مواقع التواصل الاجتماعي</span></a></li>--}}
                                </ul>
                            </div>
                        </li>
                    @endcan
                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->
        @yield('main-content')
    </div>

    <!-- end:: Body -->

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    @yield('popScreen')
    <!-- end::Scroll Top -->

    <!--begin::Global Theme Bundle -->
    <script src="{{ asset('assets/js/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!--end::Global Theme Bundle -->
@yield('scripts')
</body>

<!-- end::Body -->
</html>
