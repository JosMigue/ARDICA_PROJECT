  $(document).ready(()=>{
      /*===============================AUTOCOMPLETE SECTION FOR USERS BEGIN=============================== */
        
         // This is for autocomplete name in view "v_Administration"

        var options = {
            url: "Administration/get_autocomplete_name",
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
                }
            }
          };
          
          $("#nameFilter").easyAutocomplete(options);
     
         // This is for autocomplete name user in view "v_Administration"

         var options = {
            url: "Administration/get_autocomplete_name"
            ,
            getValue: "nickname",   
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
          
          $("#nameUserFilter").easyAutocomplete(options);

          /*===============================AUTOCOMPLETE SECTION FOR USERS END=============================== */
     
    
    
    /*===============================AUTOCOMPLETE SECTION FOR OBRAS BEGIN=============================== */
    
    // This is for autocomplete code in view "v_Administration_obras"

    var options = {
        url: "Administration/get_autocomplete_obra",

        getValue: "cc",   

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
      
      $("#codeObraFilter").easyAutocomplete(options);

      // This is for autocomplete name obra in view "v_Administration_obras"

    var options = {
        url: "Administration/get_autocomplete_obra",

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
            }
        }
      };

      /*===============================AUTOCOMPLETE SECTION FOR OBRAS END=============================== */
      // This is for get 'tipo de obra' and put it in select 
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "Administration/getTypesObres",
        success: function(response)
        {
            $('#typeFilterObra').html(response).fadeIn();
        }
});
      
  });    
