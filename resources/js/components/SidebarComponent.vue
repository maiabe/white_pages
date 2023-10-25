<template>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Temp Button</button>

    <div class="offcanvas offcanvas-start offcanvas-partially-hidden" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">
                UHWPMS
            </h5>
            <hr width="90%" />
        </div>
        <div class="offcanvas-body">
            <div class="page-links-wrapper">
                <!-- <ul>
                    <li v-for="(route, name) in routes" :key="name" >
                        <a :href="route"> {{ name }}</a>
                    </li>
                </ul> -->
                <a :href="personListingsRoute" class="page-link">
                    <div class="page-wrapper">
                        <h5>Person Listings</h5>
                    </div>
                </a>
                <a :href="departmentListingsRoute" class="page-link">
                    <div class="page-wrapper">
                        <h5>Department Listings</h5>
                    </div>
                </a>
                <a :href="deptGroupsRoute" class="page-link">
                    <div class="page-wrapper">
                        <h5>Department Groups</h5>
                    </div>
                </a>
                <a :href="deptContactsRoute" class="page-link">
                    <div class="page-wrapper">
                        <h5>Department Contacts</h5>
                    </div>
                </a>
                <div class="page-wrapper">
                    <h5>Make Approvals</h5>
                </div>
                <a :href="announcementsRoute" class="page-link">
                    <div class="page-wrapper">
                        <h5>Announcements</h5>
                    </div>
                </a>
                <a :href="adminsRoute" class="page-link">
                    <div class="page-wrapper">
                        <h5>Admins</h5>
                    </div>
                </a>                
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
            announcementsRoute: {
                type: String,
                required: true,
            },
            adminsRoute: {
                type: String,
                required: true,
            },
        },
    };
</script>