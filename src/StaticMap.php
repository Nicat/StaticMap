<?php

namespace Nicat\StaticMap;

class StaticMap {

    protected $config;

    /**
     * Create a new Skeleton Instance
     */
    public function __construct()
    {
        $this->config = config('static-map');
    }

    public function overrideConfig($options)
    {
        $this->config = array_merge($this->config, $options);
    }

    /**
     * Friendly welcome
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

        $url = 'http://maps.googleapis.com/maps/api/staticmap?center=' . $center . $zoom . $size . $mapType . $imageFormat;

        return $url;
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
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     *
     * @return string
     */
    public function attributes($attributes)
    {
        $html = [];

        foreach ((array)$attributes as $key => $value)
        {
            $element = $this->attributeElement($key, $value);

            if ( ! is_null($element))
            {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function attributeElement($key, $value)
    {
        if (is_numeric($key))
        {
            $key = $value;
        }

        if ( ! is_null($value))
        {
            return $key . '="' . e($value) . '"';
        }
    }
}
