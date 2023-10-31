$(document).ready(function() {
    let edit = false;
  
    // JSON base a mostrar en el formulario
    let baseJSON = {
      precio: 0.0,
      unidades: 1,
      modelo: "XX-000",
      marca: "NA",
      detalles: "NA",
      imagen: "img/default.png"
    };
  
    let JsonString = JSON.stringify(baseJSON, null, 2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();
  
    function listarProductos() {
      $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function(response) {
          const productos = JSON.parse(response);
  
          if (Object.keys(productos).length > 0) {
            let template = '';
  
            productos.forEach(producto => {
              let descripcion = '';
              descripcion += '<li>precio: ' + producto.precio + '</li>';
              descripcion += '<li>unidades: ' + producto.unidades + '</li>';
              descripcion += '<li>modelo: ' + producto.modelo + '</li>';
              descripcion += '<li>marca: ' + producto.marca + '</li>';
              descripcion += '<li>detalles: ' + producto.detalles + '</li>';
  
              template += `
                <tr productId="${producto.id}">
                  <td>${producto.id}</td>
                  <td><a href="#" class="product-item">${producto.nombre}</a></td>
                  <td><ul>${descripcion}</ul></td>
                  <td>
                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                      Eliminar
                    </button>
                  </td>
                </tr>
              `;
            });
  
            $('#products').html(template);
          }
        }
      });
    }

    $('#name').on('keyup', function () {
        const productName = $(this).val().trim();

        if (productName !== '') {
            $.ajax({
                url: './backend/product-check-name.php',
                type: 'POST',
                data: { name: productName },
                success: function (response) {
                    const result = JSON.parse(response);

                    if (result.exists) {
                        // El nombre del producto ya existe, muestra un mensaje de error
                        $('#name-error').text('¡El nombre del producto ya existe en la base de datos!');
                    } else {
                        // El nombre del producto es válido, elimina el mensaje de error
                        $('#name-error').text('');
                    }
                }
            });
        } else {
            // El campo de nombre está vacío, elimina el mensaje de error
            $('#name-error').text('');
        }
    });






  
    $('#search').keyup(function() {
      if ($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
          url: './backend/product-search.php?search=' + $('#search').val(),
          data: { search },
          type: 'GET',
          success: function(response) {
            if (!response.error) {
              const productos = JSON.parse(response);
  
              if (Object.keys(productos).length > 0) {
                let template = '';
                let template_bar = '';
  
                productos.forEach(producto => {
                  let descripcion = '';
                  descripcion += '<li>precio: ' + producto.precio + '</li>';
                  descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                  descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                  descripcion += '<li>marca: ' + producto.marca + '</li>';
                  descripcion += '<li>detalles: ' + producto.detalles + '</li>';
  
                  template += `
                    <tr productId="${producto.id}">
                      <td>${producto.id}</td>
                      <td><a href="#" class="product-item">${producto.nombre}</a></td>
                      <td><ul>${descripcion}</ul></td>
                      <td>
                        <button class="product-delete btn btn-danger">
                          Eliminar
                        </button>
                      </td>
                    </tr>
                  `;
  
                  template_bar += `
                    <li>${producto.nombre}</li>
                  `;
                });
  
                $('#product-result').show();
                $('#container').html(template_bar);
                $('#products').html(template);
              }
            }
          }
        });
      } else {
        $('#product-result').hide();
      }
    });
  
    $('#product-form').submit(e => {
      e.preventDefault();
      
  
      let name = $('#name').val();
      let price = parseFloat($('#price').val());
      let units = parseInt($('#units').val());
      let model = $('#model').val();
      let brand = $('#brand').val();
      let details = $('#details').val();
      let image = $('#image').val();
  
        // Verifica que los campos requeridos no estén vacíos
        if (name.trim() === '' || brand.trim() === '' || model.trim() === '' || price.toString().trim() === ''|| units === '') {
            // Muestra un mensaje de error en la pantalla
            $('#product-result').show();
            $('#container').html('<li>Todos los campos requeridos deben estar llenos.</li>');
        }else{

      if (name.trim() === '' || name.length > 100) {
        alert('El nombre debe ser requerido y tener 100 caracteres o menos.');
        return;
      }
  
      if (brand === '') {
        alert('Selecciona una marca o inserta marca.');
        return;
      }
  
      if (!/^[a-zA-Z0-9\s-]{1,25}$/.test(model)) {
        alert('El modelo debe ser requerido, texto alfanumérico y tener 25 caracteres o menos.');
        return;
      }
  
      if (isNaN(price) || price <= 99.99) {
        alert('El precio debe ser requerido y mayor a 99.99.');
        return;
      }
  
      if (units < 0) {
        alert('Las unidades deben ser requeridas y el número registrado debe ser mayor o igual a 0.');
        return;
      }
  
      if (details.length > 250) {
        alert('Los detalles deben tener 250 caracteres o menos.');
        return;
      }
  
      if (image === '') {
        image = 'img/default.png';
      }
  
      let postData = {
        nombre: name,
        precio: price,
        unidades: units,
        modelo: model,
        marca: brand,
        detalles: details,
        imagen: image
      };
  
      const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
  
      $.post(url, postData, (response) => {
        let respuesta = JSON.parse(response);
        let template_bar = '';
        template_bar += `
          <li style="list-style: none;">status: ${respuesta.status}</li>
          <li style="list-style: none;">message: ${respuesta.message}</li>
        `;
        $('#name').val('');
        $('#description').val(JsonString);
        $('#product-result').show();
        $('#container').html(template_bar);
        listarProductos();
        edit = false;
      });
    }
    });
  
    $(document).on('click', '.product-delete', (e) => {
      if (confirm('¿Realmente deseas eliminar el producto?')) {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-delete.php', { id }, (response) => {
          $('#product-result').hide();
          listarProductos();
        });
      }
    });
  
    $(document).on('click', '.product-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        //console.log(id);

        $.post('backend/product-single.php', { id }, function (response) {
            const producto = JSON.parse(response);

           // console.log(response);
            $('#name').val(producto.nombre);
            $('#price').val(producto.precio);
            $('#units').val(producto.unidades);
            $('#model').val(producto.modelo);
            $('#brand').val(producto.marca);
            $('#details').val(producto.detalles);
            $('#image').val(producto.imagen);



            $('#productId').val(producto.id);

            var atributosobj = {
                "precio": producto.precio,
                "unidades": producto.unidades,
                "modelo": producto.modelo,
                "marca": producto.marca,
                "detalles": producto.detalles,
                "imagen": producto.imagen
            };

            var objstring = JSON.stringify(atributosobj, null, 2);
            $('#description').val(objstring);
            edit = true;
        })
    });
  });
  