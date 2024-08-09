<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Edit Blog</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            .custom-file-label::after {
                content: "Choose files";
            }
            body {
                background-image: url("assets/images/blur.jpg"); /* Laravel public folder path */
                background-size: cover; /* Makes sure the image covers the whole screen */
                background-repeat: no-repeat; /* Ensures the image doesn't repeat */
                background-attachment: fixed; /* Makes the background image stay fixed when scrolling */
            }
        </style>
    </head>
    <body>
        <div class="col-md-3"></div>
        <div class="container mt-5">
            <h2>Edit Blog</h2>
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" placeholder="Enter blog title" required />
                </div>
                <div class="form-group">
                    <label for="publish_at">Publish At</label>
                    <input type="datetime-local" class="form-control" id="publish_at" name="publish_at" value="{{ $blog->publish_at->format('Y-m-d\TH:i') }}" required />
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Write your blog content here..." required>{{ $blog->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ $blog->author }}" placeholder="Enter author's name" required />
                </div>
                <div class="form-group">
                    <label for="photos">Photos</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photos" name="photos[]" multiple />
                        <label class="custom-file-label" for="photos">Choose files</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Blog</button>
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
