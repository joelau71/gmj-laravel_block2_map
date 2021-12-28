<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Content Map"],
        ['name' => "Create"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <form id="myform" method="POST"
        action="{{ route('LaravelBlock2Map.create', $element_id) }}" class="relative" enctype="multipart/form-data">

        <x-admin.atoms.required />

        @csrf
        @foreach (config('translatable.locales') as $locale)
            <x-admin.atoms.row>
                <x-admin.atoms.label for="address_{{ $locale }}" class="required mb-2">
                    Google Map Iframe ({{ $locale }})
                </x-admin.atoms.label>
                <textarea name="address_{{ $locale }}" class="w-full" id="address_{{ $locale }}" style="height: 200px;"></textarea>
            </x-admin.atoms.row>
            @error("address_{$locale}")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        @endforeach

        @foreach (config('translatable.locales') as $locale)
            <x-admin.atoms.row>
                <x-admin.atoms.label for="text_{{ $locale }}" class="mb-2">
                    Text ({{ $locale }})
                </x-admin.atoms.label>
                <textarea name="text_{{ $locale }}" id="text_{{ $locale }}" class="tinymce-textarea bg-white" style="height: 200px;"></textarea>
            </x-admin.atoms.row>
        @endforeach

        <hr class="my-10">

        <div class="mt-4 text-right">
            <x-admin.atoms.link href="{{ url()->previous() }}">Back</x-admin.atoms.link>
            <x-admin.atoms.button class="ml-3" id="save">Save</x-admin.atoms.button>
        </div>
    </form>
</x-admin.layout.app>
