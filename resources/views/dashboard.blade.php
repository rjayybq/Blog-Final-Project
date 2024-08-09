<!-- Include Bootstrap in your main layout or Blade file -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>BLOG POSTED</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <style>
            /* Custom styles */
            body {
                margin: 0;
                padding: 48px 0;
                background-image: url("assets/images/graybackground.jpg"); /* Define your gradient colors */
                background-size: cover; /* Optional: if you want to ensure the gradient covers the whole screen */
                background-repeat: no-repeat; /* Optional: ensures the gradient doesn't repeat */
                background-attachment: fixed; /* Optional: makes the background gradient stay fixed when scrolling */
            }
            .articles {
                display: grid;
                max-width: 1200px;
                margin: 0 auto;
                padding: 24px;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Adjusted min width for better layout */
                gap: 16px;
            }
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
                position: relative; /* Enable positioning for child elements */
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
                justify-content: space-between; /* Ensure content is spaced evenly */
            }
            h2 {
                font-family: Arial, Helvetica, sans-serif, cursive;
                font-size: 1.4rem;
                color: black;
                margin: 0 0 8px 0;
            }
            .author,
            .publish-date {
                font-size: 0.9rem;
                color: #555;
                margin: 0 0 4px 0;
            }
            .publish-date {
                color: #777;
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
            .expanded-content-text {
                margin: 0;
            }
            /* Custom styles for the navbar */
            .navbar {
                background-color: #333;
                color: #fff;
                padding: 10px;
                position: fixed;
                width: 100%;
                top: 0;
                left: 0;
                z-index: 1000;
                display: flex;
                justify-content: flex-end;
            }
            .navbar a {
                color: #fff;
                text-decoration: none;
                padding: 10px 15px;
                font-size: 1.1rem;
            }
            .navbar a:hover {
                background-color: #575757;
                border-radius: 5px;
            }
            .container {
                margin-top: 60px; /* Adjust if needed */
            }
            /* Prevent background scrolling when card is expanded */
            body.no-scroll {
                overflow: hidden;
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
                <img src="{{ asset('assets/images/logorm.png') }}" alt="Logo" style="width: 80px; height: auto;" />
                <a id="nav-title" href="https://codepen.io" target="_blank" style="color: rgb(11, 11, 11); text-decoration: none; font-size: 24px; margin-right: 20px;"><i class="fab fa-codepen"></i>SITE BLOGS</a>
                <a href="{{ route('blogs.index') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-right: 10px;">BLOGS</a>
            </div>

            <div id="nav-auth" style="display: flex; align-items: center;">
                {{-- <a href="{{ route('login') }}" style="color: rgb(11, 11, 11); text-decoration: none; margin-right: 10px;">Login</a>
                <a href="{{ route('register') }}" style="color: rgb(11, 11, 11); text-decoration: none;">Register</a> --}}
            </div>
        </div>

        <div class="container">
            <!-- Blog Cards Section -->
            <section class="articles">
                @forelse($blogs as $blog)
                <article onclick="toggleContent(this)">
                    <div class="article-content">
                        <figure>
                            <img src="{{ $blog->photos[0] ?? 'https://picsum.photos/800/450' }}" alt="{{ $blog->title }}" />
                        </figure>
                        <div class="article-body">
                            <h2>{{ $blog->title }}</h2>
                            <p class="author">By {{ $blog->author }}</p>
                            <p class="publish-date">Published on {{ $blog->publish_at->format('M d, Y') }}</p>
                            <p class="content">{{ Str::limit($blog->content, 100) }}</p>
                        </div>
                        <div class="expanded-content">
                            <p class="expanded-content-text">{{ $blog->content }}</p>
                            <p class="created-by">Posted by: {{ $blog->user->name }}</p>
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
        </div>

        <script>
            function toggleContent(article) {
                if (article.classList.contains("expanded")) {
                    article.classList.remove("expanded");
                    document.body.classList.remove("no-scroll"); // Allow background scrolling
                } else {
                    document.querySelectorAll("article.expanded").forEach(function (el) {
                        el.classList.remove("expanded"); // Collapse all other expanded cards
                    });
                    article.classList.add("expanded");
                    document.body.classList.add("no-scroll"); // Prevent background scrolling
                    article.scrollIntoView({ behavior: "smooth", block: "center" }); // Center the expanded card
                }
            }
        </script>
    </body>
</html>
