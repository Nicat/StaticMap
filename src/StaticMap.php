<?php

namespace Nicat\StaticMap;

class StaticMap {

    protected $config;

    public function __construct()
    {
        $this->config = config('static-map');
    }

    public function overrideConfig($options)
    {
        $this->config = array_merge($this->config, $options);
    }

    /**
     * Google
     *
     * @param string $center  Center location
     * @param array  $options Overwrite config
     *
     * @return string Returns the phrase passed in
     */
    public function Google($center, $options = null)
    {
        if ($options)
        {
            $this->overrideConfig($options);
        }
        /* Parameters of static map url */
        $zoom = '&zoom=' . $this->config['zoom'];
        $size = '&size=' . $this->config['width'] . 'x' . $this->config['height'];
        $mapType = '&maptype=' . $this->config['mapType'];
        $imageFormat = '&format=' . $this->config['imageFormat'];
        $markers = null;
        if (isset($this->config['markers']))
        {
            if (is_array($this->config['markers']))
            {
                $hiddenMarkers = [];
                foreach ($this->config['markers'] as $marker)
                {
                    $notArray = false;
                    if ( ! is_array($marker))
                    {
                        $marker = $this->config['markers'];
                        $notArray = true;
                    }

                    if ( ! isset($marker['center']))
                    {
                        throw new \Exception('Center of Market not defined');
                    }

                    $centerOfMarker = $marker['center'];
                    unset($marker['center']);
                    $hiddenMarkers[] = "&markers=" . $this->attributes($marker, '', [':', '%7C']) . $centerOfMarker;

                    if ($notArray)
                    {
                        break;
                    }

                }

                $markers = implode('', $hiddenMarkers);

            } else
            {
                $markers = '&markers=' . $center;
            }
        }

        $url = 'http://maps.googleapis.com/maps/api/staticmap?key=' . $this->config['key'] . '&center=' . $center . $zoom . $size . $mapType . $imageFormat . $markers;

        return $url;
    }

    /**
     * Generate Static Google map Link
     *
     * @param       $center
     * @param array $options    Options of Static Map
     * @param array $imgOptions Attributes of Img tag
     *
     * @return string
     */
    public function GoogleWithLink($center, $options = null, $imgOptions = null)
    {
        return '<a class="google-static-map" target="_blank" href="https://www.google.com/maps/place/' . $center . '">' . $this->GoogleWithImg($center, $options, $imgOptions) . '</a>';
    }

    /**
     * Generate Static Google map With Img tag
     *
     * @param       $center
     * @param array $options    Options of Static Map
     * @param array $imgOptions Attributes of Img tag
     *
     * @return string
     */
    public function GoogleWithImg($center, $options = null, $imgOptions = null)
    {
        $attributes = $this->attributes($imgOptions);

        return '<img ' . $attributes . ' src="' . $this->Google($center, $options) . '" />';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     * @param array  $merger
     *
     * @return string
     */
    protected function attributeElement($key, $value, $merger)
    {
        if (is_numeric($key))
        {
            $key = $value;
        }

        if ( ! is_null($value))
        {
            return $key . $merger[0] . e($value) . $merger[1];
        }
    }

    /**
     * Build an HTML attribute string from an array.
     *
     * @param array  $attributes
     * @param string $merger
     * @param array  $childMerger
     *
     * @return string
     */
    public function attributes($attributes, $merger = ' ', $childMerger = ['="', '"'])
    {
        $all = [];

        foreach ((array)$attributes as $key => $value)
        {
            $element = $this->attributeElement($key, $value, $childMerger);

            if ( ! is_null($element))
            {
                $all[] = $element;
            }
        }

        return count($all) > 0 ? $merger . implode($merger, $all) : '';
    }
}
