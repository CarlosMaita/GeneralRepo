@extends('cms.layout.main')
@section('title')
    Tienda | Productos
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h2>Productos tienda virtual</h2>
    <div>
        <a class="btn btn-outline-primary" href="{{route('tienda.product.create')}}">Crear Producto</a>
    </div>
</div>
<hr>
<section class="container-fluid">
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped table-sm" id="table1">
        <thead>
          <tr>
          	<th>#</th>
            <th>Image</th>
          	<th>Titulo</th>
          	<th>Descripción</th>
            <th>Categoria</th>
          	<th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($productos as $producto)
          <tr>
            <td>{{$producto->id}}</td>
            <td>
                <img src="{{asset('storage/'. $producto->image)}}" width="30">
            </td>
            <td>{{$producto->title}}</td>
            <td>{{substr($producto->description,0, 60)}}</td>
            <td>{{$producto->category->title}}</td>
            <td>
            	<a href="{{route('tienda.product.show', $producto->id)}}" class="btn btn-sm btn-outline-primary">Editar</a>
            	<button type="button" id="{{$producto->id}}" data-toggle="modal" data-target="#modalEliminar" class="btn btn-sm btn-outline-danger eliminar_product">Eliminar</button>	
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</section>



<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="eliminar_form" method="POST">
                    @csrf
                </form>
                <p id="modal_message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="eliminar_submit" class="btn btn-danger">Eliminar producto</button>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('vendor/datatables/datatables.min.js')}}"></script>

<!-- para usar botones en datatables JS -->
<script src="{{asset('vendor/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendor/datatables/JSZip-2.5.0/jszip.min.js')}}"></script>
<script src="{{asset('vendor/datatables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
<script src="{{asset('vendor/datatables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
<script src="{{asset('vendor/datatables/Buttons-1.5.6/js/buttons.html5.min.js')}}"></script>

<script type="text/javascript">
    let eliminarButtons = document.querySelectorAll('.eliminar_product');
    let eliminarSubmit = document.getElementById('eliminar_submit');


    eliminarSubmit.addEventListener('click', () => {
        let formEliminar = document.getElementById('eliminar_form')

        formEliminar.submit();
    }); 

    if(eliminarButtons)
    {
        eliminarButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                let id = e.target.id,
                    message = e.target.parentNode.parentNode.children[2].textContent;
                
                modalEliminar(id, message)
            });
        });
    }


    function modalEliminar(id, text)
    {
        let formEliminar = document.getElementById('eliminar_form'),
            message = document.getElementById('modal_message');

        formEliminar.action = `/cms/tienda/eliminar/producto/${id}`;
        message.innerHTML = `
            Producto: <strong>${text}</strong> </br>
            ¿Seguro que desea eliminar este producto?
        `
    }
</script>


<script>
  window.onload = function() {
    $('#table1').DataTable({
      language: {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando...",
      },
      //para usar los botones   
      responsive: "true",
      pageLength: 50,
      dom: 'Bfrtilp',
      buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i> ',
          titleAttr: 'Exportar a Excel',
          className: 'btn btn-success'
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="fas fa-file-pdf"></i> ',
          titleAttr: 'Exportar a PDF',
          className: 'btn btn-danger'
        },
        {
          extend: 'print',
          text: '<i class="fa fa-print"></i> ',
          titleAttr: 'Imprimir',
          className: 'btn btn-info'
        },
      ]
    });
  }
</script>

@endsection