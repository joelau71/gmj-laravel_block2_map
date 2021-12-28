<?php

namespace GMJ\LaravelBlock2Map\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelBlock2Map\Models\Block;
use GMJ\LaravelBlock2Map\Models\Config;

class BlockController extends Controller
{
    public function index($element_id)
    {
        $config = Config::where("element_id", $element_id)->first();
        if (!$config) {
            return redirect()->route("LaravelBlock2Map.config.create", $element_id);
        }

        $collection = Block::where("element_id", $element_id)->first();
        if ($collection) {
            return redirect()->route("LaravelBlock2Map.edit", $element_id);
        }
        return redirect()->route("LaravelBlock2Map.create", $element_id);
    }

    public function create($element_id)
    {
        $element = Element::find($element_id);
        return view("LaravelBlock2Map::create", compact("element", "element_id"));
    }

    public function store($element_id)
    {

        $element = Element::findOrFail($element_id);
        $rules = [];

        foreach (config("translatable.locales") as $locale) {
            $text[$locale] = request()["text_{$locale}"];
            $address[$locale] = request()["address_{$locale}"];
            $rules["address_{$locale}"] = "required";
        }

        request()->validate($rules);

        $collection = new Block;
        $collection->element_id = $element_id;
        $collection->text = $text;
        $collection->address = $address;
        $collection->save();

        $element->active();
        Alert::success("Add Element {$element->title} Map success");
        return redirect()->route("admin.element.index");
    }

    public function edit($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Block::where("element_id", $element_id)->first();
        return view("LaravelBlock2Map::edit", compact("element", "element_id", "collection"));
    }

    public function update($element_id)
    {

        $element = Element::findOrFail($element_id);

        foreach (config("translatable.locales") as $locale) {
            $text[$locale] = request()["text_{$locale}"];
            $address[$locale] = request()["address_{$locale}"];
            $rules["address_{$locale}"] = "required";
        }

        request()->validate($rules);

        $collection = Block::where("element_id", $element_id)->first();
        $collection->text = $text;
        $collection->address = $address;
        $collection->save();

        $element = Element::find($element_id);
        Alert::success("Edit Element {$element->title} Map success");
        return redirect()->route("admin.element.index");
    }
}
