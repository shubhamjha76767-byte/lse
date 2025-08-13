<?php

namespace App\Admin\Actions;

use OpenAdmin\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Replicate extends RowAction
{
    public $name = 'copy';

    public $icon = 'icon-copy';

    public function handle(Model $model)
    {
        // $model ...

         $model->replicate()->save();   
        return $this->response()->success('Success message.')->refresh();
    }
}