var Track = {

 	_getDomain : function (url)
	{
        var a =  document.createElement('a');
        a.href = url;
        return a.hostname;
	},

    _getRootDomain : function(url){
         var a =  document.createElement('a');
        a.href = url;
        var tmpHostName = a.hostname.split(".");
        if(tmpHostName.length === a.hostname){
            return a.hostname;
        } else {
            return tmpHostName[tmpHostName.length-2] + "." +tmpHostName[tmpHostName.length-1];
        }
    },

    _getVar : function ( name )
    {
      name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
      var regexS = "[\\?&]"+name+"=([^&#]*)";
      var regex = new RegExp( regexS );
      var results = regex.exec( window.location.href );
      if( results == null )
        return "";
      else
        return results[1];
    },

    _deleteCookie: function ( name, path, domain )
    {
        if ( this._getCookie( name ) ) document.cookie = name + '=' +
                ';path=/'  +
                ( ( domain ) ? ';domain=' + domain : '' ) +
                ';expires=Thu, 01-Jan-1970 00:00:01 GMT';
    },

    _setCookie : function ( name, value, expires, path, domain, secure )
    {
        var today = new Date();
        today.setTime( today.getTime() );
        if ( expires ) {
            expires = expires * 1000 * 60 * 60 * 24;
        }
        var expires_date = new Date( today.getTime() + (expires) );
        document.cookie = name+'='+escape( value ) +
            ( ( expires ) ? ';expires='+expires_date.toGMTString() : '' ) + //expires.toGMTString()
            ';path=/'  +
             ( ( domain ) ? ';domain=' + domain : ';domain=' + Track._getRootDomain()  ) +
            ( ( secure ) ? ';secure' : '' );
    },


    _waitDocumentForCompletion : function ()
    {
        if(document.readyState == 'complete')
            return;
        else
            setTimeout("Track._waitDocumentForCompletion();", 300);
    },

    _getCookie : function ( name )
    {
        Track._waitDocumentForCompletion();

        var start = document.cookie.indexOf( name + "=" );
        var len = start + name.length + 1;
        if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {
            return '';
        }
        if ( start == -1 ) return '';
        var end = document.cookie.indexOf( ';', len );
        if ( end == -1 ) end = document.cookie.length;
        return unescape( document.cookie.substring( len, end ) );
    },

    initializeTracking : function ()
    {
        var trackref = Track._getVar('trackref');
        if(trackref != null && trackref != '')
        {
          Track._setCookie('track', trackref, 1);
          return;
        }

        var cookieTrack = Track._getCookie('track');
        if(cookieTrack != null && cookieTrack != '')
        {
          return;
        }

        if(document.referrer != null && document.referrer != '')
        {
            var domain = Track._getDomain(document.referrer);
            if(domain != null && domain != '')
            {
                Track._setCookie('track', domain, 1);
                return;
            }
        }
    },

    getTrack : function ()
    {
        return Track._getCookie('track');
    }
};

Track.initializeTracking();
