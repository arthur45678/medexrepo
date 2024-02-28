window.medexMagicSearch = {
    defaultConfigs: {
        type: "",
        // ajaxOptions: {},
        fields: ["label"], // name + code
        id: "value",
        format: "%label%",
        noResult: "հարցմանը համապատասխան արդյունքներ չկան",
        focusShow: true,
        dropdownMaxItem: 7,
        maxShow: 10
    },
    assignConfigs: function(otherConfigs) {
        return Object.assign({}, this.defaultConfigs, otherConfigs);
    }
};

if ($) {
    $(".magic-search.ajax").each(function() {
        const multiple = $(this).data('multiple') || false;

        const catalog = $(this).data("catalog-name");
        const list = $(this).data("list-name");

        const type = list ? "lists" : "catalogs";
        const source = list || catalog;

        $(this).magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: `/${type}/${source}.json`,
                type: "ajax",
                multiple: multiple,
                multiField:'label',
                success: function($input, data) {
                    const hidden_input_id = $input.data("hidden");
                    $(hidden_input_id).val($input.attr("data-id"));
                    // console.log(window.location)
                },
                afterDelete: function($input, data) {
                    const hidden_input_id = $input.data("hidden");
                    multiple ?  $(hidden_input_id).val($input.attr("data-id")) : $(hidden_input_id).val("");
                }
            })
        );
    });

    $(".samples-search.search-defined").each(function() {
        // sample belongs to target
        const target = $(this).data("target");

        $(this).magicsearch(
            window.medexMagicSearch.assignConfigs({
                dataSource: `/catalogs/samples/target/${target}`,
                type: "ajax",
                fields: ['name'],
                id:'relation',
                format:'%name%',
                success: function($input, data) {
                    //samples of patinets
                    if(target === 'patient'){
                        openCreateSampleForPatient($input, data);
                    }

                    // samples of other
                    if(target === 'other') {
                        return 'call other function ...';
                    }

                },
            })
        );
    });
}

function openCreateSampleForPatient($input, data) {
    const { route_name: routeName = "" } = data;
    console.log('fired openCreateSampleForPatient');

    if (routeName) {
        let createUrl = "";
        const routeNameArray = routeName.split(".");
        const relationSegmentName = routeNameArray[routeNameArray.length - 1];
        const currentUrl = window.location.href;

        if (!routeNameArray.includes("samples")) {
            createUrl = `${currentUrl}/${relationSegmentName}/create`;
        } else {
            const currentUrlArray = currentUrl.split("/");
            const currentUrlArrayCopy = [...currentUrlArray];
            currentUrlArrayCopy.splice(3, 0, "samples"); // adding item with his index
            createUrl = `${currentUrlArrayCopy.join(
                "/"
            )}/${relationSegmentName}/create`;
        }

        window.open(createUrl);
    } else {
        console.error("No route_name into respose data - config.samples");
    }
};
