<?php

declare(strict_types=1);

namespace Orchid\Screen\Fields;

use Orchid\Screen\Field;

/**
 * Class DateRange.
 *
 * @method DateRange accept($value = true)
 * @method DateRange accesskey($value = true)
 * @method DateRange autocomplete($value = true)
 * @method DateRange autofocus($value = true)
 * @method DateRange checked($value = true)
 * @method DateRange disabled($value = true)
 * @method DateRange form($value = true)
 * @method DateRange formaction($value = true)
 * @method DateRange formenctype($value = true)
 * @method DateRange formmethod($value = true)
 * @method DateRange formnovalidate($value = true)
 * @method DateRange formtarget($value = true)
 * @method DateRange list($value = true)
 * @method DateRange max(int $value)
 * @method DateRange maxlength(int $value)
 * @method DateRange min(int $value)
 * @method DateRange multiple($value = true)
 * @method DateRange name(string $value = null)
 * @method DateRange pattern($value = true)
 * @method DateRange placeholder(string $value = null)
 * @method DateRange readonly($value = true)
 * @method DateRange required(bool $value = true)
 * @method DateRange size($value = true)
 * @method DateRange src($value = true)
 * @method DateRange step($value = true)
 * @method DateRange tabindex($value = true)
 * @method DateRange value($value = true)
 * @method DateRange help(string $value = null)
 * @method DateRange popover(string $value = null)
 */
class DateRange extends Field
{
    /**
     * @var string
     */
    protected $view = 'platform::fields.range';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'type'  => 'text',
        'class' => 'form-control',
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
    ];

    /**
     * @param string|null $name
     *
     * @return DateRange
     */
    public static function make(string $name = null): self
    {
        return (new static())->name($name);
    }
}
