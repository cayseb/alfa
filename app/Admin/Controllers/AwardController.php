<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\Award;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class AwardController extends AdminController
{
    public function index(Content $content): Content
    {

        return $content
            ->title('Награды компании')
            ->breadcrumb(
                [
                    'text' => 'Награды компании',
                    'url' => route('admin.awards.index')
                ],
            )->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new Award());
        $grid->sortable();
        $grid->column('name', 'Название');
        $grid->column('year', 'Год');
        $grid->column('created_at', 'Дата создания')->display(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $grid->disableCreateButton(false);
        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new Award());
        $form->text('name', 'Название')->required();
        $form->text('year', 'Год')->required();
        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            [
                'text' => 'Награды компании',
                'url' => route('admin.awards.index')
            ],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $award = Award::findOrFail($id);

        $content->breadcrumb(
            [
                'text' => 'Награды компании',
                'url' => route('admin.awards.index')
            ],
            [
                'text' => $award->name,
                'url' => '/'
            ],
        );
        return $content->body($this->form()->edit($id));
    }
}
