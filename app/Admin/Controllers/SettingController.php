<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Seting;
use Encore\Admin\Facades\Admin;

class SettingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Setting';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Seting);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
     
     $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableDelete();
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Seting::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
          $show->panel()->tools(function ($tools) {
            $tools->disableList();
            $tools->disableDelete();
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
  protected function form()
{
    $form = new Form(new Seting);

    $form->tab('Website Details', function ($form) {
        $form->image('logo', 'Website Logo');
    })
     ->tab('Email Option', function ($form) {
        $form->table('email_to', 'Email Option', function ($table) {
            $table->text('name', 'Email');
            
        });
    })
    ->tab('Contact Info', function ($form) {
        $form->text('time', 'Time');
        $form->email('email', 'Email');
        $form->text('contact', 'Contact');
        $form->text('whatsapp', 'WhatsApp');
        $form->text('telegram', 'Telegram');
    })
    ->tab('Explore', function ($form) {
        $form->table('explore', 'Explore Features', function ($table) {
            $table->text('name', 'Name');
            $table->url('link', 'Link');
        });
    })
    ->tab('Follow Us', function ($form) {
        $form->url('insta', 'Instagram Link');
        $form->url('tweeter', 'Twitter Link');
        $form->url('facebook', 'Facebook Link');
    });

    // After Save
    $form->saved(function(Form $form){
        admin_toastr('Update successful');
        return redirect('/admin/setting/'.$form->model()->id.'/edit');
    });

    // Tools customization
    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
        $tools->disableList();
    });

    // Disable extra buttons
    $form->disableCreatingCheck(true);
    $form->disableEditingCheck(true);
    $form->disableViewCheck(true);
    $form->disableReset();

    return $form;
}

}
