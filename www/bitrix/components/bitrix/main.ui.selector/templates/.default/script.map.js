{"version":3,"file":"script.min.js","sources":["script.js"],"names":["BX","namespace","Main","selectorManager","controls","Selector","this","initialized","blockInit","id","input","options","callback","items","entities","mainPopupWindow","entitiesSet","create","params","util","hashCode","Math","random","toString","self","init","getId","prototype","ReferenceError","err","inputId","containerNode","containerId","bindNode","bindId","tag","tagId","parameters","name","pathToAjax","searchInput","bindMainPopup","node","offsetTop","offsetLeft","bindSearchPopup","useClientDatabase","getOption","sendAjaxSearch","showSearchInput","allowAddUser","allowAddCrmContact","allowAddSocNetGroup","allowSearchCrmEmailUsers","allowSearchNetworkUsers","enableDepartments","departmentSelectDisable","enableSonetgroups","isCrmFeed","select","unSelect","openDialog","closeDialog","openSearch","closeSearch","openEmailAdd","closeEmailAdd","allowSonetGroupsAjaxSearchFeatures","key","i","length","itemsLast","itemsSelected","selected","SocNetLogDestination","bind","delegate","initDialog","e","realParams","bByFocusEvent","PreventDefault","BXfpSetLinkName","formName","tagInputName","tagLink1","message","tagLink2","proxy","BXfpSearch","inputName","BXfpSearchBefore","hidden","ii","hasOwnProperty","apply","openDialogParams","eventParams","onCustomEvent","window","setTimeout","isShown","getData","data","eventOpen","addCustomEvent","popupWindow","ajax","url","method","dataType","sessid","bitrix_sessid","site","action","onsuccess","SUCCESS","addData","DATA","onfailure","__mergeData","target","source","obItems","ITEMS","USERS","SONETGROUPS","DEPARTMENT","buildDepartmentRelation","obItemsLast","ITEMS_LAST","CRM","obCrmFeed","SONETGROUPS_LIMITED","obAllowSonetGroupsAjaxSearch","obDestSort","DEST_SORT","optionId"],"mappings":"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"}