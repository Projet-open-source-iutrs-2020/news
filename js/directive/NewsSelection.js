app.directive('newsSelection', function(){
    'use strict';
    return{
      restrict: 'A',
      scope:{
        onSelected: '='
      },
        link:function(scope, elem){
          elem.on('select', function(){ 
           var text = elem.val().substring(elem.prop('selectionStart'), 
                elem.prop('selectionEnd'));
            scope.onSelected(text); 
          });
          
          elem.on('blur', function(){ scope.onSelected('');});
          elem.on('keydown', function(){ scope.onSelected('');});
          elem.on('mousedown', function(){ scope.onSelected('');});
        }
      };
    });