// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            let template = '';
            for(var i=0; i<=productos.length; i++ ){
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
           if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                //    descripcion += '<li>precio: ' + productos[i].precio + '</li>';
                //    descripcion += '<li>unidades: '+productos[i].unidades+'</li>';
                if (productos[i]) {
                    if (productos[i].precio) {
                        descripcion += '<li>precio: ' + productos[i].precio + '</li>';
                      } else {
                        descripcion += '<li>precio: No disponible</li>';
                      }
                      if (productos[i].unidades) {
                        descripcion += '<li>unidades: ' + productos[i].unidades + '</li>';
                      } else {
                        descripcion += '<li>unidades: No disponible</li>';
                      }
                    if (productos[i].modelo) {
                      descripcion += '<li>modelo: ' + productos[i].modelo + '</li>';
                    } else {
                      descripcion += '<li>modelo: No disponible</li>';
                    }
                  
                    if (productos[i].marca) {
                      descripcion += '<li>marca: ' + productos[i].marca + '</li>';
                    } else {
                      descripcion += '<li>marca: No disponible</li>';
                    }
                  
                    if (productos[i].detalles) {
                      descripcion += '<li>detalles: ' + productos[i].detalles + '</li>';
                    } else {
                      descripcion += '<li>detalles: No disponibles</li>';
                    }
                  } else {
                    descripcion += '<li>Producto no disponible</li>';
                  }
                  
                  
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                    template += `
                    
                        <tr>
                            <td>${productos[i].id}</td>
                            <td>${productos[i].nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
        }
    };
    client.send("id="+id);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);

    if(finalJSON.precio  < 99.99 ){
        alert('Introduce un precio mayor a 99.99');
        return;
    }

    parseInt(finalJSON["unidades"]);
   if(finalJSON.unidades <= 0 ){
    alert('Debe ingresar al menos una unidad');
    return;
    }
    
    if(finalJSON.modelo == ''){
        alert('Introduce un modelo');
        return;
    }
    if(finalJSON.marca == ''){
        alert('Introduce una marca');
        return;
    }
    if(finalJSON.detalles.length > 250){
        alert('Ingresa detalles con menos de 250 caracteres');
        return;
    }
    if(finalJSON.imagen == 'img/default.png'){
        finalJSON['imagen'] = 'img/imagen.png';
        return;
    }
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON,null,2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
            if(client.responseText === 'ESTE PRODUCTO FUE INSERTADO CORRECTAMENTE'){
                alert('producto insertado correctamente');
            }else{
                alert('' + client.responseText);
            }
        }
    };
    client.send(productoJsonString);
}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}