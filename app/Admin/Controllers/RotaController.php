<?php

namespace App\Admin\Controllers;

use App\Models\Rota;
use App\Models\Profile;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Arr;

class RotaController extends AdminController
{
    protected $title = 'Rota';

    // Skip grid and redirect directly to edit form
    public function index(Content $content)
    {
        $rota = Rota::firstOrCreate([]); // Always ensure a single rota exists
        return redirect()->route('admin.rota.edit', $rota->id);
    }

   

    
    protected function form()
{
    $form = new Form(new Rota());

    $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    // Get profiles with id, name, thumbnail
    $profiles = Profile::select('id', 'name', 'thumbnail')->get();
    $profileOptions = $profiles->pluck('name', 'id');
    $thumbnails = $profiles->pluck('thumbnail', 'id');

    foreach ($days as $day) {
        $form->multipleSelect($day, __("Profiles for " . ucfirst($day)))
            ->options($profileOptions)
            ->attribute([
                'data-role' => 'profile-select',
                'data-day' => $day,
                'data-thumbnails' => json_encode($thumbnails),
            ])
            ->default(function () use ($day, $form) {
                $data = $form->model()->getAttribute($day);
                return is_array($data) ? $data : json_decode($data, true) ?? [];
            });
    }

    // Disable view/delete/list buttons
    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
        $tools->disableView();
        $tools->disableList();
    });

    // Disable footer buttons
    $form->footer(function ($footer) {
        $footer->disableViewCheck();
        $footer->disableEditingCheck();
        $footer->disableCreatingCheck();
    });

    // Add the Select2 script for styling and thumbnails
    \Encore\Admin\Admin::script(<<<'JS'
$(function() {
    $('select[data-role="profile-select"]').each(function() {
        const $select = $(this);
        const thumbnails = $select.data('thumbnails') || {};

        $select.select2({
            templateResult: formatProfile,
            templateSelection: formatProfile,
            escapeMarkup: function(m) { return m; }
        });

        function formatProfile(profile) {
            if (!profile.id) return profile.text;

            const name = profile.text;
            const thumb = thumbnails[profile.id];
            const avatar = '/public/storage/' + thumb;

            return `
                <div style="display: flex; align-items: center;">
                    <img src="${avatar}" style="width: 32px; height: 32px; border-radius: 50%; margin-right: 10px;">
                    <span>${name}</span>
                </div>
            `;
        }
    });
});
JS);

    return $form;
}


    public function detail($id)
    {
        // Skip detail page
        return redirect()->route('admin.rota.edit', $id);
    }



}
