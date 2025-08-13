<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Models\Home;
use Encore\Admin\Facades\Admin;

class HomePageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Home Page';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Home);

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
        $show = new Show(Home::findOrFail($id));

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
        $form = new Form(new Home);

       $form->tab('Basic Details', function ($form) {
        $form->image('banner', 'Banner Image');
        $form->text('title', 'Banner Title');
        $form->ckeditor('content', 'Banner Content');
        $form->ckeditor('description', 'Description');
       
         })->tab('Partner', function ($form) {
      $form->ckeditor('partner', 'Partner Code');

       })->tab('Meta', function ($form) {
         
           $form->text('seo_title', 'Title');
            $form->text('seo_keywords', 'Keywords');
            $form->textarea('seo_description', 'Description');
           
        
       });

           $form->saved(function(Form $form){
            admin_toastr('update success');
            return redirect('/admin/homepage/'.$form->model()->id.'/edit');
        });

        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableList();
        });

        $form->disableCreatingCheck(true);
        $form->disableEditingCheck(true);
        $form->disableViewCheck(true);
        $form->disableReset();
        return $form;
    }
}
