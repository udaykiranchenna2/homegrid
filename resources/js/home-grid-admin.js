class HomeGridAdminManagement {
    init(tableId) {
        const $table = $(document).find(`#${tableId}_wrapper`)

        $.each($table.find('tbody'), (index, el) => {
            Sortable.create(el, {
                group: el + '_' + index,
                sort: true,
                delay: 0,
                disabled: false,
                store: null,
                animation: 150,
                handle: 'tr',
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dataIdAttr: 'data-id',
                forceFallback: false,
                fallbackClass: 'sortable-fallback',
                fallbackOnBody: false,
                scroll: true,
                scrollSensitivity: 30,
                scrollSpeed: 10,
                onEnd: () => {
                    const $box = $(el).closest('.card')
                    $box.find('.btn-save-sort-order').addClass('sort-button-active').show()
                    $.each($box.find('tbody tr'), (index, sort) => {
                        $(sort)
                            .find('.order-column')
                            .text(index + 1)
                    })
                },
            })
        })

        const $sortButton = $table.closest('.card').find('.btn-save-sort-order')

        $sortButton.off('click').on('click', (event) => {
            event.preventDefault()
            const _self = $(event.currentTarget)

            let items = []
            $.each(_self.closest('.card').find('tbody tr'), (index, sort) => {
                items.push(parseInt($(sort).find('td:first-child').text()))
                $(sort)
                    .find('.order-column')
                    .text(index + 1)
            })

            Botble.showButtonLoading(_self)

            $httpClient
                .make()
                .post($sortButton.data('url'), {
                    items,
                })
                .then(({ data }) => {
                    Botble.showSuccess(data.message)
                })
                .finally(() => {
                    Botble.hideButtonLoading(_self)
                    _self.hide()
                })
        })
    }
}

$(() => {
    document.addEventListener('core-table-init-completed', function (event) {
        new HomeGridAdminManagement().init(event.detail.table.prop('id'))
    })

    $(document)
        .on('show.bs.modal', '#home-grid-item-modal', (e) => {
            const modal = $(e.currentTarget)
            const href = $(e.relatedTarget).prop('href')

            $httpClient
                .make()
                .withLoading(modal.find('.modal-content'))
                .get(href)
                .then(({ data }) => {
                    modal.find('.modal-header .modal-title').text(data.data.title)
                    modal.find('.modal-body').html(data.data.content)

                    Botble.initMediaIntegrate()

                    Botble.initResources()
                })
        })

        .on('click', '#home-grid-item-modal button[type="submit"]', (e) => {
            e.preventDefault()

            const button = $(e.currentTarget)
            const modal = button.closest('.modal')
            const form = modal.find('form')

            $httpClient
                .make()
                .withLoading(form)
                .withButtonLoading(button)
                .post(form.prop('action'), form.serialize())
                .then(({ data }) => {
                    Botble.showSuccess(data.message)

                    modal.modal('hide')

                    $('#botble-home-grid-tables-home-grid-item-table').DataTable().draw()
                })
        })
})