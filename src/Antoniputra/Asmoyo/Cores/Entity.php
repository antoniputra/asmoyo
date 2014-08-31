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
     * Global entity events
     * we used this for reset caching
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            // if the attribute has slug, make it slugable
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

    /**
     * check validation
     * @return bool
     */
    public function isValid()
    {
        if ( ! isset($this->validationRules)) {
            throw new NoValidationRules('no validation rule array defined in class ' . get_called_class());
        }
        $this->validator = Validator::make($this->getAttributes(), $this->getPreparedRules());

        return $this->validator->passes();
    }

    /**
     * Get errors from validation
     * @return array
     */
    public function getErrors()
    {
        if ( ! $this->validator) {
            throw new NoValidatorInstantiated;
        }

        return $this->validator->errors();
    }

    /**
     * Set new rules, used in validation
     * @param array rules
     * @return this
     */
    public function setRules($rules = array())
    {
        if ( ! is_array($rules) ) {
            throw new \Exception("$rules should be array, string given", 1);
        }
        $this->validationRules = $rules;
        return $this;
    }

    /**
     * Save we will do validation from validationRules property
     */
    public function save(array $options = array())
    {
        // when saving, we should always check validation
        if ( ! $this->isValid()) {
            return false;
        }

        return parent::save($options);
    }

    /**
     * translate validation
     * @return array
     */
    protected function getPreparedRules()
    {
        $newRules = [];

        foreach ($this->validationRules as $key => $rule) {
            if (str_contains($rule, '{id}'))
            {
                $replacement = $this->exists ? $this->getAttribute($this->primaryKey) : 1;
                $rule = str_replace('{id}', $replacement, $rule);
            }
            array_set($newRules, $key, $rule);
        }

        return $newRules;
    }
}