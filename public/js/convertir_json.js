  var langMap = {
      en: {
        path: 'English',
        mods: {
          sLengthMenu: "Display _MENU_ records per page - custom test"
        }
      },
      es: {
        path: 'Spanish',
        mods: {
          sLengthMenu: "Mostrar _MENU_ registros - algo muy especial..."
        }
      }
    };


        function getLanguage() {
          var lang = 'es'; //$('html').attr('lang');
          var result = null;
          var path = '/plugins/dataTables-1.10.21/Plugins/i18n/';
          $.ajax({
            async: false,  
            url: path + langMap[lang].path + '.lang',
            success: function(obj) {
              result = $.extend({}, obj, langMap[lang].mods)
            }
          })
         // console.log(result);
          return result;
        }