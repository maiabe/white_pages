<template>
    <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Temp Button</button> -->

    <div class="offcanvas offcanvas-start sidebar-offcanvas" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <!-- Sidebar toggle button -->
        <div class="sidebar-toggle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
            <div id="sidebarToggleBtn" class="sidebar-toggle-tab">
                <font-awesome-icon class="sidebar-toggle-btn up" icon="angles-up" style="color: #ffffff;" />
                <font-awesome-icon class="sidebar-toggle-btn down expanded" icon="angles-down" style="color: #ffffff;" />
            </div>
        </div>

        <!-- Sidebar Header -->
        <div class="offcanvas-header">
            <!-- <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
            <div class="logo-wrapper">
                <img src="../../../public/images/logo/UHWPMS_LOGO.png" width="50" />
            </div>
            <div class="title-wrapper">
                <h3 class="offcanvas-title" id="offcanvasScrollingLabel">WPMS</h3>
            </div>
        </div>
        <div style="display: flex; justify-content: center;">
            <hr width="85%" style="margin: 0;" />
        </div>
        
        <!-- Sidebar Body -->
        <div class="offcanvas-body">
            <div class="page-links-wrapper">
                <div class="main-page-links">
                    <a :href="personListingsRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="user" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Person Listings</h6>
                        </div>
                    </a>
                    <!-- <a :href="departmentListingsRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="building" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Department Listings</h6>
                        </div>
                    </a> -->
                    <a :href="deptGroupsRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="building-columns" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Department Groups</h6>
                        </div>
                    </a>
                    <a :href="deptContactsRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="address-book" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Department Contacts</h6>
                        </div>
                    </a>
                    <a :href="adminsRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="user-gear" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Admins</h6>
                        </div>
                    </a>
                    <a :href="announcementsRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="bullhorn" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Announcements</h6>
                        </div>
                    </a>
                </div>
                
                <div class="user-page-links">
                    <div style="display: flex; justify-content: center; margin-bottom: 15%;">
                        <hr width="85%" style="margin: 0;" />
                    </div>
                    <a :href="profileRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="circle-user" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Profile</h6>
                        </div>
                    </a>
                    <a :href="profileRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="circle-question" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Help</h6>
                        </div>
                    </a>
                    <a :href="profileRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="gear" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Settings</h6>
                        </div>
                    </a>
                    <a :href="profileRoute" class="page-link">
                        <div class="page-icon">
                            <font-awesome-icon icon="right-from-bracket" style="color: #ffffff;" />
                        </div>
                        <div class="page-name">
                            <h6>Logout</h6>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
</template>


<script>

    export default {
        props: {
            personListingsRoute: {
                type: String,
                required: true,
            },
            departmentListingsRoute: {
                type: String,
                required: true,
            },
            deptGroupsRoute: {
                type: String,
                required: true,
            },
            deptContactsRoute: {
                type: String,
                required: true,
            },
            adminsRoute: {
                type: String,
                required: true,
            },
            announcementsRoute: {
                type: String,
                required: true,
            },
            profileRoute: {
                type: String,
                required: true,
            },
        },
        mounted() {
            const sidebar = document.querySelector('.sidebar-offcanvas');
            sidebar.addEventListener('show.bs.offcanvas', (e) => this.toggleSidebarContent(e));
            sidebar.addEventListener('hide.bs.offcanvas', (e) => this.toggleSidebarContent(e));
            sidebar.addEventListener('shown.bs.offcanvas', (e) => this.toggleSidebarTab(e));
            sidebar.addEventListener('hidden.bs.offcanvas', (e) => this.toggleSidebarTab(e));
        },
        methods: {
            toggleSidebarContent(e) {
                const sidebarWrapper = e.target.closest('aside');
                const logoWrapper = e.target.querySelector('.logo-wrapper');
                const titleWrapper = e.target.querySelector('.title-wrapper');
                const pageIcons = e.target.querySelectorAll('.page-icon');
                const pageNames = e.target.querySelectorAll('.page-name');
                sidebarWrapper.classList.toggle('expanded');
                
                logoWrapper.classList.toggle('expanded');
                titleWrapper.classList.toggle('expanded');
                pageIcons.forEach(pi => { pi.classList.toggle('expanded') });
                pageNames.forEach(pn => { pn.classList.toggle('expanded') });
            },
            toggleSidebarTab(e) {
                const toggleBtnUp = e.target.querySelector('.sidebar-toggle-btn.up');
                const toggleBtnDown = e.target.querySelector('.sidebar-toggle-btn.down');
                toggleBtnUp.classList.toggle('expanded');
                toggleBtnDown.classList.toggle('expanded');
            }
        }     
    };
</script>