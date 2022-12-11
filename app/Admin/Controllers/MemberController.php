<?php

namespace App\Admin\Controllers;

use App\Helpers\Counter;
use App\Models\MGroup;
use App\Models\MMember;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MemberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Member';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MMember());

        //$grid->column('id', __('Id'));
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
        $grid->column('groupm.group_name', __('Group'));
        $grid->column('member_name', __('Member'));
        $grid->column('photo', __('Photo'))->image();

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
        $show = new Show(MMember::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('group_id', __('Group id'));
        $show->field('member_name', __('Member name'));
        $show->field('photo', __('Photo'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new MMember());

        //$form->number('group_id', __('Group id'));
        $form->select('group_id', 'Group')->options(
            MGroup::select('id', 'group_name')->get()->pluck('group_name','id')
        );
        $form->text('member_name', __('Member name'));
        $form->text('position', __('Posisi'));
        $form->image('photo', __('Image'));
        $form->disableEditingCheck();
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->tools(function (Form\Tools $tools) {
            $tools->disableDelete();
            $tools->disableView();
        });
        return $form;
    }
}
