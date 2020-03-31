<?php 
    include("_header.html");
    include("_navbar.html");
    require_once "util.php";
?>

<!--Perro (idPerro, nombre, tamaño, condiciones médicas, edad estimada cuando llego, fecha de llegada, sexo, historia, estado de adopción, personalidad, foto, raza)-->

<div class="container">
<h2>Nuestros Perros</h2>

    <div class="card-panel">
        <div class="row">
            <div class="col s12 m4">
            <form action="catalogo.php">
                <h4>Filtrar Catálogo</h4>
                <!--tamaño-->
                <!--condiciones medicas-->
                <!--edad-->
                <div id="ageSlider"></div> <div id="ageSlider-value"></div>
                <!--sexo-->
                <div class="col s6"><label><input id="hembra" name="group1" type="checkbox" checked /><span>Hembra</span></label></div>
                <div class="col s6"><label><input id="macho" name="group1" type="checkbox" checked/><span>Macho</span></label></div>

                <!--personalidad-->

                <!--raza-->

                <h4>Ordenar Por</h4>

                <!--nombre-->
                <!--tiempo en el refugio-->
                <!--edad-->
                <!--tamaño-->
                <!--condiciones medicas-->
                <!--personalidad-->
                <button class="btn waves-effect waves-light" type="submit" name="action">
                    Submit
                    <i class="material-icons right">send</i>
                </button>
            </form>
            </div>
        </div>

    </div>

    <div class="row">
    <?php
    print_r($_POST);

    $result = getDogsByAge(0,50);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            //Des-comentar cuando se hayan agregado imagenes
            //$img = "img/dog".$row["idPerro"].".jpg";
            $img = "img/Mario.jpg";
            $name = $row["nombre"];

            $m = $row["edad"];
            $a = ($m-$m%12)/12;
            $m = $m%12;

            $age= $a.' Años, '.$m.' Meses';

            $age = '';
            if($a>0){
                $age = $a.' '.($a==1?'Año':'Años');
            }
            //El $a <= 3 se puede quitar, solo es preferencia para mostrar los meses solo para perros menores a 3 años
            if($m>0 AND $a<=3){
                $age = $age.', '.$m.' '.($m==1?'Mes':'Meses');
            }

            include("_tarjetaPerro.html");

        }
    }


    include("_tarjetaPerro.html");
        include("_tarjetaPerro.html");

    ?>
    </div>
</div>


<div id="modal1" class="modal">
  <div class="modal-content">
    <h4>Modal Header</h4>
    <p>A bunch of text</p>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
  </div>
</div>


<?php include("_footer.html"); ?>
<script>
  $(document).ready(function(){
    $('.materialboxed').materialbox();
    $('.modal').modal();
  });



  let ageSlider = document.getElementById('ageSlider');
  noUiSlider.create(ageSlider, {
      start: [6, 24],
      connect: true,
      step: 1,
      tooltips: [
          {to: value => value/12<1 ? parseInt(value) + "M" :  parseInt(value/12) + "A"},
          {to: value => value/12<1 ? parseInt(value) + "M" :  parseInt(value/12) + "A"}
      ],
      range: {
          'min': [0],
          '40%': [12, 12],
          'max': [144]
      }, format: {
          // 'to' the formatted value. Receives a number.
          to:  value => value/12<1 ? parseInt(value) + " meses" :  parseInt(value/12) + " años",
          // 'from' the formatted value.
          // Receives a string, should return a number.
          from: value => Number(value.replace(' meses\|años', ''))
      }
  });
  let ageSliderValueElement = document.getElementById('ageSlider-value');
  ageSlider.noUiSlider.on('update', function (values) {
      ageSliderValueElement.innerHTML = values.join(' - ');
  });

</script>