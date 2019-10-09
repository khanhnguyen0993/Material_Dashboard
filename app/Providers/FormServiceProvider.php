<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      Form::component('bsText', 'components.form.text', ['name', 'value' => null, 'attributes'=>[]]);
      Form::component('bsNumber', 'components.form.number', ['name', 'value' => null, 'attributes'=>[]]);
      Form::component('bsSubmit', 'components.form.submit', ['value' => 'Submit', 'attributes'=>[]]);
      Form::component('hidden', 'components.form.hidden', ['name', 'value' => null, 'attributes'=>[]]);
      Form::component('bsTextArea', 'components.form.textarea', ['name', 'value' => null, 'attributes'=>[]]);
      Form::component('password', 'components.form.password', ['name', 'value'=>null, 'attributes'=>[]]);
      Form::component('bsCheckbox', 'components.form.checkbox', ['name', 'value', 'check','attributes'=>[]]);
      Form::component('file', 'components.form.file', ['name', 'attributes'=>[]]);
    }
}
