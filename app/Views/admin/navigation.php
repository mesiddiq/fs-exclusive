
    
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="javascript:;">
                <img src="<?php echo site_url('assets/img/logo.png'); ?>" alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <?php
            $uri = current_url(true);
            $uri = explode("/", $uri);
            ?>
            <ul>
                <li class="nav-item <?php echo $uri[4] == 'dashboard' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/dashboard'); ?>">
                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22">
                                <path
                                d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"
                                />
                            </svg>
                        </span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?php echo $uri[4] == 'categories' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/categories'); ?>">
                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.58341 8.70841L6.87508 12.8334H2.29175L4.58341 8.70841ZM2.75008 3.66675H6.41675V7.33341H2.75008V3.66675ZM4.58341 18.3334C5.06964 18.3334 5.53596 18.1403 5.87978 17.7964C6.22359 17.4526 6.41675 16.9863 6.41675 16.5001C6.41675 16.0139 6.22359 15.5475 5.87978 15.2037C5.53596 14.8599 5.06964 14.6667 4.58341 14.6667C4.09718 14.6667 3.63087 14.8599 3.28705 15.2037C2.94324 15.5475 2.75008 16.0139 2.75008 16.5001C2.75008 16.9863 2.94324 17.4526 3.28705 17.7964C3.63087 18.1403 4.09718 18.3334 4.58341 18.3334ZM8.25008 4.58341V6.41675H19.2501V4.58341H8.25008ZM8.25008 17.4167H19.2501V15.5834H8.25008V17.4167ZM8.25008 11.9167H19.2501V10.0834H8.25008V11.9167Z"></path>
                            </svg>
                        </span>
                        <span class="text">Categories</span>
                    </a>
                </li>
                <li class="nav-item <?php echo $uri[4] == 'products' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/products'); ?>">
                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.75 4.58325H16.5L15.125 6.41659L13.75 4.58325ZM4.58333 1.83325H17.4167C18.4342 1.83325 19.25 2.65825 19.25 3.66659V18.3333C19.25 19.3508 18.4342 20.1666 17.4167 20.1666H4.58333C3.575 20.1666 2.75 19.3508 2.75 18.3333V3.66659C2.75 2.65825 3.575 1.83325 4.58333 1.83325ZM4.58333 3.66659V7.33325H17.4167V3.66659H4.58333ZM4.58333 18.3333H17.4167V9.16659H4.58333V18.3333ZM6.41667 10.9999H15.5833V12.8333H6.41667V10.9999ZM6.41667 14.6666H15.5833V16.4999H6.41667V14.6666Z"></path>
                            </svg>
                        </span>
                        <span class="text">Products</span>
                    </a>
                </li>
                <li class="nav-item <?php echo $uri[4] == 'users' ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/users'); ?>">
                        <span class="icon">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.0001 3.66675C11.9725 3.66675 12.9052 4.05306 13.5928 4.74069C14.2804 5.42832 14.6667 6.36095 14.6667 7.33341C14.6667 8.30587 14.2804 9.23851 13.5928 9.92614C12.9052 10.6138 11.9725 11.0001 11.0001 11.0001C10.0276 11.0001 9.09499 10.6138 8.40736 9.92614C7.71972 9.23851 7.33341 8.30587 7.33341 7.33341C7.33341 6.36095 7.71972 5.42832 8.40736 4.74069C9.09499 4.05306 10.0276 3.66675 11.0001 3.66675ZM11.0001 5.50008C10.5139 5.50008 10.0475 5.69324 9.70372 6.03705C9.3599 6.38087 9.16675 6.84718 9.16675 7.33341C9.16675 7.81964 9.3599 8.28596 9.70372 8.62978C10.0475 8.97359 10.5139 9.16675 11.0001 9.16675C11.4863 9.16675 11.9526 8.97359 12.2964 8.62978C12.6403 8.28596 12.8334 7.81964 12.8334 7.33341C12.8334 6.84718 12.6403 6.38087 12.2964 6.03705C11.9526 5.69324 11.4863 5.50008 11.0001 5.50008ZM11.0001 11.9167C13.4476 11.9167 18.3334 13.1359 18.3334 15.5834V18.3334H3.66675V15.5834C3.66675 13.1359 8.55258 11.9167 11.0001 11.9167ZM11.0001 13.6584C8.27758 13.6584 5.40841 14.9967 5.40841 15.5834V16.5917H16.5917V15.5834C16.5917 14.9967 13.7226 13.6584 11.0001 13.6584Z"></path>
                            </svg>
                        </span>
                        <span class="text">Users</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->