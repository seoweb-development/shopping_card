/**
 * Created by owner on 07/06/2017.
 */

$(function () {
General.init();
})

var General = {

  init:function () {

     // this.getAdressString();
  },
  getAdressString:function () {
      var url = window.location.href.split('/');
      console.log(url);
  },

    getCookieValue:function (cookieName) {
        var cook = document.cookie;
        var COOKIES = {};
        var splited = cook.split('; ');
        for(var i = splited.length-1;i>=0;i--){
            c = splited[i].split('=');
            COOKIES[c[0]]=c[1];
        }
        if(COOKIES[cookieName]) {
            return COOKIES[cookieName];
        }
        return false;
    },
    CookiesSet:function (cookieName, cookieValue, expired, collback) {
        $.ajax({
            url: 'forms/setCookies',
            type: 'post',
            dataType: 'text',
            data: {cookieName: cookieName, cookieValue: cookieValue, expired: expired},
            success: function (data) {
                if (collback != undefined) {

                collback();
            }

            }
        });
    },

    GenadyParser:function (objectData,selectorsJqueryObject, attributesArray) {
        selectorsJqueryObject.each(function () {
            var that = $(this);
            $.each(attributesArray, function (key, val) {
                if(that.is('['+val+']')){
                    var splitedObj = that.attr(val).split(':');
                    this.objectData = objectData;
                    if(splitedObj[0]=='val'
                        ||splitedObj[0]=='text'
                        ||splitedObj[0]=='html'
                        ||splitedObj[0]=='append'
                        ||splitedObj[0]=='prepend'){
                        that[splitedObj[0]](this.objectData[splitedObj[1]]);
                    }else{
                        that.attr(splitedObj[0],this.objectData[splitedObj[1]]);
                    }
                }

            })




        })
    }

}
