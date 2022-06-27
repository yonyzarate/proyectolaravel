<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }
 
 
        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }
 
        #encabezado{
        text-align: center;
        margin-left: 35%;
        margin-right: 35%;
        font-size: 15px;
        }
 
        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        background:#F0940C;
        }
 
        section{
        clear: left;
        }
 
        #cliente{
        text-align: left;
        }
 
        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }
 
        #facliente thead{
        padding: 20px;
        background:#F0940C;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facvendedor thead{
        padding: 20px;
        background: #F0940C;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
        #facproducto{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }
 
        #facproducto thead{
        padding: 20px;
        background: #F0940C;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }
 
    
    </style>
    <body>
        @foreach ($venta as $ve)
        <header>
            <!--<div id="logo">
                <img src="img/logo.png" alt="" id="imagen">
            </div>-->
         
             <div>
                
                <table id="datos">
                    <thead>                        
                        <tr>
                            <th id="">DATOS DEL CLIENTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Nombre: {{$ve->nombre}}<br>
                            {{$ve->tipo_identificacion}}-VENTA: {{$ve->num_venta}}<br>
                            Dirección: {{$ve->direccion}}<br>
                            Teléfono: {{$ve->telefono}}<br>
                            Email: {{$ve->email}}</</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div id="fact">
                <p>{{$ve->tipo_identificacion}} VENTA<br/>
                  {{$ve->num_venta}}</p>
            </div>  
        </header>
        <br>
        
        @endforeach
        <br>
        <section>
            <div>
                <table id="facdendedor">
                    <thead>
                        <tr id="fv">
                            <th>VENDEDOR</th>
                            <th>FECHA VENTA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$ve->usuario}}</td>
                            <td>{{$ve->created_at}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facproducto">
                    <thead>
                        <tr id="fa">
                            <th>CANTIDAD</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO VENTA (USD$)</th>
                            <th>DESCUENTO (%)</th>
                            <th>SUBTOTAL (USD$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                        <tr>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->producto}}</td>
                            <td>${{$det->precio}}</td>
                            <td>${{$det->descuento}}</td>
                            <!--<td>${{$det->cantidad*$det->precio}}</td>-->
                            <td>${{number_format($det->cantidad*$det->precio - $det->cantidad*$det->precio*$det->descuento/100,2)}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @foreach ($venta as $v)
                        <tr>
                           <th colspan="3"><p align="right">TOTAL:</p></th>
                            <td><p align="right">${{number_format($v->total)}}<p></td>
                        </tr>
                        <tr>
                           <th colspan="3"><p align="right">TOTAL IMPUESTO (20%):</p></th>
                            <td><p align="right">$ {{number_format($v->total*20/100,2)}}</p></td>
                        </tr>
                        <tr>
                           <th  colspan="3"><p align="right">TOTAL PAGAR:</p></th>
                            <td><p align="right">$ {{number_format($v->total+($v->total*20/100),2)}}</p></td>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
             <!--puedes poner un mensaje aqui-->
             <div id="datos">
                <p id="encabezado">
                    <b>yony_zarate96.com</b><br>Yony Zarate Paco<br>Telefono:(+00)75513825<br>Email:yony.zarate96@gmail.com
                </p>
            </div>
        </footer>
    </body>
</html>