<?php

namespace Yassir3wad\TranslatableSlug;

use MrMonat\Translatable\Translatable;

class TranslatableSlug extends Translatable
{
    public $component = "translatable-slug-field";

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->singleLine();
        $this->slug();
    }

    /**
     * Specify the field that contains the actual slug.
     *
     * @param string $slugField
     *
     * @return $this
     */
    public function slug($slugField = 'slug')
    {
        $this->withMeta([__FUNCTION__ => $slugField]);

        return $this;
    }

    public function forLang($lang)
    {
        $this->withMeta([
            'slug_lang' => $lang
        ]);

        return $this;
    }

    /**
     * Resolve the given attribute from the given resource.
     *
     * @param mixed $resource
     * @param string $attribute
     * @return mixed
     */
    protected function resolveAttribute($resource, $attribute)
    {
        if (method_exists($resource, 'getTranslations')) {
            return $resource->getTranslations($attribute);
        }
        return data_get($resource, $attribute);
    }
}
