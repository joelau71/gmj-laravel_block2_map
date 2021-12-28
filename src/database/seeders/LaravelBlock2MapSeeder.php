<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\ElementTemplate;
use Faker\Factory;
use GMJ\LaravelBlock2Map\Models\Block;
use GMJ\LaravelBlock2Map\Models\Config;
use Illuminate\Database\Seeder;

class LaravelBlock2MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ElementTemplate::where("component", "LaravelBlock2Map")->first();

        if ($template) {
            return false;
        }

        $template = ElementTemplate::create(
            [
                "title" => "Laravel Block2 Map",
                "component" => "LaravelBlock2Map",
            ]
        );

        $element = Element::create([
            "template_id" => $template->id,
            "title" => "laravel-block2-map-sample",
            "is_active" => 1
        ]);

        $faker = Factory::create();

        Config::create([
            "element_id" => $element->id,
            "layout" => "left-content-right-map"
        ]);

        foreach (config('translatable.locales') as $locale) {
            $address[$locale] = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2193.908566620719!2d114.13451044517149!3d22.36496516316324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403f899b773529f%3A0x8c383948b99c3da!2zTWljMTguY29tIOWvjOW8t-WwiOalremfs-mfvyBQcm8gYXVkaW8gRXF1aXBtZW50!5e0!3m2!1sen!2shk!4v1637747971630!5m2!1sen!2shk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
            $text[$locale] = $faker->text(100);
        }

        Block::create([
            "element_id" => $element->id,
            "address" => $address,
            "text" => $text
        ]);
    }
}
