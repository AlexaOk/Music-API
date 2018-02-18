$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_list_albums',
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php (for your example it's "bye bye"
    var x = $('#template').html();
    var y = Mustache.render(x, data);
    $('#display').html(y);
    // console.log(data);
  }
})
});

$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_albums_by_id&name='+t[1],
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php
      var x = $('#template2').html();
      var y = Mustache.render(x, data);
      $('#display2').html(y);
    }
  })
});

$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_list_artists',
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php (for your example it's "bye bye"
    var x = $('#template3').html();
    var y = Mustache.render(x, data);
    $('#display3').html(y);
    // console.log(data);
  }
})
});


$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_artists_by_id&name='+t[1],
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php
      console.log(data);
      var x = $('#template4').html();
      var y = Mustache.render(x, data);
      $('#display4').html(y);
    }
  })
});

$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_tracks_by_album&name='+t[1],
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php
      console.log(data);
      var x = $('#template5').html();
      var y = Mustache.render(x, data);
      $('#display5').html(y);
    }
  })
});

$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_albums_by_artist&name='+t[1],
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php
      console.log(data);
      var x = $('#template6').html();
      var y = Mustache.render(x, data);
      $('#display6').html(y);
    }
  })
});

$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_random_albums',
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php
      console.log(data);
      var x = $('#template7').html();
      var y = Mustache.render(x, data);
      $('#display7').html(y);
    }
  })
});


$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_list_genres',
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php
      console.log(data);
      var x = $('#template8').html();
      var y = Mustache.render(x, data);
      $('#display8').html(y);
    }
  })
});


$(function ()
{
  $.ajax
  ({
    url: '../api.php?action=get_genre_album&name='+t[1],
    dataType : "JSON",
    success: function (data)
    {//response is value returned from php
      console.log(data);
      var x = $('#template9').html();
      var y = Mustache.render(x, data);
      $('#display9').html(y);
    }
  })
});
// function extractUrlParams(){
var t = location.search.substring(1).split('=');

console.log(t[1])
// 	return f;
// }
