<!-- <html>
    <head>
        <title>SD</title>
    </head>

    <body>
        <h1>TEST</h1>

        <table id="tbl" border="1" cellspacing="0">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>FNAME</td>
                    <td>LNAME</td>
                    <td>action</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>eJ</td>
                    <td>Mumar</td>
                    <td><button>!</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Cherry</td>
                    <td>Ann</td>
                    <td><button>!</button></td>
                </tr>
            </tbody>
        </table>

        <script src="<?=base_url('assets/jquery.js')?>"></script>
        <script>
            $("#tbl").on('click', 'button',function(){
                $row = $(this).closest('tr').find('td:nth-child(1)').html();

                alert($row);
            })
        </script>
    </body>
</html> -->


<!-- <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
  } );
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div>
 
 
</body>
</html> -->


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <title>Sample</title>
</head>
<body>

    <input type="text" placeholder="No of Jobs, previous?"> <button>in</button>

    <div class="appended">
        <br>
    </div>
    
    <script src="<?=base_url('assets/jquery.js')?>"></script>

    <script>
            var app1 = '<hr><input type="text" placeholder="Company Name"><br>';
            var app2 = '<input type="text" placeholder="Address"><br>';
            var app3 = '<input type="text" placeholder="Sample"><br>';

        $('button').on('click',function(){
            if(confirm('Append '+$('input').val()+' Forms ?')){
                var jobs = parseInt($('input').val());
                
                for(i=0; i < jobs ; i++){
                    $('div.appended').append(app1+app2+app3);
                }
            }else{
                alert('no');
            }
        })
    </script>
  </body>
</html> -->
