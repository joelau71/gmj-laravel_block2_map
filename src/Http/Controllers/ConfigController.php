<?php

namespace GMJ\LaravelBlock2Map\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelBlock2Map\Models\Config;

class ConfigController extends Controller
{

    public function create($element_id)
    {
        $element = Element::findOrFail($element_id);
        return view("LaravelBlock2MapConfig::create", compact("element", "element_id"));
    }

    public function store($element_id)
    {
        $element = Element::findOrFail($element_id);

        request()->validate([
            "layout" => "required",
        ]);

        //dd("store...");
        $collection = new Config();
        $collection->element_id = $element_id;
        $collection->layout = request()->layout;
        $collection->save();

        $element->active();
        Alert::success("Add Element {$element->title} Map Config success");
        return redirect()->route("LaravelBlock2Map.create", $element_id);
    }

    public function edit($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Config::where("element_id", $element_id)->first();
        return view("LaravelBlock2MapConfig::edit", compact("element", "element_id", "collection"));
    }

    public function update($element_id)
    {
        $element = Element::findOrFail($element_id);

        request()->validate([
            "layout" => "required",
        ]);

        $collection = Config::where("element_id", $element_id)->first();
        $collection->layout = request()->layout;
        $collection->save();

        Alert::success("Edit Element {$element->title} Map Config success");
        return redirect()->route("LaravelBlock2Map.edit", $element_id);
    }
}
