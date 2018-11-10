<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Colors</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
   <body>

       <div class="container content">
            <div class="row">
                <div class="col-md-12 border border-secondary">
                    <h1 class="text-center">Colors</h1>
                </div>
            </div>
            <div class="row content">
                <div class="col-md-5">
                    <form id="submitform">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputFile"  >Subir Imagen</label>
                            <input name='imageInput' type="file" accept="image/png, image/jpeg">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                         <div class="loader invisible"></div> 
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <div id="color_result"  style="">
                        
                    </div>
                    <h3 id="text-color" class="text-center"></h3>
                </div>
            </div>
       </div>
        <div id="messageModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p class="modal-message"></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
    </body>

</html>
