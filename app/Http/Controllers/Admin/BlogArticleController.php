<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogArticleController extends Controller
{
    /**
     * Display a listing of the blog articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogArticles = BlogArticle::all(); // Fetch all blog articles
        return view('admin.blog.index', compact('blogArticles'));
    }

    /**
     * Show the form for creating a new blog article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create'); // Return the view for creating a new blog article
    }
    
     /**
     * Show the  blog article.
     *
     * @return BlogData
     */
    public function show($slug)
    {
        // Find the blog article by its slug
        $blogArticle = BlogArticle::where('slug', $slug)->firstOrFail();
        // Return the view for displaying the blog post
        return view('blog.show', compact('blogArticle'));
    }

    /**
     * Store a newly created blog article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_articles,slug',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'is_published' => 'nullable|boolean',
            'nofollow' => 'nullable|boolean',
            'noindex' => 'nullable|boolean',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image file
        ]);

        // Handle the cover image upload
        if ($request->hasFile('cover_image')) {
            // Get the original file name
            $originalName = $request->cover_image->getClientOriginalName();
            
            // Store the image with the original name, prepended with a timestamp to ensure uniqueness
            $fileName = time() . '_' . $originalName;
            $request->cover_image->storeAs('public/cover_images', $fileName);
            
            // Save the path to the image
            $validated['cover_image'] = 'cover_images/' . $fileName;
        }

        BlogArticle::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?: Str::slug($validated['title']),
            'content' => $validated['content'],
            'meta_title' => $validated['meta_title'],
            'meta_keywords' => $validated['meta_keywords'],
            'meta_description' => $validated['meta_description'],
            'author' => $validated['author'],
            'nofollow' => $request->boolean('nofollow'),
            'noindex' => $request->boolean('noindex'),
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
            'cover_image' => $validated['cover_image'] ?? null, // Save the cover image path
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog article created successfully.');
    }

    /**
     * Show the form for editing the specified blog article.
     *
     * @param  \App\Models\BlogArticle  $blogArticle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogArticle = BlogArticle::find($id);
    
        if (!$blogArticle) {
            // If the blog article is not found, redirect back with an error message
            return redirect()->back()->with('error', 'Blog article not found.');
        }
    
        return view('admin.blog.edit', compact('blogArticle'));
    }

    /**
     * Update the specified blog article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogArticle  $blogArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Fetch the BlogArticle using the ID from the route
        $blogArticle = BlogArticle::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('blog_articles', 'slug')->ignore($blogArticle->id),
            ],
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'nofollow' => 'nullable|boolean',
            'noindex' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the image file
        ]);

        // Handle the cover image upload
        if ($request->hasFile('cover_image')) {

          
            // Get the original file name with extension
            $originalName = $request->cover_image->getClientOriginalName();
            
            // Create a unique file name using a timestamp and the original name
            $fileName = time() . '_' . $originalName;
            
            // Store the file in the 'public/cover_images' directory
            $request->cover_image->storeAs('public/cover_images', $fileName);
            
            // Update the validated data with the cover image path
            $validated['cover_image'] = 'cover_images/' . $fileName;
            // Optionally, delete the old cover image file from storage if it exists
            if ($blogArticle->cover_image) {
                \Storage::delete('public/' . $blogArticle->cover_image);
            }
        }

        // Update the blog article with the new data
        $updated = $blogArticle->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?: $blogArticle->slug,
            'content' => $validated['content'],
            'meta_title' => $validated['meta_title'],
            'meta_keywords' => $validated['meta_keywords'],
            'meta_description' => $validated['meta_description'],
            'author' => $validated['author'],
            'nofollow' => $request->boolean('nofollow'),
            'noindex' => $request->boolean('noindex'),
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->boolean('is_published') ? now() : null,
            'cover_image' => $validated['cover_image'] ?? $blogArticle->cover_image, // Use new or existing cover image
        ]);

        if ($updated) {
            return redirect()->route('admin.blog.index')->with('success', 'Blog article updated successfully.');
        } else {
            \Log::error('Failed to update BlogArticle with ID: ' . $blogArticle->id);
            return redirect()->back()->with('error', 'Blog article update failed.');
        }
    }

    /**
     * Remove the specified blog article from storage.
     *
     * @param  \App\Models\BlogArticle  $blogArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $blogArticle = BlogArticle::findOrFail($id);
        $blogArticle->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog article deleted successfully.');
    }
    

    
}