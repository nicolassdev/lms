<style>
    /* Custom styling for profile */
    .profile-card {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #2980b9, #6dd5fa, #ffffff);
    }

    .profile-img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .profile-header h2 {
        font-size: 2rem;
        /* Increased size */
    }

    .profile-header p {
        font-size: 1.25rem;
        /* Increased size */
    }

    .profile-details {
        font-size: 1.25rem;
        /* Increased size */
        line-height: 1.6;
    }

    /* Larger button custom class */
    .btn-lg-custom {
        font-size: 1.25rem;
        padding: 0.75rem 1.5rem;
    }
</style>

</head>

<body>
    <div class="container me-5">
        <!-- Edit Profile Button -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card responsive">
                    <button class="btn btn-secondary btn-sm-custom me-2">
                        <a class="nav-link text-white" href="index.php?page=index">
                            <i class="bi bi-arrow-left-circle me-1"></i>Back
                        </a>
                    </button>
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <h2>John Doe</h2>
                        <p class="text-muted">Admin, Pixel8 Company</p>
                    </div>

                    <!-- Profile Details -->
                    <div class="profile-details">
                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Email:</strong>
                                <p>john.doe@pixel8.com</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Phone:</strong>
                                <p>+63 912 345 6789</p>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Role:</strong>
                                <p>System Administrator</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Joined:</strong>
                                <p>January 10, 2022</p>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6">
                                <strong>Address:</strong>
                                <p>123 Main Street, Legazpi City, Philippines</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Status:</strong>
                                <p>Active</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center ">

                            <button type="button" class="btn btn-primary btn-sm-custom me-2" title="Edit" data-bs-toggle="modal" data-bs-target="#semester">
                                <i class="bi bi-pencil-square me-2"></i>Edit
                            </button>
                            <button type="button" class="btn btn-success btn-sm-custom" title="New" data-bs-toggle="modal" data-bs-target="#semester">
                                <i class="bi bi-plus-circle me-2"></i>New
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>