<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Http\AuthTraits\OwnsRecord;
use App\Widget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WidgetController extends Controller
{
    use OwnsRecord;

    public function __construct()
    {
        $this->middleware(['auth', 'admin'], ['except' => ['index', 'show']] );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = Widget::paginate(10);
        return view('widget.index', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('widget.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:widgets|string|max:40',
        ]);

        $slug = str_slug($request->name, "-");
        $widget = Widget::create(['name' => $request->name,'slug' => $slug,'user_id' => Auth::id()]);
        $widget->save();
        alert()->success('Congrats!', 'You made a Widget');
        return Redirect::route('widget.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Widget $widget, $slug = '')
    {
        if ($widget->slug !== $slug) {
            return Redirect::route('widget.show', [
                'widget' => $widget,
                'slug' => $widget->slug
            ], 301);
        }
        return view('widget.show', compact('widget'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Widget $widget)
    {
        return view('widget.edit', compact('widget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Widget $widget)
    {
        if ( !$this->adminOrCurrentUserOwns($widget)){
            throw new UnauthorizedException;
        }
        $this->validate($request, [
            'name' => 'required|string|max:40|unique:widgets,name,'.$widget->id
        ]);
        $slug = str_slug($request->name, "-");
        $widget->update(['name' => $request->name,
            'slug' => $slug,
            'user_id' => Auth::id()]);
        alert()->success('Congrats!', 'You updated a widget');
        return Redirect::route('widget.show', [
            'widget' => $widget, 'slug' =>$slug
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Widget::destroy($id);
        alert()->overlay('Attention!', 'You deleted a widget', 'error');
        return Redirect::route('widget.index');
    }
}
