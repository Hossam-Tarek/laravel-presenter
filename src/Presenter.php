<?php

namespace HossamTarek\LaravelPresenter;

class Presenter
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
}
