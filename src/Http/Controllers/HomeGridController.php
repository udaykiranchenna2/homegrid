<?php

namespace Botble\HomeGrid\Http\Controllers;

use Botble\Base\Facades\Assets;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Supports\Breadcrumb;
use Botble\HomeGrid\Forms\HomeGridForm;
use Botble\HomeGrid\Http\Requests\HomeGridRequest;
use Botble\HomeGrid\Models\HomeGrid;
use Botble\HomeGrid\Models\HomeGridItem;
use Botble\HomeGrid\Tables\HomeGridTable;
use Illuminate\Http\Request;

class HomeGridController extends BaseController
{
    protected function breadcrumb(): Breadcrumb
    {
        return parent::breadcrumb()
            ->add(trans('plugins/home-grid::home-grid.menu'), route('home-grid.index'));
    }

    public function index(HomeGridTable $dataTable)
    {
        $this->pageTitle(trans('plugins/home-grid::home-grid.menu'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/home-grid::home-grid.create'));

        return HomeGridForm::create()
            ->removeMetaBox('grid-items')
            ->renderForm();
    }

    public function store(HomeGridRequest $request)
    {
        $form = HomeGridForm::create()->setRequest($request);
        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('home-grid.index')
            ->setNextRoute('home-grid.edit', $form->getModel()->getKey())
            ->withCreatedSuccessMessage();
    }

    public function edit(HomeGrid $homeGrid)
    {
        Assets::addScripts('sortable')
            ->addScriptsDirectly('vendor/core/plugins/home-grid/js/home-grid-admin.js');

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $homeGrid->name]));

        return HomeGridForm::createFromModel($homeGrid)
            ->renderForm();
    }

    public function update(HomeGrid $homeGrid, HomeGridRequest $request)
    {
        HomeGridForm::createFromModel($homeGrid)->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->setPreviousRoute('home-grid.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(HomeGrid $homeGrid)
    {
        return DeleteResourceAction::make($homeGrid);
    }

    public function postSorting(Request $request)
    {
        foreach ($request->input('items', []) as $key => $id) {
            HomeGridItem::query()->where('id', $id)->update(['order' => ($key + 1)]);
        }

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/home-grid::home-grid.update_grid_position_success'));
    }
}