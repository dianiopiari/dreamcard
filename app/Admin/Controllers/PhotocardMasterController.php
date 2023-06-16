<?php

namespace App\Admin\Controllers;

use App\Helpers\Common;
use App\Helpers\Counter;
use App\Models\MAlbum;
use App\Models\MChannel;
use App\Models\MGroup;
use App\Models\MMasterPhotocard;
use App\Models\MMember;
use App\Models\MPhotocard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Admin;

class PhotocardMasterController extends AdminControllerCustome
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
        $grid = new Grid(new MMasterPhotocard());
        $grid->disableRowSelector();
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
        $grid->column('mgroup.group_name', __('Group'));
        $grid->column('malbump.album', __('Album'));
        $grid->column('mchannel.channel', __('Channel'));
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
        $show = new Show(MMasterPhotocard::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('group_id', __('Group id'));
        $show->field('album_id', __('Album id'));
        $show->field('member_id', __('Member id'));
        $show->field('channel_id', __('Channel id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    private function script($per_active)
    {
        return <<<EOT
            var generateTahuns = function(){
                var per = {$per_active};
                var tpl = $('template.photocards-tpl');
                var target = $('.has-many-photocards-forms');
                if (target.children().length == 0) {
                    $.each(per, function(i, v){
                        var template = tpl.html().replace(/__LA_KEY__/g, i);
                        target.append(template);
                    });
                }
            };
            generateTahuns();
        EOT;
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($idx = null)
    {
        $form = new Form(new MMasterPhotocard());
        $common = new Common;
        $form->setWidth(9,1);
        $form->tab('Basic info', function ($form) {
            $form->select('group_id', 'Group')->options(
                MGroup::select('id', 'group_name')->get()->pluck('group_name','id')->toArray()
            )->load('album_id', config('app.url').'/admin/ajax/albumbygroup');
            $form->select('album_id', 'Album')->options(
                MAlbum::select('id', 'album')->get()->pluck('album','id')
            )->load('channel_id', config('app.url').'/admin/ajax/channel')->default("");
            $form->select('channel_id', 'Event')->options(
                MChannel::select('id', 'channel')->get()->pluck('channel','id')
            );
            $form->ckeditor('credit', __('Info Credit'));
        })->tab('Member Photocard', function ($form) use($common,$idx ){
            if($idx!=0){
                $form->hasMany('photocards', __(''), function (Form\NestedForm $form) use($common,$idx){
                    $master = MMasterPhotocard::find($idx);
                    $form->select('member_id', 'Member')->options(
                        MMember::select('id', 'member_name')->where('group_id','=',$master->group_id)->get()->pluck('member_name','id')
                    );
                    $form->image('pic_front', __('Image Depan'));
                    $form->image('pic_back', __('Image Belakang'));
                })->useTable();
            }else{
                $form->html('Submit first');
                $form->hasMany('photocards', __(''), function (Form\NestedForm $form) use($common){
                    $form->select('member_id', 'Member')->options(
                    );
                    $form->image('pic_front', __('Image Depan'));
                    $form->image('pic_back', __('Image Belakang'));
                })->useTable();
            }
        });

        $form->saved(function (Form $form) {
            $id = $form->model()->id;
            if( $id != 0){
                //disini tambahkan pengecekan, kalau kosong insert otomatis
                $idphoto = MPhotocard::where('master_id', $id)->count();
                if($idphoto!=0){
                    MPhotocard::where('master_id', $id)->update(
                        [
                            'group_id' => $form->model()->group_id,
                            'album_id' => $form->model()->album_id,
                            'channel_id'=> $form->model()->channel_id,
                            'credit'=> $form->model()->credit
                        ]
                    );
                }else{
                    //insert otmatis sebanyak jumlah member
                    $listMembers = MMember::where('group_id','=',$form->model()->group_id)->where('tipe','=',0)->get();
                    foreach ($listMembers  as $listMember) {
                        $photocard = new MPhotocard();
                        $photocard->master_id = $id;
                        $photocard->group_id = $form->model()->group_id;
                        $photocard->album_id=$form->model()->album_id;
                        $photocard->channel_id=$form->model()->channel_id;
                        $photocard->member_id=$listMember->id;
                        $photocard->save();
                    }
                }
            }
            admin_toastr(__('Berhasil'));
            return redirect("/admin/m-master-photocards/$id/edit");
        });
        if($idx!=0){
            Admin::script($this->script(\json_encode($common->listMember($idx))));
        }
        $form->disableCreatingCheck();
        $form->disableViewCheck();
        $form->disableEditingCheck();
        return $form;
    }
}
