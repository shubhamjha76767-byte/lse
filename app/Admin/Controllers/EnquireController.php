<?php

namespace App\Admin\Controllers;

use App\Models\Bookingdata;
use App\Models\Profile;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EnquireController extends AdminController
{
    /**
     * Title for current resource.
     */
    protected $title = 'Bookings';

    /**
     * Make a grid builder.
     */
    protected function grid()
    {
        $grid = new Grid(new Bookingdata());
         $grid->model()->orderBy('id', 'desc');

        $grid->column('id', __('ID'))->sortable();
        $grid->column('profile.name', __('Escort Name'))->sortable();
        $grid->column('full_name', __('Full Name'));
        $grid->column('contact_number', __('Contact Number'));
        $grid->column('contact_email', __('Contact Email'))->sortable();
        $grid->column('booking_date', __('Booking Date'))->sortable();
        $grid->column('booking_time', __('Booking Time'));
        $grid->column('duration', __('Duration'));
        $grid->column('address', __('Address'))->limit(30);
        $grid->column('notes', __('Notes'))->limit(50);
        // $grid->column('created_at', __('Submitted At'));

        return $grid;
    }

    /**
     * Make a show builder.
     */
    protected function detail($id)
    {
        $show = new Show(Bookingdata::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('profile.name', __('Escort Name'));
        $show->field('full_name', __('Full Name'));
        $show->field('contact_number', __('Contact Number'));
        $show->field('contact_email', __('Contact Email'));
        $show->field('booking_date', __('Booking Date'));
        $show->field('booking_time', __('Booking Time'));
        $show->field('duration', __('Duration'));
        $show->field('address', __('Address'));
        $show->field('notes', __('Notes'));
        $show->field('created_at', __('Submitted At'));
        $show->field('updated_at', __('Updated At'));

        return $show;
    }

    /**
     * Make a form builder.
     */
    protected function form()
    {
        $form = new Form(new Bookingdata());

        $form->select('profile_id', __('Escort'))->options(
            Profile::pluck('name', 'id')
        )->required();

        $form->text('full_name', __('Full Name'))->required();
        $form->mobile('contact_number', __('Contact Number'))->options(['mask' => '9999999999'])->required();
        $form->email('contact_email', __('Contact Email'))->required();
        $form->date('booking_date', __('Booking Date'))->required();
        $form->time('booking_time', __('Booking Time'))->required();
        $form->text('duration', __('Duration'))->required();
        $form->textarea('address', __('Address'))->required();
        $form->textarea('notes', __('Notes'));

        return $form;
    }
}
