<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Home</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <style>
            /* Include your styles here */
            article {
                border-radius: 16px;
                background: #fff;
                box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
                overflow: hidden;
                transition: transform 0.4s ease-in-out;
                cursor: pointer;
                display: flex;
                flex-direction: column;
                text-align: left;
                height: 350px; /* Fixed height for the card */
                position: relative;
            }
            article.expanded {
                transform: scale(1.1);
                z-index: 10;
                height: auto; /* Allow height to expand */
                background: rgba(255, 255, 255, 0.95); /* Slight transparency for better readability */
                position: absolute;
                top: 100px; /* Add top margin */
                left: 50%; /* Position relative to the center */
                transform: translate(-50%, 20px); /* Center horizontally and adjust for the top margin */
                width: 80%; /* Reduce the width to prevent overflow */
                overflow-y: auto; /* Allow scrolling within the expanded card */
                max-height: 80vh; /* Limit the maximum height of the expanded card */
                padding: 16px; /* Add padding to ensure text doesn't touch the edges */
                margin-bottom: 20px; /* Add bottom margin */
            }
            .article-content {
                display: flex;
                flex-direction: column; /* Ensure the content is arranged vertically */
                height: 100%;
            }
            article a::after {
                position: absolute;
                inset-block: 0;
                inset-inline: 0;
                cursor: pointer;
                content: "";
            }
            h2 {
                font-family: Arial, Helvetica, sans-serif, cursive;
                font-size: 1.4rem;
                color: black;
                margin: 0 0 8px 0;
            }
            article .author {
                font-size: 1rem;
                color: #555;
                margin-bottom: 10px;
            }
            figure {
                margin: 0;
                padding: 0;
                height: 50%; /* Fill half the height of the card */
                overflow: hidden;
            }
            article img {
                width: 100%;
                height: 100%; /* Make image fill the figure */
                object-fit: cover; /* Ensure all images have the same size */
            }
            .article-body {
                padding: 16px;
                height: 50%; /* Fill half the height of the card */
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                overflow: hidden;
            }
            .expanded-content {
                display: none;
                padding: 16px;
                background: #f9f9f9;
                border-top: 1px solid #ddd;
            }
            article.expanded .expanded-content {
                text-align: center; /* Center align text */
                overflow: visible; /* Allow overflow in expanded state */
                padding: 16px;
            }
            article a {
                display: inline-flex;
                align-items: center;
                text-decoration: none;
                color: #28666e;
            }
            .expanded-content-text {
                margin: 0;
            }
            .publish-date {
                color: #777;
            }
            * {
                box-sizing: border-box;
            }
            body {
                margin: 0;
                padding: 0;
                background-image: url("assets/images/graybackground.jpg"); /* Define your gradient colors */
                background-size: cover; /* Optional: if you want to ensure the gradient covers the whole screen */
                background-repeat: no-repeat; /* Optional: ensures the gradient doesn't repeat */
                background-attachment: fixed; /* Optional: makes the background gradient stay fixed when scrolling */
            }
            .read-more {
                color: #28666e;
                text-decoration: none;
                font-weight: bold;
                margin-top: auto; /* Push it to the bottom */
                align-self: flex-start;
                background-color: white; /* Background color for better visibility */
                padding: 5px; /* Padding for better visibility */
            }
            .articles {
                display: grid;
                max-width: 1200px;
                margin: 0 auto;
                padding: 24px;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Adjusted min width for better layout */
                gap: 16px;
            }

            .sr-only:not(:focus):not(:active) {
                clip: rect(0 0 0 0);
                clip-path: inset(50%);
                height: 1px;
                overflow: hidden;
                position: absolute;
                white-space: nowrap;
                width: 1px;
            }
            .thick-marquee {
                font-size: 24px;
                padding: 10px;
                line-height: 1.5;
                position: fixed;
                width: 100%;
                z-index: 1;
                background: #008b8b;
                color: #fff;
                margin: 0;
                top: 0;
            }

            .content {
                font-size: 0.8rem;
                color: #333;
                margin: 8px 0;
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3; /* Limit to 3 lines */
                -webkit-box-orient: vertical;
            }
            .box {
                width: 200px;
                height: 100px;
                border: 1px solid #000;
                padding: 10px;
                background-color: #f0f0f0;
                position: absolute;
                top: -10px;
                right: 10px;
                text-align: center;
                border-radius: 16px;
            }

            .toggle-theme {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .pagination-navbar {
                position: fixed;
                bottom: 0;
                left: 0;
                width: auto; /* Set width to auto to avoid taking the entire row */
                background-color: #333; /* Navbar background color */
                padding: 5px 10px; /* Add some padding for spacing */
                text-align: left; /* Align content to the left */
                box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
                z-index: 1000; /* Ensure it stays on top */
                border-radius: 0 4px 0 0; /* Add rounded corner on top-right */
            }
            .pagination-navbar .pagination {
                margin: 0;
                display: flex;
                justify-content: flex-start; /* Align items to the left */
                list-style: none;
            }
            .pagination-navbar .page-item {
                margin: 0 3px; /* Margin between pagination items */
            }
            .pagination-navbar .page-item a {
                padding: 5px 10px;
                color: white;
                background-color: #444;
                border-radius: 4px;
                text-decoration: none;
                transition: background-color 0.3s;
            }
            .pagination-navbar .page-item a:hover {
                background-color: #555;
            }
            .pagination-navbar .page-item.active span {
                background-color: #007bff;
                border-radius: 4px;
                color: white;
            }
            .pagination-navbar .page-item.disabled span {
                color: #777;
            }
        </style>
    </head>
    <body>
        <div class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background-color: #bebebe;">
            <div id="nav-header" style="display: flex; align-items: center;">
                <img src="{{ asset('assets/images/logorm.png') }}" alt="Logo" style="width: 100px; height: auto;" />
                <a href="{{ route('home') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-right: 10px; font-size: 20px;" class="ml-3">SITE BLOGS</a>
                <a href="{{ route('dashboard') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-left: 50px; font-size: 15px;">DASHBOARD</a>
                <a href="{{ route('blogs.index') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-left: 50px; font-size: 15px;">BLOGS</a>
                <a style="margin-left: 900px; font-size: 20px;">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="nav-button" style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        @csrf
                        <i class="fas fa-sign-out-alt"></i>
                        <span style="color: rgb(11, 11, 11);" class="mt-3 ml-5">Logout</span>
                    </form>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 sidebar-container"></div>
            </div>
        </div>

        <div class="container">
            <!-- Blog Cards Section -->
            <section class="articles">
                @forelse($blogs as $blog)
                <article>
                    <div class="article-content">
                        <figure>
                            <img src="{{ $blog->photos[0] ?? 'https://picsum.photos/800/450' }}" alt="{{ $blog->title }}" />
                        </figure>
                        <div class="article-body">
                            <h2>{{ $blog->title }}</h2>
                            <p class="author">By {{ $blog->author }}</p>
                            <p class="publish-date">Published on {{ $blog->publish_at->format('M d, Y') }}</p>
                            <p class="content">{{ Str::limit($blog->content, 100) }}</p>
                            <a href="javascript:void(0);" class="read-more" onclick="toggleContent(this)"></a>
                            <div class="expanded-content">
                                <p class="expanded-content-text">{{ $blog->content }}</p>
                                <p class="created-by">Posted by: {{ $blog->user->name }}</p>
                            </div>
                        </div>
                    </div>
                </article>
                @empty
                <p>No blogs found.</p>
                @endforelse
            </section>
            <div class="pagination-navbar">
                {{ $blogs->links() }}
            </div>
            <!--  -->
        </div>

        <script>
            function toggleContent(element) {
                const article = element.closest("article");
                const content = article.querySelector(".content");
                const expandedContent = article.querySelector(".expanded-content");
                if (article.classList.contains("expanded")) {
                    article.classList.remove("expanded");
                    element.textContent = "Read more";
                    content.style.display = "block"; // Show truncated content again
                    expandedContent.style.display = "none"; // Hide expanded content
                    document.body.classList.remove("no-scroll"); // Allow background scrolling
                } else {
                    article.classList.add("expanded");
                    element.textContent = "Read less";
                    content.style.display = "none"; // Hide truncated content
                    expandedContent.style.display = "block"; // Show expanded content
                    document.body.classList.add("no-scroll"); // Prevent background scrolling
                    article.scrollIntoView({ behavior: "smooth", block: "center" }); // Center the expanded card
                }
            }
        </script>
    </body>
</html>
