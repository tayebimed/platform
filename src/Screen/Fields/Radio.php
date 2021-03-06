<?php

declare(strict_types=1);

namespace Orchid\Screen\Fields;

use Orchid\Screen\Field;

/**
 * Class Radio.
 *
 * @method Radio accept($value = true)
 * @method Radio accesskey($value = true)
 * @method Radio autocomplete($value = true)
 * @method Radio autofocus($value = true)
 * @method Radio checked($value = true)
 * @method Radio disabled($value = true)
 * @method Radio form($value = true)
 * @method Radio formaction($value = true)
 * @method Radio formenctype($value = true)
 * @method Radio formmethod($value = true)
 * @method Radio formnovalidate($value = true)
 * @method Radio formtarget($value = true)
 * @method Radio list($value = true)
 * @method Radio max(int $value)
 * @method Radio maxlength(int $value)
 * @method Radio min(int $value)
 * @method Radio multiple($value = true)
 * @method Radio name(string $value = null)
 * @method Radio pattern($value = true)
 * @method Radio placeholder(string $value = null)
 * @method Radio readonly($value = true)
 * @method Radio required(bool $value = true)
 * @method Radio size($value = true)
 * @method Radio src($value = true)
 * @method Radio step($value = true)
 * @method Radio tabindex($value = true)
 * @method Radio value($value = true)
 * @method Radio help(string $value = null)
 */
class Radio extends Field
{
    /**
     * @var string
     */
    protected $view = 'platform::fields.radio';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'type'   => 'radio',
        'class'  => 'custom-control-input',
        'value'  => null,
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'accept',
        'accesskey',
        'autocomplete',
        'autofocus',
        'checked',
        'disabled',
        'form',
        'formaction',
        'formenctype',
        'formmethod',
        'formnovalidate',
        'formtarget',
        'list',
        'max',
        'maxlength',
        'min',
        'multiple',
        'name',
        'pattern',
        'placeholder',
        'readonly',
        'required',
        'size',
        'src',
        'step',
        'tabindex',
        'value',
        'type',
    ];

    /**
     * @param string|null $name
     *
     * @return self
     */
    public static function make(string $name = null): self
    {
        return (new static())->name($name);
    }
}
