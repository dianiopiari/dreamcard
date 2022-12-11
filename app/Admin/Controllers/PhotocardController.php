<?php

namespace App\Admin\Controllers;

use App\Helpers\Counter;
use App\Models\MAlbum;
use App\Models\MChannel;
use App\Models\MGroup;
use App\Models\MMember;
use App\Models\MPhotocard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PhotocardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Master Photocard';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MPhotocard());
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
        $grid->column('groupp.group_name', __('Group'));
        $grid->column('memberp.member_name', __('Member'));
        $grid->column('channelp.channel', __('Channel'));
        $grid->column('pic_front', __('Pic front'))->image();
        $grid->column('pic_back', __('Pic back'))->image();

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
        $show = new Show(MPhotocard::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('group_id', __('Group id'));
        $show->field('member_id', __('Member id'));
        $show->field('channel_id', __('Channel id'));
        $show->field('album_id', __('Album id'));
        $show->field('pic_front', __('Pic front'));
        $show->field('pic_back', __('Pic back'));
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
        $form = new Form(new MPhotocard());
        $form->select('group_id', 'Group')->options(
            MGroup::select('id', 'group_name')->get()->pluck('group_name','id')
        );
        $form->select('member_id', 'Member')->options(
            MMember::select('id', 'member_name')->get()->pluck('member_name','id')
        );
        $form->select('album_id', 'Album')->options(
            MAlbum::select('id', 'album')->get()->pluck('album','id')
        );
        $form->select('channel_id', 'Event')->options(
            MChannel::select('id', 'channel')->get()->pluck('channel','id')
        );
        $form->image('pic_front', __('Image Depan'));
        $form->image('pic_back', __('Image Belakang'));
        return $form;
    }
}
