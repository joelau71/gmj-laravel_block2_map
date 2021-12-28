<div class="laravel_block2_map" id="laravel_block2_map_{{$element_id}}">
    <div class="container mx-auto px-8">
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 mt-6 md:mt-0">
                <div class="px-4">
                    {!! $collection->getTranslation("text", $locale) !!}
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="px-4">
                    {!! $collection->getTranslation("address", $locale) !!}
                </div>
            </div>
        </div>
    </div>
</div>

