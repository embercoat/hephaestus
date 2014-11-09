<?php
/*
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */

class controller_kmom4 extends controller_common {
    function before(){
        model::renderer()->add_css('/css/movies.css');
    }
    function index(){
        $movie_page = model::renderer('movies');
        // Fetch all movies
        $movies = model::movie()->get_all();
        $passed_filter = array();
        // Loop through them
        foreach($movies as $m){
            // Title match?
            if(!empty($_GET['title']) && !stripos($m['name'], $_GET['title'])){
                continue;
            }
            // year match?
            if(!empty($_GET['year_min']) && !($m['year'] >= $_GET['year_min'])){
                continue;
            }
            if(!empty($_GET['year_max']) && !($m['year'] <= $_GET['year_max'])){
                continue;
            }
            // Everything matched. Add it to the head that passed the filter.
            $passed_filter[] = $m;
        }
        // Unset $movies to free up some memory.
        unset($movies);
        // Add it to the local renderer
        $movie_page->movies = $passed_filter;
        model::renderer()->add_css('/css/form.css');
        model::renderer()->content = $movie_page->render('template/kmom4/list.php');
    }

}