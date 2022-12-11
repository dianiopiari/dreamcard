<?php

namespace App\Admin\Controllers;

use App\Helpers\Counter;
use App\Models\MAlbum;
use App\Models\MGroup;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
Use Encore\Admin\Widgets\Table;
Use Encore\Admin\Widgets\Box;

class AlbumController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Album';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new MAlbum());
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
        $grid->column('groupk.group_name', __('Group'));
        $grid->column('album', __('Album'));
        $grid->column('tahun', __('Tahun'));
        $grid->column('photo', __('Gambar'))->image();
        $grid->column('versi')->expand(function () {
            $sks = $this->listversi->map(function ($listversi) {
                return $listversi->only(['channel','kategori_id', 'keterangan']);
            });
            $table = new Table(['channel','kategori','keterangan'], $sks->toArray());
            $box = new Box();
            $box->style('success');
            $box->solid();
            $box->title('Daftar Versi');
            $box->content($table);
            return $box;
        });
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
        $show = new Show(MAlbum::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('group_id', __('Group id'));
        $show->field('album', __('Album'));
        $show->field('tahun', __('Tahun'));
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
        $form = new Form(new MAlbum());

        $form->select('group_id', 'Group')->options(
            MGroup::select('id', 'group_name')->get()->pluck('group_name','id')
        );
        $form->text('album', __('Album'));
        $form->text('tahun', __('Tahun'));
        $form->image('photo', __('Image'));
        $form->number('order', __('order'));
        $form->hasMany('versichannel', __('Versi'), function (Form\NestedForm $form) {
            $form->text('channel', __('Versi'));
            $form->select('kategori_id', __('Kategori'))->options([0 => 'Album Inclusions', 1 => 'Fansign/POB', '2' => 'Other Photocard']);
            $form->image('photo', __('Photo'));
            $form->textarea('keterangan', __('Keterangan'));
        });
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
