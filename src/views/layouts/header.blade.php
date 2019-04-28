<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ cb()->getAdminUrl() }}" title='{{ cb()->getAppName()  }}' class="logo">{{ cb()->getAppName() }}</a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ cb()->session()->photo() }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ cb()->session()->name() }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ cb()->session()->photo()  }}" class="img-circle" alt="User Image"/>
                            <p>
                                {{ cb()->session()->name() }}
                                <small>{{ cb()->session()->roleName() }}</small>
                                <small><em><?php echo date('d F Y')?></em></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-{{ trans('crudbooster.left') }}">
                                <a href="{{ cb()->getProfileUrl() }}" class="btn btn-default btn-flat"><i
                                            class='fa fa-user'></i> {{trans("crudbooster.label_button_profile")}}</a>
                            </div>
                            <div class="pull-{{ trans('crudbooster.right') }}">
                                <a href="{{ cb()->getLogoutUrl() }}" class="btn btn-danger btn-flat"><i class='fa fa-power-off'></i></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
