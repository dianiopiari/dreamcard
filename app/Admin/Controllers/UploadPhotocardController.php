<?php

namespace App\Admin\Controllers;

use App\Models\MPhotocard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UploadPhotocardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'MPhotocard';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MPhotocard());

        $grid->column('id', __('Id'));
        $grid->column('group_id', __('Group id'));
        $grid->column('album_id', __('Album id'));
        $grid->column('member_id', __('Member id'));
        $grid->column('channel_id', __('Channel id'));
        $grid->column('pic_front', __('Pic front'));
        $grid->column('pic_back', __('Pic back'));
        $grid->column('pic_hd', __('Pic hd'));
        $grid->column('credit', __('Credit'));
        $grid->column('hash_img', __('Hash img'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show->field('album_id', __('Album id'));
        $show->field('member_id', __('Member id'));
        $show->field('channel_id', __('Channel id'));
        $show->field('pic_front', __('Pic front'));
        $show->field('pic_back', __('Pic back'));
        $show->field('pic_hd', __('Pic hd'));
        $show->field('credit', __('Credit'));
        $show->field('hash_img', __('Hash img'));
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
        $form->table('comments', '', function(Form\NestedForm $form) {
            // $form->datetime('created_at');
            // $form->text('author');
            // $form->text('type');
            // $form->text('comment');
            $form->number('group_id', __('Group id'));
            $form->number('album_id', __('Album id'));
            $form->number('member_id', __('Member id'));
            $form->number('channel_id', __('Channel id'));
            $form->text('pic_front', __('Pic front'));
            $form->text('pic_back', __('Pic back'));
            $form->text('pic_hd', __('Pic hd'));
            $form->textarea('credit', __('Credit'));
            $form->textarea('hash_img', __('Hash img'));
         });
        return $form;
    }
}
