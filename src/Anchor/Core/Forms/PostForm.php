<?php

namespace Anchor\Core\Forms;

use Laracasts\Validation\FormValidator;
use Laracasts\Validation\FactoryInterface as ValidatorFactory;
use Illuminate\Translation\Translator;
use Laracasts\Validation\FormValidationException;

class PostForm extends FormValidator
{

    protected $rules = [
        'title' => [
            'required',
        ],
        'slug'  => [
            'required',
            'alpha_dash',
            'unique:posts,slug,:id'
        ]
    ];

    public function __construct(ValidatorFactory $validator, Translator $translator)
    {
        parent::__construct($validator);

        $this->messages = $translator->get('core::posts');
    }

    public function fill($data)
    {
        foreach ($data as $find => $replace) {
            $this->rules = $this->fillRules($find, $replace, $this->rules);
        }

        return $this;
    }

    protected function fillRules($find, $replace, $array)
    {
        if (!is_array($array)) {
            return str_replace($find, $replace, $array);
        }

        $newArray = array();

        foreach ($array as $key => $value) {
            $newArray[$key] = $this->fillRules($find, $replace, $value);
        }

        return $newArray;
    }

    public function validate(array $formData)
    {
        $this->validation = $this->validator->make(
            $formData,
            $this->getValidationRules(),
            $this->getValidationMessages()
        );

        if ($this->validation->fails())
        {
            throw new FormValidationException('Validation failed', $this->getValidationErrors());
        }

        return true;
    }
}
