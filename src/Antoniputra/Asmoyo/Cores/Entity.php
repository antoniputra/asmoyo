<?php namespace Antoniputra\Asmoyo\Cores;

use Validator, DB, Eloquent, Cache;
use Antoniputra\Asmoyo\Cores\Exceptions\NoValidationRules;
use Antoniputra\Asmoyo\Cores\Exceptions\NoValidatorInstantiated;

abstract class Entity extends Eloquent
{
    /**
     * Base Validation Rules
     */
	protected $validationRules = [];
    
    /**
     * Validator Class
     */
    protected $validator;

    /**
     * contain default status list
     */
    public $statusList = ['publish', 'private'];


    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            if ( $slug = $model->getAttribute('slug') ) {
                $model->slug = \Str::slug($slug);
            }
        });

        static::saved(function($model)
        {
            Cache::tags( $model->getTable() )->flush();
        });

        static::deleted(function($model)
        {
            Cache::tags( $model->getTable() )->flush();
        });
    }

    public function isValid()
    {
        if ( ! isset($this->validationRules)) {
            throw new NoValidationRules('no validation rule array defined in class ' . get_called_class());
        }
        $this->validator = Validator::make($this->getAttributes(), $this->getPreparedRules());

        return $this->validator->passes();
    }

    public function setRules($rules = array())
    {
        $this->validationRules = $rules;
    }

    public function getRules($rules_name = null)
    {
        if ($rules_name) {
            return $this->$rules_name;
        }
        return $this->validationRules;
    }

    public function getErrors()
    {
        if ( ! $this->validator) {
            throw new NoValidatorInstantiated;
        }

        return $this->validator->errors();
    }

    public function save(array $options = array())
    {
        // when saving, we should always check validation
        if ( ! $this->isValid()) {
            return false;
        }

        return parent::save($options);
    }

    protected function getPreparedRules()
    {
        $newRules = [];

        foreach ($this->validationRules as $key => $rule) {
            if (str_contains($rule, '<id>'))
            {
                $replacement = $this->exists ? $this->getAttribute($this->primaryKey) : '';
                $rule = str_replace('<id>', $replacement, $rule);
            }
            array_set($newRules, $key, $rule);
        }

        return $newRules;
    }
}