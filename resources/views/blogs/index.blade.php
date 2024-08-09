<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Blogs</title>
        <!-- Include Bootstrap CSS for styling -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            body {
                margin: 0;
                padding: 0;
                background-image: url("assets/images/blur.jpg"); /* Define your gradient colors */
                background-size: cover; /* Optional: if you want to ensure the gradient covers the whole screen */
                background-repeat: no-repeat; /* Optional: ensures the gradient doesn't repeat */
                background-attachment: fixed; /* Optional: makes the background gradient stay fixed when scrolling */
            }
            .table-wrapper {
                display: flex;
                justify-content: center; /* Centers the table horizontally */
            }
            .table {
                width: 100%; /* Ensures the table takes the full width of its container */
                max-width: 100%; /* Ensures the table does not exceed the container width */
                background-color: wheat;
                border-radius: 30px;
                margin-left: auto;
                margin-right: auto;
            }
            .table th {
                background-color: #555;
            }
            .sticky-header {
                padding: 10px 0; /* Padding around the header content */
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Adds a shadow for better visibility */
                z-index: 1000; /* Ensures the sticky header stays above other content */
                background-color: #9c88ff;
            }
            .a-btn-slide-text {
                display: flex;
                align-items: center;
                padding: 0.375rem 0.75rem; /* Adjust padding */
                font-size: 0.875rem; /* Font size */
                border-radius: 0.2rem; /* Slightly rounded corners */
            }
            .a-btn-slide-text i {
                font-size: 16px; /* Adjust icon size */
            }
            .btn-outline-primary,
            .btn-outline-danger {
                border: 1px solid;
                color: inherit;
                margin-bottom: 10px;
            }
            .btn-outline-danger {
                border-color: #dc3545;
                color: #dc3545;
            }
            .btn-outline-danger:hover {
                background-color: #dc3545;
                color: white;
            }
            .btn-minimalistic {
                display: inline-flex;
                align-items: center;
                padding: 5px 10px; /* Reduce padding for a minimalistic look */
                font-size: 14px; /* Slightly smaller font size */
                color: #555; /* Neutral text color */
                background-color: transparent; /* No background */
                border: none; /* No border */
                border-radius: 3px; /* Slightly rounded corners */
                transition: color 0.2s ease-in-out;
                text-decoration: none; /* Remove underline from links */
                cursor: pointer;
            }
            .btn-minimalistic i {
                margin-right: 5px; /* Space between icon and text */
                font-size: 16px; /* Icon size */
            }
            .btn-minimalistic:hover {
                color: #007bff; /* Slight color change on hover */
            }
            .btn-edit {
                color: #28a745; /* Custom color for Edit button */
            }
            .btn-edit:hover {
                color: #218838; /* Darker shade on hover */
            }
            .btn-delete {
                color: #dc3545; /* Custom color for Delete button */
            }
            .btn-delete:hover {
                color: #c82333; /* Darker shade on hover */
            }
        </style>
    </head>

    <body>
        <div class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #bebebe;">
            <div id="nav-header" style="display: flex; align-items: center;">
                <img src="{{ asset('assets/images/logorm.png') }}" alt="Logo" style="width: 100px; height: auto;" />
                <a href="{{ route('home') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-right: 10px; font-size: 20px;" class="ml-3">SITE BLOGS</a>
                <a href="{{ route('home') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-left: 15px; font-size: 15px;">HOME</a>
                <a href="{{ route('dashboard') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-left: 30px; font-size: 15px;">DASHBOARD</a>
                <a style="margin-left: 850px; font-size: 20px;">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="nav-button" style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        @csrf
                        <i class="fas fa-sign-out-alt"></i>
                        <span style="color: rgb(11, 11, 11);" class="mt-3 ml-5">Logout</span>
                    </form>
                </a>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
            </div>
            <!-- Main content -->
            <div class="col-md-9">
                <!-- Sticky Navbar -->
                <div class="sticky-top sticky-header mt-5">
                    <div class="container">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">BLOG LIST</h2>
                            <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create Blog</a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="container mt-5">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="table-wrapper">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publish Date</th>
                                    <th>Content</th>
                                    <th>Photos</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->author }}</td>
                                    <td>{{ $blog->publish_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $blog->content }}</td>
                                    <td>
                                        @if (is_array($blog->photos)) @foreach ($blog->photos as $photo)
                                        <img src="{{ asset('storage/' . $photo) }}" alt="Photo" style="width: 100px;" />
                                        @endforeach @endif
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <!-- Edit Button -->
                                        <a href="{{ url('blogs', $blog->id) }}/edit" class="btn btn-minimalistic btn-edit">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ url('blogs', $blog->id) }}" method="post" class="d-inline">
                                            @method('delete') @csrf
                                            <button type="submit" class="btn btn-minimalistic btn-delete" onclick="return confirm('Are you sure you want to delete this item?')">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="8" class="text-right">
                                        {!! $blogs->links() !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
