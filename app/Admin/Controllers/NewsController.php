<?php

declare(strict_types=1);

namespace App\Admin\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class NewsController extends AdminController
{
    public function index(Content $content): Content
    {
        return $content
            ->title('Новости')
            ->breadcrumb(
                [
                    'text' => 'Новости',
                    'url' => route('admin.news.index')
                ],
            )->body($this->grid());
    }

    protected function grid(): Grid
    {
        $grid = new Grid(new News());
        $grid->model()->orderByDesc('published_at');
        $grid->column('name', 'Название');
        $states = [
            'on' => ['value' => '1', 'text' => 'Да'],
            'off' => ['value' => '0', 'text' => 'Нет'],
        ];
        $grid->published('Опубликовано')->switch($states);
        $grid->column('published_at', 'Дата публикации');
        $grid->disableCreateButton(false);

        return $grid;
    }

    protected function form(): Form
    {
        $form = new Form(new News());
        $form->text('name', 'Название')->required();
        $form->datetime('published_at', 'Дата публикации')->value(Carbon::now());
        $form->image('img_path', 'Картинка')
            ->required()
            ->rules('max:5000', ['max' => 'Максимальные размер изображения 5 Мб']);
        $form->summernote('description', 'Описание')
            ->rules('required', ['required' => 'Поле обязательно к заполнению']);
        $states = [
            'on' => ['value' => true, 'text' => 'Да'],
            'off' => ['value' => false, 'text' => 'Нет'],
        ];
        $form->switch('published', 'Опубликовать')->states($states);

        return $form;
    }

    public function create(Content $content): Content
    {
        $content->breadcrumb(
            ['text' => 'Новости', 'url' => route('admin.news.index')],
            ['text' => 'Создание', 'url' => '/']
        );
        return $content->body($this->form());
    }

    public function edit($id, Content $content): Content
    {
        $news = News::findOrFail($id);
        $content->breadcrumb(
            ['text' => 'Новости', 'url' => route('admin.news.index')],
            ['text' => $news->name, 'url' => '/']
        );
        return $content->body($this->form()->edit($id));
    }
}
