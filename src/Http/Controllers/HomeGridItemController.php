<?php

namespace Botble\HomeGrid\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\HomeGrid\Forms\HomeGridItemForm;
use Botble\HomeGrid\Http\Requests\HomeGridItemRequest;
use Botble\HomeGrid\Models\HomeGridItem;
use Botble\HomeGrid\Tables\HomeGridItemTable;

class HomeGridItemController extends BaseController
{
    public function index(HomeGridItemTable $dataTable)
    {
        return $dataTable->renderTable();
    }

    public function create()
    {
        $form = HomeGridItemForm::create()
            ->setUseInlineJs(true)
            ->renderForm();

        return $this
            ->httpResponse()
            ->setData([
                'title' => trans('plugins/home-grid::home-grid.create_new_item'),
                'content' => $form,
            ]);
    }

    public function store(HomeGridItemRequest $request)
    {
        HomeGridItemForm::create()->setRequest($request)->save();

        return $this
            ->httpResponse()
            ->withCreatedSuccessMessage();
    }

    public function edit(int|string $id)
    {
        $homeGridItem = HomeGridItem::query()->findOrFail($id);

        $form = HomeGridItemForm::createFromModel($homeGridItem)
            ->setUseInlineJs(true)
            ->renderForm();

        return $this
            ->httpResponse()
            ->setData([
                'title' => trans('plugins/home-grid::home-grid.edit_item', ['id' => $homeGridItem->getKey()]),
                'content' => $form,
            ]);
    }

    public function update(int|string $id, HomeGridItemRequest $request)
    {
        $homeGridItem = HomeGridItem::query()->findOrFail($id);

        HomeGridItemForm::createFromModel($homeGridItem)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->withUpdatedSuccessMessage();
    }

    public function destroy(int|string $id)
    {
        $homeGridItem = HomeGridItem::query()->findOrFail($id);

        return DeleteResourceAction::make($homeGridItem);
    }
}