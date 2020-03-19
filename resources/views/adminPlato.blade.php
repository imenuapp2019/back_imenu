@extends('layouts.app')

@section('content')




  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pruebamodal">Panel de platos</button>

<div class="modal fade" id="pruebamodal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class = "modal-body">

        <div class = "container">

            <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#plato" data-toggle = "tab">Plato</a>

            </li>
             <li class="nav-item">
              <a class="nav-link" href="#galeria" data-toggle = "tab">Menús asignados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#alergenos" data-toggle = "tab">Alergenos</a>
            </li>
          </ul>

          <div class = "tab-content">
            <div id="plato" class="container tab-pane active"><br>

                <form>
                    <div class="form-group">
                        <label for="plato">Nombre del plato:</label>
                        <input type="text" class="form-control" id="name">
                      </div>
                    <div class="file-field">
                        <div class="z-depth-1-half mb-4">
                            <img src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" class="img-fluid"
                                 alt="example placeholder">
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="btn btn-mdb-color btn-rounded float-left">

                                <input type="file">
                            </div>
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="plato">Descripción del plato:</label>
                        <textarea class="form-control" name="message" rows="10"></textarea>
                      </div>

                      <div class = "form-group">
                         <label for="quantity">Precio (Entre 1 y 700€):</label>
                         <input type="number"  id="quantity" name="quantity" min="1" max="700" >€
                     </div>






                    <button type="submit" class="btn btn-primary">Guardar plato</button>
                </form>



              </div>
              <div id="galeria" class="container tab-pane fade"><br>
                  <div class="row">
                     <div class="col-md-12">
                         <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                             Asignar Menús
                         </a>
                     </div>
                  </div>
                  <div class="row collapse" id="collapseExample">
                      <div class="col-md-12 form-group">
                        <select class="form-control" name="menuPlate">
                            <option value="">Selecciona categoría</option>
                            {{--Imprimir los menus del restaurante--}}
                        </select>
                      </div>

                  </div>

              <div class="row">
                  <div class="col-md-12">
                      <ul class="list-group list-group-flush">
                          <li class="list-group-item">
                              Menú 1
                              <button class="btn btn-light"><img src="{{asset('images/minus.png')}}"></button>
                          </li>
                      </ul>
                  </div>
              </div>

                <div class = "row">
                    <button type="submit" class="btn btn-primary">Guardar Menú</button>
                </div>
              </div>
              <div id="alergenos" class="container tab-pane fade"><br>
                <h3>Alergenos</h3>

                <div class="row">
                    <div class="col-md-12">

                      <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                          Alergenos
                        </a>

                      </p>
                      <div class="collapse" id="collapseExample">
                        <div class="form-group">
                          <select class="form-control" multiple="multiple" name="alergenos">
                            <option value="pesacdo">Pescado</option>
                            <option value="harina">Harina</option>
                            <option value="lacteos">Lacteos</option>
                            <option value="huevo">Huevo</option>
                            <option value="frutos">Frutos secos</option>
                          </select>
                        </div>
                      </div>



                      <button class="btn-save btn btn-primary btn-sm" style="margin-left: 60px">Guardar</button>

                    </div>
                  </div>


              </div>


            </div>
          </div>
  </div>
</div>
  </div>
</div>

@endsection
