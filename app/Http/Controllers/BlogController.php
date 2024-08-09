<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author' => 'required|max:255',
            'publish_at' => 'required|date',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                try {
                    $path = $photo->store('photos', 'public');
                    Log::info('Photo uploaded: ' . $path);
                    $photos[] = $path;
                } catch (\Exception $e) {
                    Log::error('File upload failed: ' . $e->getMessage());
                    return redirect()
                        ->back()
                        ->withErrors(['photos' => 'Failed to upload one or more photos.']);
                }
            }
            $validatedData['photos'] = $photos;
        } else {
            $validatedData['photos'] = null;
        }

        // Associate the blog with the currently authenticated user
        $validatedData['user_id'] = auth()->id();

        try {
            $blog = Blog::create($validatedData);
            Log::info('Blog created with ID: ' . $blog->id);
        } catch (\Exception $e) {
            Log::error('Blog creation failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['general' => 'Failed to create blog.']);
        }

        return redirect('blogs')->with('success', 'Blog created successfully.');
    }

    public function show(string $id)
    {
        $blog = Blog::findOrFail($id); // Fetch the blog post by ID or throw a 404 error if not found
        return view('show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'publish_at' => 'required|date',
            'content' => 'required',
            'author' => 'required|max:255',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            $photos = [];
            foreach ($request->file('photos') as $photo) {
                try {
                    $path = $photo->store('photos', 'public');
                    Log::info('Photo uploaded: ' . $path);
                    $photos[] = $path;
                } catch (\Exception $e) {
                    Log::error('File upload failed: ' . $e->getMessage());
                    return redirect()
                        ->back()
                        ->withErrors(['photos' => 'Failed to upload one or more photos.']);
                }
            }
            $validatedData['photos'] = $photos;
        } else {
            $validatedData['photos'] = null;
        }

        try {
            $blog = Blog::findOrFail($id);
            $blog->update($validatedData);
            Log::info('Blog updated with ID: ' . $blog->id);
        } catch (\Exception $e) {
            Log::error('Blog update failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withErrors(['general' => 'Failed to update blog.']);
        }

        return redirect()
            ->route('blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->to('blogs');
    }

    public function dashboard()
    {
        $blogs = Blog::orderBy('publish_at', 'desc')->paginate(8); // Adjust the number as needed
        return view('dashboard', compact('blogs'));
    }
}
