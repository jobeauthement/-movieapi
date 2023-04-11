<?php
/*
What: This line of code is importing the Route class from the Illuminate\Support\Facades namespace.
When: This line of code is typically used at the beginning of a PHP file that defines the routes for a Laravel application.
Where: This line of code is used in a PHP file within a Laravel application.
How: The use keyword is used to import the Route class from the Illuminate\Support\Facades namespace.
Why: This line of code is necessary to use the Route class and define the routes for a Laravel application.
*/

use Illuminate\Support\Facades\Route;


/*
What: This line of code is importing the Request class from the Illuminate\Http namespace.
When: This line of code is typically used in a PHP file that handles incoming HTTP requests in a Laravel application.
Where: This line of code is used in a PHP file within a Laravel application.
How: The use keyword is used to import the Request class from the Illuminate\Http namespace.
Why: This line of code is necessary to use the Request class and handle incoming HTTP requests in a Laravel application.

*/
use Illuminate\Http\Request;

// remember to comment

use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

// Define a route that handles GET requests to the /search URL path. When a search request is received, the closure passed as the second argument to Route::get builds a URL for the Watchmode API based on the user's search query input. The URL includes the API key for the Watchmode API, the search field (which is set to "name" in this case), and the search value (which is set to the user's search query input). This URL is returned as a string. In addition to the URL, the closure could also return a view that displays the search results to the user.
Route::get('/search', function (Request $request) {
    // return $request->input('query');
    $query = $request->input('query');
    $request_url = "https://api.watchmode.com/v1/autocomplete-search/?apiKey=" . env('WATCHMODE_KEY') . "&search_field=name&search_value=" . $query;


    $response = Http::get($request_url);
    $results = $response->json();
    $results = $results['results'];
    return view('pages.results', [
        "results" => $results,
        "query" => ucwords($query)
    ]);
});

Route::get('/movie', function () {
    return view('pages.single');
});
