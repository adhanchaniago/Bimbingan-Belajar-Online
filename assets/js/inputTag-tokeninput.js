      model.modelSelect = { 
        ID: 0,
        name: "",
        
    }

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.modelSelect),
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['name']),
        FilterValue: ko.observable('name'),
    }

    // $('#inputtag').tokenInput("destroy");
    // $("#inputtag").tokenInput("add", {"ID":res.data.Tags[i]});

    $("#inputtagKABUPATEN").tokenInput("<?= base_url('master/C_customer/getKabupaten');?>", {
        theme: "facebook",
        animateDropdown: true,
        searchDelay: 50,
        minChars: 2,
        tokenLimit: 1, 
        contentType: "json",
        excludeCurrent: true,
        excludeCurrentParameter: "x",
        tokenValue: 'ID',
        propertyToSearch: "name",
        preventDuplicates: true,

                // resultsFormatter: function(item){
                //     return "<li style='color:black;'>"+item.name+"</li>"
                // },

                // onAdd: function (item) {
                //     item.ID = item.ID.toLowerCase();
                //     if(modelSelect.config.Tags().length > 0){
                //         for(var i in modelSelect.config.Tags()){
                //             if(modelSelect.config.Tags()[i] != item.ID)
                //                 modelSelect.config.Tags.push(item.ID);
                //         }
                //     } else {
                //         modelSelect.config.Tags.push(item.ID);
                //     }
                // },

                

            }); 



    /*-------------------------------------------------------------------------------------- */




    // $('#inputtag').tokenInput("destroy");
    // $("#inputtag").tokenInput("add", {"ID":res.data.Tags[i]});

    // $("#inputtag").tokenInput("/master/Coba/getSatuan", { 
    //     zindex: 700,
    //     allowFreeTagging: true,
    //     noResultsText: "Add Tag",
    //     placeholder: 'Input Tag Here!!',
    //     tokenValue: 'ID',
    //     propertyToSearch: "ID",
    //     preventDuplicates: true,
    //     tokenLimit: 1,
    //     theme: "facebook",
    //     onAdd: function (item) {
    //         item.ID = item.ID.toLowerCase();
    //         if(modelSelect.config.Tags().length > 0){
    //             for(var i in modelSelect.config.Tags()){
    //                 if(modelSelect.config.Tags()[i] != item.ID)
    //                     modelSelect.config.Tags.push(item.ID);
    //             }
    //         } else {
    //             modelSelect.config.Tags.push(item.ID);
    //         }
    //     },

    //     onDelete: function(item){
    //         item.ID = item.ID.toLowerCase();
    //         if(modelSelect.config.Tags().length > 0){
    //             for(var i in modelSelect.config.Tags()){
    //                 if(modelSelect.config.Tags()[i] == item.ID)
    //                     modelSelect.config.Tags.remove(item.ID);
    //             }
    //         }
    //     },

    //     resultsFormatter: function(item){
    //         return "<li style='color:white;'>"+item.ID+"</li>"
    //     },
    //     onResult: function (results) {
    //         var resyo = [], boolyo = true;
    //         for (var i in results.data){
    //             boolyo = true;
    //             for (var a in modelSelect.config.Tags()){
    //                 if (results.data[i].ID == modelSelect.config.Tags()[a])
    //                     boolyo = false;
    //             }if(boolyo)
    //             resyo.push(results.data[i]);
    //         }
    //         return resyo;
    //     },

    //     onCachedResult: function(results){
    //         var resyo = [], boolyo = true;
    //         for (var i in results.data){
    //             boolyo = true;
    //             for (var a in modelSelect.config.Tags()){
    //                 if (results.data[i].ID == modelSelect.config.Tags()[a])
    //                     boolyo = false;
    //             }
    //             if(boolyo)
    //                 resyo.push(results.data[i]);
    //         }
    //         return resyo;
    //     }
    // });


