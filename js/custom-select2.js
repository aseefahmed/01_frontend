$(document).ready(function(){
    $.fn.select2.amd.require([
        'select2/selection/multiple',
        'select2/selection/search',
        'select2/dropdown',
        'select2/dropdown/attachBody',
        'select2/dropdown/closeOnSelect',
        'select2/compat/containerCss',
        'select2/utils'
    ], function (MultipleSelection, Search, Dropdown, AttachBody, CloseOnSelect, ContainerCss, Utils) {
        var SelectionAdapter = Utils.Decorate(
            MultipleSelection,
            Search
        );

        var DropdownAdapter = Utils.Decorate(
            Utils.Decorate(
                Dropdown,
                CloseOnSelect
            ),
            AttachBody
        );

        $('.inline-search').select2({
            dropdownAdapter: DropdownAdapter,
            selectionAdapter: SelectionAdapter
        });

        $('.dropdown-search').select2({
            selectionAdapter: MultipleSelection
        });

        $('.autocomplete').select2({
            dropdownAdapter: DropdownAdapter,
            selectionAdapter: Utils.Decorate(SelectionAdapter, ContainerCss),
            containerCssClass: 'select2-autocomplete'
        });
    });
});
