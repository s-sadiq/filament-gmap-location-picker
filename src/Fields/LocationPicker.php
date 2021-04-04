<?php

namespace Sadiq\GMapLocationPicker\Fields;

use Filament\Forms\Components\Field;

class LocationPicker extends Field
{
    public $view = 'gmap-location-picker::fields.location-picker';

    protected $defaultZoom = 3;

    protected $controls = [
        'mapTypeControl' => false,
        'scaleControl' => true,
        'streetViewControl' => false,
        'rotateControl' => false,
        'fullscreenControl' => true,
        'searchBoxControl' => false
    ];

    /**
     * get map default zoom
     *
     * @return int
     */
    public function getDefaultZoom()
    {
        return $this->defaultZoom;
    }

    /**
     * set map default zoom
     *
     * @param int $defaultZoom
     * @return $this
     */
    public function defaultZoom($defaultZoom)
    {
        $this->configure(function () use ($defaultZoom) {
            $this->defaultZoom = $defaultZoom;
        });

        return $this;
    }

    public function getMapControls()
    {
        return json_encode($this->controls);
    }

    public function isSearchBoxControlEnabled()
    {
        return $this->controls['searchBoxControl'];
    }

    public function mapControls(array $controls)
    {
        $this->configure(function () use ($controls) {
            $this->controls = array_merge($this->controls, $controls);
        });

        return $this;
    }
}
