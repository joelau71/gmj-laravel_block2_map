<div class="laravel_block2_map" id="laravel_block2_map_{{$element_id}}">
    <x-frontend.row>
        <div>
            {!! $collection->getTranslation("address", $locale) !!}
        </div>
        <div class="mt-6">
            {!! $collection->getTranslation("text", $locale) !!}
        </div>
    </x-frontend.row>
</div>

