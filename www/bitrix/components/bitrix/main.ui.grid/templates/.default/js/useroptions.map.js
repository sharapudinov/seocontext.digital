{"version":3,"file":"useroptions.min.js","sources":["useroptions.js"],"names":["BX","namespace","Grid","UserOptions","parent","userOptions","userOptionsActions","url","this","options","actions","init","prototype","eval","err","console","warn","getCurrentViewName","getOptions","current_view","getViewsList","views","getCurrentOptions","name","result","type","isPlainObject","getUrl","action","util","add_url_param","GRID_ID","getContainerId","bxajaxid","getAjaxId","getActions","getAction","update","newOptions","setColumns","columns","callback","join","save","setColumnsNames","view_id","custom_names","setColumnSizes","sizes","expand","reset","forAll","data","set_default_settings","delete_user_settings","view_settings","setSort","by","order","setPageSize","pageSize","isNumber","parseInt","setExpandedRows","ids","isArray","resetExpandedRows","saveForAll","self","ajax","post","res","JSON","parse","error","isFunction","onCustomEvent","getContainer"],"mappings":"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"}