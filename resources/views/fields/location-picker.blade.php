@pushonce('filament-styles:map-picker-component')
@endpushonce
@pushonce('filament-scripts:map-picker-component')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{config('gmap-location-picker.key')}}&libraries=places&v=weekly&language={{app()->getLocale()}}">
</script>
<script>
    function googleMapPicker(config) {
    return {
        value: config.value,
        id: config.id,
        zoom: config.zoom,
        init: function () {
            var center = {
                lat: this?.value?.lat || 0,
                lng: this?.value?.lng || 0
            }

            var map = new google.maps.Map(document.getElementById('map-' + config.id), {
                center: center,
                zoom: this.zoom,
                zoomControl: false,
                ... config.controls
            })

            var marker = new google.maps.Marker({
                position: center,
                map
            })

            map.addListener('click', (event) => {
                this.value = event.latLng.toJSON();
            });

            if(config.controls.searchBoxControl) {
                const input = document.getElementById("pac-input");
                const searchBox = new google.maps.places.SearchBox(input);
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                searchBox.addListener("places_changed", () => {
                    input.value = ''
                    this.value = searchBox.getPlaces()[0].geometry.location
                })
            }

            this.$watch('value', () => {
                let position = this.value
                marker.setPosition(position)
                map.panTo(position)
            })
        }

    }
}
</script>

@endpushonce
<x-forms::field-group :column-span="$formComponent->getColumnSpan()" :error-key="$formComponent->getName()"
    :for="$formComponent->getId()" :help-message="$formComponent->getHelpMessage()" :hint="$formComponent->getHint()"
    :label="$formComponent->getLabel()" :required="$formComponent->isRequired()">

    <div wire:ignore x-data="googleMapPicker({
            @if (Str::of($formComponent->getBindingAttribute())->startsWith('wire:model'))
                value: @entangle($formComponent->getName()){{ Str::of($formComponent->getBindingAttribute())->after('wire:model') }},
            @endif
            id: '{{$formComponent->getId()}}',
            zoom: {{$formComponent->getDefaultZoom()}},
            controls: {{$formComponent->getMapControls()}}
        })" id="{{ $formComponent->getId() }}" x-init="init()">
        @if($formComponent->isSearchBoxControlEnabled())
        <input id="pac-input" type="text" placeholder="Search Box" />
        @endif
        <div id="{{ 'map-' . $formComponent->getId() }}" class="w-full" style="min-height: 40vh"></div>
    </div>
</x-forms::field-group>
