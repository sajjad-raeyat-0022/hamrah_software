<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        // create sitemap
        $sitemap = App::make("sitemap");

        // set cache
        $sitemap->setCache('laravel.sitemap-index', 60);

        // add sitemaps (loc, lastmod (optional))
        $sitemap->addSitemap(URL::to('sitemap-courses'));
        $sitemap->addSitemap(URL::to('sitemap-tags'));

        // show sitemap
        return $sitemap->render('sitemapindex');
    }
    public function sitemapTags()
    {
        // create sitemap
        $sitemap_tags = App::make("sitemap");

        // set cache
        $sitemap_tags->setCache('laravel.sitemap-tags', 60);

        // add items
        $tags = Tag::all();

        foreach ($tags as $tag) {
            $sitemap_tags->add($tag->name, $tag->updated_at, '0.5', 'weekly');
        }

        // show sitemap
        return $sitemap_tags->render('xml');
    }
    public function sitemapCourses()
    {
        // create sitemap
        $sitemap_courses = App::make("sitemap");

        // set cache
        $sitemap_courses->setCache('laravel.sitemap-courses', 60);

        // add items
        $courses = Course::all();

        foreach ($courses as $course) {
            $primary_image = [];
            array_push($primary_image, ['url' => url(env('EDU_COURSE_IMAGE_UPLOAD_PATH') . $course->primary_image), 'title' => $course->name]);
            $sitemap_courses->add($course->slug, $course->update_at, '1.0', 'weekly', $primary_image);
        }

        $sitemap_courses->addSitemap(URL::to('sitemap-courses-videos'));

        // show sitemap
        return $sitemap_courses->render('xml');
    }
    public function sitemapCoursesMovies()
    {
        // create sitemap
        $sitemap_courses_movies = App::make("sitemap");

        // set cache
        $sitemap_courses_movies->setCache('laravel.sitemap-courses-movies', 60);

        // add items
        $courses = Course::all();

        foreach ($courses as $course) {
            $movies = [];

            foreach ($course->download_movie as $movie) {
                array_push($movies, ['url' => url(env('EDU_COURSE_MOVIES_UPLOAD_PATH') . $movie->movie_download_link), 'title' => $movie->movie_name]);
            }

            $sitemap_courses_movies->add($course->slug, $movie->update_at, '1.0', 'monthly',$movies);
        }

        // show sitemap
        return $sitemap_courses_movies->render('xml');
    }
}
