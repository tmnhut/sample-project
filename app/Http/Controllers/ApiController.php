<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queries\GridQueries\GridQuery;
use App\Queries\GridQueries\WidgetQuery;

class ApiController extends Controller
{

    public function widgetData(Request $request)
    {

        return GridQuery::sendData($request, new WidgetQuery);
    }

}
