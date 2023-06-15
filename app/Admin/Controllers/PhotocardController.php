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
use Illuminate\Support\Facades\Log;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;

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
        $grid->disableExport();
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });
        $counter = new Counter();
        $grid->tools(function ($tools) {
            $tools->disableRefreshButton();
        });

        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->equal('group_id',"Group")->select(
                MGroup::all()->pluck('group_name','id')
            )->load('member_id', config('app.url').'/admin/ajax/member');

            $filter->equal('member_id',"Member")->select(
                MMember::all()->pluck('member_name','id')
            )->load('album_id', config('app.url').'/admin/ajax/album');

            $filter->equal('album_id',"Album")->select(
                MAlbum::all()->pluck('album','id')
            )->load('channel_id', config('app.url').'/admin/ajax/channel');

            $filter->equal('channel_id',"Channel")->select(
                MChannel::all()->pluck('channel','id')
            );
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
            MGroup::select('id', 'group_name')->get()->pluck('group_name','id')->toArray()
        )->load('member_id', config('app.url').'/admin/ajax/member');
        $form->select('member_id', 'Member')->options(
            MMember::select('id', 'member_name')->get()->pluck('member_name','id')
        )->load('album_id', config('app.url').'/admin/ajax/album')->default("");
        $form->select('album_id', 'Album')->options(
            MAlbum::select('id', 'album')->get()->pluck('album','id')
        )->load('channel_id', config('app.url').'/admin/ajax/channel')->default("");
        $form->select('channel_id', 'Event')->options(
            MChannel::select('id', 'channel')->get()->pluck('channel','id')
        );
        $form->text('hash_img');
        $form->image('pic_front', __('Image Depan'));
        $form->image('pic_hd', __('Image Depan HD'));
        $form->image('pic_back', __('Image Belakang'));
        $form->ckeditor('credit', __('Info Credit'));

        $form->saved(function (Form $form){
            //...
            $id = $form->model()->id;
            if( $id != 0){
                //set_time_limit(1800);
                $dataphoto = MPhotocard::findOrFail($id);
                $path = config('app.str_adm')."\\".$dataphoto->pic_front;
                if(config('app.str_adm')!="production"){
                    $path = str_replace("\\","/",$path );
                }
                //dd($path);
                $hasher = new ImageHash(new DifferenceHash());
                $hash = $hasher->hash($path);
                //dd($hash);
                $dataphoto->update([
                    'hash_img'     => $hash->toBits()
                ]);

            }
        });

        $form->disableEditingCheck();
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        return $form;
    }
}
