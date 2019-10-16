$(document).ready(()=>{
     /*===============================AUTOCOMPLETE SECTION FOR PETTY CASH BEGIN=============================== */
        
         // This is for autocomplete name in view "v_Petty_Cash"

         var options = {
            url: "PettyCash/get_autocomplete_PettyCash_Filters_Number",
            getValue: "numero",   
            list:{
                maxNumberOfElements:10,
                match: {
                    enabled: true
                },
                showAnimation: {
                    type: "fade", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
        
                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                }
            }
          };
          
          $("#numberFilter").easyAutocomplete(options);
     
         // This is for autocomplete name user in view "v_Petty_Cash"

         var options = {
            url: "PettyCash/get_autocomplete_PettyCash_Filters_Location"
            ,
            getValue: "name",   
            list:{
                maxNumberOfElements:10,
                match: {
                    enabled: true
                },
                showAnimation: {
                    type: "fade", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
        
                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },

                onSelectItemEvent: function() {
                    var value = $("#locationFilter").getSelectedItemData().ID;
                    $("#selected_location").val(value).trigger("change");
                    }
            }
          };
          
          $("#locationFilter").easyAutocomplete(options);

          // This is for autocomplete name user in view "v_Petty_Cash"

         var options = {
            url: "PettyCash/get_autocomplete_PettyCash_Filters_Responsable"
            ,
            getValue: "name",   
            list:{
                maxNumberOfElements:10,
                match: {
                    enabled: true
                },
                showAnimation: {
                    type: "fade", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
        
                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
                onSelectItemEvent: function() {
                    var value = $("#responsableFilter").getSelectedItemData().ID;
                    $("#selected_responsable").val(value).trigger("change");
                    }
            }
          };
          
          $("#responsableFilter").easyAutocomplete(options);

          // This is for autocomplete name user in view "v_Petty_Cash"

         var options = {
            url: "PettyCash/get_autocomplete_PettyCash_Filters_Team"
            ,
            getValue: "nombre",   
            list:{
                maxNumberOfElements:10,
                match: {
                    enabled: true
                },
                showAnimation: {
                    type: "fade", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
        
                hideAnimation: {
                    type: "slide", //normal|slide|fade
                    time: 400,
                    callback: function() {}
                },
                onSelectItemEvent: function() {
                    var value = $("#teamFilter").getSelectedItemData().ID;
                    $("#selected_team").val(value).trigger("change");
                    }
            }
          };
          
          $("#teamFilter").easyAutocomplete(options);


       /*===============================AUTOCOMPLETE SECTION FOR PETTY CASH END=============================== */
      
});    
