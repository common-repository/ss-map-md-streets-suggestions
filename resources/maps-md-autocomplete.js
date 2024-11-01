(function($) {
    $(document).ready(mapsMDautocomplete());
    $('input[name=ship_to_different_address]').on('change', function(){
        if(this.checked) mapsMDautocomplete();
    });
    function mapsMDautocomplete() {
        if (mapmd.api) {
            $('input[name=billing_address_1], input[name=shipping_address_1]').autocomplete({
                serviceUrl: mapmd.apiEndpoint,
                type: 'GET',
                dataType: 'json',
                paramName: 'q',
                ajaxSettings: {
                    headers: {"Authorization": "Basic " + btoa(mapmd.api + ":")}
                },
                noCache: true,
                minChars: 2,
                transformResult: function (response) {
                    return {
                        suggestions: $.map(response.streets, function (dataItem) {
                            return {value: dataItem.parent_name + ', ' + dataItem.name, object: dataItem};
                        })
                    };
                },
                onSelect: function (e) {
                    let $buildings;
                    switch ($(this).prop('name')) {
                        case 'billing_address_1':
                            $buildings = $('input[name=billing_address_2]');
                            break;
                        case 'shipping_address_1':
                            $buildings = $('input[name=shipping_address_2]');
                            break;
                        default:
                            break;
                    }
                    //TODO
                    if ($buildings) {
                        $buildings.autocomplete({
                            minChars: 0,
                            lookup: e.object.buildings
                        })
                    }
                }
            })
        }
    }
})(jQuery);