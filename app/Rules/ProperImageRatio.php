<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\Facades\Image as Intervention;

class ProperImageRatio implements Rule
{
    protected $image;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($image)
    {
        $this->image = Intervention::make($image);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (($this->image->height() / $this->image->width() <= 2) and ($this->image->height() / $this->image->width() >= 0.5));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong image ratio - too horizontal or too vertical.';
    }
}
