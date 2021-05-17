<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titel der Seite | Name der Website</title>
    <link rel="stylesheet"  href= "style.css">
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">	
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    
    
    
    
    
  </head>



<script>

/*function readMouseMove(e){
	var result_x = document.getElementById('x_result');
	var result_y = document.getElementById('y_result');
	result_x.innerHTML = e.clientX;
	result_y.innerHTML = e.clientY;
}
document.onmousemove = readMouseMove;*/


const BoxHeight=60;  // siehe auch in style .blankframe
const BoxHeightOffset=20;

var projectbox="0";

var breite=0;

var deltaX=0;
var deltaY=0;

var clicking=false;
var mouseMove=false;

var NeuePositionLabelX=0;
var NeuePositionLabelY=0;

var StartpositionLabelX=0;
var StartpositionLabelY=0;

var startMouseX=0;
var startMouseY=0;

var startX=0;
var startY=0;

var startwindowWidth=0;

var projektFontSize=0;

var x0January=10;
var x0February=10;
var x0March=10;
var x0April=10;
var x0May=10;
var x0June=10;
var x0July=10;
var x0August=10;
var x0September=10;
var x0October=10;
var x0November=10;
var x0December=10;

var Row1=30;
var Row2=Row1+44;
var Row3=Row1+88;
var Row4=Row1+132;
var Row5=Row1+176;

var id_angebote;

function ChangeShowMode(Mode)
{
  console.log('Mode function ChangeShowMode ',Mode);

  if (Mode=='all') $("label").show();
  else
  {
	$("label").hide();
  	var elements = $('label:contains("' + Mode + '")');
	console.log('elements ',elements);
	$(elements).show();
  }
}

function calulateStartPointforEachMonth(Month)
{
	var StartPoint=0;
	
	var x0January=breite+"px";           	 
	var x0February=2*breite+"px";   		 
	var x0March=3*breite+"px";    			
	var x0April=4*breite+"px";				
	var x0May=5*breite+"px";				
	var x0June=6*breite+"px";				
	var x0July=7*breite+"px";				
	var x0August=8*breite+"px";			
	var x0September=9*breite+"px";			
	var x0October=10*breite+"px";			
	var x0November=11*breite+"px";			
	var x0December=12*breite+"px";

	switch (Month) {
	  case "01":StartPoint=x0January;
	        break;
	  case "02":StartPoint=x0February;
      		break;
	  case "03":StartPoint=x0March;
      		break;
	  case "04":StartPoint=x0April;
      		break;
	  case "05":StartPoint=x0May;
      		break;
	  case "06":StartPoint=x0June;
      		break;
	  case "07":StartPoint=x0July;
			break;
	  case "08":StartPoint=x0August;
			break;
	  case "09":StartPoint=x0September;
			break;
	  case "10":StartPoint=x0October;
			break;
	  case "11":StartPoint=x0November;
			break;
	  case "12":StartPoint=x0December;
			break;
	}


	return StartPoint
}

 

function SetPojektBoxX0()
{
	
	 projectValues=$("h4").text();  

	 projectValues=projectValues.split("!!!!");
	 
	 length=projectValues.length;

	for (x=0;x<length-1;x++)
	{
		Month=projectValues[x].split("-");
		
		//console.log("mm",projectValues[x]);
		//console.log("mm",Month[1]);

		Newleft=calulateStartPointforEachMonth(Month[1]);
		projectValues[x] = projectValues[x].replace(" ", "");

		//console.log("x  ",x, "valu",projectValues[x],"  ", Month[1], "  Newleft ", Newleft, " breite", breite);

		var element = $('label:contains("' + projectValues[x] + '")');
		$(element).css({left: Newleft});
		
		
	}

	

	
	
}

function readCookie(name)
{
	name=name+'=';
	
	allCookies = document.cookie; //Cookies lesen

	spli=allCookies.split(";");  // alle vorhandenen Cookies aufteilen 

	var lenght= spli.length; 

	var CookieFound=-1;

	for (x=0;x<spli.length;x++)
	{
		if (CookieFound<0)
		{
			CookieFound= spli[x].search(name);
	  		if (CookieFound>0) 
  			{    
		    	found=spli[x]; 
		    	found = found.replace(name, "");
		    	var values=found.split("%21%21%21%21");
		    	length=values.length;
		  	}
		}
	}
 return[CookieFound, values, lenght];
}


$(document).ready(function(){

	  startwindowWidth = $(window).width();
	  windowheight = $(window).height();
	  
	  
	  breite=parseInt(startwindowWidth/14);

	  lastBreite=breite; 

	  //console.log("breite:  ", breite);
	  
	  document.cookie = "Breite=" + breite; 
	  
	  /*$("h5").append("<h5  class=contacts >Contacts</h5>\
			  <h5  class=monat1 >Januar</h5> <h5  class=monat2 >Februar</h5> \
			  <h5  class=monat1 >März</h5> <h5 class=monat2 >April</h5> \
			  <h5  class=monat1 >Mai</h5> <h5  class=monat2 >Juni</h5> \
			  <h5  class=monat1 >Juli</h5> <h5 class=monat2 >August</h5> \
			  <h5  class=monat1 >September</h5> <h5  class=monat2 >Oktober</h5>\
			  <h5  class=monat1 >November</h5> <h5  class=monat2 >Dezember</h5>");*/

	  Left=0; Top=100;
	  

	  $(".blankframe").css('width',breite);
	  
	  $(".contacts").css('width',breite);	  
	  $(".monat1").css('width',breite);
	  $(".monat2").css('width',breite);

      projektFontSize=parseInt($(".projekt1").css('font-size'));


});

$(document).ready(function(){

   $(window).resize(function(){
  	 	     windowWidth = $(window).width();
		     windowheight = $(window).height();
		     		  
		     $("h5").empty();

		     breite=parseInt(windowWidth/14);
		     
		     

		     document.cookie = "Breite=" + breite; //console.log("resize",breite);

		     resizeFaktor=windowWidth/startwindowWidth;

		     FontSize=parseInt(projektFontSize*resizeFaktor);

		     

		     $(".projekt1").css('font-size', FontSize);
		     /*
		     $("h5").append("<h5  class=contacts >Contacts</h5><h5  class=monat1 >Januar</h5> <h5  class=monat2 >Februar</h5> \
					  <h5  class=monat1 >März</h5> <h5 class=monat2 >April</h5> \
					  <h5  class=monat1 >Mai</h5> <h5  class=monat2 >Juni</h5> \
					  <h5  class=monat1 >Juli</h5> <h5 class=monat2 >August</h5> \
					  <h5  class=monat1 >September</h5> <h5  class=monat2 >Oktober</h5>\
					  <h5  class=monat1 >November</h5> <h5  class=monat2 >Dezember</h5>");
			*/
		    

			 $(".blankframe").css('width',breite);
		     $(".contacts").css('width',breite);
	         $(".monat1").css('width',breite);
	         $(".monat2").css('width',breite);
	         

	         $(".monat1").css('font-size', FontSize);
	         $(".monat2").css('font-size', FontSize);
	         $(".contacts").css('font-size', FontSize);

	         SetPojektBoxX0();

	         $(".projekt1").css('font-size', FontSize);
	         $(".projekt1").css('width',breite);

	           

	         

	  //console.log("Faktor:  "+resizeFaktor+"Font: "+FontSize);

   });
});


$(document).ready(function(){
	$("label").mousedown(function() { 

		if (mouseMove===false)
		{
			clicking = true;

			projectbox=$(this);

			/*  event.pageX = Position des mouse Pointers */

			startMouseX=parseInt(event.pageX);
			startMouseY=parseInt(event.pageY);

			var Koordinaten = $(this).position();
			$(this).css('z-index','2');

			StartpositionLabelX=parseInt(Koordinaten.left);
			StartpositionLabelY=(Koordinaten.top);		
	
		}	
		
	});
});

$(document).ready(function(){
	$("Label").dblclick(function() { 
		
		
		placeOccupied=$(this).css('left'); 
		if (placeOccupied==null) {}
		else
		{
			placeOccupied=null;
		
			projectValues=$(this).text(); 
			
			projectValues=projectValues.split("-");

            id_angebote=projectValues[1];console.log( " id_angebote bei dbl", id_angebote);

		    //document.location.href = "http://localhost:8888/Mysql_PHP_Ajax/shortEditProject.php?ID="+id_angebote; 

			showDialog();
		}
		 
	});
});



$(document).ready(function(){
	$(this).mouseup(function() 
    {	
		
		placeOccupied=$(projectbox).css('left'); //console.log( " placeOccupied", placeOccupied);
		if ((placeOccupied==null) && (mouseMove)) {}
		else
		{
			/* Neue Position zum Einrasten bestimmen*/
			clicking = false;
			mouseMove=false; 
			placeOccupied=null;
		
			$(projectbox).css('border', '2px solid lightgrey', 'z-index','0');

			Xpos=parseInt($(projectbox).css('left'));
			Monat=parseInt(Xpos/breite);
		
			Xtrigger=(Monat*breite+breite-Monat*breite)*0.6+Monat*breite;

			//console.log("Monat: ", Monat, "xpos ", xpos, "Mxb+bx0.9 ", trigger,"breite ",breite);
		
			if (Xpos>Xtrigger)
			{
				Monat=Monat+1;
				NewXPosition=Monat*breite+'px';
				$(projectbox).css('left', NewXPosition);
			}
			else
			{
				NewXPosition=Monat*breite+'px';
				$(projectbox).css('left', NewXPosition);
			}

			Ypos=parseInt($(projectbox).css('top'));

			Zeile=parseInt(Ypos/BoxHeight);

			

			Ytrigger=(Zeile*BoxHeight+BoxHeight-Zeile*BoxHeight)*0.6+Zeile*BoxHeight;

			if (Ypos>Ytrigger)
			{
				Zeile=Zeile+1;
				NewYPosition=Zeile*BoxHeight+BoxHeightOffset+'px'; //console.log(NewYPosition,"  ",Zeile);
				$(projectbox).css('top', NewYPosition);
			}
			else
			{
				NewYPosition=Zeile*BoxHeight+BoxHeightOffset+'px';
				$(projectbox).css('top', NewYPosition);
			}

			// Neue Monatangabe  (Monatx) und und Zeile innerhalb der Projektmatrix in 
			// Mysql beim Anagbot mit der betreffenden ID abspeichern
		

			projectValues=$(projectbox).text(); 
		
			projectValues=projectValues.split("-");

			id_angebote=projectValues[1];
		

			Ypos=parseInt($(projectbox).css('top'));
			Zeile=parseInt(Ypos/BoxHeight);
		
			Xpos=parseInt($(projectbox).css('left'));

	
			Monatx=parseInt(Xpos/breite);

			Spalte=Monatx; 

			check="sp-"+Spalte+"-";
			var element = $('span:contains("' + check + '")');
			Datum=$(element).text();//console.log(" inhalt", Datum);

			Datum=Datum.split("-");
			Year=Datum[2]; //console.log("Year",Datum);
			Monatx=Datum[1];
			
			if (Monatx<10) Monatx='0'+Monatx;


			//console.log("doppelclick", "Monat ",Monatx, " Zeile  ", Zeile, " ID ",id_angebote );

		 
			$.ajax({
				/*update the ForecastDate of the project*/
				method:'GET',
				url:'updateMonth.php',
				data:{
		    	      Monat: Monatx, ID: id_angebote, Zeile:Zeile, Year:Year
		    	    },
			
				success: function(data)
				{
				$('#help2').text(data);
				},
				error:function(){
		    	    alert("error");}
		  
			});
		}
//----------------------
		projectbox=null;
		 
	});
	
	
});

$(document).ready(function(){
	$(this).mousemove(function(){
	    if(clicking == false) return;
	    else
	    {
	    	mouseMove=true;
	    	
			diffX=parseInt(event.pageX-startMouseX);
			diffY=parseInt(event.pageY-startMouseY);

	    	NeuePositionLabelX=StartpositionLabelX+diffX;
	    	NeuePositionLabelY=StartpositionLabelY+diffY;
			
		
			$(projectbox).css('left',NeuePositionLabelX);
    		$(projectbox).css('top' ,NeuePositionLabelY);
    		
    		$(projectbox).css('border', '3px dotted grey', 'z-index','12');
	
	    }
		
	    
	    
	    
	    
	    
	});
})


 var $dialog; 
        $(document).ready(function () {
        	
            $dialog = $( "#meinDialog") 
            
            .dialog({
            	method:'GET',
            	closeText: '',
            	modal: true,
                autoOpen: false,
                data:{Id: id_angebote},
                title: 'Deal Details',
                buttons: {
					Save: function ()
					{
			     		$(this).dialog("close");
			
					},
					Cancel: function ()
					{
 						$(this).dialog("close");

					}
		         }
            });

            
        });

        function showDialog(id) {
        	
            $dialog.dialog('open');    //$('#dialog-form').data('id', nr )dialog('open');
            return false 
        }

</script> 

<body>


<!--  

<h1>Document that reads mouse movement</h1>
<h8> id="x_result">0</h8>
-->







<nav>
  <ul>
    <li><a href="index3.php" title="Startseite">Home</a></li>
    <li class="submenu"><a href="#" title="Adresseingabe">Adressen</a>
      <ul>
        <li ><a href="eingabe.php" title="Eingabe Adressen">Eingabe Adressen</a></li>
        <li ><a href="adressenanzeigen.php" title="Anzeige Adressen">Anzeige Adressen</a></li>
      </ul>    
     </li>           
    <li class="submenu"><a href="#" title="Eingabe Sales Aktivitäten">Deals</a>
    <ul>
        <li ><a href="neuedeals.php" title="Eingabe Neuer Deal">Eingabe neuer Deal</a></li>
        <li ><a href="MyDeals.php" title="Meine Deals Text">Meine Deals</a></li>
        <li ><a href="MyDeals2.php" title="Meine Deals Graphisch">Meine Deals</a></li>
      </ul> 
    </li>
    <li><a href="#" title="So erreichen Sie uns">Kontakt</a></li>
    <li><a href="#" title="Rechtliches">Impressum</a></li>
    <li><a href="login.php" title="Login">Login</a></li>
    
    <li><a href="logout.php" title="Logout">Logout</a></li>
    
  </ul>
</nav>

<div id=LoginFeld>
       <!--  https://www.iconpacks.net/free-icon-->
        
       <h1 id="SalesLogIn">Werner Brand</h1>
       <div id="LogoPosition"> <img src="Logos/user-login-305.png" width="20" height="15"></div>

</div>  

<div id=Filter>
    <select Name="SelectKindofProject" onchange="ChangeShowMode(value)">
      <option selected  disabled hidden="" >Select Projects</option>
      <option value=all>All</option>
      <option value=Contacts>Contacts</option>
      <option value=RFIs>RFIs </option>
      <option value=Angebot>Quotations</option>
      <option value=InNegotation>In Negotation</option>
      <option value=Einkauf >Purchase Process</option>
   </select> 
      

</div>



<?php 

echo"<div id=meinDialog title='Deal Details'>";



$id_angebote=$_GET['Id'];

echo "<script>console.log('MeinDialog: ' );</script>"; 

        
        $id_angebote='"'.$id_angebote.'"';

        define ( 'MYSQL_HOST',      'localhost:3306' );
        define ( 'MYSQL_BENUTZER',  'root' );
        define ( 'MYSQL_KENNWORT',  'schooling' );
        define ( 'MYSQL_DATENBANK', 'mydb-Kunden' );

        $con = mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT,MYSQL_DATENBANK);

        if ($con )
        {
    
           //echo '<h1> Verbindung erfolgreich!....: </h1>'.'<br /><br />';
    
        $sql = "select Angebotstitel, Angebotswert, Forcast, Angebotsabgabe, Wahrscheinlichkeit, SalesStatus, Angebotsnummer
            from Angebote where idAngebote=$id_angebote";
    
        }



            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);

            $value=$Currency.number_format($row[Angebotswert], 0, ',', '.');


            echo"<form >

                <div class=FormularShortEditProject>

                     <label id='AngTi' >Quotation Title :</label>
                     <span><input id='Angtitel' type='text' value=$row[Angebotstitel]> </span></br>
    
                    <label id='AngW' > Quotation Value:</label>
                    <span><input id='Angswert' type='text' value=$value> </span></br>
    
                    <label id='Forecast'> Date Forecast:</label>
                    <span><input id='Datum_Forecast' type='text' value=$row[Forcast] > </span></br>
    
                    <label id='AngCha'> Chance:</label>
                    <span><input id='AngChance' type='text' value=$row[Wahrscheinlichkeit]> </span></br>
    
                    <label id='AngDateOfQuo'> Date of Quotation:</label>
                    <span><input id='AngDateOfQuotation' type='text' value=$row[Angebotsabgabe]> </span></br>
    
                    <select Name='SalesStatus' size=6>
                    <option selected  disabled hidden='' >Select an Option</option>";

                        echo"<option";  if ($row[SalesStatus]=='Contacts')      {echo" selected value=Contacts>Contacts</option>";}           else {echo" value=Contacts>Contacts</option>";}
                        echo"<option";  if ($row[SalesStatus]=='RFIs')          {echo" selected value=RFIs>RFIs</option>"; }                  else {echo" value=RFIs>RFIs</option>";}
                        echo"<option";  if ($row[SalesStatus]=='Quotations')      {echo" selected value=Quotations>Quotations</option>";}     else {echo" value=Quotations>Quotations</option>";}
                        echo"<option";  if ($row[SalesStatus]=='Negotations')     {echo" selected value=Negotations>Negotations</option>";}   else {echo" value=Negotations>Negotations</option>";}
                        echo"<option";  if ($row[SalesStatus]=='PurchaseProcess') {echo" selected value=PurchaseProcess>PurchaseProcess</option>";}   else {echo" value=PurchaseProcess>PurchaseProcess</option>";}
                        echo"</select>
	            </form >
	      
	      
            </div>";



            mysqli_close($con);


echo"</div>";














//$showMode=filter_var($_GET['q'], FILTER_SANITIZE_STRING);;echo "<script>console.log('$showMode: " . $showMode . "' );</script>"; 

$Matrix=array();

include 'Settings.php';



function SetProject($AngebotsTitel, $SalesStatus, $NameFirma, $idAngebote, $Value)


{
    global $Currency,$width, $Monthforecast,$Row, $YPos, $ID ;
    
        echo"<label class=projekt1 style='left: $Row; width:$width; top:$YPos;'>
                    $NameFirma<br>$AngebotsTitel<br>$Currency$Value<br>
                    $SalesStatus
                    
                    <span style='font-size:7px;'>-$idAngebote-$Monthforecast </span>
                    
             </label>";
                    
                    $ID=$ID.$idAngebote.'-'.$Monthforecast.'!!!!'; 
}



error_reporting(E_ALL);
//Version 1.0
// Zum Aufbau der Verbindung zur Datenbank
define ( 'MYSQL_HOST',      'localhost:3306' );
define ( 'MYSQL_BENUTZER',  'root' );
define ( 'MYSQL_KENNWORT',  'schooling' );
define ( 'MYSQL_DATENBANK', 'mydb-Kunden' );

$db_link = mysqli_connect (MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT,MYSQL_DATENBANK);

if ( $db_link )
{
    // secho '<h1> Verbindung erfolgreich!....: </h1>'."<br /><br />";
    //print_r( $db_link);
    $SalesID="3";
    $SalesID='"'.$SalesID.'"';
  
    $sql = "select Zeile, idFirmen, idAnsprechpartner, idAngebote, NameFirma, Angebotstitel, Angebotswert, Forcast, Wahrscheinlichkeit, SalesStatus, Angebotsnummer
            from Angebote, Ansprechpartner,Firma, Sales 
            where (Firma_idfirmen=idfirmen) and (Ansprechpartner_idAnsprechpartner=idAnsprechpartner) 
                   and Angebote.Sales_idSales=idSales and Angebote.Sales_idSales=$SalesID;

";
   
    //$width = "<script>var $(window).width(); </script>";
    //$width = "<script>var windowWidth = screen.width; document.writeln(windowWidth); </script>";
    //$height = "<script>var windowHeight = screen.height; document.writeln(windowHeight); </script>";
    
    if(document.cookie)
    {
        //echo"Cookie exist! <br>";
        //echo"$_COOKIE[Breite]";
        $width=$_COOKIE[Breite];
    }
    else echo"No Cookie found";
    
    

    $x0Column1=$width;
    $x0Column2=2*$width;  
    $x0Column3=3*$width;
    $x0Column4=4*$width;
    $x0Column5=5*$width;
    $x0Column6=6*$width;
    $x0Column7=7*$width;
    $x0Column8=8*$width;  
    $x0Column9=9*$width;
    $x0Column10=10*$width;
    $x0Column11=11*$width;
    $x0Column12=12*$width;

    echo"<h3 id=help2>  </h3>";
    
    
echo" <div class=Forecast>
        <h5>       </h5>
        <h6>       </h6>
	    <label>    </label>";
       

$ID=''; 

/* Build up Matrix to checklater which field are occupied

for ($MatrixY=0;$MatrixY<11;$MatrixY++)
{   echo"<br>$MatrixY:";

    for ($MatrixX=0; $MatrixX<13; $MatrixX++)
    {
      $Matrix[$MatrixX][$MatrixY]=0;
      $value=$Matrix[$MatrixX][$MatrixY];
    
      echo"$value-";
    }

}*/

/* Build up Projectplan  */

for ($y=0; $y<11; $y++)
{
    $NewTop=($y*$BoxHeight+$BoxHeightOffset).'px';
    
    for ($x=0; $x<13; $x++)
    {
        $NewLeft=($x*$width).'px';
        echo" <h1 class=blankframe style= 'left: $NewLeft; top:$NewTop;'>  </h1>";
    }
}

/* Build up Row with 12 Months  */

$MonthTitel=array('Contacts', 'January','February','March','April','May','June','July', 'August','September','October','November','December');

$Year=date('Y');
$MonthToday = date("m");
$spalte=1;$spalte2=-1;

for ($x=0; $x<13; $x++)
{
    ++$spalte2;
    $widthx=$width.'px';
    
    $NewLeft=($x*$width).'px';
    if ($x==0) echo"<h5  class=monat1 style= 'width:$widthx; left: $NewLeft;'>Contacts</h5>";
    else 
    {
        $xMonth=$spalte+$MonthToday-1;
        if ($xMonth>12) 
        {
            $xMonth=1;
            $spalte=1;
            $MonthToday=1;
            $Year=$Year+1;
        }
         $spalte=$spalte+1;
         
         
         
         switch ($xMonth){
             case '01':echo"<h5  class=monat2 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '02':echo"<h5  class=monat3 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '03':echo"<h5  class=monat4 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '04':echo"<h5  class=monat5 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '05':echo"<h5  class=monat6 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '06':echo"<h5  class=monat7 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '07':echo"<h5  class=monat8 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '08':echo"<h5  class=monat9 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '09':echo"<h5  class=monat10 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '10':echo"<h5  class=monat11 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '11':echo"<h5  class=monat12 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
             case '12':echo"<h5  class=monat13 style= 'width:$widthx; left: $NewLeft;'>$MonthTitel[$xMonth] <span style='font-size:0px;'>-$xMonth-$Year-sp-$spalte2-</span> </h5>";break;
         }
     }
    
}

$width=$width."px";

 foreach ($db_link->query($sql) as $row) 
    {
        $datum=$row[Forcast];
        
        
        $components = preg_split("/-/", $datum); 

        $Yearforecast=$components[0];
        $Monthforecast=$components[1]; 
        $MonthToday=date('m');
        
        
        if ($Yearforecast==Date('Y'))
        {
            $ShowMonth=$Monthforecast-$MonthToday+1;  
            if ($ShowMonth>0)
            {
                switch ($ShowMonth)
                {
                case '01': $Row=$x0Column1;break;
                case '02': $Row=$x0Column2;break;
                case '03': $Row=$x0Column3;break;
                case '04': $Row=$x0Column4;break;
                case '05': $Row=$x0Column5;break;
                case '06': $Row=$x0Column6;break;
                case '07': $Row=$x0Column7;break;;
                case '08': $Row=$x0Column8;break;
                case '09': $Row=$x0Column9;break;
                case '10': $Row=$x0Column10;break;
                case '11': $Row=$x0Column11;break;
                case '12': $Row=$x0Column12;break;
            }
          }
        }
        if ($Yearforecast==Date('Y')+1)
        {
            $ShowMonth=$Monthforecast+8; //echo "<script>console.log('$ShowMonth: " . $ShowMonth . "' );</script>"; 
            switch ($ShowMonth)
            {
                case '01': $Row=$x0Column1;break;
                case '02': $Row=$x0Column2;break;
                case '03': $Row=$x0Column3;break;
                case '04': $Row=$x0Column4;break;
                case '05': $Row=$x0Column5;break;
                case '06': $Row=$x0Column6;break;
                case '07': $Row=$x0Column7;break;;
                case '08': $Row=$x0Column8;break;
                case '09': $Row=$x0Column9;break;
                case '10': $Row=$x0Column10;break;
                case '11': $Row=$x0Column11;break;
                case '12': $Row=$x0Column12;break;
            }
        }
        if ($Yearforecast>Date('Y')+1)
        {
           
        }
    
        
        if ($row[SalesStatus] == 'Kontakt') 
        {
            $Row='0'; 
        }
        
        $Row=$Row."px";
        
        $YPos=$row[Zeile]*$BoxHeight+$BoxHeightOffset.'px';
        
        $Value=number_format($row[Angebotswert], 0, ',', '.');
        
        SetProject($row[Angebotstitel], $row[SalesStatus], $row[NameFirma], $row[idAngebote],$Value);
     
    }
    
    
    echo"</div>";
    echo"<h4 id=Infozentrale> $ID </h4>";
    echo"
   
  </div>";
 
 
    
}
mysqli_close($db_link);
    ?>
    


</body>
</html>



