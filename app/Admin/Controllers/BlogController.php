<?php

namespace App\Admin\Controllers;

use App\Models\Blog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BlogController extends AdminController
{
    protected $title = 'Blog';

    protected function grid()
    {
        $grid = new Grid(new Blog());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('icon', 'Thumbnail')->image('', 60, 60);
        $grid->column('title', __('Title'))->limit(50)->sortable();
        $grid->column('slug', __('Slug'))->limit(30);
         $grid->column('status','Active')->switch([
            'on'  => ['value' => 1, 'text' => 'Published', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => 'Archived', 'color' => 'danger'],
        ]);
        $grid->column('publish_at', __('Published At'))->display(function ($published_at) {
            return $published_at ? date('d-M-Y', strtotime($published_at)) : '';
        })->sortable();

        $grid->filter(function ($filter) {
            $filter->like('title', 'Title');
            $filter->equal('status', 'Status')->select([
                '2' => 'Draft',
                '1' => 'Published',
                '0' => 'Archived',
            ]);
        });

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Blog::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('title', __('Title'));
        $show->field('overview', __('Overview'));
        $show->field('slug', __('Slug'));
        $show->field('image', __('Image'))->image();
        $show->field('body', __('Body'))->unescape();
        $show->field('publish_at', __('Publish At'));
        $show->field('status', __('Status'));
        $show->field('html_title', __('HTML Title'));
        $show->field('url_component', __('URL Component'));
        $show->field('meta_description', __('Meta Description'));
        $show->field('meta_keywords', __('Meta Keywords'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Blog());

        $form->tab('Content', function (Form $form) {
            $form->text('title', __('Title'))->required();
            $form->textarea('overview', __('Overview'));
            $form->text('slug', __('Slug'))->required();
             $form->image('icon', __('Thumb Image'))->uniqueName();
            $form->image('image', __('Image'))->uniqueName();
            $form->ckeditor('body', __('Body'));
            $form->datetime('publish_at', __('Publish At'))->default(now());
            $form->select('status', __('Status'))->options([
                '2' => 'Draft',
                '1' => 'Published',
                '0' => 'Archived',
            ])->default('draft');
        })->tab('Meta Details', function (Form $form) {
            $form->text('html_title', __('HTML Title'));
            $form->text('url_component', __('URL Component'));
            $form->textarea('meta_description', __('Meta Description'));
            $form->textarea('meta_keywords', __('Meta Keywords'));
        });

        return $form;
    }
}
