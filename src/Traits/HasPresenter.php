<?php

namespace HossamTarek\LaravelPresenter\Traits;

trait HasPresenter
{

    public function __call($method, $parameters)
    {
        try {
            return parent::__call($method, $parameters);
        } catch (\BadMethodCallException $e) {
            $presenterObject = $this->getPresenterObject();
            if (! method_exists($presenterObject, $method)) {
                throw $e;
            }

            return $presenterObject->{$method}(...$parameters);
        }
    }

    public function __get($name)
    {
        $parentValue = parent::__get($name);
        if ($parentValue !== null) {
            return $parentValue;
        }

        $presenterObject = $this->getPresenterObject();
        $methodName = $this->snakeToCamelCase($name);

        return method_exists($presenterObject, $methodName) ?
            $this->getPresenterObject()->{$methodName}() :
            null;
    }

    private function snakeToCamelCase($string)
    {
        return str_replace(' ', '', lcfirst(ucwords(str_replace('_', ' ', $string))));
    }

    private function getPresenterObject()
    {
        return new self::$presenterName($this);
    }
}
