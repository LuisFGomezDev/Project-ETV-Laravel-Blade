<h3>MENU OPCION</h3>
 <ul>
<?PHP
$tempCarp="";

while(list($key,$datoMen)=each($menuRow)){
    
    if($tempCarp!=$datoMen['idPadre'])//Si $datoMen NO esta vacio Entonces
    {
        if($tempCarp!="")
            echo "</ul></li>";
        ?>
         <li>
            
                <span <?PHP if($_GET['carp'] == $datoMen['idPadre']){echo 'class="current"';} ?>><a href="<?PHP echo $datoMen['linkPadre']; ?>" id="<?PHP echo $datoMen['clasPadre']; ?>"><?PHP echo $datoMen['nomPadre']; ?></a></span>
           <ul>
        <?PHP
        
        $tempCarp=$datoMen['idPadre'];
    }
    
        //En esta seccion dibujara los hijos por cada padre idPadre
        ?>
               
         <li><a href="<?PHP echo $datoMen['hijoLink']."&carp=".$datoMen['idPadre']; ?>" class="<?PHP echo $datoMen['hijoClas']; ?>"><?PHP echo $datoMen['hijoNombre']; ?></a></li>
        <?PHP
    
    
}

echo "</ul></li>";

?>
            <li>
                <span <?PHP if($_GET['carp'] == "usuarios"){echo 'class="current"';} ?>>
                    <?PHP
                     if(!empty($_SESSION['usuario_url']))
                     {
                      ?><a href="./index.php?<?PHP echo $_SESSION['usuario_url']; ?>" id="link-salir">Salir</a><?PHP   
                     }
                     // elseif($_SESSION['usuario_perfil']!='V'){
                    ?>
                    <a href="./index2.php?cerrar_s=Okay" id="link-salir">Salir</a>
                    <?PHP
                      //}
                    ?>
                </span>
            </li>	
</ul>