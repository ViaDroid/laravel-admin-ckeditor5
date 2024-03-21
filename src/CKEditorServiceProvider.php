<?php

namespace Viadroid\CKEditor;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;

class CKEditorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(CKEditor $extension)
    {
        if (! CKEditor::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'viadroid-ckeditor5');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/viadroid/ckeditor5')],
                'viadroid-ckeditor5'
            );
        }

        Admin::booting(function () {
            Form::extend('ckeditor', Editor::class);
        });
    }
}