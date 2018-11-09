<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Colors</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" type="text/css">    <body>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
   <body>

       <div class="container content">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Colors</h1>
                </div>
            </div>
            <div class="row content">
                <div class="col-md-6">
                    <form id="submitform">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputFile"  >File input</label>
                            <input name='imageInput' type="file" accept="image/png, image/jpeg">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <img id="my_image" src="">
                    <div id="color_result"  style=""></div>
                </div>
            </div>
       </div>
    </body>

</html>
