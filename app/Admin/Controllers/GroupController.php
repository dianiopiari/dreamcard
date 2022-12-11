<?php

namespace App\Admin\Controllers;

use App\Helpers\Counter;
use App\Models\MGroup;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GroupController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Group';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MGroup());
        $grid->disableRowSelector();
        $grid->disableTools();
        $grid->disableExport();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });
        $counter = new Counter();
        $grid->tools(function ($tools) {
            $tools->disableRefreshButton();
        });
        $grid->id('No', __('No'))->display(function() use ($counter) {
            return $counter->plus();
        });
        $grid->column('group_name', __('Group name'));
        $grid->column('logo', __('Logo'))->image();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(MGroup::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('group_name', __('Group name'));
        $show->field('logo', __('Logo'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MGroup());

        $form->text('group_name', __('Group name'));
        $form->image('logo', __('Logo'));

        return $form;
    }
}
