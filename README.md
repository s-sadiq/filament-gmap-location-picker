# Filament Google map location picker

A Filament field to enter and update latitude longitude based on map selection

# Installation 
You can install the package via composer: 
```bash
composer require sadiq/filament-gmap-location-picker
```

# Configuration
You have to set google maps javascript api key in your .env to use the package

```env
GMAP_LOCATION_PICKER_KEY={YOUR_GOOGLE_MAP_KEY}
```

# Basic usage
Use the field in your filament resources.
If you need to bind the field to model property use resource field
**Sadiq\GMapLocationPicker\Resources\Fields\LocationPicker** Or you can use **Sadiq\GMapLocationPicker\Fields\LocationPicker** and bind it to livewire property in your resource edit/create pages

```php
<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Sadiq\GMapLocationPicker\Resources\Fields\LocationPicker;
use Filament\Resources\Forms\Form;
...

class FilamentResource extends Resource
{
	...
    public static function form(Form $form)
    {
        return $form->schema([
            LocationPicker::make('point')
                ->defaultZoom(3)
                ->mapControls([
                    'mapTypeControl' => false,
                    'scaleControl' => true,
                    'streetViewControl' => false,
                    'rotateControl' => false,
                    'fullscreenControl' => true,
                    'searchBoxControl' => false
                ])
        ]);
    }
	...
}
```

# Value format
The field output the value as array
```
[
	'lat' => 0,
	'lng' => 0
]
```

