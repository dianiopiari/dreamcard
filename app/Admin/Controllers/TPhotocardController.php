<?php

namespace App\Admin\Controllers;

use App\Models\MAlbum;
use App\Models\MChannel;
use App\Models\MMember;
use App\Models\TPhotocard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TPhotocardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'TPhotocard';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TPhotocard());

        $grid->column('id', __('Id'));
        $grid->column('photocard_id', __('Photocard id'));
        $grid->column('user_id', __('User id'));
        $grid->column('status', __('Status'));
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
        $show = new Show(TPhotocard::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('photocard_id', __('Photocard id'));
        $show->field('user_id', __('User id'));
        $show->field('status', __('Status'));
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
        $form = new Form(new TPhotocard());

        $form->number('photocard_id', __('Photocard id'));
        $form->number('user_id', __('User id'));
        $form->number('status', __('Status'));

        return $form;
    }

    public function member(Request $request)
    {
        $group_id = $request->get('q');
        return MMember::where('group_id', $group_id)->get(['id', DB::raw('member_name as text')]);
    }
    public function album(Request $request)
    {
        $member_id = $request->get('q');
        $member = MMember::where("id",'=',$member_id)->first();
        return MAlbum::where('group_id', $member->group_id)->orderBy('id','desc')->get(['id', DB::raw('album as text')]);
    }
    public function channel(Request $request)
    {
        $album_id = $request->get('q');
        return MChannel::where('album_id', $album_id)->orderBy('id','desc')->get(['id', DB::raw('channel as text')]);
    }
}
