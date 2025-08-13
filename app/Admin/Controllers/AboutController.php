<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\About;
use Encore\Admin\Facades\Admin;

class AboutController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'About Page';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new About);

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
        $show = new Show(About::findOrFail($id));

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
    $form = new Form(new About);

    $form->tab('Our Story Details', function ($form) {
        // Our Story Main Section
       
        $form->text('title', 'Our Story Title');
       
        // Subsection 1
        $form->image('sub_image_1', 'Subsection 1 Image');
        $form->ckeditor('sub_content_1', 'Subsection 1 Content');

        // Subsection 2
        $form->image('sub_image_2', 'Subsection 2 Image');
        $form->ckeditor('sub_content_2', 'Subsection 2 Content');
          })->tab('Our Model', function ($form) {
        // Our Model Section
         $form->text('modeltitle', 'Our Model Title');
        $form->image('model_image', 'Our Model Image');
        $form->ckeditor('description', 'Our Model Content');

    })->tab('Meta', function ($form) {

        $form->text('seo_title', 'SEO Title');
        $form->text('seo_keywords', 'SEO Keywords');
        $form->textarea('seo_description', 'SEO Description');

    });

    // Handle after save
    $form->saved(function(Form $form){
        admin_toastr('Update successful');
        return redirect('/admin/aboutpage/'.$form->model()->id.'/edit');
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
