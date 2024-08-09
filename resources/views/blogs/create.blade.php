<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Create Blog</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            .custom-file-label::after {
                content: "Choose files";
            }
            body {
                margin: 0;
                padding: 48px 0;
                background-image: url("assets/images/bg.jpg"); /* Define your gradient colors */
                background-size: cover; /* Optional: if you want to ensure the gradient covers the whole screen */
                background-repeat: no-repeat; /* Optional: ensures the gradient doesn't repeat */
                background-attachment: fixed; /* Optional: makes the background gradient stay fixed when scrolling */
            }
        </style>
    </head>
    <body>
        <div class="col-md-3"></div>
        <div class="container mt-5">
            <h2>Create a New Blog</h2>
            <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title" required />
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Write your blog content here..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Enter author's name" required />
                </div>
                <div class="form-group">
                    <label for="publish_at">Publish At</label>
                    <input type="datetime-local" class="form-control" id="publish_at" name="publish_at" required />
                </div>

                <div class="form-group">
                    <label for="photos">Photos</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photos" name="photos[]" multiple />
                        <label class="custom-file-label" for="photos">Choose files</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Blog</button>
            </form>
        </div>
        <script>
            $(document).ready(function () {
                bsCustomFileInput.init();
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    </body>
</html>
